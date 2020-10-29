<div class="container">
  <main class="wide-content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">Create an account</div>
          <div class="card-body">
            <?php echo form_open(base_url('register')); ?>
            <div class="form-group <?php if(form_error('first_name')) echo 'has-error';?>">
              <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo set_value('first_name')?>" placeholder="First name">
              <?php if(form_error('first_name')) echo form_error('first_name'); ?> 
            </div>

            <div class="form-group <?php if(form_error('last_name')) echo 'has-error';?>">
              <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo set_value('last_name')?>" placeholder="Last name">
              <?php if(form_error('last_name')) echo form_error('last_name'); ?> 
            </div>

            <div class="form-group <?php if(form_error('email')) echo 'has-error';?>">
              <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email')?>" placeholder="Email">
              <?php if(form_error('email')) echo form_error('email'); ?> 
            </div>

            <div class="form-group <?php if(form_error('password')) echo 'has-error';?>">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              <?php if(form_error('password')) echo form_error('password'); ?> 
            </div>

            <div class="form-group <?php if(form_error('cpassword')) echo 'has-error';?>">
              <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm password">
              <?php if(form_error('cpassword')) echo form_error('cpassword'); ?> 
            </div>

            <div class="form-group <?php if(form_error('terms')) echo 'has-error';?>">
              <input type="checkbox" name="terms" value="yes" id="terms">
              <?php if(form_error('terms')) echo form_error('terms'); ?> <span class="text text-muted">I accept the <a href="<?php echo base_url('pages/page/1') ?>" class="text text-link">Privacy Policy</a></span>
            </div>

            <div class="form-group">
              <input type="submit" value="Register" class="btn btn-block btn-md btn-success">
            </div>            
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>