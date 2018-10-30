<?php

class User extends Model{
	public $id;
	public $first_name;
	public $last_name;

	public function __construct($id, $first_name, $last_name){
		$this->id = $id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
	}

	public static function get_all_users(){
		//include dirname(__DIR__) . '/core/dbconnect.php';
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT id, CONCAT(first_name, ' ', last_name) as name FROM users";
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		mysqli_free_result($result);

		mysqli_close($conn);
		return $data;
	}

	public static function get_user_details($user_id){
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT id, first_name, last_name, CONCAT(first_name, ' ', last_name) as name FROM users WHERE id = {$user_id}";
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($result);
		mysqli_free_result($result);

		mysqli_close($conn);
		return $data;
	}
}
