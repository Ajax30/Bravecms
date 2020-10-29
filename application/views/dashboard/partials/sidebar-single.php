<div class="col-sm-4 col-md-3 px-0" id="dashboard_sidebar">
  <div class="card-list-group card bg-light mb-3">
    <h6 class="card-header text-dark">Featured Image</h6>
    <div class="card-body p-0 bg-white">
      <?php if (isset($post->post_image) && $post->post_image !== 'default.jpg'): ?>
        <img src="<?php echo base_url('assets/img/posts/') . $post->post_image; ?>" alt="Main Image of <?php echo $post->title; ?>" class="img-fluid">
      <?php else: ?>
        <img src="<?php echo base_url('assets/img/posts/') . 'default.jpg'; ?>" alt="Default Post Image" class="img-fluid">
      <?php endif ?>
    </div>
    <div class="card-footer p-2 bg-white text-center">
      <a href="#<?php echo isset($post->post_image) && $post->post_image !== 'default.jpg' ? '' : 'imageUploader' ?>" <?php echo isset($post->post_image) && $post->post_image !== 'default.jpg' ? 'data-pid="' . $post->id . '"' : '' ?> id="postImage" class="smooth-scroll">
        <?php echo isset($post->post_image) && $post->post_image !== 'default.jpg' ? 'Delete' : 'Add' ?> image
      </a>
    </div>
  </div>
</div>