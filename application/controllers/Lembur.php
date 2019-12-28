<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Lembur';

        $this->load->model('model_lembur');
        $this->load->model('model_products');
        $this->load->model('model_attributes');
        $this->load->model('model_workorder');
    }

    /*
     * It only redirects to the manage lembur page
     */

    public function index() {
        if (!in_array('viewLembur', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('lembur/index', $this->data);
    }

    /*
     * It Fetches the products data from the product table 
     * this function is called from the datatable ajax function
     */

    public function fetchLemburData() {
        $result = array('data' => array());

        $data = $this->model_lembur->getLemburData();

        foreach ($data as $key => $value) {
            //start get nama WO
            if ($value['wo_name_overtime'] != 'null') {
                $wo_datas = $this->model_workorder->getWorkorderDataBulk(json_decode($value['wo_name_overtime']));
                $arr_wo = array();
                foreach ($wo_datas as $wo_data) {
                    $arr_wo[] = $wo_data['wo_name'];
                }
                $wo_name = implode(", ", $arr_wo);
            }
            //end get nama WO
            // button
            $buttons = '';
            if (in_array('updateLembur', $this->permission)) {
                $buttons .= '<a href="' . base_url('lembur/update/' . $value['id']) . '" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if (in_array('deleteLembur', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            if (in_array('approveLembur', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-success" onclick="approveFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#approveModal"><i class="fa fa-check"></i></button>';
            }
            if ($value['status_desc'] == 'Waiting Approval') {
                $status_desc = '<span class="label label-warning">' . $value['status_desc'] . '</span>';
            } elseif ($value['status_desc'] == 'Approved') {
                $status_desc = '<span class="label label-success">' . $value['status_desc'] . '</span>';
            } else {
                $status_desc = '<span class="label label-danger">' . $value['status_desc'] . '</span>';
            }
            $result['data'][$key] = array(
                $value['tgl_mulai'],
                $value['tgl_akhir'],
                $wo_name,
                $value['ket_overtime'],
                $status_desc,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    /*
     * If the validation is not valid, then it redirects to the create page.
     * If the validation for each input field is valid then it inserts the data into the database 
     * and it stores the operation message into the session flashdata and display on the manage product page
     */

    public function create() {
        if (!in_array('createLembur', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai Lembur', 'trim|required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir Lembur', 'trim|required');
        // $this->form_validation->set_rules('nama_wo', 'Nama WO', 'trim|required');
        $this->form_validation->set_rules('ket_overtime', 'Keterangan', 'trim|required');



        if ($this->form_validation->run() == TRUE) {
            // true case


            $data = array(
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'wo_name_overtime' => json_encode($this->input->post('wo_name_overtime')),
                'ket_overtime' => $this->input->post('ket_overtime'));

            $create = $this->model_lembur->create($data);
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('lembur/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('lembur/create', 'refresh');
            }
        } else {
            // false case
            // attributes 
            $wo_data = $this->model_lembur->getWorkorderData();

            $this->data['wo'] = $wo_data;


            $this->render_template('lembur/create', $this->data);
        }
    }

    /*
     * This function is invoked from another function to upload the image into the assets folder
     * and returns the image path
     */


    /*
     * If the validation is not valid, then it redirects to the edit product page 
     * If the validation is successfully then it updates the data into the database 
     * and it stores the operation message into the session flashdata and display on the manage product page
     */

    public function update($lembur_id) {
        if (!in_array('updateLembur', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$lembur_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai Lembur', 'trim|required');
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir Lembur', 'trim|required');
        // $this->form_validation->set_rules('nama_wo', 'Nama WO', 'trim|required');
        $this->form_validation->set_rules('ket_overtime', 'Keterangan', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'wo_name_overtime' => json_encode($this->input->post('wo_name_overtime')),
                'ket_overtime' => $this->input->post('ket_overtime'));


            $update = $this->model_lembur->update($data, $lembur_id);
            if ($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('lembur/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('lembur/update/' . $lembur_id, 'refresh');
            }
        } else {
            // attributes 
            $attribute_data = $this->model_attributes->getActiveAttributeData();

            $attributes_final_data = array();
            foreach ($attribute_data as $k => $v) {
                $attributes_final_data[$k]['attribute_data'] = $v;

                $value = $this->model_attributes->getAttributeValueData($v['id']);

                $attributes_final_data[$k]['attribute_value'] = $value;
            }

            // false case
            $this->data['attributes'] = $attributes_final_data;


            $lembur_data = $this->model_lembur->getLemburData($lembur_id);
            $this->data['lembur_data'] = $lembur_data;
            $this->render_template('lembur/edit', $this->data);
        }
    }

    /*
     * It removes the data from the database
     * and it returns the response into the json format
     */

    public function remove() {
        if (!in_array('deleteLembur', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $lembur_id = $this->input->post('lembur_id');

        $response = array();
        if ($lembur_id) {
            $delete = $this->model_lembur->remove($lembur_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the overtime information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    public function approve() {
        if (!in_array('approveLembur', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $lembur_id = $this->input->post('lembur_id');
        $decision = ($this->input->post('decision') == 'Approve') ? 1 : 2;
        $msg = ($this->input->post('decision') == 'Approve') ? 'Approved' : 'Rejected';

        $data = array(
            'status' => $decision
        );
        $response = array();
        if ($lembur_id) {
            $approve = $this->model_lembur->approve($lembur_id, $data);
            if ($approve == true) {
                $response['success'] = true;
                $response['messages'] = "Overtime $msg";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while approving the overtime";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }
        echo json_encode($response);
    }

}
