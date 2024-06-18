<?php
include_once('../admin-panel/config/sessioncheck_receiptionist.php');
include_once 'Receiptionist_Class.php';

if(isset($_POST['submit'])){
  $new_name = addslashes(strip_tags(trim($_POST['name'])));
  $new_email = addslashes(strip_tags(trim($_POST['email'])));
  $new_phone = addslashes(strip_tags(trim($_POST['phone'])));
  $new_remark = addslashes(strip_tags(trim($_POST['remark'])));
  $id = addslashes(strip_tags(trim($_POST['id'])));
    
  $core = core::getInstance();
  $q = "UPDATE `visitors` SET `name` = :title, `phone` = :phone, `email` = :email, `remark` = :remark WHERE `id` = :id;";
  $stmt = $core->dbh->prepare($q);
  $stmt->bindParam(':title',$new_name,PDO::PARAM_STR);
  $stmt->bindParam(':phone',$new_phone,PDO::PARAM_STR);
  $stmt->bindParam(':email',$new_email,PDO::PARAM_STR);
  $stmt->bindParam(':remark',$new_remark,PDO::PARAM_STR);  
  $stmt->bindParam(':id',$id,PDO::PARAM_INT);  
  if($stmt->execute()){
    echo'<script>
      alert("Visitors added successfully.");
      window.location.href="Visitors.php"
      </script>';
  }
  else {
    echo'<script>
      alert("Error Editing Code");
      </script>';
    print_r($stmt->errorInfo());
  }
}



if (isset($_GET['id'])) {
  $N = new master();
  $id = $_GET['id'];
  $r = $N->fetch_Visitor($id);
  for($i=0;$i<sizeof($r);$i++){
    $name = $r[$i]['name'];
    $email = $r[$i]['email'];
    $phone = $r[$i]['phone'];
    $remark = $r[$i]['remark'];
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
            <h1 class="h3 mb-0 text-gray-800">Edit Visitor Record</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="edit_Visitor.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                <div class="form-group">
                  <label for="title">Name:</label>
                  <input type="text" class="form-control" name="name" value="<?php echo $name ;?>">
                </div>
                <div class="form-group">
                  <label for="title">Phone Number:</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo $phone ;?>">
                </div>
                <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email" value="<?php echo $email ;?>">
                </div>
                <div class="form-group">
                  <label for="title">Remark:</label>
                  <input type="text" class="form-control" name="remark" value="<?php echo $remark ;?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
