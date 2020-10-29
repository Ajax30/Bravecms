<div class="col-sm-4 col-md-3 px-0" id="dashboard_sidebar">
  <div class="card-list-group card bg-light mb-3">
    <h6 class="card-header text-dark">Dashboard</h6>
    <div class="card-body p-0 bg-white">
      <ul class="list-group">
        <a href="<?php echo base_url('dashboard/posts'); ?>" class="list-group-item d-flex justify-content-between align-items-center">
          <span class="text-secondary"><i class="fa fa-thumb-tack mr-1"></i> Posts</span>
          <span id="posts_count" class="badge badge-secondary badge-pill"><?php echo $number_of_posts; ?></span>
        </a>
        <a href="<?php echo base_url('dashboard/pages'); ?>" class="list-group-item d-flex justify-content-between align-items-center">
          <span class="text-secondary"><i class="fa fa-file-text mr-1"></i> Pages</span>
          <span class="badge badge-secondary badge-pill"><?php echo $number_of_pages; ?></span>
        </a>
        <a href="<?php echo base_url('dashboard/categories'); ?>" class="list-group-item d-flex justify-content-between align-items-center">
          <span class="text-secondary"><i class="fa fa-th-list mr-1"></i> Categories</span>
          <span class="badge badge-secondary badge-pill"><?php echo $number_of_categories; ?></span>
        </a>
        <a href="<?php echo base_url('dashboard/comments'); ?>" class="list-group-item d-flex justify-content-between align-items-center">
          <span class="text-secondary"><i class="fa fa-commenting mr-1"></i> Comments</span>
          <span id="comments_count" class="badge badge-secondary badge-pill"><?php echo $number_of_comments; ?></span>
        </a>
      </ul>
    </div>
  </div>
</div>