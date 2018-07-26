<div class="row-fluid">
    <div class="span3">
    </div>
    <div class="span9" style="margin-left:-25px; margin-top: -480px;">
     <div class="block">
            <div class="navbar navbar-inner block-header">
                <?php if($model->saveType=='add'): ?>
                <div class="muted pull-left">Add Menu</div>
                <?php elseif($model->saveType=='add_main'): ?>
                <div class="muted pull-left">Add main Menu</div>
                <?php endif; ?>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                     <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'menu-form',
                        'htmlOptions'=>array('class'=>'form-horizontal')
                        ));
                            echo $form->hiddenField($model,'saveType');
                        if($model->saveType=='add_main'){
                            echo $form->hiddenField($model,'parentid').$form->hiddenField($model,'redirectTo').$form->hiddenField($model,'link');
                        }
                    ?>
                        <?php if($model->saveType=='add'):
                            echo $form->hiddenField($model,'parentid').$form->hiddenField($model,'redirectTo');
                        ?>
                        <div class="control-group" >
                            <?php echo $form->labelEx($model,'parentname',array('class'=>'control-label')); ?>
                            <div class="controls">
                               <?php echo $form->textField($model,'parentname',array('disabled'=>'disabled')); ?>
                            </div>
                        </div>
                        <?php elseif ($model->saveType=='edit'): ?>
                        <div class="control-group" >
                            <?php echo $form->labelEx($model,'parentid',array('class'=>'control-label')); ?>
                            <div class="controls">
                               <?php echo $form->dropDownList($model,'parentid',$model->dataSource('parentmenu'),array('empty'=>'No Parent')); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="control-group" >
                            <?php echo $form->labelEx($model,'sort',array('class'=>'control-label')); ?>
                            <div class="controls">
                               <?php echo $form->textField($model,'sort',array('required'=>'required','placeholder'=>'Sort'));
                                echo $form->error($model,'sort');?>
                            </div>
                        </div>
                        <div class="control-group" >
                            <?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
                            <div class="controls">
                               <?php echo $form->textField($model,'title',array('required'=>'required','placeholder'=>'Title'));
                                echo $form->error($model,'title');?>
                            </div>
                        </div>
                        <?php if($model->saveType!=='add_main'):?>
                            <?php if(!empty($model->link)): ?>
                               <div class="control-group">
                                    <?= $form->labelEx($model,'link',array('class'=>'control-label','for'=>'')); ?>
                                    <div class="controls">
                                        <?php echo $form->textField($model,'link',array('class'=>'input-xlarge')); ?>&nbsp;&nbsp;&nbsp;<a class="fancy btn" href="<?= $this->createUrl('/admin/menu/browse') ?>"><i class="icon-folder-open"></i></a>
                                        <?php echo $form->error($model,'link'); ?><br>
                                        <em style="color:#AAA">Use 'http://' for external sites</em>
                                    </div>
                                </div>
                              <?php else: ?>
                                <div class="control-group">
                                    <?= $form->labelEx($model,'link',array('class'=>'control-label','for'=>'')); ?>
                                    <div class="controls">
                                        <?php echo $form->textField($model,'link',array('class'=>'input-xlarge','value'=>'#')); ?>
                                        <?php echo $form->error($model,'link'); ?>
                                        <em style="color:#AAA">Use 'http://' for external sites</em>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif;?>
                         <div class="form-actions">
                            <?php if(($model->saveType=='add') || ($model->saveType=='add_main')): ?>
                            <a class="btn btn-primary" onclick="$('#MenuutamaForm_redirectTo').val('/admin/menu');$('#menu-form').submit();">Save</a>
                            <button class="btn btn-primary">Save then add another</button>
                            <?php elseif($model->saveType=='edit'): ?>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif; ?>
                            <a href="<?= Yii::app()->createUrl('admin/menu') ?>" class="btn">Cancel</a>
                        </div>    
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
 </div>

<script type="text/javascript">
$('.fancy').fancybox({
        type:'ajax',
        width:'auto'
    });
</script>