<?php

$project = new Project($data['project_id']);
$users = ProjectUser::get_project_users($project->id);
$priorities = Priority::get_project_priorities($project->id);
$status = Status::get_project_status($project->id);

$bug = new Bug($data['bug_id']);

function selected($item1, $item2){
	return $item1 == $item2 ? "selected='selected'" : "";
}

?>


<div id="project-settings">
<div id="action">
	<a rel="external" href="<?php echo "/bug/index/{$bug->project_id}/$bug->assigned_to/$bug->status_id"; ?>"> Back </a> |
	<a href="#" id="edit"> Edit </a>
</div>
<h3> Project Name: <?php echo $project->project_name ?> </h3>
<hr>
	<form action="/bug/update/<?php echo "$bug->project_id/$bug->assigned_to/$bug->id" ?>" method="POST" data-ajax="false">
		<div>
			<input type="hidden" name="bug[project_id]" value="<?php echo $project->id ?>" class="disabled" disabled />
		</div>
		<div>
			<label>Issue Name</label>
			<input type="text" data-clear-btn="true" name="bug[bug_name]" value="<?php echo $bug->bug_name ?>" class="disabled" disabled />
		</div>
		<div>
			<label>Details</label>
			<textarea name="bug[details]" class="disabled" disabled> <?php echo $bug->details ?> </textarea>
		</div>		
		<div>
			<label> Assigned To </label>
			<select name="bug[assigned_to]" class="disabled" disabled>
				<?php 
					foreach($users as $user){
						$selected_option = selected($user['id'],$bug->assigned_to);
						echo "<option value='{$user['id']}' {$selected_option} > {$user['first_name']} </option>";
					}
				?>
			</select>
		</div>
		<div>
			<label> Priority </label>
			<select name="bug[priority_id]" class="disabled" disabled>
				<?php 
					foreach($priorities as $priority){
						$selected_option = selected($priority['id'],$bug->priority_id);
						echo "<option value='{$priority['id']}' {$selected_option} > {$priority['priority_name']} </option>";
					}
				?>
			</select>
		</div>
		<div>
			<label> Status </label>
			<select name="bug[status_id]" class="disabled" disabled>
				<?php 
					foreach($status as $stat){
						$selected_option = selected($stat['id'],$bug->status_id);
						echo "<option value='{$stat['id']}' {$selected_option} > {$stat['status_name']} </option>";
					}
				?>
			</select>
		</div>		
		<div>
			<input type="submit" name="submit" value="submit" class="disabled" disabled />
		</div>
	</form>
</div>