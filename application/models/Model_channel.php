<?php

class Model_channel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* get the active brands information */

    public function getActiveChannel() {
        $sql = "SELECT * FROM channel WHERE active = ?";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();
    }

    /* get the brand data */

    public function getChannelData($id = null) {
        if ($id) {
            $sql = "SELECT * FROM channel WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM channel";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function create($data) {
        if ($data) {
            $insert = $this->db->insert('channel', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id) {
        if ($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('channel', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id) {
        if ($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('channel');
            return ($delete == true) ? true : false;
        }
    }

    public function getChannelDataBulk($id = NULL) {
        if ($id) {
            $sql = "SELECT * FROM channel WHERE id IN  ?";
            $query = $this->db->query($sql, array($id));
            return $query->result_array();
        }
    }

}
