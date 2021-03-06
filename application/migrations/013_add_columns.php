<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_columns extends CI_Migration {
  public function up () {
    $sql = "ALTER TABLE `new_blocks` ADD `sort` int(11) NOT NULL DEFAULT '0'";
    $this->db->query ($sql);
    $sql = "ALTER TABLE `aroma_blocks` ADD `sort` int(11) NOT NULL DEFAULT '0'";
    $this->db->query ($sql);
    $sql = "ALTER TABLE `new_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    $this->db->query ($sql);
    $sql = "ALTER TABLE `aroma_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    $this->db->query ($sql);
  }
}