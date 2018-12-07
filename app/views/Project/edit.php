<?php
	if(isset($data))
		$project_id = $data;
	$project = new Project($project_id);
	$project_users = ProjectUser::get_project_users($project_id);
	$roles = Role::get_all_roles();
	$tags = Tag::get_project_tags($project_id);
	$priorities = Priority::get_project_priorities($project_id);
	$status = Status::get_project_status($project_id);

	function selected($item1, $item2){
		return $item1 == $item2 ? "selected='selected'" : "";
	}
?>

<div id="project-settings">
	<form action="/project/update" method="POST" data-ajax="false">
		<label>Project Name</label>
		<input type="hidden" name="project_id" value="<?php echo $project_id ?>" />
		<div id="project-name-container">
			<input type="text" data-clear-btn="true" name="project[project_name]" <?php echo "value='{$project->project_name}'" ?> />
			<a id="del-project" href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop"> Delete Project </a>

			<!-- remove this comment once you know how to use the poup diaglog
			<a id="del-project" <?php //echo "href='/project/delete/{$project_id}'"; ?> rel="external"> Delete Project </a>
			-->
			
			<!-- DELETE Project popup message  -->
			<div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
		        <div data-role="header" data-theme="a">
				    <h1>Delete Project?</h1>
				</div>
			    <div role="main" class="ui-content">
			        <h3 class="ui-title">Are you sure you want to delete this project?</h3>
			        <p>This action cannot be undone.</p>
			        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
			        <a <?php echo "href='/project/delete/{$project_id}'"; ?> class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" rel="external">Delete</a>
		        </div>
			</div>
			<!-- end -->

		</div>
		<hr>
		<label> Project Settings </label>
		<div id='project-settings-panel'>
			<div id="user-panel" data-role="collapsible" data-collapsed="false">
				<h3> Users </h3>
				<small>List of users that can be selected within the project and their corresponding permissions.</small>
				<div>
					<table id="user_list">
						<?php
							foreach($project_users as $user){
								$proj_user_id = $user['pid'];
								echo "<tr>";
								echo "<td><input type='hidden' name='users[{$proj_user_id}]' value='{$user['id']}' />";
								echo "<select name='users[{$proj_user_id}]' disabled><option value='{$user['id']}'> {$user['name']} </option></select></td>";
								echo "<td><select name='roles[{$proj_user_id}]'>";
								foreach($roles as $role){
									$selected = selected($role['id'], $user['role_id']);
									echo "<option value='{$role['id']}' {$selected}> {$role['role_name']} </option>";
								}
								echo "</select></td>";
								echo '<td><a id="delete" class="remove_user ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext" href="#">Remove</a></td>';
								echo "</tr>";
							}
						?>
					</table>
				</div>
				<input type="button" id="add_user" data-inline="true" value="Add User">
			</div>


			<div id="tag-panel" data-role="collapsible" data-collapsed="false">
				<h3> Tags </h3>
				<small>List of tags that can be use within the project.</small>
				<div id="tag_list">
					<?php
						foreach($tags as $tag){
							echo "<div><input type='text' name='tags[{$tag['id']}]' value='{$tag['tag_name']}' /><a id='delete' class='remove_tag ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></div>";
						}
					?>			
				</div>
				<input type="button" id="add_tag" data-inline="true" value="Add Tag">
			</div>


			<div id="priority-panel" data-role="collapsible" data-collapsed="false">
				<h3>Priorities</h3>
				<small>List of priorities that can be use within the project.</small>
				<div>
					<table id="priority_list">
						<?php
							foreach($priorities as $priority){
								echo "<tr><td><input type='text' name='priorities[priority_name][{$priority['id']}]' value='{$priority['priority_name']}' /></td><td><input type='number' name='priorities[priority_weight][{$priority['id']}]' value='{$priority['priority_weight']}' /></td><td><input class='priority-color' type='color' name='priorities[priority_color][{$priority['id']}]' value='{$priority['priority_color']}' /></td><td><a id='delete' class='remove_priority ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></td></tr>";
							}
						?>
					</table>
				</div>	
				<input type="button" id="add_priority" data-inline="true" value="Add Priority">		
			</div>



			<div data-role="collapsible" data-collapsed="false">
				<h3>Status</h3>
				<small>List of status that can be used within the project.</small>
				<div id="status_list">
					<?php
						foreach($status as $stat){
							echo "<div><input type='text' name='status[{$stat['id']}]' value='{$stat['status_name']}' /><a id='delete' class='remove_status  ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a></div>";
						}
					?>			
				</div>
				<input type="button" id="add_status" data-inline="true" value="Add Status">
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" />
	</form>
</div>