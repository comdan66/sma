/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function () {
  var srcs = $('#supersize input').map (function () {
    return $(this).val ();
  });
  var timer = null, index = 0;

  var change = function () {
    clearTimeout (timer);
    (index > srcs.length - 1) && (index = 0);
    $('#supersize').find ('img').removeClass ('show');
    $('#supersize').append ($('<img />').attr ('src', srcs[index++])).OAimgLiquid ().find ('img').addClass ('show');
    $('#supersize img:not(:last)').remove ();
    timer = setTimeout (change, 4000);
  };
  change ();
  $(window).resize (function () {
    $('#supersize').OAimgLiquid ();
  });
});
