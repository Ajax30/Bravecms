<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content content">
      <div class="row">
        <div class="card bg-light w-100">
          <div class="card-header d-flex p-2">
            <h6 class="text-dark m-0 align-self-center">Newsletter list</h6>
            <a class="btn btn-sm btn-success ml-auto" href="<?php echo base_url('dashboard/subscribers/export') ?>"><i class="fa fa-file mr-1"></i> Export CSV</a>
          </div>
          <div class="card-body bg-white p-0">
            <?php if($total_subscribers > 0):?>
              <div class="table-responsive">
                <table class="table table-striped table-sm mb-0 w-100">
                  <thead>
                    <tr class="row m-0">
                      <th class="w-5">#</th>
                      <th class="w-50">Email</th>
                      <th class="w-25">Subscription date</th>
                      <th class="w-20 text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($subscribers as $index => $subscriber): ?>
                      <tr id="<?php echo $subscriber->id; ?>" class="row m-0">
                        <td class="w-5"><?php $count = $index + 1; echo $count + $offset; ?></td>
                        <td class="w-50"><?php echo $subscriber->email; ?></td>
                        <td class="w-25"><?php echo $subscriber->subscription_date; ?></td>
                        <td class="w-20 text-right">
                          <div class="btn-group">
                            <a href="<?php echo base_url('dashboard/subscribers/edit/' . $subscriber->id); ?>" title="Edit" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                            <a href="<?php echo base_url('dashboard/subscribers/delete/' . $subscriber->id); ?>" title="Delete" class="delete-subscriber btn btn-sm btn-success"><i class="fa fa-trash"></i> Delete</a>
                          </div> 
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white px-0 py-<?php echo $total_subscribers > $limit ? '1' : '0'?>">                      
                <?php if($total_subscribers > $limit):?>
                  <?php $this->load->view("dashboard/partials/pagination");?>
                <?php endif ?>
              </div>              
              <?php else: ?>
                <p class="text-center my-2">No subscribers</p>
              <?php endif ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>