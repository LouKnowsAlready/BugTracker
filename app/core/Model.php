<?php

class Model{

	public function create($data, $table){
		//include 'dbconnect.php';
		$db = new DbConnect();
		$conn = $db->connect();

		$keys = $this->get_keys($data);
		$values = $this->get_values($data);
		$sql = "INSERT INTO " . $table . " (". $keys . ") VALUES (". $values .")";
		if(isset($conn)){
			mysqli_query($conn, $sql);
			$last_id = mysqli_insert_id($conn);
			mysqli_close($conn);
		}

		return $last_id;

	}

	public function update($data, $table, $filter){
		//include 'dbconnect.php';
		$db = new DbConnect();
		$conn = $db->connect();

		$sql = "UPDATE {$table} SET ";
		foreach($data as $key => $value){
			$sql = $sql . "{$key} = '{$value}', ";
		}
		$sql = rtrim($sql,', ');
		$sql = $sql . " WHERE {$filter}"; 
		$sql = preg_replace("/'(\d+)'/", '$1', $sql);

		if(isset($conn)){
			mysqli_query($conn, $sql);
			mysqli_close($conn);
		}
	}




################## CLASS METHODS ############################

	private function get_keys($data){
		return implode(',', array_keys($data));
	}

	private function get_values($data){
		$data = implode("','", array_values($data));
		$data = str_replace($data, "'".$data."'", $data);
		$data = preg_replace("/'(\d+)'/", '$1', $data);

		return $data;
	}	

}