<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Newpassword extends CI_Controller
{
    public function index($token = NULL)
    {
        $data               = $this->Static_model->get_static_data();
        $data['pages']      = $this->Pages_model->get_pages();
        $data['tagline']    = 'New password';
        $data['categories'] = $this->Categories_model->get_categories();
        $data['token']      = $token;
        
        // Form validation rules
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');
        
        if (!$this->form_validation->run()) {
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('auth/newpassword');
            $this->load->view('dashboard/partials/footer');
        } else {
            // Encrypt new password
            $enc_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            
            if ($this->Usermodel->set_new_password($token, $enc_password)) {
                $this->session->set_flashdata("new_password_success", "Your new password was set. You can login");
                redirect('login');
            } else {
                $this->session->set_flashdata("new_password_fail", "We have failed updating your password");
                redirect('/newpassword/' . $token);
            }
        }
    }
}