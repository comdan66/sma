    <div class='paginations'>
      <?php echo $pagination;?>
    </div>
    <div class='cases clearfix'>
<?php if ($cases) {
        foreach ($cases as $key => $case) { ?>
          <a href='<?php echo base_url (array ('case', $case->id));?>' class='case_a' data-tag='<?php echo $case->tag ? $case->tag->name : '';?>'>
            <div class='case'>
              <img src="<?php echo $case->first_pic->file_name->url ('200x200');?>" />
              <div class='name'><?php echo $case->title;?></div>
              <div class='info clearfix'>
                <div class='address'><?php echo $case->address;?></div>
                <div class='level'><?php echo $case->level;?>坪</div>
              </div>
            </div>
          </a>
  <?php }
      } ?>
    </div>