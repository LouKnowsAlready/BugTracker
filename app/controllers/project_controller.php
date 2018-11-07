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

	public function edit($project_id){
		include '../app/views/Project/edit.php';
	}

	public function create(){
	
		if(isset($_POST['project'])){
			$Project_obj = $this->get_model($this->model_name);
			$id = $Project_obj->create($_POST['project'], 'projects');

			if(isset($_POST['users']['new'])){
				$ProjectUser_obj = $this->get_model('ProjectUser');
				$users = $_POST['users']['new'];
				$roles = $_POST['roles']['new'];

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

	public function update(){
		$this->update_users($_POST);
		$this->render_view($this->layout, $this->view_name,'index');
	}

	private function update_users($data){
		$ProjectUser_obj = $this->get_model('ProjectUser');
		$users = $data['users'];
		unset($users['new']); // do not include newly inserted users
		$roles = $data['roles'];
		$project = $data['project_id'];

		// get current records
		$filter = "project_id = {$project}";
		$proj_users_records = ProjectUser::get_records('project_users','id',$filter);

		// get updated records
		foreach($users as $index => $user){
   			$role = $roles[$index];
   			$proj_user = array("id"=>$index, "project_id"=>$project, "user_id"=>$user, "role_id"=>$role);
   			$filter = "id = {$index}";
   			$ProjectUser_obj->update($proj_user, 'project_users', $filter);
		}

		// get  newly inserted users
		if(isset($data['users']['new'])){
			$new_users = $data['users']['new'];
			$new_roles = $data['roles']['new'];
			foreach($new_users as $index => $user){
				$role = $new_roles[$index];
				$proj_user = array("project_id"=>$project, "user_id"=> $user, "role_id"=> $role);
				$ProjectUser_obj->create($proj_user, 'project_users');
			}
		}

		// get deleted users
		$del_users = $this->get_deleted_records($proj_users_records, $users);
		$filter = "id IN(" . implode(',',$del_users) . ')';
		$ProjectUser_obj->delete('project_users', $filter);
	}
	
}