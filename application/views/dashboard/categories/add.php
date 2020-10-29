<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
            <h6 class="card-header text-dark">New category</h6>
            <div class="card-body bg-white">
              <?php echo form_open(base_url('dashboard/categories/create')); ?>
              <div class="form-group <?php if(form_error('category_name')) echo 'has-error';?>">
                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category name">
                <?php if(form_error('category_name')) echo form_error('category_name'); ?> 
              </div>
              <div class="form-group">
                <input type="submit" value="Add category" class="btn btn-block btn-md btn-success">
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>