<?php

class ApiController
{
	public function __construct()
	{
		include 'db.php';
	}
	
	/**
	 * @param String $action
	 * @param Object $data
	 * @param String $auth
	 */ 
	public function handle($action, Data $data, $auth)
	{
		switch($action) {
			case 'login':
				return $this->onLogin($data);
				break;
			case 'logout':
				
				break;
			default:
				throw new Exception("Nepostojeca metoda!");
				break;
		}
	}
	
	private function generateResult($ok, $data, $error = NULL)
	{
		$r = new Result();
		$r->ok = $ok;
		$r->data = $data;
		$r->error = $error;
		
		return $r;
	}
	
	private function onLogin($data)
	{
		include 'controller/user_controller.php';
		include 'model/user.php';
		$user = new User();
		$user->username = $data->username;
		$user->password = $data->password;
		$uc = new UserController();
		$result = $uc->login($user);
		
		if ($result) {
			$r = $this->generateResult(TRUE, $result);
		} else {
			$r = $this->generateResult(FALSE, NULL, 'Invalid login data');
		}
		
		return $r;
	}
}
