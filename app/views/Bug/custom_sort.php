<?php
	$bugs = Bug::custom_sort_bugs($data['project_id'], $data['user_id'], $data['status_id']);

	echo '<ul id="sort-list" data-role="listview" data-split-icon="three-dots" data-filter="true" data-filter-placeholder="Search bugs..." data-inset="true">';
	foreach($bugs as $bug){
		echo '
				<li class="bug-check-container" data-index="' . $bug['id'] . '" data-position="' . $bug['position'] . '" data-priority="' . $bug['priority_weight'] . '" data-icon="false">
					<a href="#">
						<img src="/Icons/uncheck.png" data-id="' . $bug['id'] . '" class="uncheck ui-li-icon ui-corner-none">
						<h2 class="bug-label">' . $bug['bug_name'] . '</h2>
						<span class="bug-priority-color" style="background-color: ' . $bug['priority_color'] . ';">&nbsp;</span>
						</a>
					<a rel="external" href="/bug/show/' . $data['project_id'] . '/' . $data['user_id'] . '/' . $bug['id'] . '">&nbsp;</a>
				</li>
			 ';
	}
	echo '</ul>';
?>