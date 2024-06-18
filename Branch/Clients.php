<?php
include_once '../admin-panel/config/sessioncheck_branch.php';

$N = new master();
$r = $N->fetch_branchname_by_id($_SESSION['branch_id']);
for($i=0;$i<sizeof($r);$i++){
  $bname = $r[$i]['branch'];
}

if (isset($_GET['id'])) {
    $q = "DELETE FROM enquiry WHERE e_id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Your Client deleted successfully.");window.location.href="My_Clients.php";</script>';
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
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=v4muaonwnxcmjw1fn31xyib57lpvc56r94td8aksiv18smp7"></script>

  <style media="screen">
      .mce-btn button{
        padding: 2px 2px !important;
        font-size: 12px !important;
        line-height: 18px !important;
      }
    </style>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=v4muaonwnxcmjw1fn31xyib57lpvc56r94td8aksiv18smp7"></script>
    <script>
    tinymce.init({
    selector: 'textarea',
    menubar: true,
    plugins: [
      'advlist autolink lists link image charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css']
    });
  </script>

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
          <h1 class="h3 mb-0 text-gray-800">All Client</h1>
          <p class=" text-info">
            <button class="btn btn-primary" align="center" type="button" onclick="printdiv()"><i class="fa fa-print"></i></button>
            <button class="btn btn-warning" onclick="fnExcelReport();" type="button" id="btnExport"><i class="fa fa-file-excel-o"> Export to excel</i></button>
        
          </p>
        </div>

        <!-- Content Row -->
        <div class="row">
          <div class="card-body">
            <div class="table-responsive">
              <div id="printit">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-white bg-info">
                      <th class="text-center">#</th>
                      <th class="text-center">CP</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Service</th>
                      <th class="text-center">Edit</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                          include_once('../admin-panel/config/connect.php');
                          $N = new master();
                          $r = $N->fetch_Client_by_branch($bname);
                          for($i=0;$i<sizeof($r);$i++){
                            echo '<tr>';
                              echo '<td>'.$r[$i]['id'].'</td>';
                              echo '<td>';
                              if($r[$i]['cp'] == 0){
                                echo 'Direct';   
                              }
                              else{
                                $q = $N->fetch_CP_by_id($r[$i]['cp']);
                                echo $q[0]['name'];
                              }
                              echo '</td>';
                              echo '<td>'.$r[$i]['name'].'</td>';
                              echo '<td>'.$r[$i]['phone'].'</td>';
                              echo '<td>'.$r[$i]['mail'].'</td>';
                              echo '<td>'.$r[$i]['service'].'</td>';
                              echo '<td><a href="edit_Clients.php?id='.$r[$i]['id'].'">Edit &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a></td>';
                              echo '<td><a href="My_Clients.php?id='.$r[$i]['id'].'">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i>
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

      <!-- End of Footer -->
      </div>
    </div>
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
  <script src="../admin-panel/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../admin-panel/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    // Call the dataTables jQuery plugin
  $(document).ready(function() {
      $('#dataTable').DataTable();
    });

  </script>




</body>

</html>
