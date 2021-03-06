<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Site_cells extends Cell_Controller {

  public function _cache_index () {
    return array ('time' => 60 * 60, 'key' => null);
  }
  public function index () {
    return $this->load_view ();
  }
  // public function _cache_menus () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function menus () {
    return $this->load_view ();
  }
}