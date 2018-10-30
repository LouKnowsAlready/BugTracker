<?php
	$bugs = Bug::get_users_bug_per_status($data['project_id'], $data['user_id'], $data['status_id']);
?>

<div id="project-settings">
<ul data-role="listview" data-filter="true" data-filter-placeholder="Search bugs..." data-inset="true">
    <?php
    	foreach($bugs as $bug){
    		echo "<li><a href='#'>{$bug['bug_name']}</a></li>";
    	}
   	?>
</ul>
</div>