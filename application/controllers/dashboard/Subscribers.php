<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        } else {
            // Admin ONLY area!
            if (!$this->session->userdata('user_is_admin')) {
                $this->session->set_flashdata('admin_only_pages', 'Only admins are allowed to manage subscribers');
                redirect('dashboard');
            }
        }
        
        $this->load->library('pagination');
        $config['base_url']             = base_url("dashboard/subscribers");
        $config['query_string_segment'] = 'page';
        $config['total_rows']           = $this->Newsletter_model->get_num_rows();
        $config['per_page']             = 10;
        
        if (!isset($_GET[$config['query_string_segment']]) || $_GET[$config['query_string_segment']] < 1) {
            $_GET[$config['query_string_segment']] = 1;
        }
        
        $limit  = $config['per_page'];
        $offset = ($this->input->get($config['query_string_segment']) - 1) * $limit;
        $this->pagination->initialize($config);
        
        $data                      = $this->Static_model->get_static_data();
        $data['subscribers']       = $this->Newsletter_model->getSubscribers($limit, $offset);
        $data['offset']            = $offset;
        $data['limit']             = $limit;
        $data['total_subscribers'] = $config['total_rows'];
        
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/subscribers');
        $this->load->view('dashboard/partials/footer');
    }
    
    public function edit($id)
    {
        // Admin ONLY area!
        if (!$this->session->userdata('user_is_admin')) {
            $this->session->set_flashdata('admin_only_pages', 'Only admins are allowed to edit subscribers');
            redirect('dashboard');
        }
        
        $data               = $this->Static_model->get_static_data();
        $data['subscriber'] = $this->Newsletter_model->editSubscriber($id);
        
        $this->load->view('dashboard/partials/header', $data);
        $this->load->view('dashboard/edit-subscriber');
        $this->load->view('dashboard/partials/footer');
    }
    
    public function update()
    {
        // Only logged in users can update subscribers
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
        
        $id = $this->input->post('subscriber');
        
        $data               = $this->Static_model->get_static_data();
        $data['subscriber'] = $this->Newsletter_model->editSubscriber($id);
        
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');
        
        if (!$this->form_validation->run()) {
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('dashboard/edit-subscriber');
            $this->load->view('dashboard/partials/footer');
        } else {
            $this->Newsletter_model->updateSubscriber($id);
            $this->session->set_flashdata('subscriber_updated', 'The email address was updated');
            redirect('dashboard/subscribers');
        }
    }
    
    public function delete($id)
    {
        // Only admins can delete subscribers
        if ($this->session->userdata('user_is_admin')) {
            
            // Do delete
            if ($this->Newsletter_model->deleteSubscriber($id)) {
                $this->session->set_flashdata('subscriber_delete_success', "The subscriber was deleted");
            } else {
                $this->session->set_flashdata('subscriber_delete_fail', "Failed to delete subscriber");
            }
            redirect('dashboard/subscribers');
            
        } else {
            $this->session->set_flashdata('admin_only_pages', 'Only admins are allowed to delete subscribers');
            redirect('dashboard');
        }
    }
    
    public function export()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        } else {
            // Admin ONLY area!
            if (!$this->session->userdata('user_is_admin')) {
                $this->session->set_flashdata('admin_only_pages', 'Only admins are allowed to export subscribers');
                redirect('dashboard');
            }
        }
        
        $data        = $this->Static_model->get_static_data();
        $subscribers = $this->Newsletter_model->fetchSubscribers();
        
        $file_name = 'subscribers_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");
        
        // CSV creation 
        $file   = fopen(BASEPATH . '../downloads/csv/' . $file_name, 'w');
        $header = array(
            "Email",
            "Subscription Date"
        );
        fputcsv($file, $header);
        foreach ($subscribers as $subscriber) {
            fputcsv($file, array(
                $subscriber->email,
                $subscriber->subscription_date
            ));
        }
        fclose($file);
        redirect('dashboard/subscribers');
    }
}