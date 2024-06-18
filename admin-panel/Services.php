<?php

include_once 'config/sessioncheck_admin.php';

if(isset($_POST['submit'])){
    $title = addslashes(strip_tags(trim($_POST['title'])));
    $description = addslashes(trim($_POST['description']));
    $link = addslashes(trim($_POST['link']));
    
    //file upload first()
    $imgpath=time().$_FILES["fileToUpload"]["name"];
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/services/".$imgpath)){
      $core = core::getInstance();
      $q = 'INSERT INTO services (s_id, s_name, s_details, s_img, page_link) VALUES (NULL, :title, :description, :imgpath, :link);';
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':title',$title,PDO::PARAM_STR);
      $stmt->bindParam(':description',$description,PDO::PARAM_STR);
      $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
      $stmt->bindParam(':link',$link,PDO::PARAM_STR);
      if($stmt->execute()){
        echo'<script>alert("Service Added Successfully.");window.location.href="Services.php";</script>';
      }
      else print_r($stmt->errorInfo());
    }
}



if (isset($_GET['id'])) {
    $q = "DELETE FROM services WHERE s_id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Service deleted successfully.");window.location.href="Services.php";</script>';

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
    icons: 'material',
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
            <h1 class="h3 mb-0 text-gray-800">Add Service</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="Services.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Service Name:</label>
                  <input type="text" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                  <label for="description">Service Details:</label>
                  <textarea class="form-control" rows="4" name="description" id="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="title">Page Link:</label>
                  <input type="text" class="form-control" name="link" id="link">
                </div>
                <div class="form-group">
                  <label for="description">Service image (Any Size):</label>                            
                  <input type="file" name="fileToUpload">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Save Service</button>
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
          <h1 class="h3 mb-0 text-gray-800">All Services</h1>
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
                      <th class="text-center">Services</th>
                      <th class="text-center">Details</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Page Link</th>
                      <th class="text-center">Edit</th>
                      <th class="text-center">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                          $N = new master();
                          $r = $N->fetch_Services();
                          for($i=0;$i<sizeof($r);$i++){
                            echo '<tr>';
                              echo '<td>'.$r[$i]['id'].'</td>';
                              echo '<td>'.$r[$i]['name'].'</td>';
                              echo '<td>'.$r[$i]['details'].'</td>';
                              echo '<td><img src="uploads/services/'.$r[$i]['img'].'" class="img-thumbnail" width="200px" /></td>';
                              echo '<td>'.$r[$i]['link'].'</td>';
                              echo '<td><a href="edit_Service.php?id='.$r[$i]['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a></td>';
                              echo '<td><a href="Services.php?id='.$r[$i]['id'].'"><i class="fa fa-trash" aria-hidden="true"></i>
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
