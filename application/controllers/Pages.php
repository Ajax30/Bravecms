<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function page($page_id) {
		$data = $this->Static_model->get_static_data();
		$data['base_url'] = base_url("/");
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['authors'] = $this->Usermodel->getAuthors();
		$data['posts'] = $this->Posts_model->sidebar_posts($limit=5, $offset=0);
		$data['page'] = $this->Pages_model->get_page($page_id);

		if ($data['categories']) {
			foreach ($data['categories'] as &$category) {
				$category->posts_count = $this->Posts_model->count_posts_in_category($category->id);
			}
		}

		if (!empty($data['page'])) {
				// Overwrite the default tagline with the page title
				$data['tagline'] = $data['page']->title;
				$this->load->view('dashboard/partials/header', $data);
				$this->twig->addGlobal('pageTemplate',"themes/{$data['theme_directory']}/templates/page.twig");
				$this->twig->display("themes/{$data['theme_directory']}/layout", $data);
			} else {
				$data['tagline'] = "Page not found";
				$this->load->view('dashboard/partials/header', $data);
				$this->load->view('404');
			}
			$this->load->view('dashboard/partials/footer');
	}

}