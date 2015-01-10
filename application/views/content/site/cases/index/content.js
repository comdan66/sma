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
  }

  $('.sub[data-key="cases"] .item').click (function () {
    filterCase ($(this).text ())
  });
  window.location.hash && filterCase (window.location.hash.split('#')[1]);
});