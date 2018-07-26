<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Investor <small><?php @$model->saveType=='add'?'Tambah Investor':'Edit Investor' ?></small></h2>
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
                $form->hiddenField($model,'Password').
                $form->hiddenField($model,'role').
                $form->hiddenField($model,'IsActive').
                $form->hiddenField($model,'userid');

          ?>
            <?php if($model->saveType=='add'): ?>
              <legend><h3>Tambah User</h3></legend>
          <?php else: ?>
              <legend><h3>Edit User</h3></legend>
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
                  <?= $form->labelEx($model,'username',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'username',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'username','required'=>'required')); ?>
                  <?php echo $form->error($model,'username'); ?>
                    </div>
                </div>
                <?php if($model->saveType =='add'):?>
                <div class="form-group">
                  <?= $form->labelEx($model,'Password',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->passwordField($model,'Password',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Password','required'=>'required')); ?>
                  <?php echo $form->error($model,'Password'); ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="form-group">
                  <?= $form->labelEx($model,'email',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'email',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'email','required'=>'required')); ?>
                  <?php echo $form->error($model,'email'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'Fullname',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'Fullname',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Fullname','required'=>'required')); ?>
                  <?php echo $form->error($model,'Fullname'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'Phone',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->numberField($model,'Phone',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Phone','required'=>'required')); ?>
                  <?php echo $form->error($model,'Phone'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'City',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'City',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'City','required'=>'required')); ?>
                  <?php echo $form->error($model,'City'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'nama_bank',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->textField($model,'nama_bank',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'Bank','required'=>'required')); ?>
                  <?php echo $form->error($model,'nama_bank'); ?>
                    </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'rek_bank',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $form->numberField($model,'rek_bank',array('class'=>'form-control col-md-7 col-xs-12','placeholder'=>'No Rekening','required'=>'required')); ?>
                  <?php echo $form->error($model,'rek_bank'); ?>
                    </div>
                </div>
                <?php if($model->saveType =='add'):?>
                <div class="form-group">
                  <?= $form->labelEx($model,'IsActive',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                  <div class="radio">
                    <label>
                        <?php                  
                          echo $form->radioButtonList($model,'IsActive',array('1'=>'True', '0'=>'False'),array('separator'=>'','required'=>'required','class'=>'flat'));
                          echo $form->error($model,'IsActive');
                        ?>
                      </label>
                  </div>
                </div>
                <div class="form-group">
                  <?= $form->labelEx($model,'role',array('class'=>'control-label col-md-3 col-sm-3 col-xs-12','for'=>'')); ?>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="radio">
                      <label>
                          <?php                  
                            echo $form->radioButtonList($model,'role',$model->dataSource('role'),array('separator'=>'','required'=>'required','class'=>'flat'));
                            echo $form->error($model,'role');
                          ?>
                        </label>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              <div class="form-group">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?php if($model->saveType=='add'): ?>
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i>Save</button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-primary"><i class="icon-ok"></i>Edit</button>
                    <?php endif; ?>
                    <?php if(isset($_GET['referrer'])):?>
                    <a href="<?= Yii::app()->createUrl('admin/users/profile/i/'.$_GET['i'].'') ?>" class="btn btn-default">Cancel</a>
                    <?php else:?>
                    <a href="<?= Yii::app()->createUrl('admin/users') ?>" class="btn btn-default">Cancel</a>
                  <?php endif;?>
                </div>
              </div>
          </div>
        <?php $this->endWidget(); ?>
      </div>
    </div>
  </div>
</div>