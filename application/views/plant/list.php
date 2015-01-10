<h2>植物</h2>

<a href="/plant/add/">增</a>

<table border="1" width="100%" summary="表格形式展示植物">
  <tr>
    <th scope="col">中文名</th>
    <th scope="col">添加人</th>
    <th scope="col">添加时间</th>
    <th scope="col">审核状态</th>
    <th scope="col">manage</th>
  </tr>
  
  <?php foreach ($plants as $item): ?>
  <tr>
    <td><a href="/plant/view/<?php echo $item['plant_id'] ?>"><?php echo $item['name'] ?></a></td>
    <td><?php echo $item['uploader_id'] ?></td>
    <td><?php echo $item['upload_time'] ?></td>
    <td>
	<?php
	switch ($item['status'])
	{
		case 'EDITING':
			echo '编辑中';
			if ($this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($item['uploader_id']))
			{
				echo '[<a href="/plant/submit/' . $item['plant_id'] . '">提交</a>]';
			}
			break;
		case 'VERIFYING':
			echo '未审核';
			if ($this->user_model->is_auth('VERIFY'))
			{
				echo '[<a href="/plant/verify/' . $item['plant_id'] . '">审核</a> | <a href="/plant/retreat/' . $item['plant_id'] . '">退回</a>]';
			}
			break;
		case 'VERIFIED':
			echo '已审核';
			if ($this->user_model->is_auth('VERIFY'))
			{
				echo '[<a href="/plant/verify/' . $item['plant_id'] . '">反审核</a>]';
			}
			break;
	}
	?>
    </td>
    <td>
    <?php
	if (($item['status'] == 'EDITING' && $this->user_model->is_auth('UPLOAD') && $this->user_model->is_self($item['uploader_id']))
		|| ($item['status'] != 'EDITING' && $this->user_model->is_auth('VERIFY')))
	{
	?>
      <a href="/plant/modify/<?php echo $item['plant_id'] ?>">修改</a> |
      <a onClick="javascript: return confirm('确实要删除记录吗？');" href="/plant/delete/<?php echo $item['plant_id'] ?>">删</a>
    <?php
	}
	?>
    </td>
  </tr>
  <?php endforeach ?>
  
</table>
