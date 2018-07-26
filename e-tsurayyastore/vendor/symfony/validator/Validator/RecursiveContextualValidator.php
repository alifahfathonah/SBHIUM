<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\NoSuchMetadataException;
use Symfony\Component\Validator\Exception\RuntimeException;
use Symfony\Component\Validator\Exception\UnsupportedMetadataException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Mapping\CascadingStrategy;
use Symfony\Component\Validator\Mapping\ClassMetadataInterface;
use Symfony\Component\Validator\Mapping\GenericMetadata;
use Symfony\Component\Validator\Mapping\MetadataInterface;
use Symfony\Component\Validator\Mapping\PropertyMetadataInterface;
use Symfony\Component\Validator\Mapping\TraversalStrategy;
use Symfony\Component\Validator\MetadataFactoryInterface;
use Symfony\Component\Validator\ObjectInitializerInterface;
use Symfony\Component\Validator\Util\PropertyPath;

/**
 * Recursive implementation of {@link ContextualValidatorInterface}.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class RecursiveContextualValidator implements ContextualValidatorInterface
{
    /**
     * @var ExecutionContextInterface
     */
    private $context;

    /**
     * @var string
     */
    private $defaultPropertyPath;

    /**
     * @var array
     */
    private $defaultGroups;

    /**
     * @var MetadataFactoryInterface
     */
    private $metadataFactory;

    /**
     * @var ConstraintValidatorFactoryInterface
     */
    private $validatorFactory;

    /**
     * @var ObjectInitializerInterface[]
     */
    private $objectInitializers;

    /**
     * Creates a validator for the given context.
     *
     * @param ExecutionContextInterface           $context            The execution context
     * @param MetadataFactoryInterface            $metadataFactory    The factory for
     *                                                                fetching the metadata
     *                                                                of validated objects
     * @param ConstraintValidatorFactoryInterface $validatorFactory   The factory for creating
     *                                                                constraint validators
     * @param ObjectInitializerInterface[]        $objectInitializers The object initializers
     */
    public function __construct(ExecutionContextInterface $context, MetadataFactoryInterface $metadataFactory, ConstraintValidatorFactoryInterface $validatorFactory, array $objectInitializers = array())
    {
        $this->context = $context;
        $this->defaultPropertyPath = $context->getPropertyPath();
        $this->defaultGroups = array($context->getGroup() ?: Constraint::DEFAULT_GROUP);
        $this->metadataFactory = $metadataFactory;
        $this->validatorFactory = $validatorFactory;
        $this->objectInitializers = $objectInitializers;
    }

    /**
     * {@inheritdoc}
     */
    public function atPath($path)
    {
        $this->defaultPropertyPath = $this->context->getPropertyPath($path);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, $constraints = null, $groups = null)
    {
        $groups = $groups ? $this->normalizeGroups($groups) : $this->defaultGroups;

        $previousValue = $this->context->getValue();
        $previousObject = $this->context->getObject();
        $previousMetadata = $this->context->getMetadata();
        $previousPath = $this->context->getPropertyPath();
        $previousGroup = $this->context->getGroup();

        // If explicit constraints are passed, validate the value against
        // those constraints
        if (null !== $constraints) {
            // You can pass a single constraint or an array of constraints
            // Make sure to deal with an array in the rest of the code
            if (!is_array($constraints)) {
                $constraints = array($constraints);
            }

            $metadata = new GenericMetadata();
            $metadata->addConstraints($constraints);

            $this->validateGenericNode(
                $value,
                null,
                is_object($value) ? spl_object_hash($value) : null,
                $metadata,
                $this->defaultPropertyPath,
                $groups,
                null,
                TraversalStrategy::IMPLICIT,
                $this->context
            );

            $this->context->setNode($previousValue, $previousObject, $previousMetadata, $previousPath);
            $this->context->setGroup($previousGroup);

            return $this;
        }

        // If an object is passed without explicit constraints, validate that
        // object against the constraints defined for the object's class
        if (is_object($value)) {
            $this->validateObject(
                $value,
                $this->defaultPropertyPath,
                $groups,
                TraversalStrategy::IMPLICIT,
                $this->context
            );

            $this->context->setNode($previousValue, $previousObject, $previousMetadata, $previousPath);
            $this->context->setGroup($previousGroup);

            return $this;
        }

        // If an array is passed without explicit constraints, validate each
        // object in the array
        if (is_array($value)) {
            $this->validateEachObjectIn(
                $value,
                $this->defaultPropertyPath,
                $groups,
                true,
                $this->context
            );

            $this->context->setNode($previousValue, $previousObject, $previousMetadata, $previousPath);
            $this->context->setGroup($previousGroup);

            return $this;
        }

        throw new RuntimeException(sprintf(
            'Cannot validate values of type "%s" automatically. Please '.
            'provide a constraint.',
            gettype($value)
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function validateProperty($object, $propertyName, $groups = null)
    {
        $classMetadata = $this->metadataFactory->getMetadataFor($object);

        if (!$classMetadata instanceof ClassMetadataInterface) {
            // Cannot be UnsupportedMetadataException because of BC with
            // Symfony < 2.5
            throw new ValidatorException(sprintf(
                'The metadata factory should return instances of '.
                '"\Symfony\Component\Validator\Mapping\ClassMetadataInterface", '.
                'got: "%s".',
                is_object($classMetadata) ? get_class($classMetadata) : gettype($classMetadata)
            ));
        }

        $propertyMetadatas = $classMetadata->getPropertyMetadata($propertyName);
        $groups = $groups ? $this->normalizeGroups($groups) : $this->defaultGroups;
        $cacheKey = spl_object_hash($object);
        $propertyPath = PropertyPath::append($this->defaultPropertyPath, $propertyName);

        $previousValue = $this->context->getValue();
        $previousObject = $this->context->getObject();
        $previousMetadata = $this->context->getMetadata();
        $previousPath = $this->context->getPropertyPath();
        $previousGroup = $this->context->getGroup();

        foreach ($propertyMetadatas as $propertyMetadata) {
            $propertyValue = $propertyMetadata->getPropertyValue($object);

            $this->validateGenericNode(
                $propertyValue,
                $object,
                $cacheKey.':'.$propertyName,
                $propertyMetadata,
                $propertyPath,
                $groups,
                null,
                TraversalStrategy::IMPLICIT,
                $this->context
            );
        }

        $this->context->setNode($previousValue, $previousObject, $previousMetadata, $previousPath);
        $this->context->setGroup($previousGroup);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function validatePropertyValue($objectOrClass, $propertyName, $value, $groups = null)
    {
        $classMetadata = $this->metadataFactory->getMetadataFor($objectOrClass);

        if (!$classMetadata instanceof ClassMetadataInterface) {
            // Cannot be UnsupportedMetadataException because of BC with
            // Symfony < 2.5
            throw new ValidatorException(sprintf(
                'The metadata factory should return instances of '.
                '"\Symfony\Component\Validator\Mapping\ClassMetadataInterface", '.
                'got: "%s".',
                is_object($classMetadata) ? get_class($classMetadata) : gettype($classMetadata)
            ));
        }

        $propertyMetadatas = $classMetadata->getPropertyMetadata($propertyName);
        $groups = $groups ? $this->normalizeGroups($groups) : $this->defaultGroups;

        if (is_object($objectOrClass)) {
            $object = $objectOrClass;
            $cacheKey = spl_object_hash($objectOrClass);
            $propertyPath = PropertyPath::append($this->defaultPropertyPath, $propertyName);
        } else {
            // $objectOrClass contains a class name
            $object = null;
            $cacheKey = null;
            $propertyPath = $this->defaultPropertyPath;
        }

        $previousValue = $this->context->getValue();
        $previousObject = $this->context->getObject();
        $previousMetadata = $this->context->getMetadata();
        $previousPath = $this->context->getPropertyPath();
        $previousGroup = $this->context->getGroup();

        foreach ($propertyMetadatas as $propertyMetadata) {
            $this->validateGenericNode(
                $value,
                $object,
                $cacheKey.':'.$propertyName,
                $propertyMetadata,
                $propertyPath,
                $groups,
                null,
                TraversalStrategy::IMPLICIT,
                $this->context
            );
        }

        $this->context->setNode($previousValue, $previousObject, $previousMetadata, $previousPath);
        $this->context->setGroup($previousGroup);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getViolations()
    {
        return $this->context->getViolations();
    }

    /**
     * Normalizes the given group or list of groups to an array.
     *
     * @param mixed $groups The groups to normalize
     *
     * @return array A group array
     */
    protected function normalizeGroups($groups)
    {
        if (is_array($groups)) {
            return $groups;
        }

        return array($groups);
    }
    /**
     * Validates an object against the constraints defined for its class.
     *
     * If no metadata is available for the class, but the class is an instance
     * of {@link \Traversable} and the selected traversal strategy allows
     * traversal, the object will be iterated and each nested object will be
     * validated instead.
     *
     * @param object                    $object            The object to cascade
     * @param string                    $propertyPath      The current property path
     * @param string[]                  $groups            The validated groups
     * @param int                       $traversalStrategy The strategy for traversing the
     *                                                     cascaded object
     * @param ExecutionContextInterface $context           The current execution context
     *
     * @throws NoSuchMetadataException      If the object has no associated metadata
     *                                      and does not implement {@link \Traversable}
     *                                      or if traversal is disabled via the
     *                                      $traversalStrategy argument
     * @throws UnsupportedMetadataException If the metadata returned by the
     *                                      metadata factory does not implement
     *                                      {@link ClassMetadataInterface}
     */
    private function validateObject($object, $propertyPath, array $groups, $traversalStrategy, ExecutionContextInterface $context)
    {
        try {
            $classMetadata = $this->metadataFactory->getMetadataFor($object);

            if (!$classMetadata instanceof ClassMetadataInterface) {
                throw new UnsupportedMetadataException(sprintf(
                    'The metadata factory should return instances of '.
                    '"Symfony\Component\Validator\Mapping\ClassMetadataInterface", '.
                    'got: "%s".',
                    is_object($classMetadata) ? get_class($classMetadata) : gettype($classMetadata)
                ));
            }

            $this->validateClassNode(
                $object,
                spl_object_hash($object),
                $classMetadata,
                $propertyPath,
                $groups,
                null,
                $traversalStrategy,
                $context
            );
        } catch (NoSuchMetadataException $e) {
            // Rethrow if not Traversable
            if (!$object instanceof \Traversable) {
                throw $e;
            }

            // Rethrow unless IMPLICIT or TRAVERSE
            if (!($traversalStrategy & (TraversalStrategy::IMPLICIT | TraversalStrategy::TRAVERSE))) {
                throw $e;
            }

            $this->validateEachObjectIn(
                $object,
                $propertyPath,
                $groups,
                $traversalStrategy & TraversalStrategy::STOP_RECURSION,
                $context
            );
        }
    }

    /**
     * Validates each object in a collection against the constraints defined
     * for their classes.
     *
     * If the parameter $recursive is set to true, nested {@link \Traversable}
     * objects are iterated as well. Nested arrays are always iterated,
     * regardless of the value of $recursive.
     *
     * @param array|\Traversable        $collection    The collection
     * @param string                    $propertyPath  The current property path
     * @param string[]                  $groups        The validated groups
     * @param bool                      $stopRecursion Whether to disable
     *                                                 recursive iteration. For
     *                                                 backwards compatibility
     *                                                 with Symfony < 2.5.
     * @param ExecutionContextInterface $context       The current execution context
     *
     * @see ClassNode
     * @see CollectionNode
     */
    private function validateEachObjectIn($collection, $propertyPath, array $groups, $stopRecursion, ExecutionContextInterface $context)
    {
        if ($stopRecursion) {
            $traversalStrategy = TraversalStrategy::NONE;
        } else {
            $traversalStrategy = TraversalStrategy::IMPLICIT;
        }

        foreach ($collection as $key => $value) {
            if (is_array($value)) {
                // Arrays are always cascaded, independent of the specified
                // traversal strategy
                // (BC with Symfony < 2.5)
                $this->validateEachObjectIn(
                    $value,
                    $propertyPath.'['.$key.']',
                    $groups,
                    $stopRecursion,
                    $context
                );

                continue;
            }