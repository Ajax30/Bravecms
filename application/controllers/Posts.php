<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  private function _initPagination($path, $totalRows, $query_string_segment = 'page')
  {
    // load and configure pagination 
    $this->load->library('pagination');
    $config['base_url']             = base_url($path);
    $config['query_string_segment'] = $query_string_segment;
    $config['enable_query_strings'] = TRUE;
    $config['reuse_query_string']   = TRUE;
    $config['total_rows']           = $totalRows;
    $config['per_page']             = 12;

    if ($this->Static_model->get_static_data()['has_pager']) {
      $config['display_pages'] = FALSE;
      $config['first_link'] = FALSE;
      $config['last_link'] = FALSE;
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li class="next">';
      $config['next_tag_close'] = '</li>';
    }

    if (!isset($_GET[$config['query_string_segment']]) || $_GET[$config['query_string_segment']] < 1) {
      $_GET[$config['query_string_segment']] = 1;
    }
    $this->pagination->initialize($config);

    $limit  = $config['per_page'];
    $offset = ($this->input->get($config['query_string_segment']) - 1) * $limit;

    return array(
      'limit' => $limit,
      'offset' => $offset
    );
  }

  public function index()
  {
    //call initialization method
    $config = $this->_initPagination("/", $this->Posts_model->get_num_rows());
    $data                  = $this->Static_model->get_static_data();
    $data['base_url']      = base_url("/");
    $data['pages']         = $this->Pages_model->get_pages();
    $data['categories']    = $this->Categories_model->get_categories();
    $data['search_errors'] = validation_errors();
    $data['posts'] = $this->Posts_model->get_posts($config['limit'], $config['offset']);
    $data['max_page'] = ceil($this->Posts_model->get_num_rows() / 12);

    $this->twig->addGlobal('pagination', $this->pagination->create_links());

    // Featured posts
    if ($data['is_featured']) {
      $data['featured'] = $this->Posts_model->featured_posts();
      $this->twig->addGlobal('featuredPosts', "themes/{$data['theme_directory']}/partials/hero.twig");
    }

    $this->twig->display("themes/{$data['theme_directory']}/layout", $data);
  }

  public function search()
  {
    // Force validation since the form's method is GET
    $this->form_validation->set_data($this->input->get());
    $this->form_validation->set_rules('search', 'search term', 'required|trim|min_length[3]', array(
      'min_length' => 'The search term must be at least 3 characters long.'
    ));
    $this->form_validation->set_error_delimiters('<p class = "error search-error">', '</p>');
    // If search fails
    if ($this->form_validation->run() === FALSE) {
      $data['search_errors'] = validation_errors();
      return $this->index();
    } else {
      $expression           = $this->input->get('search');
      $posts_count          = $this->Posts_model->search_count($expression);
      $query_string_segment = 'page';
      $config               = $this->_initPagination("/posts/search", $posts_count, $query_string_segment);
      $data                 = $this->Static_model->get_static_data();
      $data['base_url']     = base_url("/");
      $data['pages']        = $this->Pages_model->get_pages();
      $data['categories']   = $this->Categories_model->get_categories();
      //use limit and offset returned by _initPaginator method
      $data['posts']        = $this->Posts_model->search($expression, $config['limit'], $config['offset']);
      $data['expression']   = $expression;
      $data['posts_count']  = $posts_count;
      $data['max_page'] = ceil($posts_count / 12);
      
      $this->twig->addGlobal('pagination', $this->pagination->create_links());
      $this->twig->display("themes/{$data['theme_directory']}/layout", $data);
    }
  }

  public function byauthor($authorid)
  {
    //load and configure pagination 
    $this->load->library('pagination');
    $config['base_url']             = base_url('/posts/byauthor/' . $authorid);
    $config['query_string_segment'] = 'page';
    $config['total_rows']           = $this->Posts_model->posts_by_author_count($authorid);
    $config['per_page']             = 12;

    if ($this->Static_model->get_static_data()['has_pager']) {
      $config['display_pages'] = FALSE;
      $config['first_link'] = FALSE;
      $config['last_link'] = FALSE;
      $config['prev_tag_open'] = '<li class="prev">';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li class="next">';
      $config['next_tag_close'] = '</li>';
    }

    if (!isset($_GET[$config['query_string_segment']]) || $_GET[$config['query_string_segment']] < 1) {
      $_GET[$config['query_string_segment']] = 1;
    }

    $limit  = $config['per_page'];
    $offset = ($this->input->get($config['query_string_segment']) - 1) * $limit;
    $this->pagination->initialize($config);

    $data                 = $this->Static_model->get_static_data();
    $data['base_url']     = base_url("/");
    $data['pages']        = $this->Pages_model->get_pages();
    $data['categories']   = $this->Categories_model->get_categories();
    $data['posts']        = $this->Posts_model->get_posts_by_author($authorid, $limit, $offset);
    $data['posts_count']  = $this->Posts_model->posts_by_author_count($authorid);
    $data['max_page'] = ceil($data['posts_count'] / $limit);
    $data['posts_author'] = $this->Posts_model->posts_author($authorid);
    $data['tagline']      = "Posts by " . $data['posts_author']->first_name . " " . $data['posts_author']->last_name;

    $this->twig->addGlobal('pagination', $this->pagination->create_links());
    $this->twig->display("themes/{$data['theme_directory']}/layout", $data);
  }

  public function post($slug)
  {
    $data                 = $this->Static_model->get_static_data();
    $data['base_url']     = base_url("/");
    $data['pages']        = $this->Pages_model->get_pages();
    $data['categories']   = $this->Categories_model->get_categories();
    $data['authors']      = $this->Usermodel->getAuthors();
    $data['posts']        = $this->Posts_model->sidebar_posts($limit = 5, $offset = 0);
    $data['post']         = $this->Posts_model->get_post($slug);
    $data['next_post']    = $this->Posts_model->get_next_post($slug);
    $data['prev_post']    = $this->Posts_model->get_prev_post($slug);
    $data['author_image'] = isset($data['post']->avatar) && $data['post']->avatar !== '' ? $data['post']->avatar : 'default-avatar.png';

    if ($data['categories']) {
      foreach ($data['categories'] as &$category) {
        $category->posts_count = $this->Posts_model->count_posts_in_category($category->id);
      }
    }

    if (!empty($data['post'])) {
      // Overwrite the default tagline with the post title
      $data['tagline']  = $data['post']->title;
      // Get post comments
      $post_id          = $data['post']->id;
      $data['comments'] = $this->Comments_model->get_comments($post_id);
      $this->twig->addGlobal('singlePost', "themes/{$data['theme_directory']}/templates/singlepost.twig");
    } else {
      $data['tagline'] = "Page not found";
      $this->twig->addGlobal('notFound', "themes/{$data['theme_directory']}/templates/404.twig");
    }
    $this->twig->display("themes/{$data['theme_directory']}/layout", $data);
  }
}
