<h2>植物图片</h2>

<?php echo form_open('/plant/update_photo/' . $plant_id); ?>

  <a href="/plant/modify/<?php echo $plant_id; ?>">植物信息</a>
  <a href="/plant/update_feature/<?php echo $plant_id; ?>">检索特征</a>

  <input type="submit" id="smtSave" name="save" value="保存">
  <?php
  if (isset($plant) && $plant['status'] == 'EDITING')
  {
  ?>
  <input type="submit" id="smtSubmit" name="submit" value="提交">
  <?php
  }
  ?>
  <input type="submit" id="smtBack" name="back2list" value="返回列表">

<table border="1" width="100%" summary="表格形式展示植物图片">
  <tr>
    <th scope="col">图片</th>
    <th scope="col">拍摄者</th>
    <th scope="col">描述</th>
    <th scope="col">管理</th>
  </tr>
  
  <?php foreach ($photos as $item): ?>
  <tr>
    <td><a target="_blank" href="<?php echo $item['url'] ?>"><?php echo $item['url'] ?></a></td>
    <td><input name="pic_photographer_<?php echo $item['pic_id'] ?>" value="<?php echo $item['photographer'] ?>"></td>
    <td><input name="pic_desc_<?php echo $item['pic_id'] ?>" value="<?php echo $item['description'] ?>"></td>
    <td>
      <a href="/plant/set_cover/<?php echo $plant_id . '/' . $item['pic_id'] ?>">设为封面</a> |
      <a onClick="javascript: return confirm('确实要删除图片吗？');" href="/plant/delete_photo/<?php echo $plant_id . '/' . $item['pic_id'] ?>">删</a>
    </td>
  </tr>
  <?php endforeach ?>
  
</table>

</form>

<?php echo form_open_multipart('/plant/add_photo/' . $plant_id);?>

  <input type="file" name="photo" size="20">

  <br>
  
  描述：<input type="text" name="description" size="20">
  
  <br>
  
  <span>注意：图片大小应小于2MB，长边应该小于或等于1200像素，允许的格式包括jpg/gif/png。</span>

  <input type="submit" name="upload" value="上传"> 

</form>

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#smtSave").click(function(e) {
        arr = $('form').attr('action').split('/');
		method = arr[4];
		plant_id = arr[5];
		$('form').attr('action', '/plant/' + method + '/' + plant_id + '/save');
    });
	$("#smtSubmit").click(function(e) {
        arr = $('form').attr('action').split('/');
		method = arr[4];
		plant_id = arr[5];
		$('form').attr('action', '/plant/' + method + '/' + plant_id + '/submit');
    });
	$("#smtBack").click(function(e) {
		window.location.href = '/plant/view_list';
		return false;
    });
});
</script>
