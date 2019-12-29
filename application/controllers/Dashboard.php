<?php

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Dashboard';

        $this->load->model('model_workorder');
        $this->load->model('model_lembur');
        $this->load->library('Pdf');
    }

    /*
     * It only redirects to the manage category page
     * It passes the total product, total paid orders, total users, and total stores information
      into the frontend.
     */

    public function index() {
        $list_wos = $this->model_workorder->dashboardWorkorder();
        $arr_wo = array();
        $wait = 0;
        $reject = 0;
        $approve = 0;
        $done = 0;
        foreach ($list_wos as $list_wo) {
            if ($list_wo['status'] == 'Waiting Approval') {
                $wait++;
                $arr_wo[$list_wo['status']] = $wait;
            } else if ($list_wo['status'] == 'Approved') {
                $approve++;
                $arr_wo[$list_wo['status']] = $approve;
            } else if ($list_wo['status'] == 'Rejected') {
                $reject++;
                $arr_wo[$list_wo['status']] = $reject;
            } else {
                $done++;
                $arr_wo[$list_wo['status']] = $done;
            }
        }

        $piewo = array();
        foreach ($arr_wo as $key => $value) {
            $object = new stdClass();
            $object->value = $value;
            $object->label = $key;
            if ($key == 'Rejected') {
                $object->color = '#f56954';
                $object->highlight = '#f56954';
            } elseif ($key == 'Done') {
                $object->color = '#00a65a';
                $object->highlight = '#00a65a';
            } elseif ($key == 'Waiting Approval') {
                $object->color = '#f39c12';
                $object->highlight = '#f39c12';
            } else {
                $object->color = '#3c8dbc';
                $object->highlight = '#3c8dbc';
            }

            $piewo[] = $object;
        }
        $this->data['pie_wo'] = json_encode($piewo);

        $list_lemburs = $this->model_lembur->dashboardLembur();
        $arr_lembur = array();
        $wait = 0;
        $reject = 0;
        $approve = 0;
        foreach ($list_lemburs as $list_lembur) {
            if ($list_lembur['status_desc'] == 'Waiting Approval') {
                $wait++;
                $arr_lembur[$list_lembur['status_desc']] = $wait;
            } else if ($list_lembur['status_desc'] == 'Approved') {
                $approve++;
                $arr_lembur[$list_lembur['status_desc']] = $approve;
            } else if ($list_lembur['status_desc'] == 'Rejected') {
                $reject++;
                $arr_lembur[$list_lembur['status_desc']] = $reject;
            }
        }

        $pielembur = array();
        foreach ($arr_lembur as $key => $value) {
            $object = new stdClass();
            $object->value = $value;
            $object->label = $key;
            if ($key == 'Rejected') {
                $object->color = '#f56954';
                $object->highlight = '#f56954';
            } elseif ($key == 'Approved') {
                $object->color = '#00a65a';
                $object->highlight = '#00a65a';
            } elseif ($key == 'Waiting Approval') {
                $object->color = '#f39c12';
                $object->highlight = '#f39c12';
            }

            $pielembur[] = $object;
        }
        $this->data['pie_lembur'] = json_encode($pielembur);
        
        $list_mixs = $this->model_workorder->dashboardMix();
        $piemix = array();
        foreach ($list_mixs as $key => $value) {
            $object = new stdClass();
            $object->value = $value['jumlah'];
            $object->label = $value['status'];
            if ($key == 'Overtime') {
                $object->color = '#ff851b';
                $object->highlight = '#ff851b';
            } else{
                $object->color = '#D81B60';
                $object->highlight = '#D81B60';
            }

            $piemix[] = $object;
        }
        $this->data['pie_mix'] = json_encode($piemix);

        $user_id = $this->session->userdata('id');
        $is_admin = ($user_id == 1 or $user_id == 9) ? true : false;

        $this->data['is_admin'] = $is_admin;
        $this->render_template('dashboard', $this->data);
    }
    
    public function woChartPDF() {
        $image = $this->input->post('imagewo');
        $data = array(
            'image' => $image,
            'page_total' => $this->pdf->get_canvas()->get_page_count()
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Workorder-Chart.pdf";
        $this->pdf->load_view('dashboard/wo_chart_pdf', $data);
    }
    public function otChartPDF() {
        $image = $this->input->post('imageot');
        $data = array(
            'image' => $image,
            'page_total' => $this->pdf->get_canvas()->get_page_count()
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Overtime-Chart.pdf";
        $this->pdf->load_view('dashboard/ot_chart_pdf', $data);
    }
    public function mixChartPDF() {
        $image = $this->input->post('imagemix');
        $data = array(
            'image' => $image,
            'page_total' => $this->pdf->get_canvas()->get_page_count()
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "mix-Chart.pdf";
        $this->pdf->load_view('dashboard/mix_chart_pdf', $data);
    }

}
