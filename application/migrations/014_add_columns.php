<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_column2s extends CI_Migration {
  public function up () {
    $sql = "ALTER TABLE `new_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    $this->db->query ($sql);
    $sql = "ALTER TABLE `aroma_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    $this->db->query ($sql);
  }
}