<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['page_title'] = 'Reports';
        $this->load->model('model_reports');
        $this->load->model('model_workorder');
    }

    /*
     * It redirects to the report page
     * and based on the year, all the orders data are fetch from the database.
     */

    public function index() {
        if (!in_array('viewReports', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $today_year = date('Y');

        if ($this->input->post('select_year')) {
            $today_year = $this->input->post('select_year');
        }

        $parking_data = $this->model_reports->getOrderData($today_year);
        $this->data['report_years'] = $this->model_reports->getOrderYear();


        $final_parking_data = array();
        foreach ($parking_data as $k => $v) {

            if (count($v) > 1) {
                $total_amount_earned = array();
                foreach ($v as $k2 => $v2) {
                    if ($v2) {
                        $total_amount_earned[] = $v2['gross_amount'];
                    }
                }
                $final_parking_data[$k] = array_sum($total_amount_earned);
            } else {
                $final_parking_data[$k] = 0;
            }
        }

        $this->data['selected_year'] = $today_year;
        $this->data['company_currency'] = $this->company_currency();
        $this->data['results'] = $final_parking_data;

        $this->render_template('reports/index', $this->data);
    }

    public function fetchWorkorderData() {
        $year = ($this->input->post('year') == '') ? NULL : $this->input->post('year');
        $wo_data = $this->model_reports->getWorkorderData($year);
        $data = array('data' => array());
        foreach ($wo_data as $value) {
            $qty_status = '';
            if ($value['bobot'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if ($value['bobot'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }

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

            $data['data'][] = array(
                $value['nomor_wo'],
                $value['wo_name'],
                $value['marketing_name'],
                $qty_status,
                $status_desc
            );
        }

        echo json_encode($data);
    }

    public function woPDF() {
        $year = $this->input->post('year_wo');
        $wo_data = $this->model_reports->getWorkorderData($year);
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberWO()['report_wo']+1;
        $arr_number = array(
          "report_wo" => $number  
        );
        $this->model_reports->updateNumberWO($arr_number);
        $data = array(
            'wo_data' => $wo_data,
            'year' => $year,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTWO/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Workorder-$year.pdf";
        $this->pdf->load_view('reports/wo_pdf', $data);
    }

    public function fetchOvertimeData() {
        $year = ($this->input->post('year') == '') ? NULL : $this->input->post('year');
        $ot_data = $this->model_reports->getOvertimeData($year);
        $data = array('data' => array());
        foreach ($ot_data as $value) {
            if ($value['wo_name_overtime'] != 'null') {
                $wo_datas = $this->model_workorder->getWorkorderDataBulk(json_decode($value['wo_name_overtime']));
                $arr_wo = array();
                foreach ($wo_datas as $wo_data) {
                    $arr_wo[] = $wo_data['wo_name'];
                }
                $wo_name = implode(", ", $arr_wo);
            }
            if ($value['status_desc'] == 'Waiting Approval') {
                $status_desc = '<span class="label label-warning">' . $value['status_desc'] . '</span>';
            } elseif ($value['status_desc'] == 'Approved') {
                $status_desc = '<span class="label label-success">' . $value['status_desc'] . '</span>';
            } else {
                $status_desc = '<span class="label label-danger">' . $value['status_desc'] . '</span>';
            }

            $data['data'][] = array(
                $value['tgl_mulai'],
                $value['tgl_akhir'],
                $wo_name,
                $value['ket_overtime'],
                $status_desc,
            );
        }

        echo json_encode($data);
    }

    public function otPDF() {
        $year = $this->input->post('year_ot');
        $ot_data = $this->model_reports->getOvertimeData($year);
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberOT()['report_ot']+1;
        $arr_number = array(
          "report_ot" => $number  
        );
        $this->model_reports->updateNumberOT($arr_number);

        foreach ($ot_data as $key => $value) {
            if ($value['wo_name_overtime'] != 'null') {
                $wo_datas = $this->model_workorder->getWorkorderDataBulk(json_decode($value['wo_name_overtime']));
                $arr_wo = array();
                foreach ($wo_datas as $wo_data) {
                    $arr_wo[] = $wo_data['wo_name'];
                }
                $ot_data[$key]['wo_name_overtime'] = implode(", ", $arr_wo);
            }
        }


        $data = array(
            'ot_data' => $ot_data,
            'year' => $year,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTLMBR/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Overtime-$year.pdf";
        $this->pdf->load_view('reports/ot_pdf', $data);
    }

    public function fetchKaryawanData() {
        $karyawanDatas = $this->model_reports->getKaryawanData();
        $data = array('data' => array());
        foreach ($karyawanDatas as $value) {
            $data['data'][] = array(
                $value['nik'],
                $value['firstname'] . ' ' . $value['lastname'],
                $value['email'],
                $value['phone'],
                $value['gender']
            );
        }
        echo json_encode($data);
    }

    public function karyawanPDF() {
        $karyawanDatas = $this->model_reports->getKaryawanData();
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberKaryawan()['report_karyawan']+1;
        $arr_number = array(
          "report_karyawan" => $number  
        );
        $this->model_reports->updateNumberKaryawan($arr_number);
        
        $data = array(
            'karyawan_data' => $karyawanDatas,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTKYWN/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Karyawan.pdf";
        $this->pdf->load_view('reports/karyawan_pdf', $data);
    }

    public function fetchChannelData() {
        $channelDatas = $this->model_reports->getChannelData();
        $data = array('data' => array());
        foreach ($channelDatas as $value) {
            $data['data'][] = array(
                $value['name'],
                $value['nama_pic'],
                $value['no_hp']
            );
        }
        echo json_encode($data);
    }

    public function channelPDF() {
        $channelDatas = $this->model_reports->getChannelData();
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberChannel()['report_channel']+1;
        $arr_number = array(
          "report_channel" => $number  
        );
        $this->model_reports->updateNumberChannel($arr_number);

        $data = array(
            'channel_datas' => $channelDatas,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTCHNL/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Channel.pdf";
        $this->pdf->load_view('reports/channel_pdf', $data);
    }

    public function fetchProductData() {
        $productDatas = $this->model_reports->getProductData();
        $data = array('data' => array());
        $i = 0;
        foreach ($productDatas as $value) {
            $i++;
            $data['data'][] = array(
                $i,
                $value['name']
            );
        }
        echo json_encode($data);
    }

    public function productPDF() {
        $produkDatas = $this->model_reports->getProductData();
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberProduct()['report_product']+1;
        $arr_number = array(
          "report_product" => $number  
        );
        $this->model_reports->updateNumberProduct($arr_number);

        $data = array(
            'produk_datas' => $produkDatas,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTPRDK/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Produk.pdf";
        $this->pdf->load_view('reports/produk_pdf', $data);
    }

    public function fetchGroupData() {
        $groupDatas = $this->model_reports->getGroupData();
        $data = array('data' => array());
        $i = 0;
        foreach ($groupDatas as $value) {
            $i++;
            $data['data'][] = array(
                $i,
                $value['group_name']
            );
        }
        echo json_encode($data);
    }

    public function groupPDF() {
        $groupDatas = $this->model_reports->getGroupData();
        $this->load->library('Pdf');
        $number = $this->model_reports->getNumberGroup()['report_group']+1;
        $arr_number = array(
          "report_group" => $number  
        );
        $this->model_reports->updateNumberGroup($arr_number);

        $data = array(
            'group_datas' => $groupDatas,
            'page_total' => $this->pdf->get_canvas()->get_page_count(),
            'number' => 'FINNET/'.$number.'/RPTUSGP/'.date('Y')
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Group.pdf";
        $this->pdf->load_view('reports/user_group_pdf', $data);
    }

}
