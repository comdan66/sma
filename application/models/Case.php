<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Case extends OaModel {

  static $table_name = 'cases';

  static $has_one = array (
    array ('first_pic', 'class_name' => 'CasePic', 'order' => 'id ASC')
  );
  static $has_many = array (
    array ('pics', 'class_name' => 'CasePic'),
    array ('blocks', 'class_name' => 'CaseBlock')
  );
  static $belongs_to = array (
    array ('tag', 'class_name' => 'CaseTag')
  );

  public function __construct ($attributes = array (), $guard_attributes = TRUE, $instantiating_via_find = FALSE, $new_record = TRUE) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
}