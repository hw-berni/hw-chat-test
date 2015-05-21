<?php

class UserController
{
	
	public function __construct()
	{
		
	}
	
	public function login(User $user)
	{
		$db = Baza::$db;
		$username = $db->real_escape_string($user->username);
		$password = md5($db->real_escape_string($user->password));
		
		$sql = "SELECT * FROM user "
			." WHERE username = '$username' AND password = '$password' ";
		$r = $db->query($sql);
		
		if ($r->num_rows === 0) {
			return FALSE;
		}
		$u = $r->fetch_object();
		return $u->id;
	}
}
