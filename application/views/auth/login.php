<div class="container">
  <main class="wide-content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">Sign in</div>
          <div class="card-body">
            <?php echo form_open(base_url('login/login')); ?>

            <div class="form-group <?php if(form_error('email')) echo 'has-error';?>">
              <input type="text" name="email" id="email" class="form-control" placeholder="Email">
              <?php if(form_error('email')) echo form_error('email'); ?> 
            </div>

            <div class="form-group <?php if(form_error('password')) echo 'has-error';?>">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              <?php if(form_error('password')) echo form_error('password'); ?> 
            </div>

            <div class="form-group">
              <input type="submit" value="Login" class="btn btn-block btn-md btn-success">
            </div>            
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>