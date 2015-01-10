/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */
$(function () {
  $(window).resize (function () {
    if ($('#content').height () > $('.content').height ())
      $('.content').css ({'height': $('#content').height () + 'px'});
  }).resize ();
  

  var $rightSlide = $('#right_slide');
  var overflow = $('body').css ('overflow');
  $('.option').click (function () {
    if ($rightSlide.hasClass ('close')) {
      $rightSlide.removeClass ('close');
      $('body').css ('overflow', 'hidden');
    } else {
      $rightSlide.addClass ('close');
      $('body').css ('overflow', overflow);
    }
  });
  $('#slide_cover').click (function () {
    if (!$rightSlide.hasClass ('close')) {
      $rightSlide.addClass ('close');
      $('body').css ('overflow', overflow);
    }
  });
});
