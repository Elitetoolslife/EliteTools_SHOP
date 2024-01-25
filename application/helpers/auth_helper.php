<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sessionLogin($role)
{
  $CI =& get_instance();
  $CI->load->library('session');
  
  $CI->session->set_userdata('logged', TRUE);
  $CI->session->set_userdata('role', $role);
}

function sessionLogout() 
{
  $CI =& get_instance();
  $CI->load->library('session');
  
  $CI->session->unset_userdata('logged');
  $CI->session->unset_userdata('role');
}

function isLoggedIn()
{
  $CI =& get_instance();
  $CI->load->library('session');

  return $CI->session->userdata('logged') === TRUE;
}

function userRole()
{
  $CI =& get_instance();
  $CI->load->library('session');

  return $CI->session->userdata('role');
}