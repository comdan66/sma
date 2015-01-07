<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Aromas extends Admin_controller {
  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _delete ($ids) {
    array_map (function ($aroma) {
      array_map (function ($block) {
        if (($block->type == 'file_name') || $block->file_name)
          $block->file_name->cleanAllFiles ();

        $block->delete ();
      }, $aroma->blocks);

      $aroma->delete ();
    }, Aroma::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);

    redirect (array ('admin', $this->get_class (), 'index'), 'refresh');
  }

  public function index ($offset = 0) {
    $start       = trim ($this->input_post ('start'));
    $end         = trim ($this->input_post ('end'));
    $aroma_tag_id = trim ($this->input_post ('aroma_tag_id'));

    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = $start && $end && $aroma_tag_id ? array ('date BETWEEN ? AND ? AND aroma_tag_id = ?', $start, $end, $aroma_tag_id) : ($start && $end ? array ('date BETWEEN ? AND ?', $start, $end) : ($aroma_tag_id ? array ('aroma_tag_id = ?', $aroma_tag_id) : array ()));

    $limit = 10;
    $total = Aroma::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $aromas = Aroma::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('aromas' => $aromas, 'pagination' => $pagination, 'aroma_tag_id' => $aroma_tag_id, 'start' => $start, 'end' => $end));
  }

  public function tags () {
    if ($this->has_post ()) {
      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (AromaTag::create (array ('name' => $name, 'sort' => AromaTag::count () + 1))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        if ($delete_ids = array_diff (field_array (AromaTag::find ('all', array ('select' => 'id')), 'id'), array_map (function ($tag) { return $tag['id']; }, $tags))) {
          AromaTag::delete_all (array ('conditions' => array ('id IN (?)', $delete_ids)));
          Aroma::update_all (array ('set' => 'aroma_tag_id = 0', 'conditions' => array ('aroma_tag_id IN (?)', $delete_ids)));
        }

        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            AromaTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
    }

    $tags = AromaTag::find ('all', array ('order' => 'sort DESC, id DESC'));
    $this->load_view (array ('tags' => $tags));
  }

  public function create () {
    if ($this->has_post ()) {
      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');
      $aroma_tag_id = $this->input_post ('aroma_tag_id');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if ($title && $file && $date && is_numeric ($is_enabled)) {

        if (verifyCreateOrm ($aroma = Aroma::create (array ('title' => $title, 'file_name' => '', 'content' => '', 'date' => $date, 'is_enabled' => $is_enabled, 'aroma_tag_id' => $aroma_tag_id ? $aroma_tag_id : 0))) && $aroma->file_name->put ($file)) {
          if ($blocks)
            foreach ($blocks as $i => $block) {
              $b = AromaBlock::create (array ('aroma_id' => $aroma->id, 'type' => $block['type'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $block['type'] == 'content' ? $block['content'] : '', 'file_name' => ''));

              if ($block['type'] == 'file_name')
                if (!$b->file_name->put (array_shift ($block_files)))
                  $b->delete ();
            }

          identity ()->set_session ('_flash_message', '新增成功!', true);
          redirect (array ('admin', $this->get_class ()));
        } else {
          @$aroma->delete ();
        }
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！'));
      }
    } else {
      $this->load_view ();
    }
  }

  public function edit ($id = 0) {
    if (!($aroma = Aroma::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if ($this->has_post ()) {

      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');
      $aroma_tag_id = $this->input_post ('aroma_tag_id');

      $old_blocks = $this->input_post ('old_blocks');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if ($title && $date && is_numeric ($is_enabled)) {
        if ($file)
          $aroma->file_name->put ($file);

        if ($old_blocks && ($delete_ids = array_diff (field_array ($aroma->blocks, 'id'), array_map (function ($block) { AromaBlock::table ()->update ($set = array ('title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $block['type'] == 'content' ? $block['content'] : ''), array ('id' => $block['id'])); return $block['id']; }, $old_blocks))))
          AromaBlock::delete_all (array ('conditions' => array ('id IN (?) AND aroma_id = ?', $delete_ids, $aroma->id)));

        if ($blocks)
          foreach ($blocks as $i => $block) {
            $b = AromaBlock::create (array ('aroma_id' => $aroma->id, 'type' => $block['type'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $block['type'] == 'content' ? $block['content'] : '', 'file_name' => ''));

            if ($block['type'] == 'file_name')
              if (!$b->file_name->put (array_shift ($block_files)))
                $b->delete ();
          }

        $aroma->title       = $title;
        $aroma->date       = $date;
        $aroma->is_enabled  = $is_enabled;
        $aroma->aroma_tag_id = $aroma_tag_id ? $aroma_tag_id : 0;
        $aroma->save ();

        identity ()->set_session ('_flash_message', '修改成功!', true);
        redirect (array ('admin', $this->get_class ()));
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！', 'aroma' => $aroma));
      }
    } else {
      $this->load_view (array ('aroma' => $aroma));
    }
  }
}