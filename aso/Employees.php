<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../admin-panel/config/sessioncheck_aso.php');
include_once 'ASO_Class.php';

if(isset($_POST['submit'])){
    $name = addslashes(strip_tags(trim($_POST['name'])));
    $phone = addslashes(strip_tags(trim($_POST['phone'])));
    $email = addslashes(strip_tags(trim($_POST['email'])));
    $loc = addslashes(strip_tags(trim($_POST['loc'])));
    $deg = addslashes(strip_tags(trim($_POST['des'])));
    $add = addslashes(strip_tags(trim($_POST['add'])));
    
    //file upload first()
    $imgpath=time().$_FILES["fileToUpload"]["name"];
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../admin-panel/uploads/employee/".$imgpath)){
      $core = core::getInstance();
      $q = "INSERT INTO `employee` (`id`, `name`, `phone`, `email`, `address`, `designation`, `location`, `photo`) VALUES (NULL, '$name', '$phone', '$email', '$add', '$deg', '$loc', '$imgpath');";
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':title',$title,PDO::PARAM_STR);
      $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
      if($stmt->execute()){
        echo'<script>alert("Employee added successfully.");window.location.href="Employees.php";</script>';
      }
      else print_r($stmt->errorInfo());
    }
}



if (isset($_GET['id'])) {
    $q = "DELETE FROM employee WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Employee deleted successfully.");window.location.href="Employees.php";</script>';

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
            <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="Employees.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Name:</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                  <label for="title">Phone:</label>
                  <input type="text" class="form-control" name="phone">
                </div>
                <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                  <label for="title">Designation:</label>
                  <input type="text" class="form-control" name="des">
                </div>
                <div class="form-group">
                  <label for="title">Location:</label>
                  <input type="text" class="form-control" name="loc">
                </div>
                <div class="form-group">
                  <label for="title">Address:</label>
                  <input type="text" class="form-control" name="add">
                </div>
                <div class="form-group">
                  <label for="description">Select Photo ( jpeg only ):</label>                            
                  <input type="file" name="fileToUpload">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
              </form>
            </div>

          </div>
          <hr/>

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
                          <th class="text-center">Email</th>
                          <th class="text-center">Designation</th>
                          <th class="text-center">Location</th>
                          <th class="text-center">Address</th>
                          <th class="text-center">photo</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_employee();
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                  echo '<td>'.$r[$i]['name'].'</td>';
                                  echo '<td>'.$r[$i]['phone'].'</td>';
                                  echo '<td>'.$r[$i]['email'].'</td>';
                                  echo '<td>'.$r[$i]['designation'].'</td>';
                                  echo '<td>'.$r[$i]['location'].'</td>';
                                  echo '<td>'.$r[$i]['address'].'</td>';
                                  echo '<td><img src="../admin-panel/uploads/employee/'.$r[$i]['photo'].'" style="max-height:100px;"/></td>';
                                  echo '<td><a href="edit_employee.php?id='.$r[$i]['id'].'">Edit &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
                                  echo '<td><a href="Employees.php?id='.$r[$i]['id'].'">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></a></td>';
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
 <script src="../admin-panel/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../admin-panel/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../admin-panel/js/sb-admin-2.min.js"></script>
<script type="text/javascript">
    // Call the dataTables jQuery plugin
  $(document).ready(function() {
      $('#dataTable').DataTable();
    });

  </script>



</body>

</html>
