<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_users extends CI_Migration {
  public function up () {
    $sql = "CREATE TABLE `users` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `login_count` int(11) NOT NULL DEFAULT '0',
              `logined_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `account_password_index` (`account`, `password`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $this->db->query ($sql);

    $sql = "INSERT INTO `users` (`account`, `password`) VALUES ('admin@sma.com', '" . md5 ('123456') . "')";
    $this->db->query ($sql);
  }
}