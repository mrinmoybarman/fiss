<?php
include_once("../admin-panel/config/connect.php");
include "ASO_Class.php";
$user_id=strtolower(addslashes(strip_tags(trim($_POST['user_id']))));
$pwd=md5(addslashes(strip_tags(trim($_POST['pwd']))));
$core=core::getInstance();


$q="select * from aso where email=:user_id and password=:password and active='1'";
	// select * from admin_login where user_id = "admin" and password= "admin" and active_flag='1' 
$stmt=$core->dbh->prepare($q);
$stmt->bindPARAM(':user_id',$user_id,PDO::PARAM_STR);
$stmt->bindPARAM(':password',$pwd,PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){
	while($r=$stmt->fetchObject())
	{
		$_SESSION['aso_id'] = $user_id;
		$_SESSION['token'] = $pwd;
		echo 1;
	}
	//$_SESSION['sponsor_code'] = $sponsor_code;
}

else echo 0;



?>