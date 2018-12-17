<?php
	$bugs = Bug::get_users_bug_per_status($data['project_id'], $data['user_id'], $data['status_id']);
	$user = User::get_user_details($data['user_id']);
	$status = Status::get_status_details($data['status_id']);
	$completed_status = Status::get_last_status_per_project($data['project_id']);
	$check_icon = 'uncheck.png';
	if($data['status_id'] == $completed_status['id'])
		$check_icon = 'checked.png';
?>

<div id="project-settings">
	<h4><?php echo $user['name']; ?></h4>
	<h5><?php echo $status['status_name']; ?></h5>
	<input type="hidden" id="bug-info" data-user="<?php echo $data['user_id']; ?>" data-status="<?php echo $data['status_id']; ?>" data-status-comp="<?php echo $completed_status['id']; ?>" data-project="<?php echo $data['project_id']; ?>" />
	<hr>
	<div id="bug-list">
		<div id="bug-menu">
			<div id="sort-buttons">
				<label>Sort By:</label>
				<input type="button" id="alphabetical-sort" value="Name" />
				<input type="button" id="priority-sort" value="Priority" />
				<input type="button" id="custom-sort" value="Custom" />
			</div>
		</div>
		<ul id="sort-list" data-role="listview" data-split-icon="three-dots" data-filter="true" data-filter-placeholder="Search bugs..." data-inset="true">
		    <?php
		    	foreach($bugs as $bug){

		    		echo '
		    				<li class="bug-check-container" data-index="' . $bug['id'] . '" data-position="' . $bug['position'] . '" data-priority="' . $bug['priority_weight'] . '" data-icon="false">
		    					<a href="#">
        							<img src="/Icons/' . $check_icon . '" data-id="' . $bug['id'] . '" class="uncheck ui-li-icon ui-corner-none">
    								<h2 class="bug-label">' . $bug['bug_name'] . '</h2>
    								<span class="bug-priority-color" style="background-color: ' . $bug['priority_color'] . ';">&nbsp;</span>
 								</a>
        						<a rel="external" href="/bug/show/' . $data['project_id'] . '/' . $data['user_id'] . '/' . $bug['id'] . '">Click for details</a>
    						</li>
		    			 ';

		    		
		    	}
		   	?>
		</ul>
	</div>
</div>

