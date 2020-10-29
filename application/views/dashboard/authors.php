<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <div class="card bg-light w-100">
          <h6 class="card-header text-dark">Manage authors</h6>
          <div class="card-body bg-white p-0">
            <?php if(count($authors)):?>
              <div class="table-responsive">
                <table class="table table-striped table-sm mb-0 w-100">
                  <thead>
                    <tr class="row m-0">
                      <th class="w-5">ID</th>
                      <th class="w-20">Full name</th>
                      <th class="w-25">Email</th>
                      <th class="w-10">Created</th>
                      <th class="w-10">Status</th>
                      <th class="w-10 text-center">Admin</th>
                      <th class="w-20">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($authors as $author): ?>
                      <tr id="<?php echo $author->id ?>" class="row m-0">
                        <td class="w-5"><?php echo $author->id ?></td>
                        <td class="w-20"><?php echo $author->first_name . " " . $author->last_name; ?></td>
                        <td class="w-25"><?php echo $author->email; ?></td>
                        <td class="w-10"><?php echo nice_date($author->register_date, 'M d, Y'); ?></td>
                        <td class="w-10 status-column">
                          <?php if ($author->active == 1) {
                            echo '<span class="text-success">' . 'Enabled' . '</span>';
                          } else {
                            echo '<span class="text-danger">' . 'Disabled' . '</span>';
                          }
                          ?>
                        </td>
                        <td class="w-10 text-center"><?php echo $author->is_admin; ?></td>
                        <td class="text-center d-inline-block w-20">
                          <?php if ($author->is_admin == 0): ?>
                            <div class="btn-group">                 
                              <?php if ($author->active == 1): ?>
                                <a href="<?php echo base_url('dashboard/users/deactivate/'. $author->id); ?>" title="Deactivate" class="btn btn-sm btn-success state-change" data-role="deactivate" data-id="<?php echo $author->id ?>">Disable</a>
                                <?php else: ?>
                                  <a href="<?php echo base_url('dashboard/users/activate/' . $author->id); ?>" title="Activate" class="btn btn-sm btn-success state-change" data-role="activate" data-id="<?php echo $author->id ?>">Enable</a>
                                <?php endif; ?>
                                <a href="<?php echo base_url('dashboard/users/edit/' . $author->id); ?>" title="Edit" class="btn btn-sm btn-success">Edit</a>
                                <a href="<?php echo base_url('dashboard/users/delete/' . $author->id); ?>" title="Delete" class="delete-user btn btn-sm btn-success">Delete</a>
                              </div>
                              <?php else: ?>
                                <a href="<?php echo base_url('dashboard/users/edit/' . $author->id); ?>" title="Edit" class="btn btn-sm btn-success">Edit</a>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>              
                  <?php else: ?>
                    <p class="text-center">No records to display</p>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>