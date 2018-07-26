<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Slot <small><?php @$model->saveType=='add'?'Tambah Slot':'Edit Slot' ?></small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'add-follow-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class'=>'form-horizontal form-label-left','data-parsley-validate'),
                ));
            echo $form->hiddenField($model,'saveType').
		   	$form->hiddenField($model,'id_slot');

          ?>
          	<?php if($model->saveType=='add'): ?>
	          	<legend><h3>Input Slot</h3></legend>
	        <?php else: ?>
	          	<legend><h3>Edit Slot</h3></legend>
	        <?php endif; ?>

              <?php if(Yii::app()->user->hasFlash('Succes')): ?>
                <div class="alert alert-info" >
                    <?php echo Yii::app()->user->getFlash('Succes'); ?>
                </div>
              <?php endif; ?>
              <?php if(Yii::app()->user->hasFlash('Error')): ?>
                <div class="alert alert-danger" >
                    <?php echo Yii::app()->user->getFlash('Error'); ?>
                </div>
              <?php endif; ?>
                <div class="form-group">
                  <?= $form->labelEx($model,'userid',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->dropDownList($model,'userid',$model->dataSource('investor'),array('empty'=>'--Please Select--','class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Nama Investor','required'=>'required')); ?>
                  <?php echo $form->error($model,'userid'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'debit',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->numberField($model,'debit',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Debit')); ?>
                  <?php echo $form->error($model,'debit'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'kredit',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->numberField($model,'kredit',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Kredit')); ?>
                  <?php echo $form->error($model,'kredit'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'input_date',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'input_date',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Tanggal Input','required'=>'required')); ?>
                  <?php echo $form->error($model,'input_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'active_date',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'active_date',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Tanggal Active','required'=>'required')); ?>
                  <?php echo $form->error($model,'active_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'keterangan',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textArea($model,'keterangan',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Keterangan')); ?>
                  <?php echo $form->error($model,'keterangan'); ?>
                    </div>
                </div>
              <div class="form-group">
              <div class="ln_solid"></div>
		          <div class="form-group">
		            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		            <?php if($model->saveType=='add'): ?>
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i>Save</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i>Edit</button>
                    <?php endif; ?>
                    <a href="<?= Yii::app()->createUrl('admin/slot') ?>" class="btn btn-default">Cancel</a>
		            </div>
		          </div>
	   		  </div>
        <?php $this->endWidget(); ?>
      </div>
  	</div>
  </div>
</div>

<script type="text/javascript">
  $('#SlotForm_input_date').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4",
          format: 'DD/MM/YYYY',
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
  $('#SlotForm_active_date').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4",
          format: 'DD/MM/YYYY',
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
</script>