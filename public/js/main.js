$(document).ready(function() {  
	
	// User New Form: Add and Remove Users
	$("#bug").on("click", "#add_user" , function() { 	
		$.ajax({
			type: "GET",
			url: "/user/ajax_get_users_roles",
			success: function(msg){
				$("#user_list").append(msg).enhanceWithin();
			}
		});	
	 });

	$("#bug").on("click", "a.remove_user", function() { 	
		$(this).parents('tr').remove();
	 });
	// end

	// User New Form: Add and Remove Tags
	$("#bug").on("click", "#add_tag" ,function() {
		$("#tag_list").append("<div><input type='text' name='tags[new][]' /><a id='delete' class='remove_tag ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></div>").enhanceWithin();
	});

	$("#bug").on("click", "a.remove_tag", function() { 	
		$(this).parent().remove();
	 });
	// end

	// User New Form: Add and Remove Priorities
	$("#bug").on("click", "#add_priority" , function() {
		$("#priority_list").append("<tr><td><input type='text' name='priorities[priority_name][new][]' placeholder='Priority name' /></td><td><input type='number' name='priorities[priority_weight][new][]' placeholder='Priority Weight' /></td><td><input class='priority-color' type='color' name='priorities[priority_color][new][]' value='#ff0000' /></td><td><a id='delete' class='remove_priority ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></td></tr>").enhanceWithin();
	});

	$("#bug").on("click", "a.remove_priority", function() { 	
		$(this).parents('tr').remove();
	 });
	//end

	// User New Form: Add and Remove Status
	$("#bug").on("click", "#add_status", function() {
		$("#status_list").append("<div><input type='text' name='status[new][]' /><a id='delete' class='remove_status  ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></div>").enhanceWithin();
	});

	$("#bug").on("click", "a.remove_status", function() { 	
		$(this).parent().remove();
	 });
	// end	

	$(".new_bug").on("click", function(){
		var url = $(this).data("url");

		if($("#project-settings").length){
			$("#project-settings").remove();
		}

		$.ajax({
			type: "GET",
			url: url,
			success: function(msg){
				$("#bug").append(msg).enhanceWithin();
			}
		});
	});

	$(".bug_status").on("click", function(){
		var status_param = $(this).data("status");
		var project_param = $(this).data("project");
		var user_param = $(this).data("user");

		if($("#project-settings").length){
			$("#project-settings").remove();
		}

		$.ajax({
			type: "GET",
			url: '/bug/ajax_index/' + project_param + '/' + user_param + '/' + status_param,
			success: function(msg){
				$("#bug").append(msg).enhanceWithin();
				$('.ui-filterable').prependTo('#bug-menu');

			}
		});
	});

	$("#edit").on("click", function(){
		$("#action").empty();
		$(".ui-state-disabled").removeClass("ui-state-disabled");
		$(".disabled").prop("disabled", false);
		$("#action").append("<a href='#' id='cancel'> Cancel </a>");
	});

	$("#action").on("click", "#cancel", function() {
		location.reload();
	});

	$(".edit-project").on("click", function(event, ui){
		var project_param = $(this).data("project");

		/*
		if($("#project-settings").length){
			$("#project-settings").remove();
		}

		$.ajax({
			type: "GET",
			url: '/project/edit/' + project_param,
			success: function(msg){
				$("#bug").append(msg).enhanceWithin();
			}
		});
		*/
		window.location.replace("/project/edit/" + project_param);

		return false;
	});

	/****************** Algo inside are used for sorting the bugs ******************/

	// Refer to FS.1 below for the functions being called inside thise algorithm.

	var asc = true;


	$('#bug').on('click', '#custom-sort',function(){
		$("#sort-list").remove();
		sortElementCustom();
	});

	$('#bug').on('click', '#alphabetical-sort', function(){
		$('#sort-list').sortable({disabled: true});
		if(asc)
			sortElementAsc();
		else
			sortElementDesc();
		asc = !asc;
	});

	$('#bug').on('click', '#priority-sort', function(){
		$('#sort-list').sortable({disabled: true});
		sortElementPriority();
	});

	/*******************************************************************************/

});


/****** Called functions from JQUERY ready function ***********/

// FS.1 start

function saveNewPosition(){
	var positions = [];

	$('.updated').each(function(){
		positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
		$(this).removeClass('updated');
	});

	$.ajax({
		url: '/bug/ajax_update_position',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			positions: positions
		},
		success: function(response){
			console.log(response);
		}
	});
}

function sortElementAsc(){
	var $list = $("#sort-list");

	$list.children().detach().sort(function(a, b) {
	return $(a).text().localeCompare($(b).text());
	}).appendTo($list);
}

function sortElementDesc(){
	var $list = $("#sort-list");

	$list.children().detach().sort(function(a, b) {
	return $(b).text().localeCompare($(a).text());
	}).appendTo($list);
}

function sortElementPriority(){
	var $list = $("#sort-list");

	/*
	$list.children().detach().sort(function(a, b) {
	return ($(b).data('priority')) < ($(a).data('priority')) ? 1 : -1;
	}).appendTo($list);
	*/

	$list.children().detach().sort(function(a, b) {
		if(($(b).data('priority')) < ($(a).data('priority'))){
			return 1;
		}
		else if(($(b).data('priority')) == ($(a).data('priority'))){
			return $(a).text().localeCompare($(b).text());
		}
		else
			return -1;
	//return ($(b).data('priority')) < ($(a).data('priority')) ? 1 : -1;
	}).appendTo($list);
}

function sortElementCustom(){
	var project_id = $("#bug-info").data("project");
	var user_id = $("#bug-info").data("user");
	var status_id = $("#bug-info").data("status");

	$.ajax({
			url: '/bug/ajax_custom_sort',
			method: "GET",
			dataType: 'text',
			data: {
				project_id: project_id,
				user_id: user_id,
				status_id: status_id
			},
			success: function(msg){
				$("#bug-list").append(msg).enhanceWithin();

				$('#sort-list').sortable({
				update: function(event, ui){
							$(this).children().each(function(index){ // 'this' pertains to tbody because it has the class ui-sortable
								if($(this).attr('data-position') !=  (index+1)){
									$(this).attr('data-position', (index+1)).addClass('updated');
								}
							});

							saveNewPosition();
						}
				});

				$('.ui-filterable').prependTo('#bug-menu');
			}
		});
}

// FS.1 end