/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2014 OA Wu Design
 */

$(function() {
  $('#select_all').click (function () {
    $('input[type="checkbox"][name="delete_ids[]"]').prop ('checked', $('#check_all').click ().is (':checked'));
  });
  $('#check_all').click (function () {
    $('input[type="checkbox"][name="delete_ids[]"]').prop ('checked', this.checked);
  });
});