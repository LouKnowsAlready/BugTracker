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
		<input type="text" data-clear-btn="true" name="project[project_name]" <?php echo "value='{$project->project_name}'" ?> />
		<a <?php echo "href='/project/delete/{$project_id}'"; ?> rel="external"> Delete </a>
		<hr>
		<label> Project Settings </label>
		<label> Users </label>
		<div id="user_list">
			<?php
				foreach($project_users as $user){
					$proj_user_id = $user['pid'];
					echo "<div>";
					echo "<input type='hidden' name='users[{$proj_user_id}]' value='{$user['id']}' />";
					echo "<select name='users[{$proj_user_id}]' disabled><option value='{$user['id']}'> {$user['name']} </option></select>";
					echo "<select name='roles[{$proj_user_id}]'>";
					foreach($roles as $role){
						$selected = selected($role['id'], $user['role_id']);
						echo "<option value='{$role['id']}' {$selected}> {$role['role_name']} </option>";
					}
					echo "</select>";
					echo '<a class="remove_user" href="#">Remove</a>';
					echo "</div>";
				}
			?>
		</div>
		<input type="button" id="add_user" data-inline="true" value="Add User">
		<label> Tags </label>
		<div id="tag_list">
			<?php
				foreach($tags as $tag){
					echo "<div><input type='text' name='tags[{$tag['id']}]' value='{$tag['tag_name']}' /><a class='remove_tag' href='#'>Remove</a></div>";
				}
			?>			
		</div>
		<input type="button" id="add_tag" data-inline="true" value="Add Tag">
		<label>Priorities</label>
		<div id="priority_list">
			<?php
				foreach($priorities as $priority){
					echo "<div><label>Priority Name: </label><input type='text' name='priorities[priority_name][{$priority['id']}]' value='{$priority['priority_name']}' /><label>Priority Weight:</label><input type='number' name='priorities[priority_weight][{$priority['id']}]' value='{$priority['priority_weight']}' /><a class='remove_priority' href='#'>Remove</a></div>";
				}
			?>				
		</div>
		<input type="button" id="add_priority" data-inline="true" value="Add Priority">
		<label>Status</label>
		<div id="status_list">
			<?php
				foreach($status as $stat){
					echo "<div><input type='text' name='status[{$stat['id']}]' value='{$stat['status_name']}' /><a class='remove_status' href='#'>Remove</a></div>";
				}
			?>			
		</div>
		<input type="button" id="add_status" data-inline="true" value="Add Status">
		<input type="submit" name="submit" value="submit" />
	</form>
</div>