<div class="container">
  <main class="content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">Edit email</div>
          <div class="card-body">
					<?php echo form_open(base_url('dashboard/subscribers/update')); ?>
					
						<input type="hidden" name="subscriber" value="<?php echo $subscriber->id; ?>">

						<div class="form-group <?php if(form_error('email')) echo 'has-error';?>">
							<input type="text" name="email" id="email" class="form-control" placeholder="Subscriber email" value="<?php echo $subscriber->email; ?>">
							<?php if(form_error('email')) echo form_error('email'); ?> 
						</div>
						
						<div class="form-group">
							<input type="submit" value="Update" class="btn btn-block btn-md btn-success">
						</div>

						<?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>