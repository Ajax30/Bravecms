<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index() {
    $data = $this->Static_model->get_static_data();
    $data['pages'] = $this->Pages_model->get_pages();
    $data['tagline'] = 'Sign in to your ' . $data['site_title'] . ' account.';
    $data['categories'] = $this->Categories_model->get_categories();

    $this->load->view('dashboard/partials/header', $data);
    $this->load->view('auth/login');
    $this->load->view('dashboard/partials/footer');
  }

  public function login() {  
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
    $this->form_validation->set_error_delimiters('<p class="error-message">', '</p>');
    if ($this->form_validation->run()) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
    
      $this->load->model('Usermodel');
      $current_user = $this->Usermodel->user_login($email, $password);
        // If we find a user
      if ($current_user) {
        // If the user found is active
        if ($current_user->active == 1) {
          $this->session->set_userdata(
           array(
            'user_id' => $current_user->id,
            'user_email' => $current_user->email,
            'user_avatar' => $current_user->avatar,
            'user_first_name' => $current_user->first_name,
            'user_is_admin' => $current_user->is_admin,
            'user_active' => $current_user->active,
            'is_logged_in' => TRUE
            )
           );

           // Remember me
           if (!empty($this->input->post('remember_me'))) {
            setcookie ('userEmail', $email, time() + (7 * 24 * 3600));  
            setcookie ('userPassword', $password,  time() + (7 * 24 * 3600));
           } else {
            setcookie ('userEmail', ''); 
            setcookie ('userPassword','');
          }
           
          // After login, display flash message
          $this->session->set_flashdata('user_signin', 'You have signed in');
          //and redirect to the posts page
          redirect('/dashboard');
        } else {
          // If the user found is NOT active
          $this->session->set_flashdata("login_failure_activation", "Your account has not been activated yet.");
          redirect('login'); 
        }
      } else {
        // If we do NOT find a user
        $this->session->set_flashdata("login_failure_incorrect", "Incorrect email or password.");
        redirect('login'); 
      }
    }
    else {
      $this->index();
    }
  }

  public function logout(){
    // Unset the current user's data
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_email');
    $this->session->unset_userdata('user_first_name');
    $this->session->unset_userdata('is_logged_in');

    $this->session->set_flashdata('user_signout', 'You have signed out');

    /* After user has signed out, redirect him/her to posts page */
    redirect('/dashboard');   
  }
}


