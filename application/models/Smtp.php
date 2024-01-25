<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Smtp extends CI_Model {
  
  private $id;
  private $table_name = 'smtp';
  
  public function __construct()
  {
    parent::__construct();
  }
  
  public function setId($id)
  {
    $this->id = $id;
  }
  
  public function getId()
  {
    return $this->id;
  }
  
  public function add($data)
  {
    $this->db->insert($this->table_name, $data);
    return $this->db->insert_id();
  }
  
  public function update($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update($this->table_name, $data);
    return $this->db->affected_rows();
  }
  
  public function get($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get($this->table_name);
    return $query->row();
  }
  
  public function remove($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table_name);
    return $this->db->affected_rows();
  }
  
  public function getList()
  {
    $this->db->select('*');
    $this->db->from($this->table_name);
    $this->db->join('user', 'user.id = smtp.seller_id');
    $query = $this->db->get();
    return $query->result();
  }
}