<div class='d'><?php echo $aroma->date->format ('Y.m.d');?></div>
<div class='t clearfix'>
  <div class='tt'><?php echo $aroma->title;?></div>
  <div class='bs'>
    <a href='<?php echo base_url (array ('aromas'));?>' class='back'>← 返回</a>
    <div class="fb-like" data-href="<?php echo base_url (array ('aromas', $aroma->id));?>" data-width="120" data-send="false" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
  </div>
</div>
<div class='c'>
  <?php
  if ($aroma->blocks) {
    foreach ($aroma->blocks as $block) {
      if ($block->type == 'file_name') {?>
        <div class='i'><img src="<?php echo $block->file_name->url ();?>"></div>
  <?php
      } else if ($block->type == 'title') { ?>
        <div class='tt'><?php echo $block->title;?></div>
  <?php
      } else if ($block->type == 'content') { ?>
        <div class='cc'><?php echo $block->content;?></div>
  <?php
      }
    }
  }
  ?>

</div>