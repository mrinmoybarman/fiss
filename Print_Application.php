<?php
if(isset($_GET['appId'])){
    $appId = addslashes(strip_tags(trim($_GET['appId'])));
?>

<?php
include_once('admin-panel/config/connect.php');
include_once('admin-panel/config/class.php');
$N = new master();
$r = $N->fetch_job_application_by_appid($appId);
?>

<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FISS APPLICATION PRINT</title>

  <!-- Custom fonts for this template-->
  <link href="admin-panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php //include 'sidebar.php';?>
  
  <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

<?php //include 'header.php'; ?>

        <div style="">
      
          <!-- Begin Page Content -->
          <div class="container-fluid py-4">

                <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4 ">
              <h1 class="h3 mb-0 text-gray-800">Please Print This Application !</h1>
              <p class=" text-info">
                <button class="btn btn-primary" align="center" type="button" onclick="printdiv()"><i class="fa fa-print"></i></button>
              </p>
            </div>

              <!-- Content Row -->
            <div id="printit" style="-webkit-print-color-adjust: exact;">
              <div class="container" style="border:2px solid Black;padding:2em;min-height:100vh;"> 
                <h1 class="text-center">Application Form</h1>
                <h2 class="text-center">FISS SECURITY SERVICES</h2>
                <hr/>
                <div class="row">
                
                <div class="col-md-6 mt-4 text-left">
                    <strong>Generated On <?php date_default_timezone_set("Asia/Calcutta"); echo date("F j, Y, g:i a");?></strong>
                </div>
                <div class="col-md-6 mt-4 text-right">
                    <strong>Application Id: <?php echo $appId;?></strong>
                </div>
                </div>
                <hr/>
                <div class="row">
                
                <div class="col-md-6 mt-4 text-left">
<?php

for($i=0;$i<sizeof($r);$i++){
?>
                  <h4>Personal Information:</h4>
                  
                    <p><strong>Name :</strong> <?php echo $r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname']; ?></p>
                    <p><strong>Fathers Name :</strong> <?php echo $r[$i]['fathersname'];?></p>
                    <p><strong>Mothers Name :</strong> <?php echo $r[$i]['mothersname'];?></p>
                    <p><strong>Date Of Birth :</strong> <?php echo $r[$i]['dob'];?></p>
                    <p><strong>Gender :</strong> <?php echo $r[$i]['gender'];?></p>
                    <p><strong>Merital Status :</strong> <?php echo $r[$i]['meritalstatus'];?></p>
                  <br/>
                </div>
                <div class="col-md-6 mt-4 text-right">
                  <h4>Contact Information:</h4><br/>
                    <p><strong>Phone Number :</strong> <?php echo $r[$i]['phone1']; ?></p>
                    <p><strong>Whatsapp Number :</strong> <?php echo $r[$i]['phone2'];?></p>
                    <p><strong>Email Id :</strong> <?php echo $r[$i]['email'];?></p>
                    <p><strong>Date Applied :</strong> <?php echo $r[$i]['date'];?></p>
                </div>

                <div class="col-md-6 text-left">
                  <h4>Present Address:</h4><br/>
                  <p><strong>Vill/Town :</strong> <?php echo $r[$i]['vill1']; ?></p>
                  <p><strong>Post Office :</strong> <?php echo $r[$i]['po1'];?></p>
                  <p><strong>Police Satation :</strong> <?php echo $r[$i]['ps1'];?></p>
                  <p><strong>District :</strong> <?php echo $r[$i]['dist1'];?></p>
                  <p><strong>State :</strong> <?php echo $r[$i]['state1'];?></p>
                  <p><strong>PIN Number :</strong> <?php echo $r[$i]['pin1'];?></p>
                </div>

                <div class="col-md-6 text-right">
                  <h4>Parmanent Address:</h4><br/>
                  <p><strong>Vill/Town :</strong> <?php echo $r[$i]['vill2']; ?></p>
                  <p><strong>Post Office :</strong> <?php echo $r[$i]['po2'];?></p>
                  <p><strong>Police Satation :</strong> <?php echo $r[$i]['ps2'];?></p>
                  <p><strong>District :</strong> <?php echo $r[$i]['dist2'];?></p>
                  <p><strong>State :</strong> <?php echo $r[$i]['state2'];?></p>
                  <p><strong>PIN Number :</strong> <?php echo $r[$i]['pin2'];?></p>
                </div>
                </div>
                <hr/>
                <div class="col-md-12 mt-4 text-center">
                  <h4>Payment Details</h4><br/>
<?php
$p = $N->fetch_payment_by_appid($appId);
for($i=0;$i<sizeof($r);$i++){
?>
                  <p><strong>Order Id :</strong> <?php echo $p[$i]['order_id']; ?></p>
                  <p><strong>Payment Status :</strong> <?php echo $p[$i]['status'];?></p>
                  <p><strong>Amount Paid :</strong> <?php echo $p[$i]['amount'];?></p>
                  <p><strong>Reference ID :</strong> <?php echo $p[$i]['ref_id'];?></p>
                  <p><strong>Payment Mode :</strong> <?php echo $p[$i]['mode'];?></p>
                  <p><strong>Date & Time :</strong> <?php echo $p[$i]['time'];?></p>
<?php
}
?>
                </div>
</div>
                <!--<div class="col-md-12">-->
                <!--  <iframe src="uploads/cv/<?php echo $r[$i]['cv'];?>" style="width:100%;min-height:100vh;"/>-->
                <!--</div>-->
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
  
<?php //include 'logout_modal.php'; ?>
  <!-- Bootstrap core JavaScript-->
  <!-- Bootstrap core JavaScript-->
  <script src="admin-panel/vendor/jquery/jquery.min.js"></script>
  <script src="admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin-panel/js/sb-admin-2.min.js"></script>
  
  <script src="admin-panel/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="admin-panel/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    // Call the dataTables jQuery plugin
  $(document).ready(function() {
      $('#dataTable').DataTable();
    });

  </script>

  <script>
    function printdiv() {
      var printContents = document.getElementById('printit').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      
      var cssId = 'myCss';
      var head  = document.getElementsByTagName('head')[0];
      var link  = document.createElement('link');
      link.id   = cssId;
      link.rel  = 'stylesheet';
      link.type = 'text/css';
      link.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
      link.media = 'all';
      head.appendChild(link);
    
      window.print();
      document.body.innerHTML = originalContents;
    } 
  </script>

</body>

</html>


<?php
}
?>