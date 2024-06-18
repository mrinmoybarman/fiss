<?php

include_once("connect.php");
// include_once("class.php");

// if(!isset($_SESSION)){
// 	session_start();
// }

if(isset($_SESSION['CP_user_id']) ) {	 

	$core=core::getInstance();

	$q="select * from cp where email=:user_id and active='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindPARAM(':user_id',$_SESSION['CP_user_id'],PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount()>0){

	}

	else header('location:https://fissecurity.com/');

}

else header('location:config/logout_CP.php');
?>