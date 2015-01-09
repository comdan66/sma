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
    <div id='container'>
      <div id='header' class='clearfix'>
        <div class='logo'>
          <img src='<?php echo base_url (array ('resource', 'site', 'img', 'wlogo.png'));?>'>
        </div>
        <div class='info'>
          <img src='<?php echo base_url (array ('resource', 'site', 'img', 'title_bg.jpg'));?>' />
          <div class='title'>CASE STUDY</div>
        </div>
      </div>
      <div id='content' class='clearfix'>
        <div class='footer'>
          <a href="https://www.facebook.com/chitorch922" class="icon-facebook">asd</a>
          <div></div>
        </div>
        <div class='slider'>
          <a href=''><div class='item'>dasds</div></a>
          <a href=''><div class='item'>CASE STUDY</div></a>
          <div class='sub show'>
            <a href=''><div class='item'>SHOWSHOWSHOWSHOWSHOWSHOWSHOWSHOW</div></a>
            <a href=''><div class='item'>dasds</div></a>
          </div>
          <a href=''><div class='item'>dasds</div></a>
          <a href=''><div class='item'>dasds</div></a>
          <a href=''><div class='item'>dasds</div></a>
          <a href=''><div class='item'>dasds</div></a>
          <a href=''><div class='item'>dasds</div></a>
        </div>
        <div class='content'>d
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
          das<hr/>
        </div>
      </div>
    </div>
    <?php echo isset ($content) ? $content : '';?>
  </body>
</html>