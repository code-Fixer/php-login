<?php
	
	//@author lumiere
	require_once('config.php');

	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['gender']) || empty($_POST['password']) || empty($_POST['account'])){
		echo json_encode(["status"=> false,"msg" => "Feilds missing"]);
		exit(0);
	}

	$error_vector = [];

	array_push($error_vector,!!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
	array_push($error_vector, (boolean) preg_match('/^[a-zA-Z ]+$/', $_POST['name']));

	if(in_array(false, $error_vector)){
		echo json_encode(["status"=> false,"msg" => "Invalid values given"]);
		exit(0);
	}

	$sql = "select * from users where email = '%s' ";
	$sql = sprintf($sql,$_POST['email']);

	$DB->query($sql);
	
	if(mysqli_affected_rows($DB) > 0){
		echo json_encode(["status"=> false,"msg" => "Email already exists"]);
		exit(0);
	}

	$sql = "insert into users(email,name,password,gender) values('%s','%s','%s',%d)";

	$pwd = md5($_POST['password']);

	$sql = sprintf($sql,$_POST['email'],$_POST['name'],$pwd,$_POST['gender']);

	$res = $DB->query($sql);
	
	if($res)
		echo json_encode(['status' => true ,"msg" => "you can now login"]);
	else
		echo json_encode(['status' => true ,"msg" => "Failed to save data try again"]);

?>