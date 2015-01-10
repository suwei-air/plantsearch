<?php
function set_checkbox($post_key, $post_value)
{
//	$key = substr($post_key, 0, strlen($post_key)-2);
//	return in_array($post_value, $selected[$key]);
}
?>

<form action="/search" method="post" accept-charset="utf-8">
  <label>整体</label>
  <label>
    <input type="checkbox" name="entirety[]" value="乔木" <?php echo in_array('乔木', @$selected['entirety']==null ? array() : $selected['entirety']) ? 'checked="checked"' : ''; ?>>
    乔木 </label>
  <label>
    <input type="checkbox" name="entirety[]" value="灌木" <?php echo in_array('灌木', @$selected['entirety']==null ? array() : $selected['entirety']) ? 'checked="checked"' : ''; ?>>
    灌木 </label>
  <label>
    <input type="checkbox" name="entirety[]" value="草本" <?php echo in_array('草本', @$selected['entirety']==null ? array() : $selected['entirety']) ? 'checked="checked"' : ''; ?>>
    草本 </label>
  <label>
    <input type="checkbox" name="entirety[]" value="藤本" <?php echo in_array('藤本', @$selected['entirety']==null ? array() : $selected['entirety']) ? 'checked="checked"' : ''; ?>>
    藤本 </label>
  <br>
  <label>区域</label>
  <label>
    <input type="checkbox" name="area[]" value="榆中校区" <?php echo in_array('榆中校区', @$selected['area']==null ? array() : $selected['area']) ? 'checked="checked"' : ''; ?>>
    榆中校区 </label>
  <label>
    <input type="checkbox" name="area[]" value="本部" <?php echo in_array('本部', @$selected['area']==null ? array() : $selected['area']) ? 'checked="checked"' : ''; ?>>
    本部 </label>
  <label>
    <input type="checkbox" name="area[]" value="医学校区" <?php echo in_array('医学校区', @$selected['area']==null ? array() : $selected['area']) ? 'checked="checked"' : ''; ?>>
    医学校区 </label>
  <label>
    <input type="checkbox" name="area[]" value="其他校区" <?php echo in_array('其他校区', @$selected['area']==null ? array() : $selected['area']) ? 'checked="checked"' : ''; ?>>
    其他校区 </label>
  <br>
  <label>叶类型</label>
  <label>
    <input type="checkbox" name="leaf_type[]" value="单叶" <?php echo in_array('单叶', @$selected['leaf_type']==null ? array() : $selected['leaf_type']) ? 'checked="checked"' : ''; ?>>
    单叶 </label>
  <label>
    <input type="checkbox" name="leaf_type[]" value="羽状复叶" <?php echo in_array('羽状复叶', @$selected['leaf_type']==null ? array() : $selected['leaf_type']) ? 'checked="checked"' : ''; ?>>
    羽状复叶 </label>
  <label>
    <input type="checkbox" name="leaf_type[]" value="三出复叶" <?php echo in_array('三出复叶', @$selected['leaf_type']==null ? array() : $selected['leaf_type']) ? 'checked="checked"' : ''; ?>>
    三出复叶 </label>
  <label>
    <input type="checkbox" name="leaf_type[]" value="掌状复叶" <?php echo in_array('掌状复叶', @$selected['leaf_type']==null ? array() : $selected['leaf_type']) ? 'checked="checked"' : ''; ?>>
    掌状复叶 </label>
  <br>
  <label>叶序</label>
  <label>
    <input type="checkbox" name="phyllotaxy[]" value="簇生" <?php echo in_array('簇生', @$selected['phyllotaxy']==null ? array() : $selected['phyllotaxy']) ? 'checked="checked"' : ''; ?>>
    簇生 </label>
  <label>
    <input type="checkbox" name="phyllotaxy[]" value="互生" <?php echo in_array('互生', @$selected['phyllotaxy']==null ? array() : $selected['phyllotaxy']) ? 'checked="checked"' : ''; ?>>
    互生 </label>
  <label>
    <input type="checkbox" name="phyllotaxy[]" value="对生" <?php echo in_array('对生', @$selected['phyllotaxy']==null ? array() : $selected['phyllotaxy']) ? 'checked="checked"' : ''; ?>>
    对生 </label>
  <label>
    <input type="checkbox" name="phyllotaxy[]" value="轮生" <?php echo in_array('轮生', @$selected['phyllotaxy']==null ? array() : $selected['phyllotaxy']) ? 'checked="checked"' : ''; ?>>
    轮生 </label>
  <label>
    <input type="checkbox" name="phyllotaxy[]" value="基生" <?php echo in_array('基生', @$selected['phyllotaxy']==null ? array() : $selected['phyllotaxy']) ? 'checked="checked"' : ''; ?>>
    基生 </label>
  <br>
  <label>叶形</label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="鳞片状" <?php echo in_array('鳞片状', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    鳞片状 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="针状" <?php echo in_array('针状', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    针状 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="披针形" <?php echo in_array('披针形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    披针形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="倒披针形" <?php echo in_array('倒披针形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    倒披针形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="卵形" <?php echo in_array('卵形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    卵形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="倒卵形" <?php echo in_array('倒卵形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    倒卵形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="条形" <?php echo in_array('条形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    条形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="椭圆形" <?php echo in_array('椭圆形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    椭圆形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="圆形" <?php echo in_array('圆形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    圆形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="箭形" <?php echo in_array('箭形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    箭形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="心形" <?php echo in_array('心形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    心形 </label>
  <label>
    <input type="checkbox" name="leaf_shape[]" value="肾形" <?php echo in_array('肾形', @$selected['leaf_shape']==null ? array() : $selected['leaf_shape']) ? 'checked="checked"' : ''; ?>>
    肾形 </label>
  <br>
  <label>花色</label>
  <label>
    <input type="checkbox" name="flower_color[]" value="黄白系" <?php echo in_array('黄白系', @$selected['flower_color']==null ? array() : $selected['flower_color']) ? 'checked="checked"' : ''; ?>>
    黄白系 </label>
  <label>
    <input type="checkbox" name="flower_color[]" value="粉红系" <?php echo in_array('粉红系', @$selected['flower_color']==null ? array() : $selected['flower_color']) ? 'checked="checked"' : ''; ?>>
    粉红系 </label>
  <label>
    <input type="checkbox" name="flower_color[]" value="蓝紫系" <?php echo in_array('蓝紫系', @$selected['flower_color']==null ? array() : $selected['flower_color']) ? 'checked="checked"' : ''; ?>>
    蓝紫系 </label>
  <label>
    <input type="checkbox" name="flower_color[]" value="绿色系" <?php echo in_array('绿色系', @$selected['flower_color']==null ? array() : $selected['flower_color']) ? 'checked="checked"' : ''; ?>>
    绿色系 </label>
  <br>
  <label>花型</label>
  <label>
    <input type="checkbox" name="pattern[]" value="禾本状" <?php echo in_array('禾本状', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    禾本状 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="花瓣四" <?php echo in_array('花瓣四', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    花瓣四 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="花瓣五" <?php echo in_array('花瓣五', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    花瓣五 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="花瓣六" <?php echo in_array('花瓣六', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    花瓣六 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="重瓣" <?php echo in_array('重瓣', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    重瓣 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="蝶形"<?php echo in_array('蝶形', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    蝶形 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="头状花序" <?php echo in_array('头状花序', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    头状花序 </label>
  <label>
    <input type="checkbox" name="pattern[]" value="筒状" <?php echo in_array('筒状', @$selected['pattern']==null ? array() : $selected['pattern']) ? 'checked="checked"' : ''; ?>>
    筒状 </label>
  <br>
  <label>果实颜色</label>
  <label>
    <input type="checkbox" name="fruit_color[]" value="黑色" <?php echo in_array('黑色', @$selected['fruit_color']==null ? array() : $selected['fruit_color']) ? 'checked="checked"' : ''; ?>>
    黑色 </label>
  <label>
    <input type="checkbox" name="fruit_color[]" value="红色" <?php echo in_array('红色', @$selected['fruit_color']==null ? array() : $selected['fruit_color']) ? 'checked="checked"' : ''; ?>>
    红色 </label>
  <label>
    <input type="checkbox" name="fruit_color[]" value="黄色" <?php echo in_array('黄色', @$selected['fruit_color']==null ? array() : $selected['fruit_color']) ? 'checked="checked"' : ''; ?>>
    黄色 </label>
  <label>
    <input type="checkbox" name="fruit_color[]" value="白色" <?php echo in_array('白色', @$selected['fruit_color']==null ? array() : $selected['fruit_color']) ? 'checked="checked"' : ''; ?>>
    白色 </label>
  <br>
  <label>叶缘</label>
  <label>
    <input type="checkbox" name="leafmargin[]" value="全缘" <?php echo in_array('全缘', @$selected['leafmargin']==null ? array() : $selected['leafmargin']) ? 'checked="checked"' : ''; ?>>
    全缘 </label>
  <label>
    <input type="checkbox" name="leafmargin[]" value="波状" <?php echo in_array('波状', @$selected['leafmargin']==null ? array() : $selected['leafmargin']) ? 'checked="checked"' : ''; ?>>
    波状 </label>
  <label>
    <input type="checkbox" name="leafmargin[]" value="齿状" <?php echo in_array('齿状', @$selected['leafmargin']==null ? array() : $selected['leafmargin']) ? 'checked="checked"' : ''; ?>>
    齿状 </label>
  <label>
    <input type="checkbox" name="leafmargin[]" value="缺刻" <?php echo in_array('缺刻', @$selected['leafmargin']==null ? array() : $selected['leafmargin']) ? 'checked="checked"' : ''; ?>>
    缺刻 </label>
</form>

<hr>

<?php
if (count($plants) == 0)
{
?>
无法搜索到相关结果。
<?php
}
else
{
	foreach($plants as $plant)
	{
?>
<div><h1><?php echo $plant['name']; ?></h1></div>
<?php
	}
}
?>
<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(e) {
	$("input").change(function(e) {
        $("form").submit();
    });
});
</script> 
