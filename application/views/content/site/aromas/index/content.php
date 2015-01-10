    <div class='aromas'>
<?php if ($aromas) {
        foreach ($aromas as $aroma) { ?>
          <div class='aroma'>
            <div class='top clearfix'>
              <div class='img'>
                <a href="<?php echo base_url (array ('aromas', $aroma->id));?>"><img src="<?php echo $aroma->file_name->url ('115x115');?>"></a>
              </div>
              <div class='info'>
                <a href="<?php echo base_url (array ('aromas', $aroma->id));?>"><div class='t'><?php echo $aroma->title;?></div></a>
                <div class='d'><?php echo $aroma->date->format ('Y.m.d');?></div>
                <div class='c'><?php echo strip_tags ($aroma->content);?></div>
              </div>
            </div>
            <div class='bottom'>
              <a href="<?php echo base_url (array ('aromas', $aroma->id));?>">+ 閱讀更多</a>
            </div>
          </div>
  <?php }
      } ?>
    </div>

    <div class='paginations'>
<?php echo $pagination;?>
    </div>