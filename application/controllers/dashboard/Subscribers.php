<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
			
			if (!$this->session->userdata('is_logged_in')) {
				redirect('login');
			} else {
				// Admin ONLY area!
				if (!$this->session->userdata('user_is_admin')) {
					redirect($this->agent->referrer());
				}
			}

			$data = $this->Static_model->get_static_data();
			$data['subscribers'] = $this->Newsletter_model->getSubscribers();

			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('dashboard/subscribers');
			$this->load->view('dashboard/partials/footer');
    }

		public function edit($id) {
			// Only logged in users can edit subscribers
			if (!$this->session->userdata('is_logged_in')) {
				redirect('login');
			}
	
			$data = $this->Static_model->get_static_data();
			$data['subscriber'] = $this->Newsletter_model->editSubscriber($id);
	
			$this->load->view('dashboard/partials/header', $data);
			$this->load->view('dashboard/edit-subscriber');
			$this->load->view('dashboard/partials/footer');
		}

		public function update() {
			// Only logged in users can update user profiles
			if (!$this->session->userdata('is_logged_in')) {
				redirect('login');
			}
	
			$id = $this->input->post('subscriber');
	
			$data = $this->Static_model->get_static_data();
			$data['subscriber'] = $this->Newsletter_model->editSubscriber($id);
	
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');
	
			if(!$this->form_validation->run()) {
				$this->load->view('dashboard/partials/header', $data);
				$this->load->view('dashboard/edit-subscriber');
				$this->load->view('dashboard/partials/footer');
			} else {
				$this->Newsletter_model->updateSubscriber($id);
				$this->session->set_flashdata('subscriber_updated', 'The email address was updated');
				redirect('dashboard/subscribers');
			}
		}

		public function delete($id) {
			if ($this->Newsletter_model->deleteSubscriber($id)) {
				$this->session->set_flashdata('subscriber_delete_success', "The subscriber was deleted");
			} else {
				$this->session->set_flashdata('subscriber_delete_fail', "Failed to delete subscriber");
			}
			redirect('dashboard/subscribers');
		}
}