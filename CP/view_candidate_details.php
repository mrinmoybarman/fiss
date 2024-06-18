<?php
include_once('../admin-panel/config/sessioncheck_CP.php');
include_once('CP_Class.php');
$N = new master();
$r = $N->fetch_job_application_by_id($_GET['id']);
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
              <h1 class="h3 mb-0 text-gray-800">View Candidate Details</h1>
              <p class=" text-info">
                <button class="btn btn-primary" align="center" type="button" onclick="printdiv()"><i class="fa fa-print"></i></button>
              </p>
            </div>

              <!-- Content Row -->
            <div id="printit">
              <div class="row"> 
              
                <div class="col-md-6">
<?php

for($i=0;$i<sizeof($r);$i++){
?>
                  <h4>Personal Information:</h4><br/>
                  <ul>
                    <li>Name : <?php echo $r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname']; ?></li>
                    <li>Fathers Name : <?php echo $r[$i]['fathersname'];?></li>
                    <li>Mothers Name : <?php echo $r[$i]['mothersname'];?></li>
                    <li>Date Of Birth : <?php echo $r[$i]['dob'];?></li>
                    <li>Gender : <?php echo $r[$i]['gender'];?></li>
                    <li>Merital Status : <?php echo $r[$i]['meritalstatus'];?></li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <h4>Conatct Information:</h4><br/>
                  <ul>
                    <li>Phone Number : <?php echo $r[$i]['phone1']; ?></li>
                    <li>Whatsapp Number : <?php echo $r[$i]['phone2'];?></li>
                    <li>Email Id : <?php echo $r[$i]['email'];?></li>
                    <li>Date Applied : <?php echo $r[$i]['date'];?></li>
                  </ul>
                </div>

                <div class="col-md-6">
                  <h4>Present Address:</h4><br/>
                  <ul>
                    <li>Vill/Town : <?php echo $r[$i]['vill1']; ?></li>
                    <li>Post Office : <?php echo $r[$i]['po1'];?></li>
                    <li>Police Satation : <?php echo $r[$i]['ps1'];?></li>
                    <li>District : <?php echo $r[$i]['dist1'];?></li>
                    <li>State : <?php echo $r[$i]['state1'];?></li>
                    <li>PIN Number : <?php echo $r[$i]['pin1'];?></li>
                  </ul>
                </div>

                <div class="col-md-6">
                  <h4>Parmanent Address:</h4><br/>
                  <ul>
                    <li>Vill/Town : <?php echo $r[$i]['vill2']; ?></li>
                    <li>Post Office : <?php echo $r[$i]['po2'];?></li>
                    <li>Police Satation : <?php echo $r[$i]['ps2'];?></li>
                    <li>District : <?php echo $r[$i]['dist2'];?></li>
                    <li>State : <?php echo $r[$i]['state2'];?></li>
                    <li>PIN Number : <?php echo $r[$i]['pin2'];?></li>
                  </ul>
                </div>

                <div class="col-md-12">
                  <iframe src="../admin-panel/uploads/cv/<?php echo $r[$i]['cv'];?>" style="width:100%;min-height:100vh;"/>
                </div>
<?php
}
?>
                  </div>  
                                  
              
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
  <!-- Bootstrap core JavaScript-->
  <script src="../admin-panel/vendor/jquery/jquery.min.js"></script>
  <script src="../admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <script src="../admin-panel/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../admin-panel/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    // Call the dataTables jQuery plugin
  $(document).ready(function() {
      $('#dataTable').DataTable();
    });

  </script>

  <script>
    function printdiv() {

    console.log("ok");

    var printContents = document.getElementById('printit').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();
    document.body.innerHTML = originalContents;
    } 
  </script>

</body>

</html>
