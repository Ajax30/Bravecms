<div class="container">
  <main class="wide-content">
    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto my-4 px-1">
        <div class="card bg-light">
          <div class="card-header bg-light">Edit your account information</div>
          <div class="card-body">
            <?php echo form_open_multipart(base_url('dashboard/users/update')); ?>

            <input type="hidden" name="id" id="uid" value="<?php echo $author->id; ?>">

            <div class="form-group <?php if(form_error('first_name')) echo 'has-error';?>">
              <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo set_value('first_name', $author->first_name); ?>" placeholder="First name">
              <?php if(form_error('first_name')) echo form_error('first_name'); ?> 
            </div>

            <div class="form-group <?php if(form_error('last_name')) echo 'has-error';?>">
              <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo set_value('last_name', $author->last_name); ?>" placeholder="Last name">
              <?php if(form_error('last_name')) echo form_error('last_name'); ?> 
            </div>

            <div class="form-group <?php if(form_error('email')) echo 'has-error';?>">
              <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value('email', $author->email); ?>" placeholder="Email">
              <?php if(form_error('email')) echo form_error('email'); ?> 
            </div>

            <div class="form-group <?php if(form_error('bio')) echo 'has-error';?>">
              <textarea name="bio" id="bio" cols="30" rows="5" class="form-control" placeholder="Add a short bio"><?php echo set_value('bio', $author->bio); ?></textarea>
              <?php if(form_error('bio')) echo form_error('bio'); ?> 
            </div>

            <input type="hidden" name="avatar" id="avatar" value="<?php echo $author->avatar; ?>">
              <label for="avatar">Upload avatar</label>
              <div class="form-group d-flex mb-3">
                <div class="w-75 pr-1">
                  <input type="file" name="userfile" id="uavatar" size="20">
                  <?php if(isset($uerrors)){
                      foreach ($uerrors as $uerror) {
                        echo '<div class="alert alert-danger alert-dismissible small mt-3 mb-0"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $uerror . '</div>';
                      }
                    }?>
                </div>
                  <div class="w-25 pl-1 preview">
                    <div class="pull-right">
                      <?php if (isset($author->avatar) && $author->avatar !== ''): ?>
                        <img src="<?php echo base_url('assets/img/authors/') . $author->avatar; ?>" class="rounded-circle img-thumbnail avatar-preview" />
                        <span class="trash">
                          <a href="#" class="icon text-light" id="delete-avatar" data-uid="<?php echo $author->id; ?>"><i class="fa fa-trash"></i>
                          </a>
                        </span>
                      <?php else: ?>  
                        <img src="<?php echo base_url('assets/img/authors/') . 'default-avatar.png' ?>" class="rounded-circle img-thumbnail avatar-preview" />
                      <?php endif ?>
                    </div>
                  </div>
              </div>

            <div class="form-group d-flex">
              <div class="w-50 pr-1">
                <input type="submit" value="Update" class="btn btn-block btn-md btn-success">
              </div>
              <div class="w-50 pl-1">
                <a href="<?php echo base_url('dashboard/users/edit/' . $author->id); ?>" class="btn btn-block btn-md btn-success">Cancel</a>
              </div>
            </div>          
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  </main>
</div>