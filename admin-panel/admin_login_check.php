<?php
include("config/connect.php");
include("config/class.php");

$user_id=strtolower(addslashes(strip_tags(trim($_POST['user_id']))));

$pwd=md5(addslashes(strip_tags(trim($_POST['pwd']))));

$core=core::getInstance();


$q="select * from admin_login where user_id=:user_id and password=:password and active_flag='1'";
	// select * from admin_login where user_id = "admin" and password= "admin" and active_flag='1' 
$stmt=$core->dbh->prepare($q);
$stmt->bindPARAM(':user_id',$user_id,PDO::PARAM_STR);
$stmt->bindPARAM(':password',$pwd,PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){
	echo 1;
	while($r=$stmt->fetchObject())
	{
		$token = $r->token;
		//$sponsor_code = $r->sponsor_code;
		
	}
	$_SESSION['user_id'] = $user_id;

	$_SESSION['token'] = $token;

	//$_SESSION['sponsor_code'] = $sponsor_code;
}

else echo 0;



?>