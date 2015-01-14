/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  var filterCase = function (key) {
    var $select = $('.case_a[data-tag="' + key + '"]').clone ();
    $select.find ('.case').removeClass ('cover');
    var $not_select = $('.case_a[data-tag!="' + key + '"]').clone ();
    $not_select.find ('.case').addClass ('cover');
    $('.cases').empty ().append ($select).append ($not_select);
    return true;
  }

  $('.sub[data-key="cases"] .item').click (function () {
    $(this).parents ('.sub').find ('.item').removeClass ('action')
    $(this).addClass ('action');
    filterCase ($(this).text ())
  });
  if (window.location.hash) {
    var h = window.location.hash.split('#')[1];
    filterCase (h);
    $('.sub[data-key="cases"] .item').removeClass ('action')
    $('.sub[data-key="cases"] .item[data-v="' + h + '"]').addClass ('action')
  }
});