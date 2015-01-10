<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Aromas extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index ($tag_name = '') {
    $this->load_view (null);
  }
  public function content ($id) {
    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    var_dump ('s');
    exit ();
  }
}
