<h2>分类阶元</h2>

<a href="/taxon/add/">增</a>

<?php
// 此函数可优化
function recursion($taxons, $taxon_id)
{
	$html = "<ul>\n";
	$counter = 0;
	foreach ($taxons as $taxon)
	{
		if ($taxon['parent_id'] == $taxon_id)
		{
			++$counter;
			$html .= "<li>\n";
			$html .= '<span title="' . $taxon['intro'] . '">' . $taxon['name'] . '</span>';
			$html .= ' (' . str_replace('}', '</i>', str_replace('{', '<i>', $taxon['sci_name'])) . ') ';
			$html .= '[<a href="/taxon/modify/' . $taxon['taxon_id'] . '">改</a> | <a href="/taxon/delete/' . $taxon['taxon_id'] . '">删</a>]';
			$html .= "\n";
			$html .= recursion($taxons, $taxon['taxon_id']);
			$html .= "</li>\n";
		}
	}
	if ($counter == 0)
	{
		return "";
	}
	$html .= "</ul>\n";
	return $html;
}

echo recursion($taxons, 0);
?>
