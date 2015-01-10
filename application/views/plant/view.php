<h1 id="p-name"><?php echo $plant['name'] ?></h1>
<a class="p-searchlink" href="">新检索</a>
<a class="p-searchlink" href="">返回检索结果</a>

<hgroup id="h-info">
  <img id="p-cover_pic" src="<?php echo $plant['cover_pic'] ?>!medium">
  <h1><?php echo $plant['name'] ?></h1>
  <h2>拼音：<span class="p-pinyin"><?php echo $plant['pinyin'] ?></span></h2>
  <h2>学名：<span class="p-sci_name"><?php echo str_replace('}', '</i>', str_replace('{', '<i>', $plant['sci_name'])) ?></span></h2>
  <h2>俗名：<span class="p-comm_name"><?php echo $plant['comm_name'] ?></span></h2>
  <hr>
  <!-- h3>分类：<span class="p-family">科</span><span class="p-genus">属</span></h3>
  <h3>花期：<span class="p-flower_season"><?php //echo date('m', strtotime($plant['flowering_season'])) ?>月</span></h3>
  <h3>果期：<span class="p-fruit_season">7月</span></h3 -->
</hgroup>

<div id="p-photo_gallery">
  <h1>More Picture</h1>
  <span class="p-pg-arrow_l"></span>
  <ul>
  <?php
  foreach ($photos as $photo) {
  ?>
    <li <?php if ($photo['url'] == $plant['cover_pic']) echo 'class="selected"'; ?>><a style="background-image:url(<?=$photo['url']?>!200x200)" href="<?=$photo['url']?>"><img src="<?=$photo['url']?>!200x200"><span><?=$photo['description']?></span></a></li>
  <?php
  }
  ?>
  </ul>
  <span class="p-pg-arrow_r"></span>
</div>

<article class="p-intro">
  <h1>科普简介</h1>
  <section>
	<?php echo $plant['pop_intro'] ?>
  </section>
</article>
<article class="p-intro">
  <h1>专业简介</h1>
  <section>
	<?php echo $plant['sci_intro'] ?>
    <p id="p-sci_intro_source">资料来源：<?php echo $plant['sci_intro_source'] ?></p>
  </section>
</article>
<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script language="javascript">
$(document).ready(function(e) {
    $("div#p-photo_gallery h1").click(function(e) {
        $("div#p-photo_gallery span, div#p-photo_gallery ul").slideToggle(null, null, function(e) {
			if ($(this).is(':visible')) {
				$(this).parent().children('h1').css('background-image', 'url(/static/image/arrow-u-blue.png)');
			}
			else {
				$(this).parent().children('h1').css('background-image', 'url(/static/image/arrow-d-blue.png)');
			}
		});
    });
    $("article h1").click(function(e) {
        $(this).parent().children('section').slideToggle(null, null, function(e) {
			if ($(this).is(':visible')) {
				$(this).parent().children('h1').css('background-image', 'url(/static/image/arrow-u-white.png)');
			}
			else {
				$(this).parent().children('h1').css('background-image', 'url(/static/image/arrow-d-white.png)');
			}
		});
    });
	$("div#p-photo_gallery span.p-pg-arrow_l").click(function(e) {
		var first_item = $("div#p-photo_gallery ul li:first");
		var first_item_width = '-' + first_item.css('width');
		first_item.animate({marginLeft:first_item_width, paddingLeft:0, paddingRight:0}, 'slow', null, function(e) {
			$("div#p-photo_gallery ul li:last").after($(this));
			$(this).css({'margin-left':'0', 'padding':'10px'});
		});
    });
	$("div#p-photo_gallery span.p-pg-arrow_r").click(function(e) {
        $("div#p-photo_gallery ul li:first").before($("div#p-photo_gallery ul li:last"));
		$("div#p-photo_gallery ul li:first").css('margin-left', '-220px')
			.animate({marginLeft:0}, 'slow');
    });
	$("div#p-photo_gallery ul li a").click(function(e) {
		var url = $(this).attr('href');
		url += '!medium';
        $("img#p-cover_pic").attr('src', url);
		$("div#p-photo_gallery > ul > li.selected").removeClass('selected');
		$(this).parent().addClass('selected');
		return false;
    });
});
</script>
