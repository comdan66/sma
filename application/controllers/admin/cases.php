<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Cases extends Admin_controller {
  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _delete ($ids) {
    array_map (function ($case) {
      array_map (function ($pic) {
        $pic->file_name->cleanAllFiles ();
        $pic->delete ();
      }, $case->pics);

      array_map (function ($block) {
        array_map (function ($item) {
          $item->delete ();
        }, $block->items);

        $block->delete ();
      }, $case->blocks);

      $case->delete ();
    }, Casee::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);

    redirect (array ('admin', $this->get_class (), 'index'), 'refresh');
  }

  public function index ($offset = 0) {
    $tag_id = trim ($this->input_post ('tag_id'));

    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = $tag_id ? array ('tag_id = ?', $tag_id) : array ();

    $limit = 10;
    $total = Casee::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $cases = Casee::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('cases' => $cases, 'pagination' => $pagination, 'tag_id' => $tag_id));
  }

  public function tags () {
    if ($this->has_post ()) {
      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (CaseTag::create (array ('name' => $name, 'sort' => CaseTag::count () + 1))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        if ($delete_ids = array_diff (field_array (CaseTag::find ('all', array ('select' => 'id')), 'id'), array_map (function ($tag) { return $tag['id']; }, $tags))) {
          CaseTag::delete_all (array ('conditions' => array ('id IN (?)', $delete_ids)));
          Casee::update_all (array ('set' => 'case_tag_id = 0', 'conditions' => array ('case_tag_id IN (?)', $delete_ids)));
        }
        
        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            CaseTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
    }

    $tags = CaseTag::find ('all', array ('order' => 'sort DESC, id DESC'));
    $this->load_view (array ('tags' => $tags));
  }
  public function create () {
    if ($this->has_post ()) {
      $title       = trim ($this->input_post ('title'));
      $address     = trim ($this->input_post ('address'));
      $level       = trim ($this->input_post ('level'));
      $is_enabled  = $this->input_post ('is_enabled');
      $case_tag_id = $this->input_post ('case_tag_id');

      $files       = $this->input_post ('files[]', true, true);
      $blocks      = $this->input_post ('blocks');

      if ($title && $level && $address && $files && is_numeric ($is_enabled)) {

        if (verifyCreateOrm ($case = Casee::create (array ('title' => $title, 'level' => $level, 'address' => $address, 'is_enabled' => $is_enabled, 'case_tag_id' => $case_tag_id ? $case_tag_id : 0)))) {
          foreach ($files as $file)
            if (verifyCreateOrm ($pic = CasePic::create (array ('case_id' => $case->id, 'file_name' => ''))))
              $pic->file_name->put ($file);

          if ($blocks)
            foreach ($blocks as $block) {
              $b = CaseBlock::create (array ('case_id' => $case->id, 'title' => $block['title'], 'type' => $block['type']));

            if (isset ($block['items']))
              foreach ($block['items'] as $item)
                CaseBlockItem::create (array ('case_block_id' => $b->id, 'title' => $item['title'], 'content' => $item['content']));
            }

          identity ()->set_session ('_flash_message', '新增成功!', true);
          redirect (array ('admin', $this->get_class ()));
        } else {
          @$case->delete ();
        }
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！'));
      }
    } else {
      $this->load_view ();
    }
  }

  public function edit ($id = 0) {
    if (!($case = Casee::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if ($this->has_post ()) {
      $title       = trim ($this->input_post ('title'));
      $address     = trim ($this->input_post ('address'));
      $level       = trim ($this->input_post ('level'));
      $is_enabled  = $this->input_post ('is_enabled');
      $case_tag_id = $this->input_post ('case_tag_id');

      $files       = $this->input_post ('files[]', true, true);
      $pics        = ($pics = $this->input_post ('pics')) ? $pics : array ();
      $blocks      = $this->input_post ('blocks');

      if ($title && $level && $address && ($files || $pics) && is_numeric ($is_enabled)) {

        if ($delete_pic_ids = array_diff (field_array ($case->pics, 'id'), $pics))
          array_map (function ($pic) {
            $pic->file_name->cleanAllFiles ();
            $pic->delete ();
          }, CasePic::find ('all', array ('conditions' => array ('id IN (?) AND case_id = ?', $delete_pic_ids, $case->id))));

        array_map (function ($block) {
          array_map (function ($item) {
            $item->delete ();
          }, $block->items);

          $block->delete ();
        }, $case->blocks);

        foreach ($files as $file)
          if (verifyCreateOrm ($pic = CasePic::create (array ('case_id' => $case->id, 'file_name' => ''))))
            $pic->file_name->put ($file);

        if ($blocks)
          foreach ($blocks as $block) {
            $b = CaseBlock::create (array ('case_id' => $case->id, 'title' => $block['title'], 'type' => $block['type']));

            if (isset ($block['items']))
              foreach ($block['items'] as $item)
                CaseBlockItem::create (array ('case_block_id' => $b->id, 'title' => $item['title'], 'content' => $item['content']));
          }

        $case->title       = $title;
        $case->level       = $level;
        $case->address     = $address;
        $case->is_enabled  = $is_enabled;
        $case->case_tag_id = $case_tag_id ? $case_tag_id : 0;
        $case->save ();

        identity ()->set_session ('_flash_message', '修改成功!', true);
        redirect (array ('admin', $this->get_class ()));
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！', 'case' => $case));
      }
    } else {
      $this->load_view (array ('case' => $case));
    }
  }
}