    <div class='news'>
<?php if ($news) {
        foreach ($news as $new) { ?>
          <div class='new'>
            <div class='top clearfix'>
              <div class='img'>
                <a href="<?php echo base_url (array ('new', $new->id));?>"><img src="<?php echo $new->file_name->url ('115x115');?>"></a>
              </div>
              <div class='info'>
                <div class='t'><a href="<?php echo base_url (array ('new', $new->id));?>"><?php echo $new->title;?></a></div>
                <div class='d'><?php echo $new->date->format ('Y.m.d');?></div>
                <div class='c'><?php echo mb_strimwidth (strip_tags ($new->content), 0, 130, '…', 'UTF-8');?></div>
              </div>
            </div>
            <div class='bottom'>
              <a href="<?php echo base_url (array ('new', $new->id));?>">+ 閱讀更多</a>
            </div>
          </div>
  <?php }
      } ?>
    </div>

    <div class='paginations'>
<?php echo $pagination;?>
    </div>