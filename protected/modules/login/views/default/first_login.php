<div class="row well">
	<h4><?= Yii::t('profile','changePassForm') ?></h4>
	<p><?= Yii::t('profile','firstLoginChangePass') ?></p>
	<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'changepass-form',
            'htmlOptions'=>array('class'=>'form-horizontal r-validate'),
	));
		if($err==1):
	?>
	<div class="alert alert-success">
		<?= 'Password successfully changed' ?>
	</div>
	<?php endif;
		if(is_array($err)):
		$this->widget('application.widgets.logic.ErrorHandling'
                        ,array('ws'=>$err['ws'],
                        'errNo'=>$err['errNo'],
                        'errCodeStr'=>$err['errCodeStr'],
                        'errString'=>$err['errString'],
                        'solution'=>$err['solution'],
                        'errLocation'=>$err['errLocation'],
			'errParams'=>isset($err['errParams'])?$err['errParams']:''));
	endif; ?>
       <div class="control-group">
            <?= $form->labelEx($model,'oldPassword',array('class'=>'control-label')); ?>
            <div class="controls">
              <?php echo $form->passwordField($model,'oldPassword',array('class'=>'input-large')); ?>
            </div>                
        </div>
        <div class="control-group">
            <?= $form->labelEx($model,'newPassword',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'newPassword',array('class'=>'input-large')); ?>
            </div>
        </div>
        <div class="control-group">
            <?= $form->labelEx($model,'confirmPassword',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'confirmPassword',array('class'=>'input-large')); ?>
            </div>
        </div>
	  <div class="control-group">
		<label class="control-label">&nbsp;</label>
		<div class="controls">
		    <button class="btn btn-primary"><?= Yii::t('profile','btnChangePass') ?></button>
		</div>                    
	    </div>
	<?php $this->endWidget(); ?>
</div>