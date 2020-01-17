<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Workorder extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Workorder';

        $this->load->model('model_workorder');
        $this->load->model('model_channel');
        $this->load->model('model_produk');
        $this->load->model('model_attributes');
    }

    /*
     * It only redirects to the manage product page
     */

    public function index() {
        if (!in_array('viewWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('workorder/index', $this->data);
    }

    /*
     * It Fetches the products data from the product table 
     * this function is called from the datatable ajax function
     */

    public function fetchWorkorderData() {
        $result = array('data' => array());
        if (in_array('OnlyViewWorkorder', $this->permission)) {
            $data = $this->model_workorder->getApprovedWorkorderData();
        } else {
            $data = $this->model_workorder->getWorkorderData();
        }
        $cds = array();
        foreach ($data as $key => $value) {
            $channel_datas = $this->model_channel->getChannelDataBulk(json_decode($value['channel_name']));
            $arr_channel_name = array();
            foreach ($channel_datas as $channel_data) {
                $arr_channel_name[] = $channel_data['name'];
            }
            $channel_name = implode(", ", $arr_channel_name);
            $produk_datas = $this->model_produk->getProdukDataBulk(json_decode($value['produk_name']));
            $arr_produk_name = array();
            foreach ($produk_datas as $produk_data) {
                $arr_produk_name[] = $produk_data['name'];
            }
            $produk_name = implode(", ", $arr_produk_name);
            // button
            $buttons = '';
            if (in_array('updateWorkorder', $this->permission)) {
                $buttons .= '<a href="' . base_url('workorder/update/' . $value['id']) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>';
            }

            if (in_array('deleteWorkorder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-sm btn-danger" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            if (in_array('approveWorkorder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-sm btn-success" onclick="approveFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#approveModal"><i class="fa fa-check"></i></button>';
            }

            if (in_array('doneWorkorder', $this->permission)) {
                $buttons .= ' <a href="' . base_url('workorder/done/' . $value['id']) . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>';
            }
            $buttons .= ' <a href="' . base_url('workorder/detail/' . $value['id']) . '" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>';
            $name = isset($value['name']) ? $value['name'] : "";
            $lampiran = base_url($value['lampiran']);
            // $qty = isset($value['qty']) ? $value['qty']
            $img = "<img src='$lampiran' alt='$name' class='img-circle' width='50' height='50' />";

            $deadline = new DateTime(date('d-m-Y', strtotime($value['deadline'])));
            $input_date = new DateTime(date('d-m-Y', strtotime($value['input_date'])));
            $selisih = $input_date->diff($deadline);
            $qty_status = '';
            if ($value['bobot'] >= 1 and $value['bobot'] <= 40) {
                $qty_status = '<span class="label label-danger">Low !</span>';
            } else if ($value['bobot'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            } elseif ($value['bobot'] >= 41 and $value['bobot'] <= 70) {
                $qty_status = '<span class="label label-warning">Medium</span>';
            } elseif ($value['bobot'] >= 71) {
                $qty_status = '<span class="label label-success">High</span>';
            }
            // $img = "test";
            if ($value['status_desc'] == 'Waiting Approval') {
                $status_desc = '<span class="label label-warning">' . $value['status_desc'] . '</span>';
            } elseif ($value['status_desc'] == 'Approved') {
                if ($value['done'] == 1) {
                    $status_desc = '<span class="label label-info">Done</span>';
                } else {
                    $status_desc = '<span class="label label-success">' . $value['status_desc'] . '</span>';
                }
            } else {
                $status_desc = '<span class="label label-danger">' . $value['status_desc'] . '</span>';
            }

            $cds[$value['id']]['m1'] = $value['backend_days'] + $value['frontend_days'];
            $cds[$value['id']]['m2'] = $value['frontend_days'] + $value['qa_days'];

            $result['data'][$key] = array(
                $value['nomor_wo'],
                $value['wo_name'],
                $value['marketing_name'],
                $value['input_date'],
                $value['deadline'],
                $qty_status,
                $status_desc,
                $buttons,
                $value['id'],
            );
        } // /foreach

        $seq = array();
        for ($i = 0; $i < count($cds); $i++) {
            $choosen_m1 = '';
            $choosen_m2 = '';
            $choosen_id = '';
            foreach ($cds as $id => $cdss) {
                if ($cds[$id] != '') {
                    if ($choosen_id != '' and $choosen_m1 != '' and $choosen_m2 != '') {

                        if ($cdss['m1'] < $choosen_m1) {
                            $seq[$id] = $i;

                            $choosen_m1 = $cdss['m1'];
                            $choosen_m2 = $cdss['m2'];
                            $choosen_id = $id;
                        } elseif ($cdss['m1'] == $choosen_m1) {
                            if ($cdss['m2'] < $choosen_m2) {
                                $seq[$id] = $i;

                                $choosen_m1 = $cdss['m1'];
                                $choosen_m2 = $cdss['m2'];
                                $choosen_id = $id;
                            }
                        }
                    } else {
                        $choosen_m1 = $cdss['m1'];
                        $choosen_m2 = $cdss['m2'];
                        $choosen_id = $id;
                        $seq[$id] = $i;
                    }
                }
            }
            $cds[$choosen_id] = '';
        }
        foreach ($result['data'] as $i => $data) {
            $result['data'][$i][9] = $seq[$data[8]];
        }

        echo json_encode($result);
    }

    /*
     * If the validation is not valid, then it redirects to the create page.
     * If the validation for each input field is valid then it inserts the data into the database 
     * and it stores the operation message into the session flashdata and display on the manage product page
     */

    public function create() {
        if (!in_array('createWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('nomor_wo', 'Nomor WO', 'trim|required');
        $this->form_validation->set_rules('wo_name', 'Nama WO', 'trim|required');
        // $this->form_validation->set_rules('channel_name', 'Nama Channel', 'trim|required');
        // $this->form_validation->set_rules('produk_name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('marketing_name', 'Store', 'trim|required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
        $this->form_validation->set_rules('input_date', 'Tanggal Input', 'trim|required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'trim|required');
        $this->form_validation->set_rules('catatan', 'catatan', 'trim|required');
        $this->form_validation->set_rules('backend', 'backend', 'trim|required');
        $this->form_validation->set_rules('frontend', 'frontend', 'trim|required');
        $this->form_validation->set_rules('qa', 'qa', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case
            $data = array(
                'nomor_wo' => $this->input->post('nomor_wo'),
                'wo_name' => $this->input->post('wo_name'),
                'channel_name' => json_encode($this->input->post('channel')),
                'produk_name' => json_encode($this->input->post('produk')),
                'marketing_name' => $this->input->post('marketing_name'),
                'bobot' => $this->input->post('bobot'),
                'input_date' => $this->input->post('input_date'),
                'deadline' => $this->input->post('deadline'),
                'catatan' => $this->input->post('catatan'),
                'backend_days' => $this->input->post('backend'),
                'frontend_days' => $this->input->post('frontend'),
                'qa_days' => $this->input->post('qa'),
            );
            if ($_FILES['workorder_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $data['lampiran'] = $upload_image;
            }

            $cek_wo = $this->model_workorder->cekWo($this->input->post('nomor_wo'));
            if ($cek_wo['jumlah'] > 0) {
                echo "<script>alert('WO Number Already Exist!')</script>";
                $this->session->set_flashdata('errors', 'WO Number Already Exist!');
                redirect('workorder/create', 'refresh');
            } else {
                $create = $this->model_workorder->create($data);
            }
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('workorder/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('workorder/create', 'refresh');
            }
        } else {
            // false case            
            $this->data['channel'] = $this->model_channel->getActiveChannel();
            $this->data['produk'] = $this->model_produk->getActiveProduk();


            $this->render_template('workorder/create', $this->data);
        }
    }

    /*
     * This function is invoked from another function to upload the image into the assets folder
     * and returns the image path
     */

    public function upload_image() {
        // assets/images/product_image
        $config['upload_path'] = 'assets/images/workorder_image';
        $config['file_name'] = uniqid();
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx|pptx';
        $config['max_size'] = '10000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('workorder_image')) {
            $error = $this->upload->display_errors();
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['workorder_image']['name']);
            $type = $type[count($type) - 1];

            $path = $config['upload_path'] . '/' . $config['file_name'] . '.' . $type;
            return ($data == true) ? $path : false;
        }
    }

    public function upload_evidence() {
        // assets/images/product_image
        $config['upload_path'] = 'assets/images/workorder_evidence';
        $config['file_name'] = uniqid();
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx|pptx';
        $config['max_size'] = '10000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('workorder_evidence')) {
            $error = $this->upload->display_errors();
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['workorder_evidence']['name']);
            $type = $type[count($type) - 1];

            $path = $config['upload_path'] . '/' . $config['file_name'] . '.' . $type;
            return ($data == true) ? $path : false;
        }
    }

    /*
     * If the validation is not valid, then it redirects to the edit product page 
     * If the validation is successfully then it updates the data into the database 
     * and it stores the operation message into the session flashdata and display on the manage product page
     */

    public function update($workorder_id) {
        if (!in_array('updateWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$workorder_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('nomor_wo', 'Nomor WO', 'trim|required');
        $this->form_validation->set_rules('wo_name', 'Nama WO', 'trim|required');
        // $this->form_validation->set_rules('channel_name', 'Nama Channel', 'trim|required');
        // $this->form_validation->set_rules('produk_name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('marketing_name', 'Store', 'trim|required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');
        $this->form_validation->set_rules('input_date', 'Tanggal Input', 'trim|required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'trim|required');
        $this->form_validation->set_rules('catatan', 'catatan', 'trim|required');
        $this->form_validation->set_rules('backend', 'backend', 'trim|required');
        $this->form_validation->set_rules('frontend', 'frontend', 'trim|required');
        $this->form_validation->set_rules('qa', 'qa', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(
                'nomor_wo' => $this->input->post('nomor_wo'),
                'wo_name' => $this->input->post('wo_name'),
                'channel_name' => json_encode($this->input->post('channel')),
                'produk_name' => json_encode($this->input->post('produk')),
                'marketing_name' => $this->input->post('marketing_name'),
                'bobot' => $this->input->post('bobot'),
                'input_date' => $this->input->post('input_date'),
                'deadline' => $this->input->post('deadline'),
                'catatan' => $this->input->post('catatan'),
                'backend_days' => $this->input->post('backend'),
                'frontend_days' => $this->input->post('frontend'),
                'qa_days' => $this->input->post('qa'),
            );


            if ($_FILES['workorder_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('lampiran' => $upload_image);

                $this->model_workorder->update($upload_image, $workorder_id);
            }

            $update = $this->model_workorder->update($data, $workorder_id);
            if ($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('workorder/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('workorder/update/' . $workorder_id, 'refresh');
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
            $this->data['channel'] = $this->model_channel->getActiveChannel();
            $this->data['produk'] = $this->model_produk->getActiveProduk();


            $workorder_data = $this->model_workorder->getWorkorderData($workorder_id);
            $this->data['workorder_data'] = $workorder_data;
            $this->render_template('workorder/edit', $this->data);
        }
    }

    /*
     * It removes the data from the database
     * and it returns the response into the json format
     */

    public function remove() {
        if (!in_array('deleteWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $workorder_id = $this->input->post('workorder_id');

        $response = array();
        if ($workorder_id) {
            $delete = $this->model_workorder->remove($workorder_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the workorder information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    public function approve() {
        if (!in_array('approveWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $workorder_id = $this->input->post('workorder_id');
        $decision = ($this->input->post('decision') == 'Approve') ? 1 : 2;
        $msg = ($this->input->post('decision') == 'Approve') ? 'Approved' : 'Rejected';

        $data = array(
            'status_approval' => $decision
        );
        $response = array();
        if ($workorder_id) {
            $approve = $this->model_workorder->approve($workorder_id, $data);
            if ($approve == true) {
                $response['success'] = true;
                $response['messages'] = "Workorder $msg";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while approving the workorder";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }
        echo json_encode($response);
    }

    public function done($id) {
        if (!in_array('doneWorkorder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('nomor_wo', 'Nomor WO', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if ($_FILES['workorder_evidence']['size'] > 0) {
                $upload_evidence = $this->upload_evidence();
            }
            $done = $this->model_workorder->done($id, $upload_evidence);
            if ($done == true) {
                $this->session->set_flashdata('success', 'Workorder Done!');
                redirect('workorder/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('workorder/done/' . $id, 'refresh');
            }
        } else {
            $this->data['channel'] = $this->model_channel->getActiveChannel();
            $this->data['produk'] = $this->model_produk->getActiveProduk();
            $workorder_data = $this->model_workorder->getWorkorderData($id);
            $this->data['workorder_data'] = $workorder_data;
            $this->render_template('workorder/done', $this->data);
        }
    }

    public function detail($id) {
        $this->data['channel'] = $this->model_channel->getActiveChannel();
        $this->data['produk'] = $this->model_produk->getActiveProduk();
        $workorder_data = $this->model_workorder->getWorkorderData($id);
        $arr_evidence = explode("/", $workorder_data['evidence']);
        $workorder_data['evidence_file'] = $arr_evidence[count($arr_evidence) - 1];
        $this->data['workorder_data'] = $workorder_data;
        $this->render_template('workorder/detail', $this->data);
    }

}
