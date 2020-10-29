<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {

		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		//load and configure pagination 
		$this->load->library('pagination');
		$config['base_url'] = base_url("dashboard/comments");
		$config['query_string_segment'] = 'page';
		$config['total_rows'] =	$this->Comments_model->get_num_rows();
		$config['per_page'] = 10;
		
		if (!isset($_GET[$config['query_string_segment']]) || $_GET[$config['query_string_segment']] < 1){
			$_GET[$config['query_string_segment']] = 1;
		}
		$limit = $config['per_page'];
		$offset = ($this->input->get($config['query_string_segment']) - 1) * $limit;
		$this->pagination->initialize($config);

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['number_of_pages'] = $this->Pages_model->count_pages();
		$data['number_of_posts'] = $this->Posts_model->get_num_rows();
		$data['number_of_categories'] = $this->Categories_model->get_num_rows();
		$data['comments'] = $this->Comments_model->get_all_comments($limit, $offset);
		$data['number_of_comments'] = $this->Comments_model->get_num_rows();

		$this->load->view('dashboard/partials/header', $data);
		$this->load->view('dashboard/comments');
		$this->load->view('dashboard/partials/footer');
	}

	public function aprove($comment_id) {
		$this->load->model('Comments_model');
		$comment = $this->Comments_model->aprove($comment_id);
		redirect($this->agent->referrer());
	}

	public function disaprove($comment_id) {
		$this->load->model('Comments_model');
		$comment = $this->Comments_model->disaprove($comment_id);
		redirect($this->agent->referrer());
	}

	public function delete($comment_id) {
		// Only logged in users can delete posts
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		$this->Comments_model->delete_comment($comment_id);
		$this->session->set_flashdata('comment_deleted', 'The comment has been deleted');
	}

}