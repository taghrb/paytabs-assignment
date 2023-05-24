<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Category_model');
	}

	public function index() {
		$data['mainCategories'] = $this->Category_model->getMainCategories();
		$this->load->view('categories', $data);
	}

	public function get_children() {
		$categoryId = $this->input->post('category_id');
		$childCategories = $this->Category_model->getChildCategories($categoryId);

		$response = array();

		if (!empty($childCategories)) {
			$response['status'] = 'success';
			$response['data'] = $childCategories;
		} else {
			$response['status'] = 'error';
			$response['message'] = 'No child categories found.';
		}

		echo json_encode($response);
		exit;
	}
}
