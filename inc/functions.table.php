<?php
function grid_select($cols) {
	return implode(', ', array_map(function($i){if($i[1]){return $i[0].' AS '.$i[1];}else{return $i[0];}},$cols));
}

function grid_order($cols) {
	return implode(', ', array_diff(array_map(function($i){if($i[2]){return $i[1].' '.strtoupper($i[2]);}},$cols), array('')));
}

#############################################

function grid($sql, $add=true, $full=true) {
	global $config;

	# table or dataset
	if($sql['data']) {
		$sql['table'] = serialize($sql['cols']);
	}

	# cols array(column, alias, asc/desc, type)
	foreach($sql['cols'] as $k=>$field) {
		if($field[1]) {
			$columns_data[] = $field[1];
		} else {
			if(strpos($field[0],'.')) {
				$columns_data[] = substr($field[0], strpos($field[0], '.') + 1);
			} else {
				$columns_data[] = $field[0];
			}
		}
		$columns_url[] = array($field[0], $field[1]);

		# special controls
		if($field[1] == 'action_view') $action_view = true;
		if($field[1] == 'action_edit') $action_edit = true;
		if($field[1] == 'action_delete') $action_delete = true;

		# set orders
		if($field[2]) {
			$order_data[] = '['.$k.', "'.$field[2].'"]';
		}
	}

	# filters
	if($sql['filters']) $encoded_filters = base64_encode(serialize($sql['filters']));

	# group by
	if($sql['groupby']) $encoded_groupby = base64_encode($sql['groupby']);

	# table structure
	if($add || $full) {
		echo '<div class="row"><div class="col-lg-12"><div class="panel panel-default">';
		echo '<div class="panel-heading">';
		if($add) echo '<a class="pull-right btn btn-primary btn-xs" href="'.substr(basename($_SERVER['SCRIPT_NAME']), 0, strrpos(basename($_SERVER['SCRIPT_NAME']), '.')).'.edit.php"><i class="fa fa-plus-circle"></i> '.m('record_new').'</a>';
		echo m('record_list').'</div><div class="panel-body"><div class="table-responsive">';
	}
	echo '<div class="table-responsive"><table class="table table-bordered table-hover" id="datatable_'.md5($sql['table']).'"><thead><tr>';
	foreach($columns_data as $k=>$th) {
		if(substr($th, 0, 7) != 'action_') {
			if($sql['cols'][$k][3] == 'boolean') {
				echo '<th>&nbsp;</th>';
			} else {
				echo '<th>'.m($th).'</th>';
			}
		} else {
			echo '<th>&nbsp;</th>';
		}
	}
	echo '</tr></thead><tbody></tbody></table></div>';
	if($add || $full) echo '</div></div></div></div></div>';
	
	# column definitions
	if(is_numeric($_GET['id']) && $full) {
		# highlight last modified record
		$defs[] = '{ "aTargets": [0], "bSortable": false, "bSearchable": false, "bVisible": false, "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {if(sData == '.$_GET['id'].'){$.doTimeout("timer_last", 50, function(){$("#datatable_'.md5($sql['table']).' tbody tr").eq(iRow).effect("highlight", {color: "#e3f8a0"}, 2500);});}}}';
	} else {
		$defs[] = '{ "aTargets": [0], "bSortable": false, "bSearchable": false, "bVisible": false }';
	}
	$action_index = -1;
	if($action_delete) $defs[] = '{ "aTargets": ['.$action_index--.'], "bSortable": false, "bSearchable": true, "sClass": "action action_delete", "mRender": function(data){ return "<a href=\"#\" id=\"delete_" + data + "\" onClick=\"$(this).delete_row(event);\"><i class=\"fa fa-times-circle\"></i></a>"; } }';
	if($action_edit) $defs[] = '{ "aTargets": ['.$action_index--.'], "bSortable": false, "bSearchable": false, "sClass": "action", "mRender": function(data){ return "<a href=\"'.substr(basename($_SERVER['SCRIPT_NAME']), 0, strrpos(basename($_SERVER['SCRIPT_NAME']), '.')).'.edit.php?id=" + data + "\"><i class=\"fa fa-caret-square-o-right\"></i></a>"; } }';
	foreach($sql['cols'] as $k=>$field) {
		switch($field[3]) {
			case 'timestamp':
				$defs[] = '{ "aTargets": ['.$k.'], "bSearchable": false, "sClass": "timestamp" }';
			break;
			case 'money':
				$defs[] = '{ "aTargets": ['.$k.'], "bSearchable": false, "sClass": "money", "mRender": function(data){return accounting.formatMoney(data);} }';
			break;
			case 'boolean':
				$defs[] = '{ "aTargets": ['.$k.'], "bSearchable": false, "sClass": "boolean", "mRender": function(data){if(data == 1) {return "<i class=\"fa fa-check text-success\"></i>";} else {return "<i class=\"fa fa-times text-muted\"></i>";}}}';
			break;
			case 'count':
				$defs[] = '{ "aTargets": ['.$k.'], "bSearchable": false, "sClass": "count" }';
			break;
			case 'hidden':
				$defs[] = '{ "aTargets": ['.$k.'], "bVisible": false }';
			break;
			default:
				# class for non-special columns
				if($field[3]) $defs[] = '{ "aTargets": ['.$k.'], "sClass": "'.$field[3].'" }';
			break;
		}
	}

	$options[] = '"aoColumnDefs": ['.implode(',', $defs).']';
	$options[] = '"bLengthChange": true';
	if($full) {
		$options[] = '"bStateSave": true';
		$options[] = '"bFilter": true';
		$options[] = '"bInfo": true';
		$options[] = '"bPaginate": true';
	} else {
		$options[] = '"bStateSave": false';
		$options[] = '"bFilter": false';
		$options[] = '"bInfo": false';
		$options[] = '"bPaginate": false';
	}
	if(is_array($order_data)) {
		$options[] = '"aaSorting": ['.implode(', ', $order_data).']';
	}
	$options[] = '"bSortClasses": false';
	$options[] = '"bAutoWidth": false';
	if(!is_array($sql['data'])) {
		# server side
		$options[] = '"bProcessing": false';
		$options[] = '"bDeferRender": true';
		$options[] = '"bServerSide": true';
		$options[] = '"sAjaxSource": "inc/datatables.php"';
		$options[] = '"fnServerData": function (sSource, aoData, fnCallback, oSettings) {
			$.getJSON(sSource, aoData, function (json) {
				if(json !== null) {
					fnCallback(json);
				} else {
					alert("error trying to load data");
				}
			});
		}';
		$options[] = '"fnServerParams": function (aoData) {
			aoData.push(
				{"name": "table", "value":"'.base64_encode($sql['table']).'"},
				{"name": "cols", "value":"'.base64_encode(serialize($columns_url)).'"},
				{"name": "filters", "value":"'.$encoded_filters.'"},
				{"name": "groupby", "value":"'.$encoded_groupby.'"}
			);
		}';
	} else {
		# preloaded data in javascript array
		foreach($sql['data'] as $tr) {
			$row = array();
			for($i = 0; $i < count($sql['cols']); $i++) {
				$row[] = $tr[$columns_data[$i]];
			}
			$aaData[] = $row;
		}
		$options[] = '"aaData": '.json_encode($aaData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	echo '<script>$(function(){var datatable_'.md5($sql['table']).' = $("#datatable_'.md5($sql['table']).'").dataTable({'.implode(',',$options).'});';

	# delete function
	if($action_delete) {
		echo '(function($){
			$.fn.delete_row = function(e) {
				e.preventDefault();
				e.stopPropagation();
				var row = $(this).closest("tr").get(0);
				var id = this.attr("id").split("_")[1];
				$(row).fadeTo("fast", 0.5);
				bootbox.confirm("'.m('delete_confirm').'", function(r) {
					if(r) {
						var row_backup = $(row).html();
						$(row).fadeTo("fast", 1).html("<td colspan=\"'.count($sql['cols']).'\" class=\"delete\">'.m('deleting').'</td>");
						$.post("'.$_SERVER['SCRIPT_NAME'].'", { action: "delete", id: id }).done(function(data){
							if($.isNumeric(data)) {
								if(data == 1) {
									$(row).fadeOut("fast", function(){
										var page_number = datatable_'.md5($sql['table']).'.fnPagingInfo().iPage;
										datatable_'.md5($sql['table']).'.fnDeleteRow(row, function(){datatable_'.md5($sql['table']).'.fnPageChange(page_number);}, false);
									});
								} else {
									bootbox.dialog({
										message: data,
										onEscape: function(){
											$(row).html(row_backup);
										},
										buttons: {
											success: {
												label: "'.m('close').'",
												className: "btn-danger",
												callback: function() {
													$(row).html(row_backup);
												}
											}
										}
									});
								}
							} else {
								bootbox.dialog({
									message: data,
									onEscape: function(){
										$(row).html(row_backup);
									},
									buttons: {
										success: {
											label: "'.m('close').'",
											className: "btn-danger",
											callback: function() {
												$(row).html(row_backup);
											}
										}
									}
								});
							}
						});
					} else {
						$(row).fadeTo("fast", 1);
					}
				});
				return this;
			}; 
		})(jQuery);';
	}

	# close ready
	echo '});</script>';
}
