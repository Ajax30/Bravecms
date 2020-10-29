<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
             <div class="card-header d-flex p-2">
              <h6 class="text-dark m-0 align-self-center">Pages</h6>
              <a class="btn btn-sm btn-success ml-auto" href="<?php echo base_url('dashboard/create-page') ?>"><i class="fa fa-plus-square mr-1" aria-hidden="true"></i> Add page</a>
            </div>
            <div class="card-body bg-white p-0">
              <table class="table table-striped table-sm mb-0">
                <thead>
                  <tr>
                    <th class="text-right">#</th>
                    <th class="w-50">Title</th>
                    <th>Publication date</th>
                    <th class="text-right pr-2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pages as $index => $page): ?>
                    <tr id="<?php echo $page->id; ?>">
                      <td class="text-right"><?php $count = $index + 1; echo $count; ?></td>
                      <td><?php echo $page->title; ?></td>
                      <td><?php echo nice_date($page->created_at, 'D, M d, Y'); ?></td>
                      <td class="text-right">
                        <div class="btn-group btn-group-sm" role="group">
                          <a href="<?php echo base_url('pages/page/') . $page->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i> View</a>
                          <?php if($this->session->userdata('is_logged_in')) : ?>
                            <a href="<?php echo base_url('dashboard/pages/edit/') . $page->id; ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                            <a href="<?php echo base_url('dashboard/pages/delete/') . $page->id; ?>" data-id="<?php echo $page->id ?>" class="delete-page btn btn-success"><i class="fa fa-trash"></i> Delete</a>
                          <?php else: ?>
                            <a href="#" class="btn btn-success disabled"><i class="fa fa-pencil-square-o"></i> Edit</a>
                            <a href="#" class="btn btn-success disabled"><i class="fa fa-trash"></i> Delete</a>
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