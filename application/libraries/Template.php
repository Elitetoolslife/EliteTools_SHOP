<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
  private $var_holder = array();
  private $rep_holder = array();
  private $base_url;
  private $use_extension;
  private $extension;
  private $views_path;
  private $header_template;
  private $footer_template;
  
  public function __construct()
  {
    $this->base_url = 'http://localhost/xbasetools';
    $this->use_extension = FALSE;
    $this->extension = 'html';
    $this->views_path = 'application/views/';
    $this->header_template = 'header';
    $this->footer_template = 'footer';

    // Load CI instance and any libraries/helpers you need
    $CI =& get_instance();
    $CI->load->helper('url'); // For example, loading the URL helper
  }

  // ... (rest of the class methods)

}


  public function setViewsPath($path)
  {
    $this->views_path = $path;
  }
  
  public function getViewsPath()
  {
    return $this->views_path;
  }
    
  public function getExtension()
  {
    return $this->extension;
  }
  
  public function setExtension($extension)
  {
    $this->extension = $extension;
  }
  
  public function getUseExtension()
  {
    return $this->use_extension;
  }
  
  public function setUseExtension($use)
  {
    $this->use_extension = (boolean) $use;
  }
  
  private function fill($template)
  {
    $template = $this->views_path . '/' . $template;
    if($this->use_extension)
      $template .= '.' . $this->extension;
    
    if(!file_exists($template)) {
      throw new Exception('Template file could not be found: ' . $template);
    }

    $data = file_get_contents($template);
    $current_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $data = str_replace('{CURRENT_URL}', $current_url, $data);
    $data = str_replace('{SERVER_BASE_URL}', $this->base_url, $data);
    
    foreach($this->var_holder as $key => $value)
    {
      $var = '{' . $key . '}';
      $data = str_replace($var, $value, $data);
    }
    
    foreach($this->rep_holder as $key => $value)
    {
      $data = str_replace($key, $value, $data);
    }
    
    return $data;
  }
  
  public function reset()
  {
    $this->var_holder = array();
    $this->rep_holder = array();
  }
  
  public function assign($var, $value)
  {
    $this->var_holder[$var] = $value;
  }
  
  public function assignObject($object, $exclude = array())
  {
    foreach($object as $key => $value)
    {
      if(!in_array($key, $exclude))
        $this->assign($key, $value);
    }
  }
  
  public function replace($str, $pattern)
  {
    $this->rep_holder[$str] = $pattern;
  }
  
  public function display($template)
  {
    echo $this->load_template($template);
  }
  
  public function load_template($template)
  {
    $full_file_path = $template;
    return $this->fill($full_file_path);
  }
  
  public function getBaseUrl()
  {
    return $this->base_url;
  }
  
  public function displayHeader()
  {
    $this->display($this->header_template);
  }
  
  public function displayFooter()
  {
    $this->display($this->footer_template);
  }
 
}

# END OF CLASS: Template.php