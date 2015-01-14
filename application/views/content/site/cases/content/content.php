  <div class='back'>
    <a href='<?php echo base_url (array ('cases'));?>'>← 返回</a>
    <div class="fb-like" data-href="<?php echo base_url (array ('cases', $case->id));?>" data-width="120" data-send="false" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
  </div>

  <div id='m_prophotobox'>
      <div class="bs-example">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators hidden-xs">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
          </ol>

          <div class="carousel-inner">
      <?php if ($case->pics) {
              foreach ($case->pics as $i => $pic) { ?>
                <div class="item<?php echo !$i ? ' active' : '';?>">
                  <img src="<?php echo $pic->file_name->url ('855x575');?>" width="100%">
                </div>
        <?php }
            }?>
          </div>

          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left hidden-xs"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right hidden-xs"></span>
          </a>
        </div>
      </div>
  </div>

  <div id="prophotobox">
    <img src="" width="100%" id="BIG">
    <div id="SMALL" class='clearfix'>
<?php if ($case->pics) {
        foreach ($case->pics as $i => $pic) { ?>
          <img src="<?php echo $pic->file_name->url ('64x64');?>" data-url="<?php echo $pic->file_name->url ('855x575');?>" width="100%" />
        <?php }
      }?>
    </div>
  </div>

  <div id="info">
    <div class='title'><?php echo $case->tag ? $case->tag->name : '';?></div>
    <div class='value clearfix'>
      <div class='v1'>
        <div class='name'><?php echo $case->title;?></div>
        <div class='address'><?php echo $case->address;?></div>
      </div>
      <div class='v2'>
  <?php if ($case->blocks) {
          foreach ($case->blocks as $block) { ?>
            <div class='t'><?php echo $block->title;?></div>
      <?php if ($block->items) {
              foreach ($block->items as $item) {
                if ($block->type == 1) { ?>
                  <div class='g clearfix'><div class='k'><?php echo $item->title;?></div><div class='v'><?php echo $item->content;?></div></div>
          <?php } else { ?>
                  <div class='tx'><?php echo nl2br($item->content);?></div>
          <?php }
              }
            }
          }
        } ?>
      </div>
    </div>
  </div>
