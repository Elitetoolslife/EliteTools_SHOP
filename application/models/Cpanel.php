<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpanel extends CI_Model {

    private $id;
    private $table_name = 'cpanel';

    public function __construct() {
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function add($data) {
        return $this->db->insert($this->table_name, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }

    public function get($id = FALSE) {
        $id = $id ? $id : $this->id;
        if ($id) {
            $query = $this->db->get_where($this->table_name, array('id' => $id));
            return $query->row_array();
        } else {
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        }
    }

    public function remove($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_name);
    }

    public function getList() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->join('user', 'user.id = cpanel.seller_id');
        $query = $this->db->get();
        return $query->result();
    }
}