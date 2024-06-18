<?php

include_once 'config/sessioncheck_admin.php';

if(isset($_POST['submit'])){
    $title = addslashes(strip_tags(trim($_POST['title'])));
    
    //file upload first()
    $imgpath=time().$_FILES["fileToUpload"]["name"];
    $ext = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/certificates/".$imgpath)){
          $core = core::getInstance();
          $q = 'INSERT INTO certificates (`id`, `caption`, `image`) VALUES (NULL, :title, :imgpath);';
          $stmt = $core->dbh->prepare($q);
          $stmt->bindParam(':title',$title,PDO::PARAM_STR);
          $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
          if($stmt->execute()){
            echo'<script>alert("Certificate added successfully.");
            window.location.href="add_certificates.php";</script>';
          }
          else print_r($stmt->errorInfo());
        }
    }
}



if (isset($_GET['id'])) {
    $id = addslashes(strip_tags(trim($_GET['id'])));
    $q = "DELETE FROM certificates WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$id,PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Certificate deleted successfully.");window.location.href="add_certificates.php";</script>';

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
            <h1 class="h3 mb-0 text-gray-800">Add Certificate</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="add_certificates.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Certificate Name:</label>
                  <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                  <label for="description">Select Certificate ( Any size ):</label>                            
                  <input type="file" name="fileToUpload">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Upload Certificate</button>
              </form>
            </div>
          </div>

        <div class="row">
          <div class="card-body" style="width:100%">
            <div class="table-responsive">
              <div id="printit">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-white bg-info">
                      <th class="text-center">#</th>
                      <th class="text-center">Certificate Title</th>
                      <th class="text-center">thumbnail</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                          $N = new master();
                          $r = $N->fetch_certificates();
                          for($i=0;$i<sizeof($r);$i++){
                            echo '<tr>';
                              echo '<td>'.$r[$i]['id'].'</td>';
                              echo '<td>'.$r[$i]['name'].'</td>';
                              echo '<td><img src="uploads/certificates/'.$r[$i]['thumbnail'].'" class="img-thumbnail" width="100px" /></td>';
                              echo '<td><a href="add_certificates.php?id='.$r[$i]['id'].'"><i class="fa fa-trash" aria-hidden="true"></i>
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
