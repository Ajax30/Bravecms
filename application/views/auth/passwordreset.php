<div class="container">
  <main class="wide-content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">Reset password</div>
          <div class="card-body">
            <?php echo form_open(base_url('passwordreset')); ?>
              <div class="form-group <?php if(form_error('email')) echo 'has-error';?>">
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo set_value('email')?>">
                <?php if(form_error('email')) echo form_error('email'); ?> 
              </div>

              <div class="form-group mb-2">
                <input type="submit" value="Reset password" class="btn btn-block btn-md btn-success">
              </div>            
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>
