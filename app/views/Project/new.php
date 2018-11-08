<div id="project-settings">
	<form action="/project/create" method="POST" data-ajax="false">
		<label>Project Name</label>
		<input type="text" data-clear-btn="true" name="project[project_name]" />
		<hr>
		<label> Project Settings </label>
		<label> Users </label>
		<div id="user_list"></div>
		<input type="button" id="add_user" data-inline="true" value="Add User">
		<label> Tags </label>
		<div id="tag_list"></div>
		<input type="button" id="add_tag" data-inline="true" value="Add Tag">
		<label>Priorities</label>
		<div id="priority_list"></div>
		<input type="button" id="add_priority" data-inline="true" value="Add Priority">
		<label>Status</label>
		<div id="status_list"></div>
		<input type="button" id="add_status" data-inline="true" value="Add Status">
		<input type="submit" name="submit" value="submit" />
	</form>
	<?php
		// /project/create
		if(isset($_POST['tags']['new'])){
			print_r($_POST['tags']['new']);
		}
	?>
</div>