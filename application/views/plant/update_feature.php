<h2>添加/修改植物</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('/plant/' . $action) ?>

  <?php
  if (isset($plant))
  {
  ?>
  <a href="/plant/modify/<?php echo $plant['plant_id']; ?>">植物信息</a>
  <a href="/plant/update_photo/<?php echo $plant['plant_id']; ?>">图片管理</a>
  <?php
  }
  ?>

  <input type="submit" id="smtNext" name="next" value="下一步">
  <input type="submit" id="smtSave" name="save" value="保存">
  <?php
  if ((! isset($plant)) || (isset($plant) && $plant['status'] == 'EDITING'))
  {
  ?>
  <input type="submit" id="smtSubmit" name="submit" value="提交">
  <?php
  }
  ?>
  <input type="submit" id="smtBack" name="back2list" value="返回列表">
  <br>

  <?php foreach ($features as $feature):
    switch ($feature['type']) {
		case 'SET': ?>
		<label><?=$feature['name']?></label>
        <?php foreach(explode('|', $feature['value']) as $value): ?>
          <label>
            <input type="checkbox" name="<?=$feature['field_name']?>[]" value="<?=$value?>" <?php echo set_checkbox($feature['field_name'] . '[]', $value, strpos(@$plant[$feature['field_name']], $value) !== FALSE); ?>>
            <?=$value?>
          </label>
          <br>
        <?php endforeach; ?>
		<?php break;
		case 'FLOAT':
		?>
        <label for="<?=$feature['field_name']?>"><?=$feature['name']?></label>
		<select name="common">
		  <option value="1" <?php echo set_select('common', '1', strpos(@$plant[$feature['field_name']], '1') !== FALSE); ?> >1</option>
		  <option value="2" <?php echo set_select('common', '2', strpos(@$plant[$feature['field_name']], '2') !== FALSE); ?> >2</option>
		  <option value="3" <?php echo set_select('common', '3', strpos(@$plant[$feature['field_name']], '3') !== FALSE); ?> >3</option>
		  <option value="4" <?php echo set_select('common', '4', strpos(@$plant[$feature['field_name']], '4') !== FALSE); ?> >4</option>
		  <option value="5" <?php echo set_select('common', '5', strpos(@$plant[$feature['field_name']], '5') !== FALSE); ?> >5</option>
		</select><br>
        <?php
		break;
		case 'DATE':
		if (isset($plant) && strpos($plant['flowering_season'], '~') !== FALSE)
		{
			$flowering_season_arr = explode('~', $plant['flowering_season']);
			$flowering_season_from = $flowering_season_arr[0];
			$flowering_season_to = $flowering_season_arr[1];
		}
		else
		{
			$flowering_season_from = '0';
			$flowering_season_to = '0';
		}
		?>
        <label for="<?=$feature['field_name']?>"><?=$feature['name']?></label>
		<select name="flowering_season_from">
		  <option value="0" <?php echo set_select('flowering_season_from', '0', $flowering_season_from == '0'); ?> >无花</option>
		  <option value="1" <?php echo set_select('flowering_season_from', '1', $flowering_season_from == '1'); ?> >一月</option>
		  <option value="2" <?php echo set_select('flowering_season_from', '2', $flowering_season_from == '2'); ?> >二月</option>
		  <option value="3" <?php echo set_select('flowering_season_from', '3', $flowering_season_from == '3'); ?> >三月</option>
		  <option value="4" <?php echo set_select('flowering_season_from', '4', $flowering_season_from == '4'); ?> >四月</option>
		  <option value="5" <?php echo set_select('flowering_season_from', '5', $flowering_season_from == '5'); ?> >五月</option>
		  <option value="6" <?php echo set_select('flowering_season_from', '6', $flowering_season_from == '6'); ?> >六月</option>
		  <option value="7" <?php echo set_select('flowering_season_from', '7', $flowering_season_from == '7'); ?> >七月</option>
		  <option value="8" <?php echo set_select('flowering_season_from', '8', $flowering_season_from == '8'); ?> >八月</option>
		  <option value="9" <?php echo set_select('flowering_season_from', '9', $flowering_season_from == '9'); ?> >九月</option>
		  <option value="10" <?php echo set_select('flowering_season_from', '10', $flowering_season_from == '10'); ?> >十月</option>
		  <option value="11" <?php echo set_select('flowering_season_from', '11', $flowering_season_from == '11'); ?> >十一月</option>
		  <option value="12" <?php echo set_select('flowering_season_from', '12', $flowering_season_from == '12'); ?> >十二月</option>
		</select>
        ~
        <select name="flowering_season_to">
		  <option value="0" <?php echo set_select('flowering_season_to', '0', $flowering_season_to == '0'); ?> >无花</option>
		  <option value="1" <?php echo set_select('flowering_season_to', '1', $flowering_season_to == '1'); ?> >一月</option>
		  <option value="2" <?php echo set_select('flowering_season_to', '2', $flowering_season_to == '2'); ?> >二月</option>
		  <option value="3" <?php echo set_select('flowering_season_to', '3', $flowering_season_to == '3'); ?> >三月</option>
		  <option value="4" <?php echo set_select('flowering_season_to', '4', $flowering_season_to == '4'); ?> >四月</option>
		  <option value="5" <?php echo set_select('flowering_season_to', '5', $flowering_season_to == '5'); ?> >五月</option>
		  <option value="6" <?php echo set_select('flowering_season_to', '6', $flowering_season_to == '6'); ?> >六月</option>
		  <option value="7" <?php echo set_select('flowering_season_to', '7', $flowering_season_to == '7'); ?> >七月</option>
		  <option value="8" <?php echo set_select('flowering_season_to', '8', $flowering_season_to == '8'); ?> >八月</option>
		  <option value="9" <?php echo set_select('flowering_season_to', '9', $flowering_season_to == '9'); ?> >九月</option>
		  <option value="10" <?php echo set_select('flowering_season_to', '10', $flowering_season_to == '10'); ?> >十月</option>
		  <option value="11" <?php echo set_select('flowering_season_to', '11', $flowering_season_to == '11'); ?> >十一月</option>
		  <option value="12" <?php echo set_select('flowering_season_to', '12', $flowering_season_to == '12'); ?> >十二月</option>
		</select><br>
        <?php
		break;
	}
  endforeach; ?>

</form>

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#smtNext").click(function(e) {
        arr = $('form').attr('action').split('/');
		method = arr[4];
		plant_id = arr[5];
		$('form').attr('action', '/plant/' + method + '/' + plant_id + '/next');
    });
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
