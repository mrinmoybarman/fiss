<?php
include_once('config/sessioncheck_admin.php');

if (isset($_GET['id'])) {
    $q = "DELETE FROM jobapply WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Record deleted successfully.");window.location.href="job_application.php";</script>';

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
              <h1 class="h3 mb-0 text-gray-800">All JOB APPLICATION </h1>
              <p class=" text-info">
                <button class="btn btn-primary" align="center" type="button" onclick="printdiv()"><i class="fa fa-print"></i></button>
              </p>
            </div>

              <!-- Content Row -->
            <div class="row">
              <div class="card-body" style="width:100%;">
                <div class="table-responsive">
                  <div id="printit">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr class="text-white bg-info">
                          <th class="text-center">#</th>
                          <th class="text-center">CP</th>
                          <th class="text-center">Application ID</th>
                          <th class="text-center">Post</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">E-mail ID</th>
                          <th class="text-center">Phone Number</th>
                          <th class="text-center">cv</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Delete</th>
                          <th class="text-center">View Details</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_job_application();
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $cp_id = $r[$i]['cp'];
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                  echo '<td>';
                                  if($r[$i]['cp'] == 0){
                                   echo 'Direct';   
                                  }
                                  else{
                                    $q = $N->fetch_CP_by_id($cp_id);
                                    // print_r($q);
                                    echo $q[0]['name'];
                                  }
                                  echo '</td>';
                                  echo '<td>'.$r[$i]['app_id'].'</td>';
                                  echo '<td>'.$r[$i]['postname'].'</td>';
                                  echo '<td>'.$r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname'].'</td>';
                                  echo '<td>'.$r[$i]['email'].'</td>';
                                  echo '<td>'.$r[$i]['phone1'].'</td>';
                                  echo '<td><a target="_blank" href="uploads/cv/'.$r[$i]['cv'].'">'.$r[$i]['cv'].'</a></td>';
                                  echo '<td>'.$r[$i]['date'].'</td>';
                                  echo '<td><a href="job_application.php?id='.$r[$i]['id'].'"><i class="fa fa-trash" aria-hidden="true"></i>
                                  </a></td>';
                                  echo '<td><a target="_blank" href="view_candidate_details.php?id='.$r[$i]['id'].'"><i class="fa fa-eye" aria-hidden="true"></i>
                                  </a></td>';
                                echo '</tr>';
                              }
                            ?>
                      </tbody>
                    </table>
                  </div>  
                </div>                  
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
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

    window.print();
    document.body.innerHTML = originalContents;
    } 
  </script>

</body>

</html>
