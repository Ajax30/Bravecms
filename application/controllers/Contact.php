<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	private $headers = "";
	private $to = 'youremail@somedomain.com'; 
	private $email_address = '';
	private $name = '';
	private $subject = ''; 
	private $message = '';
	private $body = '';

	private $message_success = false;
	private $message_fail = false;

	public function index(){	
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');

		if($this->form_validation->run() === FALSE) {
			$data['errors'] = validation_errors();
			$this->displayForm();
		} else {
			//Prepare mail
			$this->subject = "Website Contact Form: " . $this->input->post('subject');
			$this->name = $this->input->post('name');
			$this->email_address = $this->input->post('email');
			$this->message = $this->input->post('message');
			$this->body = "You have received a new message from your website contact form. Here are the details:\n\nName: $this->name\n\nEmail: $this->email_address\n\nMessage:\n$this->message";
			$this->headers = "From: noreply@yourdomain.com\n";
			$this->headers .= "Reply-To: $this->email_address"; 

			//Send mail
			$this->send_mail();
			$this->displayForm();
		}		
	}

	public function displayForm() {
    $data = $this->Static_model->get_static_data();
		$data['base_url'] = base_url("/");
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['tagline'] = "Contact us";
		$data['errors'] = validation_errors();
		$data['message_success'] = $this->message_success;
		$data['message_fail'] = $this->message_fail;

		$this->twig->addGlobal('contactForm',"themes/{$data['theme_directory']}/templates/contact.twig");
		$this->twig->display("themes/{$data['theme_directory']}/layout", $data);
	}
	
	//mail sender method
	public function send_mail() {
		if (mail($this->to, $this->subject, $this->body, $this->headers)) {
			$this->message_success = true;
		} else {
			$this->message_fail = true;
		}
	}
	
}