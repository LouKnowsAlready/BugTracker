<?php
	$bugs = Bug::get_users_bug_per_status($data['project_id'], $data['user_id'], $data['status_id']);
	$user = User::get_user_details($data['user_id']);
	$status = Status::get_status_details($data['status_id']);
?>

<div id="project-settings">
	<h4><?php echo $user['name']; ?></h4>
	<h5><?php echo $status['status_name']; ?></h5>
	<input type="hidden" id="bug-info" data-user="<?php echo $data['user_id']; ?>" data-status="<?php echo $data['status_id']; ?>" data-project="<?php echo $data['project_id']; ?>" />
	<hr>
	<div id="bug-list">
		<input type="button" id="alphabetical-sort" value="Sort by Name" />
		<input type="button" id="priority-sort" value="Sort by Priority" />
		<input type="button" id="custom-sort" value="Custom Sort" />
		<ul id="sort-list" data-role="listview" data-filter="true" data-filter-placeholder="Search bugs..." data-inset="true">
		    <?php
		    	foreach($bugs as $bug){
		    		echo "<li data-index='{$bug['id']}' data-position='{$bug['position']}' data-priority='{$bug['priority_weight']}'><a rel='external' href='/bug/show/{$data['project_id']}/{$data['user_id']}/{$bug['id']}'>{$bug['bug_name']}</a></li>";
		    	}
		   	?>
		</ul>
	</div>
</div>