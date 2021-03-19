<div class="container fluid-fixed">
  <div class="content-wrapper">
    <main class="dashboard-content content">
      <div class="row">
        <?php $this->load->view("dashboard/partials/sidebar");?>
        <div class="col-sm-8 col-md-9" id="dashboard">
          <div class="card bg-light">
            <div class="card-header d-flex p-2">
              <h6 class="text-dark m-0 align-self-center">Posts</h6>
              <a class="btn btn-sm btn-success ml-auto" href="<?php echo base_url('dashboard/create-post') ?>"><i class="fa fa-plus-square mr-1"></i> Add post</a>
            </div>
            <div class="card-body bg-white p-0">
              <?php if($total_posts > 0):?>
                <div class="table-responsive">
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
                      <?php foreach ($posts as $index => $post): ?>
                        <tr data-slug="<?php echo $post->slug; ?>">
                          <td class="text-right"><?php $count = $index + 1; echo $count + $offset; ?></td>
                          <td><?php echo $post->title; ?></td>
                          <td><?php echo nice_date($post->created_at, 'D, M d, Y'); ?></td>
                          <td class="text-right">
                            <div class="btn-group btn-group-sm" role="group">
                              <a href="<?php echo base_url('posts/post/') . $post->slug; ?>" class="btn btn-success"><i class="fa fa-eye"></i> View</a>
                              <?php if(($this->session->userdata('is_logged_in') && $this->session->userdata('user_id') == $post->author_id) || $this->session->userdata('user_is_admin')) : ?>
                                <a href="<?php echo base_url('dashboard/posts/edit/') . $post->slug; ?>" class="btn btn-success"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                <a href="#" data-slug="<?php echo $post->slug ?>" class="delete-post ajax-btn btn btn-success"><i class="fa fa-trash"></i> Delete</a>
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
                <div class="card-footer bg-white px-0 py-<?php echo $total_posts > $limit ? '1' : '0'?>">                      
                  <?php if($total_posts > $limit):?>
                    <?php $this->load->view("dashboard/partials/pagination");?>
                  <?php endif ?>
                </div>  
              <?php else: ?>
                <p class="text-center my-2">There are no posts yet</p>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>