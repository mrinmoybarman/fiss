<?php

include_once 'config/sessioncheck_admin.php';

if(isset($_POST['submit'])){
    $name = addslashes(strip_tags(trim($_POST['name'])));
    $email = addslashes(strip_tags(trim($_POST['email'])));
    $phone = addslashes(strip_tags(trim($_POST['phone'])));
    $password = md5("1234");

    if($_FILES["fileToUpload"]["name"] != NULL){
      //file upload first() 
      $imgpath=time().$_FILES["fileToUpload"]["name"];
      $ext = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/aso/".$imgpath)){
        $core = core::getInstance();
        $q = "INSERT INTO `aso` (`id`, `name`, `email`, `phone`, `dp`, `active`, `password`) VALUES (NULL, :name, :email, :phone, :imgpath, 1, :pass);";
        //$q = 'INSERT INTO cp (id, name, email, phone, dp, active, password) VALUES (NULL, :name, :email, :phone, :imgpath, 1, :pass);';
        $stmt = $core->dbh->prepare($q);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
        $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
        $stmt->bindParam(':pass',$password,PDO::PARAM_STR);
        if($stmt->execute()){
          echo'<script>alert("New ASO Added Successfully.");window.location.href="ASO.php";</script>';
        }
        else print_r($stmt->errorInfo());
      }  
    }
    }
    else{
      $core = core::getInstance();
      $q = 'INSERT INTO `aso` (`id`, `name`, `email`, `phone`, `active`, `password`) VALUES (NULL, :name, :email, :phone, 1, :pass);';
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':name',$name,PDO::PARAM_STR);
      $stmt->bindParam(':email',$email,PDO::PARAM_STR);
      $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
      $stmt->bindParam(':pass',$password,PDO::PARAM_STR);
      if($stmt->execute()){
        echo'<script>alert("New ASO Added Successfully.");window.location.href="ASO.php";</script>';
      }
      else print_r($stmt->errorInfo());
    }
    
}



if (isset($_GET['id'])) {
    $id = addslashes(strip_tags(trim($_GET['id'])));
    $q = "DELETE FROM aso WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$id,PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("ASO deleted successfully.");window.location.href="ASO.php";</script>';
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
      
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add ASO</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="ASO.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">ASO Name:</label>
                  <input type="text" class="form-control" name="name" id="title">
                </div>
                 <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email" id="title">
                </div>
                 <div class="form-group">
                  <label for="title">Phone:</label>
                  <input type="text" class="form-control" name="phone" id="title">
                </div>
                <div class="form-group">
                  <label for="description">Branch Manager avatar (400px * 400px):</label>                            
                  <input type="file" name="fileToUpload">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add ASO</button>
              </form>
            </div>

          </div>
        
        </div>
        <hr />

        <div style="">
      
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">All ASO</h1>
          <p class=" text-info">
            <button class="btn btn-primary" align="center" type="button" onclick="printdiv()"><i class="fa fa-print"></i></button>
            <button class="btn btn-warning" onclick="fnExcelReport();" type="button" id="btnExport"><i class="fa fa-file-excel-o"> Export to excel</i></button>
        
          </p>
        </div>

        <!-- Content Row -->
        <div class="row">
          <div class="card-body" style="width:100%">
            <div class="table-responsive">
              <div id="printit">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-white bg-info">
                      <th class="text-center">#</th>
                      <th class="text-center">ASO Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Avatar</th>
                      <th class="text-center">Edit</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                          $N = new master();
                          $r = $N->fetch_ASO();
                          for($i=0;$i<sizeof($r);$i++){
                            echo '<tr>';
                              echo '<td>'.$r[$i]['id'].'</td>';
                              echo '<td>'.$r[$i]['name'].'</td>';
                              echo '<td>'.$r[$i]['phone'].'</td>';
                              echo '<td>'.$r[$i]['email'].'</td>';
                              echo '<td><img src="uploads/aso/'.$r[$i]['img'].'" class="img-thumbnail" width="200px" /></td>';
                              echo '<td><a href="edit_ASO.php?id='.$r[$i]['id'].'">Edit &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a></td>';
                              echo '<td><a href="ASO.php?id='.$r[$i]['id'].'">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i>
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>




</body>

</html>
