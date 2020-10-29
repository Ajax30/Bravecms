<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
            <div class="card-header d-flex p-2">
              <h6 class="text-dark m-0 align-self-center">Categories</h6>
              <a class="btn btn-sm btn-success ml-auto" href="<?php echo base_url('dashboard/create-category') ?>"><i class="fa fa-plus-square mr-1" aria-hidden="true"></i> Add category</a>
            </div>
            <div class="card-body bg-white p-0">
              <table class="table table-striped table-sm mb-0">
                <thead>
                  <tr>
                    <th class="text-right pr-2">ID</th>
                    <th class="w-75">Name</th>
                    <th class="text-right pr-2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categories as $category): ?>
                  <tr id="<?php echo $category->id; ?>">
                    <td class="text-right pr-2"><?php echo $category->id; ?></td>
                    <td><?php echo $category->name; ?></td>
                    <td class="text-right">
                      <div class="btn-group btn-group-sm" role="group">
                        <?php if($this->session->userdata('user_is_admin')) : ?>
                        <a href="<?php echo base_url('dashboard/categories/edit/') . $category->id; ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <a href="<?php echo base_url('dashboard/categories/delete/') . $category->id; ?>" class="delete-category btn btn-success"><i class="fa fa-trash"></i> Delete</a>
                        <?php else: ?>
                        <a href="#" class="btn btn-success disabled">Edit</a>
                        <a href="#" class="btn btn-success disabled">Delete</a>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>