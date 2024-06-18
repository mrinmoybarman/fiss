<?php
include_once("../admin-panel/config/connect.php");
include_once("../admin-panel/config/class.php");

$user_id=strtolower(addslashes(strip_tags(trim($_POST['user_id']))));

$pwd=md5(addslashes(strip_tags(trim($_POST['pwd']))));

$core=core::getInstance();


$q="SELECT * FROM cp where email=:email and password=:password and active='1'";
$stmt=$core->dbh->prepare($q);
$stmt->bindPARAM(':email',$user_id,PDO::PARAM_STR);
$stmt->bindPARAM(':password',$pwd,PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){
	echo 1;
	while($r=$stmt->fetchObject())
	{
		$_SESSION['CP_id'] = $r->id;
	}
	$_SESSION['CP_user_id'] = $user_id;

	

	//$_SESSION['sponsor_code'] = $sponsor_code;
}

else echo 0;



?>