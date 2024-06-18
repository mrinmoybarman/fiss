<?php

include_once 'config/sessioncheck_admin.php';

if(isset($_POST['submit'])){
    $new_name = addslashes(strip_tags(trim($_POST['name'])));
    $new_email = addslashes(strip_tags(trim($_POST['email'])));
    $new_phone = addslashes(strip_tags(trim($_POST['phone'])));
    $id = addslashes(strip_tags(trim($_POST['id'])));
    $password = md5("1234");

    if($_FILES["fileToUpload"]["name"] != NULL){
      //file upload first() 
      $imgpath=time().$_FILES["fileToUpload"]["name"];
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/cphead/".$imgpath)){
        $core = core::getInstance();
        $q = "UPDATE `cphead` SET `name` = :name, `email` = :email, `phone` = :phone, `dp` = :imgpath WHERE `id` = :id";
        $stmt = $core->dbh->prepare($q);
        $stmt->bindParam(':name',$new_name,PDO::PARAM_STR);
        $stmt->bindParam(':email',$new_email,PDO::PARAM_STR);
        $stmt->bindParam(':phone',$new_phone,PDO::PARAM_STR);
        $stmt->bindParam(':imgpath',$imgpath,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute()){
          echo'<script>alert("CP Head Updated Successfully.");window.location.href="CP_Head.php";</script>';
        }
        else print_r($stmt->errorInfo());
      }  
    }
    else{
      $core = core::getInstance();
      $q = "UPDATE `cphead` SET `name` = :name, `email` = :email, `phone` = :phone WHERE `id` = :id";
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':name',$new_name,PDO::PARAM_STR);
      $stmt->bindParam(':email',$new_email,PDO::PARAM_STR);
      $stmt->bindParam(':phone',$new_phone,PDO::PARAM_STR);
      $stmt->bindParam(':id',$id,PDO::PARAM_INT);
      if($stmt->execute()){
        echo'<script>alert("CP Head Updated Successfully.");window.location.href="CP_Head.php";</script>';
      }
      else print_r($stmt->errorInfo());
    }
    
}



if (isset($_GET['id'])) {
  $N = new master();
  $id = $_GET['id'];
  $r = $N->fetch_CP_Head_By_Id($id);
  for($i=0;$i<sizeof($r);$i++){
    $name = $r[$i]['name'];
    $email = $r[$i]['email'];
    $phone = $r[$i]['phone'];
    $dp = $r[$i]['img'];
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
            <h1 class="h3 mb-0 text-gray-800">Edit CP Head</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="edit_CP_Head.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                  <label for="title">ASO Name:</label>
                  <input type="text" class="form-control" name="name" id="title" value="<?php echo $name; ?>">
                </div>
                 <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email" id="title" value="<?php echo $email; ?>">
                </div>
                 <div class="form-group">
                  <label for="title">Phone:</label>
                  <input type="text" class="form-control" name="phone" id="title" value="<?php echo $phone; ?>">
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="description">Branch Manager avatar (400px * 400px):</label>                            
                      <input type="file" name="fileToUpload">
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <img src="uploads/cphead/<?php echo $dp; ?>" style="margin:auto;max-height:200px;"/>
                  </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Update CP Head</button>
              </form>
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
