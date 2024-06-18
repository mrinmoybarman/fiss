<?php
include_once 'config/sessioncheck_admin.php';
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
              <h1 class="h3 mb-0 text-gray-800">Database Backup</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
              <div class="col-lg-12">
                <a href="sqldump.php"><button onclick="sconfirm();" type="button" name="dbb" id="dbb" class="btn btn-default">Backup Database <i class="fa fa-download"></i></button></a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- Scoll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
<?php include 'logout_modal.php'; ?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script>

  
        function sconfirm()
        {
          var r = confirm("Are you sure you want to take database backup?");
          return r;
        }
  


  </script>
  
<?php if(isset($_GET['msg']) && ($_GET['msg']=='db')){?>
    <script>
  alert('Database Backup File has been successgully downloaded.File was saved in Database Backup folder in E drive');
  window.location="db_backup.php";
    </script>
<?php } 
if(isset($_GET['nodir']))
{
?>
 <script>
  alert('Unable to create directory E:/Database Backup. Contact System Administrator');
  window.location="db_backup.php";
    </script>
<?php
}
?>

</body>

</html>
