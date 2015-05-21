<?php

require_once '/etc/chat/db_config.php';
require_once 'baza.php';

new Baza($dbCfg['host'], $dbCfg['username'], 
	$dbCfg['password'], $dbCfg['db']);
