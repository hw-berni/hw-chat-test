<?php


include 'controller/api_controller.php';
include 'model/result.php';

// svi ulazni podaci su u POST/REQUEST
// action
// data
// COOKIE(token) identifikacija

$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$data = isset($_POST['data']) ? $_POST['data'] : NULL;
$token = isset($_COOKIE['token']) ? $_COOKIE['token'] : NULL;

if (empty($action)) {
	die("Action is not specified");
}

include 'model/data.php';
$d = new Data();
if (!empty($data)) {
	$obj = json_decode($data, TRUE);

	if (json_last_error() !== JSON_ERROR_NONE) {
		die("Invalid JSON received");
	}
	
	foreach($obj as $key => $val) {
		$d->$key = $val;
	}
}

$api = new ApiController();
try {
	$r = $api->handle($action, $d, $token);
} catch(Exception $e){
	$r = new Result();
	$r->ok = FALSE;
	$r->error = $e->getMessage();
}

echo json_encode($r);
