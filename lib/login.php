<?php
	require_once('config.php');

	if(empty($_POST['email']) || empty($_POST['password'])){
		echo json_encode(["status"=> false,"msg" => "Feilds missing"]);
		exit(0);
	}

	$error_vector = [];

	array_push($error_vector,!!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

	if(in_array(false, $error_vector)){
		echo json_encode(["status"=> false,"msg" => "Invalid values given"]);
		exit(0);
	}

	$pwd = md5($_POST['password']);

	$sql = "select * from users where email='%s' and password ='%s'";
	$sql = sprintf($sql,$_POST['email'],$pwd);

	$res = $DB->query($sql);

	if(mysqli_affected_rows($DB) > 0){
		$row = mysqli_fetch_assoc($res);
		echo json_encode(['status' => true ,"msg" => "you have succesfully loggedin ","data" => $row]);
		session_start();
		$_SESSION['actor'] = $row['id'];
	}else{
		echo json_encode(['status' => false ,"msg" => "Invalid credentials"]);
	}	

?>