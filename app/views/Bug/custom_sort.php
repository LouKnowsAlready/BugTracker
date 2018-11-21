<?php
	$bugs = Bug::custom_sort_bugs($data['project_id'], $data['user_id'], $data['status_id']);

	echo '<ul id="sort-list" data-role="listview" data-filter="true" data-filter-placeholder="Search bugs..." data-inset="true">';
	foreach($bugs as $bug){
		echo "<li data-index='{$bug['id']}' data-position='{$bug['position']}' data-priority='{$bug['priority_weight']}'><a rel='external' href='/bug/show/{$data['project_id']}/{$data['user_id']}/{$bug['id']}'>{$bug['bug_name']}</a></li>";
	}
	echo '</ul>';
?>