<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <?php echo isset ($meta) ? $meta:'';?>

    <title><?php echo isset ($title) ? $title : '';?></title>

<?php echo isset ($css) ? $css : '';?>

<?php echo isset ($js) ? $js : '';?>
  </head>
  <body lang="zh-tw">
    <?php echo isset ($hidden) ? $hidden : '';?>

    <div id='supersize'>
<?php if ($banners = Banner::find ('all')) {
        foreach ($banners as $banner) { ?>
          <input type='hidden' value='<?php echo $banner->file_name->url ();?>' />
  <?php }
      } ?>
    </div>

    <div id='container'>
      <div class='slider'>
        <img class='logo' src='<?php echo base_url (array ('resource', 'site', 'img', 'wlogo.png'));?>'>

        <div class='item'><a href=''>ABOUT</a></div>
        <div class='item'><a href=''>CASE STUDY</a></div>
        <div class='item'><a href=''>NEWS</a></div>
        <div class='item'><a href=''>AROMA</a></div>
        <div class='item'><a href=''>CONTACT</a></div>
      </div>
      <div class='footer'>
        <div class='left'>
          <p><b>台灣嗅覺香氛行銷協會</b></p>
          <p>10690 台北市大安區忠孝東路四段191號10樓之一</p>
          <br />
          <p><b>SMA Scent Marketing Association</b></p>
          <p>10F.-1 No.191, Sec 4, Jhongsiao E. Rd.,Da-an</p>
          <p>District, TaipeiCity 10690, Taiwan (R.O.C)</p>
          <br />

          <p>info@smatw.org</p>
        </div>
        <div class='right'>
          <p>© 2014 SMA Scent Marketing Association Co.,Ltd.</p>
        </div>
      </div>
    </div>
  </body>
</html>