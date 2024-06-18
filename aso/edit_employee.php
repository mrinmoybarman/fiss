<?php
include_once('../admin-panel/config/sessioncheck_aso.php');
include_once 'ASO_Class.php';

if(isset($_POST['submit'])){
    $new_name = addslashes(strip_tags(trim($_POST['name'])));
    $new_phone = addslashes(strip_tags(trim($_POST['phone'])));
    $new_email = addslashes(strip_tags(trim($_POST['email'])));
    $new_loc = addslashes(strip_tags(trim($_POST['loc'])));
    $new_deg = addslashes(strip_tags(trim($_POST['des'])));
    $new_add = addslashes(strip_tags(trim($_POST['add'])));
    $id = addslashes(strip_tags(trim($_POST['id'])));
    
    if($_FILES["fileToUpload"]["name"] != NULL){
      //file upload first()
      $imgpath=time().$_FILES["fileToUpload"]["name"];
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../admin-panel/uploads/employee/".$imgpath)){
        echo 'ok';
        $core = core::getInstance();
        $q = "UPDATE `employee` SET `name` = '$new_name', `phone` = '$new_phone', `email` = '$new_email', `address` = '$new_add', `designation` = '$new_deg', `location` = '$new_loc', `photo` = '$imgpath' WHERE `id` = '$id';";
        $stmt = $core->dbh->prepare($q);
        // $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        // $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
        if($stmt->execute()){
          echo'<script>alert("Employee added successfully.");window.location.href="employees.php";</script>';
        }
        else print_r($stmt->errorInfo());
      }
      else{
        echo 'file upload error !';
      }  
    }
    else{
        $core = core::getInstance();
        $q = "UPDATE `employee` SET `name` = '$new_name', `phone` = '$new_phone', `email` = '$new_email', `address` = '$new_add', `designation` = '$new_deg', `location` = '$new_loc' WHERE `id` = '$id';";
        $stmt = $core->dbh->prepare($q);
        if($stmt->execute()){
          echo'<script>alert("Employee added successfully.");window.location.href="employees.php";</script>';
        }
        else print_r($stmt->errorInfo()); 
    }
    
}



if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $N = new master();
  $r = $N->fetch_employees_by_id($id);
  for($i=0;$i<sizeof($r);$i++){
    $name = $r[$i]['name'];
    $email = $r[$i]['email'];
    $phone = $r[$i]['phone'];
    $address = $r[$i]['address'];
    $designation = $r[$i]['designation'];
    $location = $r[$i]['location'];
    $photo = $r[$i]['photo'];
  }
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
              <form action="edit_employee.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                  <label for="title">Name:</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Phone:</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Designation:</label>
                  <input type="text" class="form-control" name="des" value="<?php echo $designation; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Location:</label>
                  <input type="text" class="form-control" name="loc" value="<?php echo $location; ?>">
                </div>
                <div class="form-group">
                  <label for="title">Address:</label>
                  <input type="text" class="form-control" name="add" value="<?php echo $address; ?>">
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="description">Replace Photo ( jpeg only ):</label>                            
                      <input type="file" name="fileToUpload">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <img src="../admin-panel/uploads/employee/<?php echo $photo; ?>" style="max-height:150px;max-width:100%"/>
                  </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
              </form>
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




</body>

</html>
