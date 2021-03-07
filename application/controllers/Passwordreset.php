<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passwordreset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    private $sender_email = "noreply@yourdomain.com";
    private $sender_name = "Razvan Zamfir";
    private $user_email = '';
    private $subject = 'Pasword reset link';
    private $token = '';
    private $reset_url = '';
    private $reset_link = '';
    private $body = '';
    
    public function index()
    {
        // Display form
        $data               = $this->Static_model->get_static_data();
        $data['pages']      = $this->Pages_model->get_pages();
        $data['tagline']    = 'Reset your password';
        $data['categories'] = $this->Categories_model->get_categories();
        
        // Form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');
        
        if (!$this->form_validation->run()) {
            $this->load->view('dashboard/partials/header', $data);
            $this->load->view('auth/passwordreset');
            $this->load->view('dashboard/partials/footer');
        } else {
            if ($this->Usermodel->email_exists()) {
                
                //Get user email
                $this->user_email = $this->input->post('email');
                
                //create token
                $this->token = md5(str_shuffle($this->user_email));
                
                //create url
                $this->reset_url = base_url('newpassword/') . $this->token;
                
                //create reset link
                $this->reset_link = '<a href="' . $this->reset_url . '">password reset link</a>';
                
                $this->body = "Here is your <strong>" . $this->reset_link . "</strong>. After clicking it you will be redirected to a page on the website where you will be able to set a new pasword.";
                
                // Update paswword reset token
                $this->updateToken($this->user_email, $this->token);
                
                // Send mail and rediect
                $this->sendResetMail();
                
            } else {
                $this->session->set_flashdata('email_non_existent', "The email you provided does not exist in our database");
            }
            redirect('newpassword');
        }
    }
    
    public function updateToken($user_email, $token)
    {
        $user_email = $this->user_email;
        $token      = $this->token;
        $this->Usermodel->update_token($user_email, $token);
    }
    
    public function sendResetMail()
    {
        // Email settings
        $config              = array();
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'smtp.yourdomain.com';
        $config['smtp_user'] = 'noreply@yourdomain.com';
        $config['smtp_pass'] = '******';
        $config['smtp_port'] = 25;
        $config['charset']   = 'utf-8';
        $config['mailtype']  = 'html';
        $config['newline']   = "\r\n";
        
        if (!$this->load->is_loaded('email')) {
            $this->load->library('email', $config);
        } else {
            $this->email->initialize($config);
        }
        
        // Build the body and meta data of the email message
        $this->email->from($this->sender_email, $this->sender_name);
        $this->email->to($this->user_email);
        $this->email->subject($this->subject);
        
        $this->email->message($this->body);
        
        if ($this->email->send()) {
            $this->session->set_flashdata('reset_mail_confirm', "A pasword reset link was send to the email address $this->user_email");
        } else {
            $this->session->set_flashdata('reset_mail_fail', "Our atempt to send a pasword reset link to $this->user_email has failed");
        }
    }
}