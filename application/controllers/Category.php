<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Category_model');
	}

	public function index()
	{
		$data['mainCategories'] = $this->Category_model->getMainCategories();
		$this->load->view('categories', $data);
	}

	public function get_children()
	{
		$response = array();

		if (!$this->input->is_ajax_request()) {
			$response['status'] = 'error';
			$response['error_code'] = 1002;
			$response['message'] = 'Invalid request';

			$this->_send_response($response);
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_id', 'Category', 'required|is_natural');
		if ($this->form_validation->run() === FALSE) {
			$response['status'] = 'error';
			$response['error_code'] = 1003;
			$response['message'] = form_error('category_id');

			$this->_send_response($response);
		}

		$categoryId = $this->input->post('category_id');
		$childCategories = $this->Category_model->getChildCategories($categoryId);

		if (!empty($childCategories)) {
			$response['status'] = 'success';
			$response['data'] = $childCategories;
		} else {
			$response['status'] = 'error';
			$response['error_code'] = 1001;
			$response['message'] = 'No child categories found.';
		}

		$this->_send_response($response);
	}

	private function _send_response($response_data)
	{
		echo json_encode($response_data);
		exit;
	}
}
