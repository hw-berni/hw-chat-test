<?php


class Baza extends mysqli
{
	
	public static $db;
	
	public function __construct($host, $username, $password, $db)
	{
		parent::__construct($host, $username, $password, $db);
		if ($this->connect_errno) {
			printf("Connect failed: %s\n", $db->connect_error);
			exit();
		}
		self::$db = $this;
	}
	
	public function query($sql)
	{
		$r = parent::query($sql);
		if (!$r) {
			echo $this->error;
		}
		return $r;
	}
	
}
