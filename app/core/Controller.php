<?php

class Controller{
	
	public function get_model($model){
		//require_once '../app/models/'. $model . '.php';

		return new $model();
	}

	public function render_view($layout, $view_name, $method_name, $data = []){
		// $view_name, $method_name, and $data will be available on the layout
		include '../app/views/layout/'. $layout . '.php';
	}

}