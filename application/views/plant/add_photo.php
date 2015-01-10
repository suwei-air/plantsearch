<h2>上传照片</h2>



<?php echo form_open_multipart('plant/add_photo/' . $plant_id);?>

  <input type="file" name="photo" size="20">

  <br>
  
  编号：<input type="text" name="description" size="20">
  
  <br>
  
  <span>注意：图片大小应小于2MB，长边应该小于或等于1200像素，允许的格式包括jpg/gif/png。</span>

  <input type="submit" name="submit" value="提交"> 

</form>
