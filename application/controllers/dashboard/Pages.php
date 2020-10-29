<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['number_of_pages'] = $this->Pages_model->count_pages();
		$data['number_of_posts'] = $this->Posts_model->get_num_rows();
		$data['number_of_categories'] = $this->Categories_model->get_num_rows();
		$data['number_of_comments'] = $this->Comments_model->get_num_rows();

		$this->load->view('dashboard/partials/header', $data);
		$this->load->view('dashboard/pages');
		$this->load->view('dashboard/partials/footer');
	}

	public function create() {
		// Only logged in users can create pages
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		if (!$this->session->userdata('user_is_admin')) {
			$this->session->set_flashdata('admin_only_pages', 'Only admin can add pages');
			redirect('dashboard/pages');
		}

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['number_of_pages'] = $this->Pages_model->count_pages();
		$data['number_of_posts'] = $this->Posts_model->get_num_rows();
		$data['number_of_categories'] = $this->Categories_model->get_num_rows();
		$data['number_of_comments'] = $this->Comments_model->get_num_rows();
		$data['tagline'] = "Add New Page";
		$data['is_ckeditor'] = true;

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');

		if($this->form_validation->run() === FALSE){
			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('dashboard/create-page');
			$this->load->view('dashboard/partials/footer');
		} else {
			$this->Pages_model->create_page();
			$this->session->set_flashdata('page_created', 'Your page has been created');
			redirect('dashboard/pages');
		}
		
	}

	public function edit($page_id) {
		// Only logged in users can edit posts
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['number_of_pages'] = $this->Pages_model->count_pages();
		$data['number_of_posts'] = $this->Posts_model->get_num_rows();
		$data['number_of_categories'] = $this->Categories_model->get_num_rows();
		$data['number_of_comments'] = $this->Comments_model->get_num_rows();
		$data['page'] = $this->Pages_model->get_page($page_id);
		if (1 == 1) {
			$data['tagline'] = 'Edit the page "' . $data['page']->title . '"';
			$data['is_ckeditor'] = true;
			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('dashboard/edit-page');
			$this->load->view('dashboard/partials/footer');
		} else {
			redirect('pages/page/' . $page_id);
		}
		
	}

	public function update() {

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');

		$page_id = $this->input->post('pid');

		if ($this->form_validation->run()) {
			$this->Pages_model->update_page($page_id);
			$this->session->set_flashdata('page_updated', 'The page has been updated');
			redirect('dashboard/pages');
		} else {
			$this->edit($page_id);
		}
	}

	public function delete($page_id) {
		// Only logged in users can delete posts
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		$this->Pages_model->delete_page($page_id);
		$this->session->set_flashdata('page_deleted', 'The page has been deleted');
		redirect('dashboard/pages');
	}
}