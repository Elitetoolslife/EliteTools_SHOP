<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Model {

    private $id;
    private $table_name = 'admin';

    public function __construct() {
        parent::__construct();
    }

    public function checkLogin($login, $password) {
        $hash = hash('sha256', $password);
        $query = $this->db->get_where($this->table_name, array('login' => $login, 'password' => $hash));
        return $query->num_rows() > 0 ? TRUE : FALSE;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function add($data) {
        $data['password'] = hash('sha256', $data['password']);
        return $this->db->insert($this->table_name, $data);
    }

    public function update($id, $data) {
        if(isset($data['password'])) {
            $data['password'] = hash('sha256', $data['password']);
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table_name, $data);
    }

    public function get($id = NULL) {
        if ($id === NULL) {
            $query = $this->db->get($this->table_name);
            return $query->result_array();
        } else {
            $query = $this->db->get_where($this->table_name, array('id' => $id));
            return $query->row_array();
        }
    }

    public function remove($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table_name);
    }

}