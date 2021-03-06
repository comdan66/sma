<section class="grid col-three-quarters mq2-col-full">
  <h2>Aroma > List</h2>
  <hr>

  <article id="navphilo">
    <form action="<?php echo base_url (array ('admin', 'aromas'));?>" method="post">
      日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：
      <input type='text' class="date" value='<?php echo $start ? $start : '';?>' name='start' pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$" required title="請輸入正確的時間格式 (ex: 1999-01-01)"/> ~ <input type='text' class="date" value='<?php echo $end ? $end : '';?>' name='end' pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$" required title="請輸入正確的時間格式 (ex: 1999-01-01)"/>
      <br />
      <br />
      分類：
      <select name="aroma_tag_id" class="search">
        <option value='0'<?php echo $aroma_tag_id ? '' : ' selected';?>>請選擇</option>
    <?php foreach (AromaTag::all () as $tag) { ?>
            <option value='<?php echo $tag->id;?>'<?php echo $aroma_tag_id == $tag->id ? ' selected' : '';?>><?php echo $tag->name;?></option>
    <?php } ?>
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <button type="submit">搜尋</button>
      <hr>
    </form>
  </article>

  <article id="navplace">
    <form action="<?php echo base_url (array ('admin', 'aromas'));?>" method="post">
      <button type="submit" id="delete">刪除</button>
      &nbsp;
      <button type="button" id="select_all">全選</button>
      &nbsp;
      <br><br>
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
           <th width="12%"><input type="checkbox" id='check_all'></th>
           <th width="20%">日期</th>
           <th width="20%">分類</th>
           <th>名稱</th>
           <th width="8%">修改</th>
           <th width="8%">狀態</th>
          </tr>
        </thead>
        <tbody>
          </tr>
    <?php if ($aromas) {
            foreach ($aromas as $aroma) { ?>
              <tr>
                <td><label><input type="checkbox" name='delete_ids[]' value='<?php echo $aroma->id;?>'></label></td>
                <td class="textleft"><?php echo $aroma->date->format ('Y-m-d');?></td>
                <td class="textleft"><?php echo $aroma->tag ? $aroma->tag->name : '未分類';?></td>
                <td class="textleft"><?php echo $aroma->title;?></td>
                <td><a href="<?php echo base_url (array ('admin', 'aromas', 'edit', $aroma->id));?>">修改</a></td>
                <td><?php echo $aroma->is_enabled ? '上架' : '下架';?></td>
              </tr>
      <?php }
          } else { ?>
            <tr>
              <td colspan='6'>沒有任何資料產品</td>
            </tr>
    <?php } ?>
        </tbody>
      </table>
      <p>
        <a href="<?php echo $pagination['prev_link'];?>" class="arrowpre"></a>
        <?php echo $pagination['now_page'];?> / <?php echo $pagination['page_total'];?>
        <a href="<?php echo $pagination['next_link'];?>" class="arrow"></a>
        ｜ 筆數共<?php echo $pagination['total'];?>筆
      </p>
    </form>
  </article>
</section>