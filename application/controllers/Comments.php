<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create($post_slug){
		$post_id = $this->input->post('postid');
		$post_slug = $this->input->post('slug');
		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['posts'] = $this->Posts_model->sidebar_posts($limit=5, $offset=0);
		$data['post'] = (object) $this->Posts_model->get_post($post_slug);
		$data['comments'] = $this->Comments_model->get_comments($post_id);
		$data['tagline'] = 'Comment on "' . $data['post']->title . '"';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('message', 'Comment', 'required');
		$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');

		if($this->form_validation->run() === FALSE) {
			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('post');
			$this->load->view('dashboard/partials/footer');
		} else {
			$this->Comments_model->create_comment($post_id);
			$this->session->set_flashdata('comment_added', 'Your comment will be published after aproval');
			redirect('/' . $post_slug);
		}		
	}

}