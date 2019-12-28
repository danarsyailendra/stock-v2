<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Channel';

		$this->load->model('model_channel');
	}

	/* 
	* It only redirects to the manage product page and
	*/
	public function index()
	{
		if(!in_array('viewChannel', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$result = $this->model_channel->getChannelData();

		$this->data['results'] = $result;

		$this->render_template('channel/index', $this->data);
	}

	/*
	* Fetches the brand data from the brand table 
	* this function is called from the datatable ajax function
	*/
	public function fetchChannelData()
	{
		$result = array('data' => array());

		$data = $this->model_channel->getChannelData();
		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('viewChannel', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editChannel('.$value['id'].')" data-toggle="modal" data-target="#editChannelModal"><i class="fa fa-pencil"></i></button>';	
			}
			
			if(in_array('deleteChannel', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeChannel('.$value['id'].')" data-toggle="modal" data-target="#removeChannelModal"><i class="fa fa-trash"></i></button>
				';
			}				

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['nama_pic'],
				$value['no_hp'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the brand id and retreives
	* the brand information from the brand model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchChannelDataById($id)
	{
		if($id) {
			$data = $this->model_channel->getChannelData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createChannel', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('channel_name', 'Channel name', 'trim|required');
		$this->form_validation->set_rules('nama_pic', 'pic name', 'trim|required');
		$this->form_validation->set_rules('no_hp', 'phone number', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('channel_name'),
        		'nama_pic' => $this->input->post('nama_pic'),
        		'no_hp' => $this->input->post('no_hp'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_channel->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the channel information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);

	}

	/*
	* Its checks the brand form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateChannel', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_channel_name', 'Channel name', 'trim|required');
			$this->form_validation->set_rules('edit_nama_pic', 'pic name', 'trim|required');
			$this->form_validation->set_rules('edit_no_hp', 'phone number', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_channel_name'),
	        		'nama_pic' => $this->input->post('edit_nama_pic'),
        			'no_hp' => $this->input->post('edit_no_hp'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_channel->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the channel information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the brand information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteChannel', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$channel_id = $this->input->post('channel_id');
		$response = array();
		if($channel_id) {
			$delete = $this->model_channel->remove($channel_id);

			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the channel information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}