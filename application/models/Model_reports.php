<?php

class Model_reports extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* getting the total months */

    private function months() {
        return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    }

    /* getting the year of the orders */

    public function getOrderYear() {
        $sql = "SELECT * FROM orders WHERE paid_status = ?";
        $query = $this->db->query($sql, array(1));
        $result = $query->result_array();

        $return_data = array();
        foreach ($result as $k => $v) {
            $date = date('Y', $v['date_time']);
            $return_data[] = $date;
        }

        $return_data = array_unique($return_data);

        return $return_data;
    }

    // getting the order reports based on the year and moths
    public function getOrderData($year) {
        if ($year) {
            $months = $this->months();

            $sql = "SELECT * FROM orders WHERE paid_status = ?";
            $query = $this->db->query($sql, array(1));
            $result = $query->result_array();

            $final_data = array();
            foreach ($months as $month_k => $month_y) {
                $get_mon_year = $year . '-' . $month_y;

                $final_data[$get_mon_year][] = '';
                foreach ($result as $k => $v) {
                    $month_year = date('Y-m', $v['date_time']);

                    if ($get_mon_year == $month_year) {
                        $final_data[$get_mon_year][] = $v;
                    }
                }
            }


            return $final_data;
        }
    }
    public function getWorkorderData($year = NULL) {
        if ($year) {
            $sql = "SELECT a.*,status_desc FROM marketing a INNER JOIN status_approval b on a.status_approval = b.id WHERE input_date LIKE ? ORDER BY id DESC";
            $query = $this->db->query($sql, array("%".$year."%"));
            return $query->result_array();
        }

        $sql = "SELECT a.*,status_desc FROM marketing a INNER JOIN status_approval b on a.status_approval = b.id ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function getOvertimeData($year = NULL) {
        if ($year) {
            $sql = "SELECT a.*,status_desc FROM lembur a INNER JOIN status_approval b on a.status = b.id WHERE tgl_mulai LIKE ? ORDER BY id DESC";
            $query = $this->db->query($sql, array("%".$year."%"));
            return $query->result_array();
        }

        $sql = "SELECT a.*,status_desc FROM lembur a INNER JOIN status_approval b on a.status = b.id ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getKaryawanData() {
        $sql = "select nik,email,firstname,lastname,phone,b.gender_name gender from users a inner join gender b on a.gender = b.gender_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getChannelData() {
        $sql = "select name,nama_pic,no_hp from channel";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getProductData() {
        $sql = "select name from produk";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getGroupData() {
        $sql = "select group_name from groups";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getNumberWO() {
        $sql = "select report_wo from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberWO($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function getNumberOT() {
        $sql = "select report_ot from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberOT($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function getNumberKaryawan() {
        $sql = "select report_karyawan from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberKaryawan($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function getNumberChannel() {
        $sql = "select report_channel from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberChannel($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function getNumberProduct() {
        $sql = "select report_product from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberProduct($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
    
    public function getNumberGroup() {
        $sql = "select report_group from report_count";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function updateNumberGroup($data) {
        if ($data){
            $this->db->where('id', 0);
            $update = $this->db->update('report_count', $data);
            return ($update == true) ? true : false;
        }
    }
}
