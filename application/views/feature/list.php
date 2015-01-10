<h2>检索特征</h2>

<table summary="表格形式展示检索特征">
  <caption>
    检索特征
  </caption>
  <tr>
    <th scope="col">feature_id</th>
    <th scope="col">name</th>
    <th scope="col">field_name</th>
    <th scope="col">description</th>
    <th scope="col">type</th>
    <th scope="col">value</th>
    <th scope="col">is_display</th>
    <th scope="col">manage</th>
  </tr>
  
  <?php foreach ($features as $item): ?>
  <tr>
    <th scope="row"><?php echo $item['feature_id'] ?></th>
    <td><?php echo $item['name'] ?></td>
    <td><?php echo $item['field_name'] ?></td>
    <td><?php echo $item['description'] ?></td>
    <td><?php echo $item['type'] ?></td>
    <td><?php echo $item['value'] ?></td>
    <td><?php echo $item['is_display'] ?></td>
    <td><a href="/feature/modify/<?php echo $item['feature_id'] ?>">改</a></td>
  </tr>
  <?php endforeach ?>
  
</table>

<a href="/feature/add/">增</a>
