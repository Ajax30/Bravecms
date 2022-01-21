<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$data = $this->Static_model->get_static_data();
		//$data['pages'] = $this->Pages_model->get_pages();
		$data['tagline'] = 'Want to write for ' . $data['site_title'] . '? Create an account.';
		$data['categories'] = $this->Categories_model->get_categories();

		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('last_name', 'Last name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');
		$this->form_validation->set_rules('terms', 'Terms and Conditions', 'required', array('required' => 'You have to accept the Terms and Conditions'));
		$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');

		// If validation fails
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('auth/register');
			$this->load->view('dashboard/partials/footer');
		} else {
			// If the provided email does not already
			// exist in the authors table, register user
			if (!$this->Usermodel->email_exists()) {
				// Encrypt the password
				$enc_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

				// Give the first author admin privileges
				if ($this->Usermodel->get_num_rows() < 1) {
					$active = 1;
					$is_admin = 1;
				} else {
					$active = 0;
					$is_admin = 0;
				}
				
				// Register user
				$this->Usermodel->register_user($enc_password, $active, $is_admin);

				if ($this->Usermodel->get_num_rows() == 1) {
					$this->session->set_flashdata('user_registered', "You are now registered as an admin. You can sign in");
				} else {
					$this->session->set_flashdata('user_registered', "You are now registered. Your account needs the admin's aproval before you can sign in.");
				}
				redirect('login');
			} else {
				// The user is already registered
				$this->session->set_flashdata('already_registered', "The email you provided already exists in our database. Please login.");
				redirect('login');
			}
		}
	}

}
