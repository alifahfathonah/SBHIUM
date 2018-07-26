<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Barang <small><?php @$model->saveType=='add'?'Tambah Barang':'Edit Barang' ?></small></h2>
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
		   	$form->hiddenField($model,'id_barang');

          ?>
          	<?php if($model->saveType=='add'): ?>
	          	<legend><h3>Tambah Barang</h3></legend>
	        <?php else: ?>
	          	<legend><h3>Edit Barang</h3></legend>
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
               		<?= $form->labelEx($model,'kode_barang',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    	<?php echo $form->textField($model,'kode_barang',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Kode Barang','required'=>'required')); ?>
          				<?php echo $form->error($model,'kode_barang'); ?>
                  	</div>
              	</div>
                <div class="form-group">
                  <?= $form->labelEx($model,'nama_barang',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'nama_barang',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Nama Barang','required'=>'required')); ?>
                  <?php echo $form->error($model,'nama_barang'); ?>
                    </div>
                </div>
              	<div class="form-group">
               		<?= $form->labelEx($model,'keterangan',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    	<?php echo $form->textArea($model,'keterangan',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Keterangan','required'=>'required')); ?>
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
                    <a href="<?= Yii::app()->createUrl('admin/barang') ?>" class="btn btn-default">Cancel</a>
		            </div>
		          </div>
	   		  </div>
        <?php $this->endWidget(); ?>
      </div>
  	</div>
  </div>
</div>