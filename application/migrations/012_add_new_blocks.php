<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_new_blocks extends CI_Migration {
  public function up () {
    $sql = "CREATE TABLE `new_blocks` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `new_id` int(11) NOT NULL,
              `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `content` text,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `new_id_index` (`new_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $this->db->query ($sql);
  }
}