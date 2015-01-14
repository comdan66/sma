<section class="grid col-three-quarters mq2-col-full">
  <h2>Aroma > Edit</h2>
  <hr>
  <h4>＊為必填欄位</h4>
  <form action="<?php echo base_url (array ('admin', 'aromas', 'edit', $aroma->id));?>" method="post" enctype="multipart/form-data" >
    <article>
<?php if (isset ($message) && $message) { ?>
        <div class='error'><?php echo $message;?></div>
<?php } ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width='80'>分類＊</td>
            <td class="textleft">
              <select name='aroma_tag_id'>
                <option value='0'>未分類</option>
          <?php if ($tags = AromaTag::all ()) {
                  foreach ($tags as $tag) { ?>
                    <option value='<?php echo $tag->id;?>'<?php echo $tag->id == $aroma->aroma_tag_id ? ' selected' : '';?>><?php echo $tag->name;?></option>
            <?php }
                } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>標題＊</td>
            <td class="textleft">
              <input type='text' name='title' value="<?php echo $aroma->title;?>" placeholder='請輸入標題' maxlength='100' pattern=".{1,100}" required title="輸入100個字元以內" />
              &nbsp;&nbsp;輸入100個字元以內
            </td>
          </tr>
          <tr>
            <td>封面＊</td>
            <td class="textleft">
              <img src="<?php echo $aroma->file_name->url ('80x80');?>" alt="" width="80" height="80">
              <hr/>
              <input type='file' name='file' value=''/>
            </td>
          </tr>
          <tr>
            <td>日期＊</td>
            <td class="textleft">
              <input type='text' name='date' value="<?php echo $aroma->date->format ('Y-m-d');?>" placeholder='請選擇日期' pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$" required title="請輸入正確的時間格式 (ex: 1999-01-01)" />
              &nbsp;&nbsp;* 設定當天日期
            </td>
          </tr>
          <tr>
            <td>狀態＊</td>
            <td class="textleft">
              <select name='is_enabled'>
                <option value='1'<?php echo $aroma->is_enabled ? ' selected': '';?>>上架</option>
              <option value='0'<?php echo $aroma->is_enabled ? '' : ' selected';?>>下架</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
<?php
  if ($aroma->blocks) {
    foreach ($aroma->blocks as $index => $block) {
      if ($block->type == 'title') { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
          <tbody>
            <tr>
              <td bgcolor="#F7F7F7" width="80">標題</td>
              <td bgcolor="#F7F7F7" class="textleft">
                <input type="hidden" name='old_blocks[<?php echo $index;?>][id]' value='<?php echo $block->id;?>' />
                <input type="hidden" name='old_blocks[<?php echo $index;?>][type]' value='title' />
                <input type='text' value="<?php echo $block->title;?>" name='old_blocks[<?php echo $index;?>][title]' placeholder='請輸入標題' title="輸入100個字元以內"  maxlength='100' pattern=".{1,100}" required title="輸入100個字元以內" />
                <div class='delete'>x</div>
              </td>
              <td width="120">
                <input type='number' name='old_blocks[<?php echo $index;?>][sort]' value="<?php echo $block->sort;?>" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
              </td>
            </tr>
          </tbody>
        </table>
<?php
      } else if ($block->type == 'content') { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
          <tbody>
            <tr>
              <td bgcolor="#F7F7F7" width="80">內文</td>
              <td bgcolor="#F7F7F7" class="textleft">
                <input type="hidden" name='old_blocks[<?php echo $index;?>][id]' value='<?php echo $block->id;?>' />
                <input type="hidden" name='old_blocks[<?php echo $index;?>][type]' value='content' />
                <textarea placeholder='請輸入內文' name='old_blocks[<?php echo $index;?>][content]' cols="45" rows="5" title="輸入內文" title="輸入500個字元以內"  maxlength='500' pattern=".{1,500}" required title="輸入500個字元以內" ><?php echo $block->content;?></textarea>
                <div class='delete'>x</div>
              </td>
              <td width="120">
                <input type='number' name='old_blocks[<?php echo $index;?>][sort]' value="<?php echo $block->sort;?>" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
              </td>
            </tr>
          </tbody>
        </table>
<?php
      } else if ($block->type == 'file_name') { ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
          <tbody>
            <tr>
              <td bgcolor="#F7F7F7" width="80">圖片</td>
              <td bgcolor="#F7F7F7" class="textleft pic">
                <input type="hidden" name='old_blocks[<?php echo $index;?>][id]' value='<?php echo $block->id;?>' />
                <input type="hidden" name='old_blocks[<?php echo $index;?>][type]' value='file_name' />
                <img src='<?php echo $block->file_name->url ();?>'>
                <div class='delete'>x</div>
              </td>
              <td width="120">
                <input type='number' name='old_blocks[<?php echo $index;?>][sort]' value="<?php echo $block->sort;?>" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
              </td>
            </tr>
          </tbody>
        </table>
<?php
      }
    }
  }
?>
      <hr />
      <button type="button" id='add_title'>加入小標題</button>
      <button type="button" id='add_content'>加入內文</button>
      <button type="button" id='add_file_name'>加入圖片</button>
      <button type="submit">確定修改</button>
    </article>
  </form>
</section>

<script id='_title' type='text/x-html-template'>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td bgcolor="#F7F7F7" width="80">標題</td>
        <td bgcolor="#F7F7F7" class="textleft">
          <input type="hidden" name='blocks[<%=index%>][type]' value='title' />
          <input type='text' value="" name='blocks[<%=index%>][title]' placeholder='請輸入標題' title="輸入100個字元以內"  maxlength='100' pattern=".{1,100}" required title="輸入100個字元以內" />
          <div class='delete'>x</div>
        </td>
        <td width="120">
          <input type='number' name='blocks[<%=index%>][sort]' value="0" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
        </td>
      </tr>
    </tbody>
  </table>
</script>

<script id='_content' type='text/x-html-template'>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td bgcolor="#F7F7F7" width="80">內文</td>
        <td bgcolor="#F7F7F7" class="textleft">
          <input type="hidden" name='blocks[<%=index%>][type]' value='content' />
          <textarea placeholder='請輸入內文' name='blocks[<%=index%>][content]' cols="45" rows="5" title="輸入內文" title="輸入500個字元以內"  maxlength='500' pattern=".{1,500}" required title="輸入500個字元以內" ></textarea>
          <div class='delete'>x</div>
        </td>
        <td width="120">
          <input type='number' name='blocks[<%=index%>][sort]' value="0" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
        </td>
      </tr>
    </tbody>
  </table>
</script>

<script id='_file_name' type='text/x-html-template'>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td bgcolor="#F7F7F7" width="80">圖片</td>
        <td bgcolor="#F7F7F7" class="textleft">
          <input type="hidden" name='blocks[<%=index%>][type]' value='file_name' />
          <input type="file" name='block_files[]' class='file' value='' accept="image/jpg, image/jpeg, image/png" />
          <div class='delete'>x</div>
        </td>
        <td width="120">
          <input type='number' name='blocks[<%=index%>][sort]' value="0" maxlength='10' pattern="\d*" required title="輸入10個字元以內" />
        </td>
      </tr>
    </tbody>
  </table>
</script>
