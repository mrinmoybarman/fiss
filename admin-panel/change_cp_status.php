<?php

include_once 'config/sessioncheck_admin.php';

if(isset($_GET['id'])){

  $N = new master();
  $id = $_GET['id'];
  $r = $N->fetch_CP_by_id($id);
  for($i=0;$i<sizeof($r);$i++){
  	$active = $r[$i]['active'];
  }
  //when the proccess is done
  if(isset($active)){
  	if($active == 1){
      $core = core::getInstance();
      $q = "UPDATE `cp` SET `active` = 0 WHERE `id` = '$id';";
      $stmt = $core->dbh->prepare($q);
      if($stmt->execute()){
        echo true;
      }
  	}
  	else{
	  $core = core::getInstance();
      $q = "UPDATE `cp` SET `active` = 1 WHERE `id` = '$id';";
      $stmt = $core->dbh->prepare($q);
      if($stmt->execute()){
        echo true;
      }
  	}
  }
  else{
  	echo false;
  }
} 
?>