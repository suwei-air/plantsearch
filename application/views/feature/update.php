<h2>添加/修改检索特征</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('feature/' . $action) ?>

  <label for="name" class="required">检索特征名</label> 
  <input type="input" name="name" value="<?php echo set_value('name', @$feature['name']); ?>"><br>

  <label for="field_name" class="required">字段名</label> 
  <input type="input" name="field_name" value="<?php echo set_value('field_name', @$feature['field_name']); ?>"><br>

  <label for="type">检索特性类别</label> 
  <select name="type">
    <option value="SET" <?php echo set_select('type', 'SET', @$feature['type'] == 'SET' || !isset($feature['type'])); ?>>离散</option>
    <option value="FLOAT" <?php echo set_select('type', 'FLOAT', @$feature['type'] == 'FLOAT'); ?>>数值</option>
    <option value="DATE" <?php echo set_select('type', 'DATE', @$feature['type'] == 'DATE'); ?>>日期</option>
  </select><br>

  <label for="value">取值</label> 
  <input type="input" name="value" value="<?php echo set_value('value', @$feature['value']); ?>"><br>

  <label for="description">介绍</label> 
  <textarea name="description"><?php echo set_value('description', @$feature['description']); ?></textarea><br>

  <label for="is_display" class="required">是否显示</label> 
  <input type="input" name="is_display" value="<?php echo set_value('is_display', @$feature['is_display'] || '1'); ?>"><br>

  <input type="submit" name="submit" value="提交"> 

</form>
