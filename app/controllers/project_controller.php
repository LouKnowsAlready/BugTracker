<?php 

class ProjectController extends Controller{
	private $model_name = 'Project';
	private $view_name = 'Project';
	private $layout = 'main';

	public function __construct(){}

	public function index(){		
		$this->render_view($this->layout, $this->view_name,'index');
	}

	public function new(){
		$this->render_view($this->layout, $this->view_name,'new');
	}

	public function create(){
	
		if(isset($_POST['project'])){
			$Project_obj = $this->get_model($this->model_name);
			$id = $Project_obj->create($_POST['project'], 'projects');

			if(isset($_POST['users'])){
				$ProjectUser_obj = $this->get_model('ProjectUser');
				$users = $_POST['users'];
				$roles = $_POST['roles'];

				foreach($users as $index => $user){
					$ProjectUser_obj->create(array('project_id' => $id, 'user_id' => $user, 'role_id' => $roles[$index]), 'project_users');
				}
			}

			if(isset($_POST['tags'])){
				$ProjectTag_obj = $this->get_model('Tag');
				$tags = $_POST['tags'];

				foreach($tags as $tag){
					$ProjectTag_obj->create(array('project_id' => $id, 'tag_name' => $tag), 'tags');
				}
			}

			if(isset($_POST['priorities'])){
				$ProjectPriority_obj = $this->get_model('Priority');
				$priorities = $_POST['priorities'];
				$priority_name = $priorities['priority_name'];
				$priority_weight = $priorities['priority_weight'];
				$priority_size = count($priority_name);


				for($index = 0; $index < $priority_size; $index++){
					$ProjectPriority_obj->create(array('project_id' => $id, 'priority_name' => $priority_name[$index], 'priority_weight' => $priority_weight[$index]), 'priorities');
				}
			}

			if(isset($_POST['status'])){
				$ProjectStatus_obj = $this->get_model('Status');
				$status = $_POST['status'];

				foreach($status as $stat){
					$ProjectTag_obj->create(array('project_id' => $id, 'status_name' => $stat), 'bug_status');
				}
			}			
		}

		//$this->render_view($this->layout, $this->view_name,'create');
		header('Location: /');
	}

}