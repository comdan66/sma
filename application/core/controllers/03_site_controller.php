<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Site_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    $this->load->helper ('identity');

    $this
         ->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'site')
         ->set_public_path ('public')

         ->set_title ("SMA 嗅覺香氛行銷協會")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ;
  }

  private function _add_meta () {
    return $this->add_meta (array ('name' => 'keywords', 'content' => '香氛設計、香氣行銷、嗅覺行銷、香氛行銷、香氛、精油、擴香機、香水行銷、空間香氛、Scent Design、Perfume Design、Scent Marketing、Perfume Marketing'));
  }

  private function _add_css () {
    return $this
            ->add_css ('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700')
    ;
  }

  private function _add_js () {
    return $this->add_js (base_url (utilitySameLevelPath ('resource', 'jquery_v1.10.2', 'jquery-1.10.2.min.js')))
                ->add_js (base_url (utilitySameLevelPath ('resource', 'oa-imgLiquid', 'oa-imgLiquid.js')))
                ;
  }
}