<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function loginHeader()
{
  $CI =& get_instance();
  $CI->load->view('login_header'); // Assuming you have a view named 'login_header.php'
}

function loginFooter()
{
  $CI =& get_instance();
  $CI->load->view('login_footer'); // Assuming you have a view named 'login_footer.php'
}