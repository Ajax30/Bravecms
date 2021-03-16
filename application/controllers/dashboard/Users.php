<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {

		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		} else {
			// Admin ONLY area!
			if (!$this->session->userdata('user_is_admin')) {
				redirect($this->agent->referrer());
			}
		}

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['authors'] = $this->Usermodel->getAuthors();

		$this->load->view('dashboard/partials/header', $data);
		$this->load->view('dashboard/authors');
		$this->load->view('dashboard/partials/footer');
		
	}

	public function edit($id) {
		// Only logged in users can edit user profiles
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['author'] = $this->Usermodel->editAuthor($id);

		$this->load->view('dashboard/partials/header', $data);
		$this->load->view('dashboard/edit-author');
		$this->load->view('dashboard/partials/footer');
		
	}

	function _mail_unique($email, $id){

		if( !$id ){
        $this->db->where('email', $email);
        $num = $this->db->count_all_results('authors');
    } else{
        $this->db->where('email', $email);
        $this->db->where_not_in('id', $id);
        $num = $this->db->count_all_results('authors');
    }

    if ($num > 0) {
      $this->form_validation->set_message('_mail_unique','This email is used by another author');
       return FALSE; 
    } else {
        return TRUE; 
    }

	}


	public function update() {
		// Only logged in users can update user profiles
		if (!$this->session->userdata('is_logged_in')) {
			redirect('login');
		}

		$id = $this->input->post('id');

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['author'] = $this->Usermodel->editAuthor($id);

		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback__mail_unique['.$id.']');
		$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');

		// Upload avatar
		$config['upload_path'] = './assets/img/authors';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '1024';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$uerrors = array('uerrors' => $this->upload->display_errors());

			// if NO file is uploaded,
			if (empty($_FILES['userfile']['name'])) {
				// force upload validation and
				$uerrors = [];
				// use the existing avatar (if any)
				$avatar = $this->input->post('avatar');
			}

			$data['uerrors'] = $uerrors;

		} else {
			$data = array('upload_data' => $this->upload->data());
			$avatar = $_FILES['userfile']['name'];
			$this->session->set_userdata('user_avatar', $avatar);
		}

		if(!$this->form_validation->run() || !empty($uerrors)) {

			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('dashboard/edit-author');
			$this->load->view('dashboard/partials/footer');
		} else {
			$this->Usermodel->update_user($avatar, $id);
			$this->session->set_flashdata('user_updated', 'Your account details have been updated');
			redirect(base_url('/dashboard/manage-authors'));
		}
	}

	public function delete($id) {
		if ($this->Usermodel->deleteAuthor($id)) {
			$this->session->set_flashdata('author_delete', "The author was deleted");
		} else {
			$this->session->set_flashdata('author_delete', "Failed to delete author");
		}
		redirect('dashboard/users');
	}

	public function activate($id) {
		$author = $this->Usermodel->activateAuthor($id);
		redirect($this->agent->referrer());
	}

	public function deactivate($id) {
		$author = $this->Usermodel->deactivateAuthor($id);
		redirect($this->agent->referrer());
	}

	public function deleteavatar($id) {
		$this->Usermodel->deleteAvatar($id);
		$this->session->set_userdata('user_avatar', $avatar);
		redirect($this->agent->referrer());
	}

}