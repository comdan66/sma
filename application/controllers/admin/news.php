<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class News extends Admin_controller {
  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _delete ($ids) {
    array_map (function ($new) {
      array_map (function ($block) {
        if (($block->type == 'file_name') || $block->file_name)
          $block->file_name->cleanAllFiles ();

        $block->delete ();
      }, $new->blocks);

      $new->delete ();
    }, Neww::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);

    redirect (array ('admin', $this->get_class (), 'index'), 'refresh');
  }

  public function index ($offset = 0) {
    $start       = trim ($this->input_post ('start'));
    $end         = trim ($this->input_post ('end'));

    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = $start && $end ? array ('date BETWEEN ? AND ?', $start, $end) : array ();

    $limit = 10;
    $total = Neww::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $news = Neww::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('news' => $news, 'pagination' => $pagination, 'start' => $start, 'end' => $end));
  }

  public function create () {
    if ($this->has_post ()) {
      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if (true || ($title && $file && $date && is_numeric ($is_enabled))) {

        if (verifyCreateOrm ($new = Neww::create (array ('title' => $title ? $title : '', 'file_name' => '', 'content' => '', 'date' => $date ? $date : date ('Y-m-d'), 'is_enabled' => $is_enabled)))) {
          $new->file_name->put ($file);

          $content = '';
          if ($blocks)
            foreach ($blocks as $i => $block) {
              $b = NewBlock::create (array ('new_id' => $new->id, 'type' => $block['type'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $content .= $block['type'] == 'content' ? $block['content'] : '', 'file_name' => '', 'sort' => $block['sort']));

              if ($block['type'] == 'file_name')
                if (!$b->file_name->put (array_shift ($block_files)))
                  $b->delete ();
            }
          $new->content = $content;
          $new->save ();
          identity ()->set_session ('_flash_message', '新增成功!', true);
          redirect (array ('admin', $this->get_class ()));
        } else {
          @$new->delete ();
        }
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！'));
      }
    } else {
      $this->load_view ();
    }
  }

  public function edit ($id = 0) {
    if (!($new = Neww::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if ($this->has_post ()) {

      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');

      $old_blocks = $this->input_post ('old_blocks');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if (true || ($title && $date && is_numeric ($is_enabled))) {
        if ($file)
          $new->file_name->put ($file);

        if ($delete_ids = array_diff (field_array ($new->blocks, 'id'), array_map (function ($block) { NewBlock::table ()->update ($set = array ('sort' => $block['sort'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $block['type'] == 'content' ? $block['content'] : ''), array ('id' => $block['id'])); return $block['id']; }, $old_blocks ? $old_blocks : array ())))
          NewBlock::delete_all (array ('conditions' => array ('id IN (?) AND new_id = ?', $delete_ids, $new->id)));

        $content = '';
        if ($blocks)
          foreach ($blocks as $i => $block) {
            $b = NewBlock::create (array ('new_id' => $new->id, 'type' => $block['type'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $content .= $block['type'] == 'content' ? $block['content'] : '', 'file_name' => '', 'sort' => $block['sort']));

            if ($block['type'] == 'file_name')
              if (!$b->file_name->put (array_shift ($block_files)))
                $b->delete ();
          }

        $new->title      = $title;
        $new->date       = $date;
        if ($content)
          $new->content    = $content;
        $new->is_enabled = $is_enabled;
        $new->save ();

        identity ()->set_session ('_flash_message', '修改成功!', true);
        redirect (array ('admin', $this->get_class ()));
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！', 'new' => $new));
      }
    } else {
      $this->load_view (array ('new' => $new));
    }
  }
}