<?php
include_once('../admin-panel/config/sessioncheck_receiptionist.php');
include_once 'Receiptionist_Class.php';

if(isset($_POST['submit'])){
  $name = addslashes(strip_tags(trim($_POST['name'])));
  $email = addslashes(strip_tags(trim($_POST['email'])));
  $phone = addslashes(strip_tags(trim($_POST['phone'])));
  $remark = addslashes(strip_tags(trim($_POST['remark'])));
    
  $core = core::getInstance();
  $q = "INSERT INTO `visitors` (`id`, `name`, `phone`, `email`, `timestamp`, `remark`, `branch`) VALUES (NULL, :title, :phone, :email, CURRENT_TIMESTAMP, :remark, 'HEAD');";
  $stmt = $core->dbh->prepare($q);
  $stmt->bindParam(':title',$name,PDO::PARAM_STR);
  $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
  $stmt->bindParam(':email',$email,PDO::PARAM_STR);
  $stmt->bindParam(':remark',$remark,PDO::PARAM_STR);  
  if($stmt->execute()){
    echo'<script>
      alert("Visitors added successfully.");
      window.location.href="Visitors.php"
      </script>';
  }
  else print_r($stmt->errorInfo());
}



if (isset($_GET['id'])) {
    $q = "DELETE FROM visitors WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Visitors Record deleted successfully.");window.location.href="Visitors.php";</script>';
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

              <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Visitors</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="Visitors.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Name:</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                  <label for="title">Phone Number:</label>
                  <input type="text" class="form-control" name="phone">
                </div>
                <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email">
                </div><div class="form-group">
                  <label for="title">Remark:</label>
                  <input type="text" class="form-control" name="remark">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">submit</button>
              </form>
            </div>

          </div>
        
        </div>


        <div style="">
      
          <!-- Begin Page Content -->
          <div class="container-fluid">

                <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">List of all Visitors</h1>
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
                          <th class="text-center">Name</th>
                          <th class="text-center">Phone</th>
                          <th class="text-center">E-mail</th>
                          <th class="text-center">date</th>
                          <th class="text-center">time</th>
                          <th class="text-center">remark</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_Visitors();
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                  echo '<td>'.$r[$i]['name'].'</td>';
                                  echo '<td>'.$r[$i]['phone'].'</td>';
                                  echo '<td>'.$r[$i]['email'].'</td>';
                                  echo '<td>'.$r[$i]['date'].'</td>';
                                  echo '<td>'.$r[$i]['time'].'</td>';
                                  echo '<td>'.$r[$i]['remark'].'</td>';
                                  echo '<td><a href="edit_Visitor.php?id='.$r[$i]['id'].'">Edit &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
                                  echo '<td><a href="Visitors.php?id='.$r[$i]['id'].'">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></a></td>';
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
