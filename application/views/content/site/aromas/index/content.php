    <div class='aromas'>
<?php if ($aromas) {
        foreach ($aromas as $aroma) { ?>
          <div class='aroma'>
            <div class='top clearfix'>
              <div class='img'>
                <a href="<?php echo base_url (array ('aroma', $aroma->id));?>"><img src="<?php echo $aroma->file_name->url ('115x115');?>"></a>
              </div>
              <div class='info'>
                <div class='t'><a href="<?php echo base_url (array ('aroma', $aroma->id));?>"><?php echo $aroma->title;?></a></div>
                <div class='d'><?php echo $aroma->date->format ('Y.m.d');?></div>
                <div class='c'><?php echo mb_strimwidth (strip_tags ($aroma->content), 0, 130, '…', 'UTF-8');?></div>
              </div>
            </div>
            <div class='bottom'>
              <a href="<?php echo base_url (array ('aroma', $aroma->id));?>">+ 閱讀更多</a>
            </div>
          </div>
  <?php }
      } ?>
    </div>

    <div class='paginations'>
<?php echo $pagination;?>
    </div>