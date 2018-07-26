<div class="animate form login_form">
  <section class="login_content">
    <?php 
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form'
        ));
    ?>
      <h1>Sistem Bagi Hasil Investor Usaha Mikro</h1>
      <div>
        <?php echo $form->textField($model,'username',array('placeholder'=>'Username','class'=>'form-control','required'=>'required')); ?>
      </div>
      <div>
        <?php echo $form->passwordField ($model,'password',array('placeholder'=>'Password','class'=>'form-control','required'=>'required')); ?>
      </div>
        <?php if($model->errorMessage!=''): ?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong><?= $model->errorMessage ?></strong>
        </div>
        <?php endif; ?>
      <div>
        <button type="submit" class="btn btn-default submit">Log in</button>
        <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
      </div>

      <div class="clearfix"></div>

      <div class="separator">
        <!-- <p class="change_link">New to site?
          <a href="#signup" class="to_register"> Create Account </a>
        </p> -->

        <div class="clearfix"></div>
        <br />

        <div>
          <h1><i class="fa fa-archive"></i> Tsurayya Hijab</h1>
          <p>©2016 All Rights Reserved. Rayyan Solution. Privacy and Terms</p>
        </div>
      </div>
    <?php $this->endWidget(); ?>
  </section>
</div>