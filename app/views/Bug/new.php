<?php

$project = new Project($data['project_id']);
$users = ProjectUser::get_project_users($project->id);
$priorities = Priority::get_project_priorities($project->id);
$status = Status::get_project_status($project->id);

?>


<div id="project-settings">
<h3> Project Name: <?php echo $project->project_name ?> </h3>
<hr>
<h4> New Issue </h4>
	<form action="/bug/create" method="POST" data-ajax="false">
		<div>
			<input type="hidden" name="bug[project_id]" value="<?php echo $project->id ?>" />
		</div>
		<div>
			<label>Issue Name</label>
			<input type="text" data-clear-btn="true" name="bug[bug_name]" />
		</div>
		<div>
			<label>Details</label>
			<textarea name="bug[details]"></textarea>
		</div>		
		<div>
			<label> Assigned To </label>
			<select name="bug[assigned_to]">
				<?php 
					foreach($users as $user)
						echo "<option value='" . $user['id'] . "'>" . $user['first_name'] . "</option>";
				?>
			</select>
		</div>
		<div>
			<label> Priority </label>
			<select name="bug[priority_id]">
				<?php 
					foreach($priorities as $priority)
						echo "<option value='" . $priority['id'] . "'>" . $priority['priority_name'] . "</option>";
				?>
			</select>
		</div>
		<div>
			<label> Status </label>
			<select name="bug[status_id]">
				<?php 
					foreach($status as $stat)
						echo "<option value='" . $stat['id'] . "'>" . $stat['status_name'] . "</option>";
				?>
			</select>
		</div>		
		<div>
			<input type="submit" name="submit" value="submit" style="padding-bottom: 300px;" />
		</div>
	</form>
</div>