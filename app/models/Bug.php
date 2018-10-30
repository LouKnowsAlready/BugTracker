<?php

class Bug extends Model{
	public $id;
	public $project_id;
	public $bug_name;
	public $assigned_to;
	public $priority_id;
	public $status_id;
	public $details;

	public function __construct($id = 0,
								$project_id = 0,
								$bug_name = '',
								$assigned_to = 0,
								$priority_id = 0,
								$status_id = 0,
								$details = 0)
	{
		$this->id = $id;
		$this->project_id = $project_id;
		$this->bug_name = $bug_name;
		$this->assigned_to = $assigned_to;
		$this->priority_id = $priority_id;
		$this->status_id = $status_id;
		$this->details = $details;
	}

	public static function get_user_distinct_bug_status($project_id, $user_id){
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT DISTINCT bs.id, bs.status_name FROM bugs b LEFT JOIN bug_status bs on bs.id = b.status_id WHERE b.project_id = " . $project_id . " AND " . "b.assigned_to = " . $user_id;
		
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);

		mysqli_close($conn);
		return $data;
	}

	public static function get_users_bug_per_status($project_id, $user_id, $status_id){
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT id, project_id, bug_name, assigned_to, priority_id, status_id, details FROM bugs WHERE project_id = {$project_id} AND assigned_to = {$user_id} AND status_id = {$status_id}";
		
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);

		mysqli_close($conn);
		return $data;
	}	
}
