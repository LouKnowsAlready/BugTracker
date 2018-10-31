$(document).ready(function() {  
	
	// User New Form: Add and Remove Users
	$("#add_user").on("click", function() { 	
		$.ajax({
			type: "GET",
			url: "/user/ajax_get_users_roles",
			success: function(msg){
				$("#user_list").append(msg).enhanceWithin();
			}
		});	
	 });

	$("#user_list").on("click", "a.remove_user", function() { 	
		$(this).parent().remove();
	 });
	// end

	// User New Form: Add and Remove Tags
	$("#add_tag").on("click", function() {
		$("#tag_list").append("<div><input type='text' name='tags[]' /><a class='remove_tag' href='#'>Remove</a></div>").enhanceWithin();
	});

	$("#tag_list").on("click", "a.remove_tag", function() { 	
		$(this).parent().remove();
	 });
	// end

	// User New Form: Add and Remove Priorities
	$("#add_priority").on("click", function() {
		$("#priority_list").append("<div><label>Priority Name: </label><input type='text' name='priorities[priority_name][]' /><label>Priority Weight:</label><input type='number' name='priorities[priority_weight][]' /><a class='remove_priority' href='#'>Remove</a></div>").enhanceWithin();
	});

	$("#priority_list").on("click", "a.remove_priority", function() { 	
		$(this).parent().remove();
	 });
	//end

	// User New Form: Add and Remove Status
	$("#add_status").on("click", function() {
		$("#status_list").append("<div><input type='text' name='status[]' /><a class='remove_status' href='#'>Remove</a></div>").enhanceWithin();
	});

	$("#status_list").on("click", "a.remove_status", function() { 	
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
			}
		});
	});

	$(".back").on("click", function(){
		window.history.back();
	});
	
});
