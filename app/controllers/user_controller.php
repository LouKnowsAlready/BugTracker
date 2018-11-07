<?php 

class UserController extends Controller{
	private $model_name = 'User';
	private $view_name = 'User';
	private $layout = 'main';

	public function __construct(){}

	public function ajax_get_users_roles(){
		include dirname(__DIR__) . "/models/User.php";
		include dirname(__DIR__) . "/models/Role.php";

		$users = User::get_all_users();
		$user_select = "<select name='users[new][]'>";
		foreach($users as $user){
			$user_select = $user_select . "<option value='" . $user['id'] . "'>" . $user['name'] .'</option>';
		}
		$user_select = $user_select . '</select>';

		$roles = Role::get_all_roles();
		$role_select = "<select name='roles[new][]'>";
		foreach($roles as $role){
			$role_select = $role_select . "<option value='" . $role['id'] . "'>" . $role['role_name'] . '</option>';
		}
		$role_select = $role_select . '</select>';
		$role_select = $role_select . '<a class="remove_user" href="#">Remove</a>';

		echo '<div>' . $user_select . $role_select . '</div>';
	}
}