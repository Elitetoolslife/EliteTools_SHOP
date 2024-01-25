<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rdp extends CI_Model {

    private $id;
    private $table_name = 'rdp';

    public function __construct() {
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    // Existing getList() method...

    public function add($data) {
        return $this->db->insert($this->table_name, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }

    public function get($id) {
        $query = $this->db->get_where($this->table_name, array('id' => $id));
        return $query->row_array();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_name);
    }

}