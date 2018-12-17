<?php

class Login extends Model{

	public function check_availability($username){
		$db = new DbConnect();
		$conn = $db->connect();

		$available = 1;

		$sql = "SELECT 1 FROM users WHERE user_name = '{$username}'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result))
			$available = 0;

		mysqli_free_result($result);

		mysqli_close($conn);
		return $available;		
	}

	public function verify_user($user_name, $password){
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "SELECT id FROM users WHERE user_name = '{$user_name}' AND password = '{$password}'";
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);
		return $data;		
	}
}