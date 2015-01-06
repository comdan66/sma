<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class CaseTag extends OaModel {

  static $table_name = 'case_tags';

  static $has_many = array (
    array ('cases', 'class_name' => 'Casee')
  );

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
}