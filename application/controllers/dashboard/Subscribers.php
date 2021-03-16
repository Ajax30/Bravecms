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

		public function delete($id) {
			if ($this->Newsletter_model->deleteSubscriber($id)) {
				$this->session->set_flashdata('subscriber_delete', "The subscriber was deleted");
			} else {
				$this->session->set_flashdata('subscriber_delete', "Failed to delete subscriber");
			}
			redirect('dashboard/subscribers');
		}
}