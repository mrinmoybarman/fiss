<?php
 	include('connect.php');

 	session_destroy();
	//echo "session destroyed"; 
	 header('location: ../index.php');
 ?>