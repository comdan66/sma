<section class="grid col-three-quarters mq2-col-full">
  <h2>Aroma > Create</h2>
  <hr>
  <h4>＊為必填欄位</h4>
  <form action="<?php echo base_url (array ('admin', 'aromas', 'create'));?>" method="post" enctype="multipart/form-data" >
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
                    <option value='<?php echo $tag->id;?>'><?php echo $tag->name;?></option>
            <?php }
                } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>標題＊</td>
            <td class="textleft">
              <input type='text' name='title' value="" placeholder='請輸入標題' maxlength='100' pattern=".{1,100}" required title="輸入100個字元以內" />
              &nbsp;&nbsp;輸入100個字元以內
            </td>
          </tr>
          <tr>
            <td>封面＊</td>
            <td class="textleft">
              <input type='file' name='file' value=''/>
            </td>
          </tr>
          <tr>
            <td>日期＊</td>
            <td class="textleft">
              <input type='text' name='date' value="<?php echo date ('Y-m-d');?>" placeholder='請選擇日期' pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$" required title="請輸入正確的時間格式 (ex: 1999-01-01)" />
              &nbsp;&nbsp;* 設定當天日期
            </td>
          </tr>
          <tr>
            <td>狀態＊</td>
            <td class="textleft">
              <select name='is_enabled'>
                <option value='1'>上架</option>
                <option value='0'>下架</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      <hr />
      <button type="button" id='add_title'>加入小標題</button>
      <button type="button" id='add_content'>加入內文</button>
      <button type="button" id='add_file_name'>加入圖片</button>
      <button type="submit">確定新增</button>
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
