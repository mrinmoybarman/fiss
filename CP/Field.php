<?php
include_once('../admin-panel/config/sessioncheck_CP.php');
include_once 'CP_Class.php';
$user_cp = $_SESSION['CP_user_id'];
$N = new master();
$r = $N->find_CP_ID($user_cp);
for($i=0;$i<sizeof($r);$i++){
  $CP = $r[$i]['id'];
  $branch = $r[$i]['branch'];
}

if(isset($_POST['submit'])){
  $core=core::getInstance();

  $ins = addslashes(strip_tags(trim($_POST['ins'])));
  $person = addslashes(strip_tags(trim($_POST['person'])));
  $loc = addslashes(strip_tags(trim($_POST['location'])));
  $remarks = addslashes(strip_tags(trim($_POST['remarks'])));
  $date = addslashes(strip_tags(trim($_POST['date'])));
 
  date_default_timezone_set('Asia/Kolkata'); 

  $date = date('d-m-y');


   if($_FILES["fileToUpload"]["name"] != NULL){

      $filepath=date('d-F-Y').$_FILES["fileToUpload"]["name"];
      $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
      if($ext == "JPG" || $ext == "jpg" || $ext == "jpeg" || $ext == "JPEG"){

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../admin-panel/uploads/field/".$filepath)){


          $sql = "INSERT INTO `field_visit` (`id`, `institution`, `person`, `location`, `date`, `photo`, `cp_id`) VALUES (NULL, '$ins', '$person', '$loc', '$date', '$filepath', '$CP');";
                  
          $stmt = $core->dbh->prepare($sql);
          if($stmt->execute()){
            echo'<script>alert("Record Saved Successfully !");window.location.href="Field.php";</script>';
          }
          else print_r($stmt->errorInfo());

        }
        else{
          echo'<script>alert("Error Uploading File !");</script>';
        }
      }
      else{
        echo'<script>alert("Please Select a Valid File !");</script>';
      }
  }
  else{
    echo'<script>alert("Please Select a File !");</script>';
  }
}

if (isset($_GET['id'])) {
    $q = "DELETE FROM field_visit WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Record deleted successfully.");window.location.href="Field.php";</script>';
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
            <h1 class="h3 mb-0 text-gray-800">Add New Visit</h1>
          </div>

          <div class="row">           
            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form method="POST" action="Field.php" enctype="multipart/form-data">
              
                <div class="form-group">
                  <label for="title">Name of the Institution :</label>
                  <input type="text" class="form-control" name="ins">
                </div>

                <div class="form-group">
                  <label for="title">Name of the Concerned Person :</label>
                  <input type="text" class="form-control" name="person">
                </div>

                <div class="form-group">
                  <label for="title">Location :</label>
                  <input type="text" class="form-control" name="location">
                </div>

                <div class="form-group">
                  <label for="title">Date Visited :</label>
                  <input type="date" class="form-control" name="remarks">
                </div>

                <div class="form-group">
                  <label for="title">Remarks :</label>
                  <input type="text" class="form-control" name="date">
                </div>

                <h4>Upload Photo</h4>
                <hr/>
                <div class="form-group">
                  <label for="fileToUpload">Select Photo ( Only jpg Format ):</label>                            
                  <input type="file" name="fileToUpload" accept="image/JPG, image/JPEG, image/jpg, image/jpeg" required/>
                </div>
                <hr/>
              
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
            </div>

          </div>
        
        </div>
        <hr/>

        <div style="">
      
          <!-- Begin Page Content -->
          <div class="container-fluid">

                <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Field Visit History</h1>
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
                          <th class="text-center">Institution</th>
                          <th class="text-center">Person</th>
                          <th class="text-center">Location</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">photo</th>
                          <!-- <th class="text-center">Edit</th> -->
                          <th class="text-center">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_FiledVisit_by_cp_id($_SESSION['CP_id']);
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                  echo '<td>'.$r[$i]['institution'].'</td>';
                                  echo '<td>'.$r[$i]['person'].'</td>';
                                  echo '<td>'.$r[$i]['location'].'</td>';
                                  echo '<td>'.$r[$i]['date'].'</td>';
                                  echo '<td><img src="../admin-panel/uploads/field/'.$r[$i]['photo'].'" style="max-height:100px;"/></td>';
                                  // echo '<td><a href="edit_Field.php?id='.$r[$i]['id'].'">Edit &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
                                  echo '<td><a href="Field.php?id='.$r[$i]['id'].'">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></a></td>';
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
function update_product(id,p_name,price,bv){
    $("#p_id").val(id);
    $("#p_name").val(p_name);
    $("#price").val(price);
    $("#bv").val(bv);
    $("#submit_id").hide();
    $("#update_id").show();

}


function printdiv() {

var printContents = document.getElementById('printit').innerHTML;
var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;

window.print();
document.body.innerHTML = originalContents;

} 

function fnExcelReport()
{
var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
var textRange; var j=0;
tab = document.getElementById('myTable'); // id of table

for(j = 0 ; j < tab.rows.length ; j++) 
{     
tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
//tab_text=tab_text+"</tr>";
}

tab_text=tab_text+"</table>";
tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE "); 

if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
{
txtArea1.document.open("txt/html","replace");
txtArea1.document.write(tab_text);
txtArea1.document.close();
txtArea1.focus(); 
sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
}  
else                 //other browser not tested on IE 11
sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

return (sa);
}
</script>
</body>

</html>
