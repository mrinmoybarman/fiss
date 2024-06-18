<?php
include_once("connect.php");

if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['aso_id']) && isset($_SESSION['token'] ) ) {
	$core=core::getInstance();
	$q="select * from aso where email=:user_id and password=:token and active='1'";
	$stmt=$core->dbh->prepare($q);
	$stmt->bindPARAM(':user_id',$_SESSION['aso_id'],PDO::PARAM_STR);
	$stmt->bindPARAM(':token',$_SESSION['token'],PDO::PARAM_STR);
	$stmt->execute();
	if($stmt->rowCount()>0){
	}
	//else header('location:config/logout_admin.php');
}
else header('location:config/logout_admin.php');
?>