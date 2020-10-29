<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

  function theme_view($folder, $view, $vars = array(), $return = FALSE) {
    $this->_ci_view_paths = array_merge($this->_ci_view_paths, array(FCPATH . $folder . '/' => TRUE));
    return $this->_ci_load(array(
            '_ci_view' => $view,
            '_ci_vars' => $this->_ci_prepare_view_vars($vars),
            '_ci_return' => $return
        ));
  }

}