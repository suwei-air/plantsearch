<h2>添加/修改科属</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('/taxon/' . $action) ?>

  <label for="name" class="required">分类阶元中文名</label> 
  <input type="input" name="name" value="<?php echo set_value('name', @$taxon['name']); ?>"><br>

  <label for="sci_name">分类阶元学名</label> 
  <input type="input" name="sci_name" value="<?php echo set_value('sci_name', @$taxon['sci_name']); ?>"><br>

  <label for="level">分类阶元等级</label> 
  <select id="level" name="level">
    <option value="KINGDOM" <?php echo set_select('level', 'KINGDOM', @$taxon['level'] == 'KINGDOM'); ?>>界</option>
    <option value="PHYLUM" <?php echo set_select('level', 'PHYLUM', @$taxon['level'] == 'PHYLUM'); ?>>门</option>
    <option value="CLASS" <?php echo set_select('level', 'CLASS', @$taxon['level'] == 'CLASS'); ?>>纲</option>
    <option value="ORDER" <?php echo set_select('level', 'ORDER', @$taxon['level'] == 'ORDER'); ?>>目</option>
    <option value="FAMILY" <?php echo set_select('level', 'FAMILY', @$taxon['level'] == 'FAMILY'); ?>>科</option>
    <option value="GENUS" <?php echo set_select('level', 'GENUS', @$taxon['level'] == 'GENUS'); ?>>属</option>
  </select><br>

  <label for="intro">介绍</label> 
  <textarea name="intro"><?php echo set_value('intro', @$taxon['intro']); ?></textarea><br>

  <label for="parent_id">上级分类阶元</label> 
  <select id="parent_id" name="parent_id">
  <?php
  foreach ($parent_level as $parent)
  {
  ?>
    <option value="<?php echo $parent['taxon_id']; ?>" <?php echo set_select('parent_id', $parent['taxon_id'], @$taxon['parent_id'] == $parent['taxon_id']); ?>>
	  <?php echo $parent['name']; ?>
    </option>
  <?php
  }
  ?>
  </select><br>

  <input type="submit" name="submit" value="提交"> 

</form>

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
function refreshParent() {
	s = $('#level');
	p = $('#parent_id');
	$.getJSON('/ajax/get_parent_level_taxons_by_level/' + s.val(),
		function (result) {
			p.get(0).options.length = 0;
			$.each(result, function(i, field){
				p.get(0).options.add(new Option(field.name, field.taxon_id));
			});
		});
}

$(document).ready(function(e) {
	refreshParent();
    $('#level').change(function(e) {
        refreshParent();
    });
});
</script>
