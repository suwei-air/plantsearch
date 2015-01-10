<h2>添加/修改植物</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('/plant/' . $action) ?>

  <?php
  if (isset($plant))
  {
  ?>
  <a href="/plant/update_feature/<?php echo $plant['plant_id']; ?>">检索特征</a>
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

  <label for="name" class="required">中文名</label> 
  <input type="input" name="name" value="<?php echo set_value('name', @$plant['name']); ?>"><br>

  <label for="pinyin">拼音</label> 
  <input type="input" name="pinyin" value="<?php echo set_value('pinyin', @$plant['pinyin']); ?>" placeholder="每个字拼音首字母小写，字之间用空格隔开"><br>

  <label for="sci_name">学名</label> 
  <input type="input" name="sci_name" value="<?php echo set_value('pinyin', @$plant['sci_name']); ?>" placeholder="{}表示斜体"><br>

  <label for="comm_name">俗名</label> 
  <input type="input" name="comm_name" value="<?php echo set_value('comm_name', @$plant['comm_name']); ?>"><br>

  <label for="taxon_id">属</label> 
  <select id="combobox" name="taxon_id">
<?php
foreach ($taxons as $taxon)
{
?>
    <option value="<?php echo $taxon['taxon_id']; ?>" <?php echo set_select('parent_id', $taxon['taxon_id'], @$plant['taxon_id'] == $taxon['taxon_id']); ?>><?php echo $taxon['sci_name'] . ' ' . $taxon['name']; ?></option>
<?php
}
?>
  </select><br>

  <label for="sci_intro">专业简介</label> 
  <textarea name="sci_intro" cols="100" rows="20"><?php echo set_value('sci_intro', @$plant['sci_intro']); ?></textarea><br>
  <label for="sci_intro_source">资料来源</label> 
  <input type="input" name="sci_intro_source" value="<?php echo set_value('sci_intro_source', @$plant['sci_intro_source']); ?>"><br>
  
  <label for="pop_intro">科普简介</label> 
  <textarea name="pop_intro" cols="100" rows="20"><?php echo set_value('pop_intro', @$plant['pop_intro']); ?></textarea><br>

</form>

<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
<script src="http://lib.sinaapp.com/js/jquery-ui/1.9.2/jquery-ui.min.js"></script>
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

(function( $ ) {
  $.widget( "custom.combobox", {
	_create: function() {
	  this.wrapper = $( "<span>" )
		.addClass( "custom-combobox" )
		.insertAfter( this.element );

	  this.element.hide();
	  this._createAutocomplete();
	  this._createShowAllButton();
	},

	_createAutocomplete: function() {
	  var selected = this.element.children( ":selected" ),
		value = selected.val() ? selected.text() : "";

	  this.input = $( "<input>" )
		.appendTo( this.wrapper )
		.val( value )
		.attr( "title", "" )
		.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
		.autocomplete({
		  delay: 0,
		  minLength: 0,
		  source: $.proxy( this, "_source" )
		})
		.tooltip({
		  tooltipClass: "ui-state-highlight"
		});

	  this._on( this.input, {
		autocompleteselect: function( event, ui ) {
		  ui.item.option.selected = true;
		  this._trigger( "select", event, {
			item: ui.item.option
		  });
		},

		autocompletechange: "_removeIfInvalid"
	  });
	},

	_createShowAllButton: function() {
	  var input = this.input,
		wasOpen = false;

	  $( "<a>" )
		.attr( "tabIndex", -1 )
		.attr( "title", "Show All Items" )
		.tooltip()
		.appendTo( this.wrapper )
		.button({
		  icons: {
			primary: "ui-icon-triangle-1-s"
		  },
		  text: false
		})
		.removeClass( "ui-corner-all" )
		.addClass( "custom-combobox-toggle ui-corner-right" )
		.mousedown(function() {
		  wasOpen = input.autocomplete( "widget" ).is( ":visible" );
		})
		.click(function() {
		  input.focus();

		  // Close if already visible
		  if ( wasOpen ) {
			return;
		  }

		  // Pass empty string as value to search for, displaying all results
		  input.autocomplete( "search", "" );
		});
	},

	_source: function( request, response ) {
	  var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
	  response( this.element.children( "option" ).map(function() {
		var text = $( this ).text();
		if ( this.value && ( !request.term || matcher.test(text) ) )
		  return {
			label: text,
			value: text,
			option: this
		  };
	  }) );
	},

	_removeIfInvalid: function( event, ui ) {

	  // Selected an item, nothing to do
	  if ( ui.item ) {
		return;
	  }

	  // Search for a match (case-insensitive)
	  var value = this.input.val(),
		valueLowerCase = value.toLowerCase(),
		valid = false;
	  this.element.children( "option" ).each(function() {
		if ( $( this ).text().toLowerCase() === valueLowerCase ) {
		  this.selected = valid = true;
		  return false;
		}
	  });

	  // Found a match, nothing to do
	  if ( valid ) {
		return;
	  }

	  // Remove invalid value
	  this.input
		.val( "" )
		.attr( "title", value + " didn't match any item" )
		.tooltip( "open" );
	  this.element.val( "" );
	  this._delay(function() {
		this.input.tooltip( "close" ).attr( "title", "" );
	  }, 2500 );
	  this.input.data( "ui-autocomplete" ).term = "";
	},

	_destroy: function() {
	  this.wrapper.remove();
	  this.element.show();
	}
  });
})( jQuery );

$(function() {
  $( "#combobox" ).combobox();
//  $( "#toggle" ).click(function() {
//	$( "#combobox" ).toggle();
//  });
});
</script>
