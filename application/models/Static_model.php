<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Static_model extends CI_Model {

	public function get_static_data() {
		$data['site_title'] = "My Blog";
		$data['tagline'] = "A simple blog application made with Codeigniter 3";
		$data['company_name'] = "My Company";
		$data['company_email'] = "company@domain.com";
		$data['is_featured'] = true;
		$data['twitter'] = "https://twitter.com/";
		$data['facebook'] = "https://facebook.com/";
		$data['instagram'] = "https://instagram.com/";

		$data['theme_directory'] = "calvin";
		$data['is_frontend'] = false;
		$data['is_ckeditor'] = false;
		$data['is_newsletter'] = true;
		$data['is_cookieconsent'] = true;
		return $data;
	}

}