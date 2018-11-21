<!DOCTYPE html>
<html>
	<head>
		<title>Bug Tracker</title>

		<link rel="stylesheet" href="/css/jquery.mobile-1.4.5.min.css" />
		<link rel="stylesheet" href= '/css/style.css' /> 
		
		<script src="/js/jquery-1.11.1.min.js"></script>
		<script src="/js/jquery-ui.min.js"></script>
		<script src="/js/jquery.mobile-1.4.5.min.js"></script>
		<script src="/js/main.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">


	</head>
	<body>
		<section data-role="page">
			<div class="main-container">
				<div class="ui-grid-a" >
					<div class="ui-block-a left-content">
					<!-- Insert code here -->
						<div data-role="collapsibleset" class="side-bar">
							<?php include('_main_project_list.php'); ?>
							<div class="project-block">
							    <a href="/project/new" rel="external" class="ui-btn">New Project</a>
							</div>    					    		    
						</div>
					<!-- End of block -->						
					</div>
					<!-- Tab navbar  -->
					<div class="ui-block-b right-content">
						<div class="top-nav">
							<a href="#bug" class="active ui-btn ui-btn-inline ui-btn-icon-left ui-icon-bug"> Bugs </a>
							<a href="#checklister" class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-checklister"> Checklister </a>
						</div>
						<!-- Tab contents  -->
						<div class="tab-container">
							<div id="bug" class="tab-content">
								<?php include(dirname(__DIR__) .'/'. $view_name . '/' . $method_name . '.php') ?>
							</div>
							<div id="checklister" class="tab-content" style="display: none;">
								test 2
							</div>
						</div>
						<!-- Tab contents end  -->
					</div>
					<!-- Tab navbar end  -->
				</div>
			</div>
		</section>
	</body>
</html>