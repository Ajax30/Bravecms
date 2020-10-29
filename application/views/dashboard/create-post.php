<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar-single");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
            <h6 class="card-header text-dark">New Post</h6>
            <div class="card-body bg-white">
              <?php echo form_open_multipart(base_url('dashboard/posts/create')); ?>

              <div class="form-group <?php if(form_error('title')) echo 'has-error';?>">
                <input type="text" name="title" id="title" class="form-control" value="<?php echo set_value('title')?>" placeholder="Title">
                <?php if(form_error('title')) echo form_error('title'); ?> 
              </div>

              <div class="form-group <?php if(form_error('desc')) echo 'has-error';?>">
                <input type="text" name="desc" id="desc" class="form-control" value="<?php echo set_value('desc')?>" placeholder="Short decription">
                <?php if(form_error('desc')) echo form_error('desc'); ?> 
              </div>

              <div class="form-group <?php if(form_error('body')) echo 'has-error';?>">
                <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Add post body">
                  <?php echo set_value('body')?>
                </textarea>
                <?php if(form_error('body')) echo form_error('body'); ?> 
              </div>

              <div class="form-group">
                <select name="category" id="category" class="form-control">
                  <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <label for="postimage" id="imageUploader">Upload an image</label>
              <div class="form-group">
                <input type="file" name="userfile" id="postimage" size="20">
                 <div class="error-messages">
                  <?php if(isset($upload_errors)){
                    foreach ($upload_errors as $upload_error) {
                      echo $upload_error;
                    }
                  }?>
                </div>
              </div>

              <div class="form-group d-flex">
                <div class="w-50 pr-1">
                  <input type="submit" value="Save" class="btn btn-block btn-md btn-success">
                </div>
                <div class="w-50 pl-1">
                  <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-block btn-md btn-success">Cancel</a>
                </div>
              </div>

              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>