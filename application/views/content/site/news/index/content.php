    <div class='news'>
<?php if ($news) {
        foreach ($news as $new) { ?>
          <div class='new'>
            <div class='top clearfix'>
              <div class='img'>
                <a href="<?php echo base_url (array ('news', $new->id));?>"><img src="<?php echo $new->file_name->url ('115x115');?>"></a>
              </div>
              <div class='info'>
                <div class='t'><a href="<?php echo base_url (array ('news', $new->id));?>"><?php echo $new->title;?></a></div>
                <div class='d'><?php echo $new->date->format ('Y.m.d');?></div>
                <div class='c'><?php echo strip_tags ($new->content);?></div>
              </div>
            </div>
            <div class='bottom'>
              <a href="<?php echo base_url (array ('news', $new->id));?>">+ 閱讀更多</a>
            </div>
          </div>
  <?php }
      } ?>
    </div>

    <div class='paginations'>
<?php echo $pagination;?>
    </div>