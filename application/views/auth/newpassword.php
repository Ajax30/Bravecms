<div class="container">
  <main class="wide-content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">New password</div>
          <div class="card-body">
            <?php echo form_open(base_url('newpassword/'. $token)); ?>
              <div class="form-group <?php if(form_error('password')) echo 'has-error';?>">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <?php if(form_error('password')) echo form_error('password'); ?> 
              </div>
              <div class="form-group <?php if(form_error('cpassword')) echo 'has-error';?>">
                <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm password">
                <?php if(form_error('cpassword')) echo form_error('cpassword'); ?> 
              </div>
              <div class="form-group mb-2">
                <input type="submit" value="Set password" class="btn btn-block btn-md btn-success">
              </div>            
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>
