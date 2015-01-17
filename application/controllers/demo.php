<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Demo extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    

    $sql[] = "CREATE TABLE `users` (
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
    $sql[] = "INSERT INTO `users` (`account`, `password`) VALUES ('admin@sma.com', '" . md5 ('123456') . "')";
    $sql[] = "CREATE TABLE `banners` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `case_tags` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `sort` int(11) NOT NULL DEFAULT '0',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `cases` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `case_tag_id` int(11) NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `is_enabled` int(11) NOT NULL DEFAULT '1',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `case_tag_id_is_enabled_index` (`case_tag_id`, `is_enabled`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `case_pics` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `case_id` int(11) NOT NULL,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `case_id_index` (`case_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `case_blocks` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `case_id` int(11) NOT NULL,
              `type` int(11) NOT NULL DEFAULT '1',
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `case_id_index` (`case_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `case_block_items` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `case_block_id` int(11) NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `content` text,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `case_block_id_index` (`case_block_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `aroma_tags` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `sort` int(11) NOT NULL DEFAULT '0',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `aromas` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `aroma_tag_id` int(11) NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `content` text,
              `date` date NOT NULL DEFAULT '" . date ('Y-m-d') . "',
              `is_enabled` int(11) NOT NULL DEFAULT '1',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `aroma_tag_id_is_enabled_index` (`aroma_tag_id`, `is_enabled`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `aroma_blocks` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `aroma_id` int(11) NOT NULL,
              `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `content` text,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `aroma_id_index` (`aroma_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `news` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `content` text,
              `date` date NOT NULL DEFAULT '" . date ('Y-m-d') . "',
              `is_enabled` int(11) NOT NULL DEFAULT '1',
              `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
              PRIMARY KEY (`id`),
              KEY `is_enabled_index` (`is_enabled`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
    $sql[] = "CREATE TABLE `new_blocks` (
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
    $sql[] = "ALTER TABLE `new_blocks` ADD `sort` int(11) NOT NULL DEFAULT '0'";
    $sql[] = "ALTER TABLE `aroma_blocks` ADD `sort` int(11) NOT NULL DEFAULT '0'";
    $sql[] = "ALTER TABLE `new_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    $sql[] = "ALTER TABLE `aroma_blocks` ADD `youtube` varchar(255) COLLATE utf8_unicode_ci NOT NULL";
    echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
    echo implode('<br/>', $sql);
    exit ();

  }
}
