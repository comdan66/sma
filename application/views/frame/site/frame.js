/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */
$(function () {
  $(window).resize (function () {
    if ($('#content').height () > $('.content').height ())
      $('.content').css ({'height': $('#content').height () + 'px'});
  }).resize ();
  
});
