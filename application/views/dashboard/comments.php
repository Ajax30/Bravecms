<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content wide-content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
            <div class="card-header d-flex px-2">
              <h6 class="text-dark m-0">Comments</h6>
            </div>
            <div class="card-body bg-white p-0">
              <div class="table-responsive">
                <table class="table table-striped table-sm mb-0">
                  <thead>
                    <tr>
                      <th class="w-25">Comment</th>
                      <th class="w-20">Author</th>
                      <th class="w-20">Post</th>
                      <th>Date added</th>
                      <th>Status</th>
                      <th class="w-20 text-right pr-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($comments as $index => $comment): ?>
                      <tr id="<?php echo $comment->id; ?>">
                        <td><?php echo $comment->comment; ?></td>
                        <td><?php echo $comment->name; ?></td>
                        <td>
                          <a href="<?php echo base_url('/') . $comment->post_slug; ?>" title="View the post <?php echo $comment->post_title; ?>" class="text-dark">
                            <?php echo $comment->post_title; ?>
                          </a>
                        </td>
                        <td><?php echo nice_date($comment->created_at, 'm/d/y'); ?></td>
                        <td>
                          <?php if ($comment->aproved == 1) {
                            echo '<span class="text-success">Visiable</span>';
                          } else {
                            echo '<span class="text-danger">Hidden</span>';
                          }?>
                        </td>
                        <td class="text-right">
                          <div class="btn-group btn-group-sm" role="group">
                            <?php if ($comment->aproved == 0): ?>
                              <a href="<?php echo base_url('dashboard/comments/aprove/') . $comment->id; ?>" class="btn btn-success"><i class="fa fa-check-circle-o"></i> Show</a>
                            <?php else: ?>
                              <a href="<?php echo base_url('dashboard/comments/disaprove/') . $comment->id; ?>" class="btn btn-success"><i class="fa fa-times-circle-o"></i> Hide</a>
                            <?php endif; ?>
                            <a href="#" data-id="<?php echo $comment->id ?>" class="delete-comment ajax-btn btn btn-success"><i class="fa fa-trash"></i> Delete</a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer bg-white py-1">
                <?php $this->load->view("dashboard/partials/pagination");?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>