<div class="content">
    <div class="page_wrapper"> 
        <div class="page_wrapper_inner">

            <div class="main_title_wrapper">
                <div class="page_title_wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="span12">
                                <div class="page_title_inner">                      
                                    <span class="main_t_1"> Login Form </span>
                                    <span class="main_t_2">Untuk akses admin panel</span>

                                <div class="clear"></div>    
                                    <!-- Login Form -->
                                <span class="main_t_2" style="padding-top: 100px;">
                                    <?php 
                                        $form=$this->beginWidget('CActiveForm', array(
                                            'id'=>'login-form'
                                            // 'htmlOptions'=>array('class'=>'form-horizontal'),
                                        ));
                                    ?>
                                    <div class="control-group">
                                        <div class="input-prepend" style="display: inline-flex;" title="Email" data-rel="tooltip">
                                          <span class="add-on" style="height: 24px;"><i class="icon-user"></i></span>
                                          <?php echo $form->textField($model,'username',array('placeholder'=>'Username','required'=>'required')); ?>   
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="input-prepend" style="display: inline-flex;" title="Password" data-rel="tooltip">
                                          <span class="add-on" style="height: 24px;"><i class="icon-lock"></i></span>
                                          <?php echo $form->passwordField ($model,'password',array('placeholder'=>'Password','required'=>'required')); ?>       
                                        </div>
                                    </div>
                                    <?php if($model->errorMessage!=''): ?>
                                        <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">x</button><strong><?= $model->errorMessage ?></strong></div>
                                    <?php endif; ?>
                                    <div align="center" class="control-group">
                                        <div class="input-prepend" title="Password" data-rel="tooltip">
                                            <button type="submit" class="button">Login</button>
                                        </div>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                </span>
                                <!-- End Form -->

                                </div>
                            </div>
                        </div>
                    </div>      
                </div> <!-- End page title wrapper -->
                <div class="clear"></div>
            </div>

        </div>
    </div>  <!-- End content -->
</div>