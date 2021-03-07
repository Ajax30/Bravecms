<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	private $headers = array();
	private $from = 'noreply@yourdomain.com';
	private $to = 'contact@yourdomain.com'; 
	private $email_address = '';
	private $name = '';
	private $original_subject = '';
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

		$this->displayForm();

		if($this->form_validation->run() === FALSE) {
			$data['errors'] = validation_errors();
		} else {
			//Prepare mail
			$this->headers["From"] = "$this->from\n";
    	$this->headers["Reply-To"] = ": $this->email_address";
			$this->original_subject = $this->input->post('subject');
			$this->subject = "Website Contact Form: " . $this->original_subject;
			$this->name = $this->input->post('name');
			$this->email_address = $this->input->post('email');
			$this->message = $this->input->post('message');
			$this->body = "You have received a new message from your website contact form. Here are the details\r\nName: $this->name\r\nEmail: $this->email_address\r\nSubject:$this->original_subject\r\nMessage:\n$this->message";

			//Send mail
			$this->send_mail();
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
			// Email settings
			$config = array();
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp.yourdomain.com';
			$config['smtp_user'] = 'contact@yourdomain.com';
			$config['smtp_pass'] = '******';
			$config['smtp_port'] = 25;
			$config['charset']  = 'utf-8';
			$config['mailtype'] = 'html';
			$config['newline']   = "\r\n";  

		
			if (!$this->load->is_loaded('email')) {
					$this->load->library('email', $config);
			} else {
					$this->email->initialize($config);
			}

			// set haders
			foreach($this->headers as $key => $value){
				$this->email->set_header($key, $value);
			}
		
		$this->email->from($this->from);
    $this->email->to($this->to);
    $this->email->subject($this->subject);
    $this->email->message($this->body);

		if ($this->email->send()) {
			$this->message_success = true;
		} else {
			$this->message_fail = true;
		}
	}
	
}