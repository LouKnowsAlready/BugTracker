<div id="project-settings">
	<form action="/project/create" method="POST" data-ajax="false">
		<label>Project Name</label>
		<input type="text" data-clear-btn="true" name="project[project_name]" value="Project1" />
		<hr>
		<label> Project Settings </label>
		<div id='project-settings-panel'>
			<div id="user-panel" data-role="collapsible" data-collapsed="false">
				<h3> Users </h3>
				<small>List of users that can be selected within the project and their corresponding permissions.</small>
				<div>
					<table id="user_list">
					</table>
				</div>
				<input type="button" id="add_user" data-inline="true" value="Add User">
			</div>
			<div id="tag-panel" data-role="collapsible" data-collapsed="false">
				<h3> Tags </h3>
				<small>List of tags that can be use within the project.</small>
				<div id="tag_list"></div>
				<input type="button" id="add_tag" data-inline="true" value="Add Tag">
			</div>
			<div id="priority-panel" data-role="collapsible" data-collapsed="false">
				<h3>Priorities</h3>
				<small>List of priorities that can be use within the project.</small>
				<div>
					<table id="priority_list">
						<?php
							$critical = ['pname'=>'Critical','pweight'=>1,'pcolor'=>'#ff0000'];
							$high = ['pname'=>'High','pweight'=>2,'pcolor'=>'#ff6600'];
							$medium = ['pname'=>'Medium','pweight'=>3,'pcolor'=>'#ffff00'];
							$low = ['pname'=>'Low','pweight'=>4,'pcolor'=>'#008000'];
							$priorities = [];
							array_push($priorities,$critical,$high,$medium,$low);

							foreach ($priorities as $priority) {
								echo '
								<tr>
									<td>
										<input type="text" name="priorities[priority_name][new][]" value="' . $priority['pname'] . '" />
									</td>
									<td>
										<input type="number" name="priorities[priority_weight][new][]" value="' . $priority['pweight'] . '" />
									</td>
									<td>
										<input class="priority-color" type="color" name="priorities[priority_color][new][]" value="' . $priority['pcolor'] . '" />
									</td>
									<td>
										<a id="delete" class="remove_priority ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext" href="#">Remove</a>
									</td>
								</tr> ';
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
					<div>
						<input type='text' name='status[new][]' value="Not Started" /><a id='delete' class='remove_status  ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a>
					</div>
					<div>
						<input type='text' name='status[new][]' value="In Progress" /><a id='delete' class='remove_status  ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a>
					</div>
					<div>
						<input type='text' name='status[new][]' value="Completed" /><a id='delete' class='remove_status  ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' href='#'>Remove</a>
					</div>										
				</div>
				<input type="button" id="add_status" data-inline="true" value="Add Status">
			</div>
		</div>
		<input type="submit" name="submit" value="Submit" />
	</form>
</div>
