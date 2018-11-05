<?php

class ProjectUser extends Model{

	public static function get_project_users($project_id){
		//include dirname(__DIR__) . '/core/dbconnect.php';
		//include 'User.php';
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT pu.id as pid, u.id, u.first_name, u.last_name, CONCAT(first_name, ' ', last_name) as name, pu.role_id, r.role_name FROM project_users pu LEFT JOIN users u ON u.id = pu.user_id LEFT JOIN roles r on r.id = pu.role_id WHERE project_id = " . $project_id;
		
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);
		mysqli_close($conn);
		
		return $data;		
	}
	
}