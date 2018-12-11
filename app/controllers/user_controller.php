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
		$id = uniqid();


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
		$role_select = $role_select;

		echo '<tr><td>' . $user_select . '</td> <td>' . $role_select . "</td> <td> <a id='{$id}' class='remove ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-notext' data-item='user' data-rel='popup' data-position-to='window' data-transition='pop' href='#popupDialog'>Remove</a> </td> </tr> ";
	}
}