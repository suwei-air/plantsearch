<header>
  <nav id="pro-search-nav">
    <ul>
      <li><a href="/search/pro/taxon">谱系</a></li>
      <li><a href="/search/pro/scientific_name">拉丁名</a></li>
      <li><a href="/search/pro/pinyin">拼音</a></li>
    </ul>
  </nav>
  <h2>已收录物种 <?php echo $total_number; ?> 种</h2>
  <nav id="pro-search-alphabet-nav">
    <ul>
<?php
foreach ($plants as $initial => $item)
{
	if (count($item) === 0)
	{
		continue;
	}
?>
      <li><a href="#<?php echo $initial; ?>"><?php echo $initial; ?></a></li>
<?php
}
?>
</header>

<?php
foreach ($plants as $initial => $item)
{
	if (count($item) === 0)
	{
		continue;
	}
?>
<article class="pro-search-article">
  <hgroup>
    <h1><a name="<?php echo $initial; ?>"></a><?php echo $initial; ?></h1>
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
