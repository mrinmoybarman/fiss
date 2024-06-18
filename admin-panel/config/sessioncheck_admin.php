<?php

include("connect.php");
include("class.php");

if(!isset($_SESSION)){
	session_start();
}

else if(isset($_SESSION['user_id']) && isset($_SESSION['token'] ) ) {	 

	$core=core::getInstance();

	$q="select * from admin_login where user_id=:user_id and token=:token and active_flag='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindPARAM(':user_id',$_SESSION['user_id'],PDO::PARAM_STR);
	$stmt->bindPARAM(':token',$_SESSION['token'],PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount()>0){

	}

	else header('location:config/logout_admin.php');

}

else header('location:config/logout_admin.php');
?>