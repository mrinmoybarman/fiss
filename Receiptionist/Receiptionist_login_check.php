<?php
include_once("../admin-panel/config/connect.php");
include_once("../admin-panel/config/class.php");

$user_id=strtolower(addslashes(strip_tags(trim($_POST['user_id']))));

$pwd=md5(addslashes(strip_tags(trim($_POST['pwd']))));

$core=core::getInstance();


$q="SELECT * FROM receiptionist where email=:email and password=:password and active='1'";
$stmt=$core->dbh->prepare($q);
$stmt->bindPARAM(':email',$user_id,PDO::PARAM_STR);
$stmt->bindPARAM(':password',$pwd,PDO::PARAM_STR);
$stmt->execute();
if($stmt->rowCount()>0){
	while($r=$stmt->fetchObject())
	{
		$_SESSION['Receiptionist_id'] = $user_id;
		$_SESSION['token'] = $pwd;
		echo 1;
	}
}
else echo 0;
?>