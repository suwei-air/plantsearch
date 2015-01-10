<header>
  <nav id="pro-search-nav">
    <ul>
      <li><a href="/search/pro/taxon">谱系</a></li>
      <li><a href="/search/pro/scientific_name">拉丁名</a></li>
      <li><a href="/search/pro/pinyin">拼音</a></li>
    </ul>
  </nav>
  <h2>已收录物种 <?php echo $total_number; ?> 种</h2>
  <nav id="pro-search-taxon-nav">
    <ul id="pro-search-phylum-nav">
    </ul>
    <ul id="pro-search-class-nav">
    </ul>
    <ul id="pro-search-order-nav">
    </ul>
  </nav>
</header>

<?php
foreach ($plants as $genus => $item)
{
	if (count($item) === 0)
	{
		continue;
	}
?>
<article class="pro-search-article">
  <hgroup>
    <h1><?php echo $genus; ?></h1>
    <h2><?php echo count($item); ?>种</h2>
  </hgroup>
  <ul>
<?php
foreach ($item as $plant)
{
?>
    <li>
      <span class="family-span"><?php echo $plant['tpname']; ?></span>
      <span class="species-span"><a href="/plant/view/<?php echo $plant['pid']; ?>"><?php echo $plant['pname']; ?></a></span>
      <span class="sci-name-span"><?php echo str_replace('}', '</i>', str_replace('{', '<i>', $plant['pname_2nd'])); ?></span>
    </li>
<?php
}
?>
  </ul>
</article>
<?php
}
?>

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
function refreshOrder(cid) {
	$.getJSON('/ajax/get_the_children_level_taxons_by_tid_and_level/' + cid + '/ORDER',
		function (result) {
			var str = "";
			$.each(result, function(i, field){
				str += "<li><a href=\"/search/pro/taxon/" + field.taxon_id + "\">" + field.name + "</a></li>\n";
			});
			$("ul#pro-search-order-nav").html(str);
		});
}
function refreshClass(pid) {
	$.getJSON('/ajax/get_the_children_level_taxons_by_tid_and_level/' + pid + '/CLASS',
		function (result) {
			var str = "";
			$.each(result, function(i, field){
				str += "<li data-tid=\"" + field.taxon_id + "\">" + field.name + "</li>\n";
			});
			$("ul#pro-search-class-nav").html(str);
			$("ul#pro-search-class-nav>li").click(function(e) {
				refreshOrder($(this).attr("data-tid"));
			});

		});
}
function refreshPhylum() {
	$.getJSON('/ajax/get_parent_level_taxons_by_level/CLASS',
		function (result) {
			var str = "";
			$.each(result, function(i, field){
				str += "<li data-tid=\"" + field.taxon_id + "\">" + field.name + "</li>\n";
			});
			$("ul#pro-search-phylum-nav").html(str);
			$("ul#pro-search-phylum-nav>li").click(function(e) {
				refreshClass($(this).attr("data-tid"));
			});

		});
}

$(document).ready(function(e) {
	refreshPhylum();
});
</script>
