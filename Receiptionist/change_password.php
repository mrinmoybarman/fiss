<?php
include_once('../admin-panel/config/sessioncheck_CP.php');
if(isset($_POST['change']))
{
  $pwd = md5(addslashes(strip_tags(trim($_POST['pwd']))));
  $core = core::getInstance();
  $q = "update cp set password=:password where email=:user_id";
  $stmt = $core->dbh->prepare($q);
  $stmt->bindParam(':password',$pwd,PDO::PARAM_STR);
  $stmt->bindParam(':user_id',$_SESSION['user_id'],PDO::PARAM_STR);
  if($stmt->execute())
    echo'<script>alert("password changed successfully.Please re login.");window.location.href="../admin-panel/config/logout_cp.php";</script>';
  else
    print_r($stmt->errorInfo());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin panel 2.0</title>

  <!-- Custom fonts for this template-->
  <link href="../admin-panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="mrincustom.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php include 'sidebar.php';?>
  
  <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php include 'header.php'; ?>

    <div style="">
      
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
        </div>

          <!-- Content Row -->
        <div class="row">

            <form method="POST" id="f" name="f">
<div class="container">
  <div class="row">
    <div class="col-lg-5">
      <label for="pwd">Password</label>
      <input type="password" name="pwd" id="pwd" class="form-control" required>
    </div>
    <div class="col-lg-5">
      <label for="pwd">Confirm Password</label>
      <input type="password" name="cpwd" id="cpwd" class="form-control" required>
    </div>
        <div class="col-lg-2">
          <label for="">&nbsp;</label><br>
<input type="submit" class="btn btn-primary" name="change" class="form-control"></p>
    </div>
  </div>
</div>
</form>

        
        </div>                  
      </div>
      
    </div>
    </div>
    </div>

      <!-- End of Footer -->
  </div>
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
<?php include 'logout_modal.php'; ?>
  <!-- Bootstrap core JavaScript-->
  <script src="../admin-panel/vendor/jquery/jquery.min.js"></script>
  <script src="../admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../admin-panel/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../admin-panel/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../admin-panel/js/demo/chart-area-demo.js"></script>
  <script src="../admin-panel/js/demo/chart-pie-demo.js"></script>
  <script>
  $("form").on('submit',function(){
    var pwd = $("#pwd").val();
    var cpwd =  $("#cpwd").val();
 if(  pwd==cpwd  )
  return true;
else
{
  alert("Password does not match.");
  return false;
}

  });
</script>

</body>

</html>
