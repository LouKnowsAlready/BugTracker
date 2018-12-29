<?php

class LoginController extends Controller{
	private $view_name = 'Login';

	public function index(){
		$this->render_view('',$this->view_name,'index');
	}

	public function register(){
		session_start();

		if(isset($_POST['register'])){
			$login_obj = $this->get_model('Login');
			$new_user = $_POST['user'];
			if($this->check_user_availability($new_user['user_name'])){		
				$user_id = $login_obj->create($new_user,'users');
				$_SESSION['uid'] = $user_id;
				header('Location: /');
			}else{
				header('Location: /login?error=Username\'s already taken');
			}
		}
	}

	public function start_session(){
		session_start();

		$user_name = $_POST['uid'];
		$password = $_POST['pwd'];

		$Login_obj = $this->get_model('Login');
		$uid = $Login_obj->verify_user($user_name, $password);

		if($uid['id']){
			$_SESSION['uid'] = $uid['id'];
			header('Location: /');
		}else{
			header('Location: /login?error=No user found');
		}
	}

	public function destroy_session(){
		session_start();
		session_unset();
		session_destroy();
		header('Location: /');
	}

	private function check_user_availability($username){
		$login_obj = $this->get_model('Login');

		return $login_obj->check_availability($username);		
	}

}