<header class="grid col-full">
  <hr>
<?php
  if (identity ()->user ()) { ?>
    <p class="fleft">奇拓室內裝修設計</p>
    <strong>
      <a href="<?php echo base_url (array ('admin', 'login'));?>" class="alignright">CHI-TORCH(<?php echo identity ()->user ()->account;?>)</a>
    </strong>
<?php
  } ?>
</header>