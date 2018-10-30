<?php

class DbConnect{

public $server_name = "localhost";
public $username = "root";
public $password = "";
public $db_name = "bugtracker";


public function connect(){
	$conn = mysqli_connect($this->server_name, $this->username, $this->password, $this->db_name);
	return $conn;
}


}
