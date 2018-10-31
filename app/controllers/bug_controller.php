<?php

class BugController extends Controller{
	private $model_name = 'Bug';
	private $view_name = 'Bug';
	private $layout = 'main';
	private $model_obj;

	public function __construct(){
		//$this->model_obj = $this->get_model($this->model_name);
	}

	public function index($project_id = 0, $user_id = 0, $status_id = 0){
		$data['project_id'] = $project_id;
		$data['user_id'] = $user_id;
		$data['status_id'] = $status_id;
		$this->render_view($this->layout, $this->view_name,'index', $data);
	}

	public function ajax_index($project_id = 0, $user_id = 0, $status_id = 0){
		$data['project_id'] = $project_id;
		$data['user_id'] = $user_id;
		$data['status_id'] = $status_id;		
		include '../app/views/Bug/index.php';
	}

	public function show($project_id = 0, $user_id = 0, $bug_id = 0){
		$data = array("project_id" => $project_id, "user_id" => $user_id, "bug_id" => $bug_id);

		$this->render_view($this->layout, $this->view_name,'show', $data);
	}

	public function new($project_id){
		$data['project_id'] = $project_id;

		$this->render_view($this->layout, $this->view_name, 'new', $data);
	}

	public function create(){
		$id = 0;
		$data['status_id'] = $_POST['bug']['status_id'];
		$data['project_id'] = $_POST['bug']['project_id'];
		$data['user_id'] = $_POST['bug']['assigned_to'];
		if(isset($_POST['bug'])){
			$Bug_obj = $this->get_model($this->model_name);
			$Bug_obj->create($_POST['bug'], 'bugs');
		}

		//$this->render_view($this->layout, $this->view_name, 'show', $data);
		header("Location: /bug/index/{$data['project_id']}/{$data['user_id']}/{$data['status_id']}");
	}

	public function ajax_new($project_id){
		$data['project_id'] = $project_id;
		
		include '../app/views/Bug/new.php';
	}

}