<?php
include_once 'config/sessioncheck_admin.php';


if(isset($_POST['submit'])){
  $core=core::getInstance();

//   echo $post = addslashes(strip_tags(trim($_POST['post'])));
  echo $firstname = addslashes(strip_tags(trim($_POST['fname'])));
  echo $middlename = addslashes(strip_tags(trim($_POST['mname'])));
  echo $lastname = addslashes(strip_tags(trim($_POST['lname'])));
  echo $fathersname = addslashes(strip_tags(trim($_POST['fathersname'])));
  echo $mothersname = addslashes(strip_tags(trim($_POST['mothersname'])));
  echo $gender = addslashes(strip_tags(trim($_POST['gender'])));
  echo $meritalstatus = addslashes(strip_tags(trim($_POST['mstatus'])));
  echo $dob = addslashes(strip_tags(trim($_POST['dob'])));
  
  echo $vill1 = addslashes(strip_tags(trim($_POST['village1'])));
  echo $po1 = addslashes(strip_tags(trim($_POST['postoffice1'])));
  echo $ps1 = addslashes(strip_tags(trim($_POST['policestation1'])));
  echo $dist1 = addslashes(strip_tags(trim($_POST['district1'])));
  echo $state1 = addslashes(strip_tags(trim($_POST['state1'])));
  echo $pin1 = addslashes(strip_tags(trim($_POST['pinnumber1'])));

  echo $vill2 = addslashes(strip_tags(trim($_POST['village2'])));
  echo $po2 = addslashes(strip_tags(trim($_POST['postoffice2'])));
  echo $ps2 = addslashes(strip_tags(trim($_POST['policestation2'])));
  echo $dist2 = addslashes(strip_tags(trim($_POST['district2'])));
  echo $state2 = addslashes(strip_tags(trim($_POST['state2'])));
  echo $pin2 = addslashes(strip_tags(trim($_POST['pinnumber2'])));

  echo $phone1 = addslashes(strip_tags(trim($_POST['mobile1'])));
  echo $phone2 = addslashes(strip_tags(trim($_POST['mobile2'])));
  echo $email = addslashes(strip_tags(trim($_POST['email'])));

//   echo $expected = addslashes(strip_tags(trim($_POST['Expacted'])));
//   echo $why = addslashes(strip_tags(trim($_POST['why'])));

  date_default_timezone_set('Asia/Kolkata'); 

  $date = date('d-m-y');

  if($_FILES["fileToUpload"]["name"] != NULL){

      echo $filepath=date('d-F-Y').$_FILES["fileToUpload"]["name"];
      $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
      if($ext == "PDF" || $ext == "pdf"){

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../admin-panel/uploads/cv/".$filepath)){

          $sql = "INSERT INTO `training_apply` (`id`, `postname`, `firstname`, `middlename`, `lastname`, `fathersname`, `mothersname`, `gender`, `meritalstatus`, `dob`, `vill1`, `po1`, `ps1`, `dist1`, `state1`, `pin1`, `vill2`, `po2`, `ps2`, `dist2`, `state2`, `pin2`, `phone1`, `whatsapp`, `email`, `cv`, `date`, `cp`, `expected_salery`, `why`, `branch`) VALUES (NULL, NULL, '$firstname', '$middlename', '$lastname', '$fathersname ', '$mothersname ', '$gender', '$meritalstatus', '$dob', '$vill1', '$po1', '$ps1', '$dist1', '$state1', '$pin1', '$vill2', '$po2', '$ps2', '$dist2', '$state2', '$pin2', '$phone1', '$phone2', '$email', '$filepath', '$date', 'ASO', NULL, NULL, 'HEAD');";
          

          $stmt = $core->dbh->prepare($sql);
          if($stmt->execute()){
            echo'<script>alert("You have applied Successfully !");window.location.href="job_application.php";</script>';
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
    $q = "DELETE FROM training_apply WHERE id=:p_id";
    $stmt=$core->dbh->prepare($q);
    $stmt->bindParam(':p_id',$_GET['id'],PDO::PARAM_INT);
    $stmt->execute();
    echo'<script>alert("Record deleted successfully.");window.location.href="Training.php";</script>';

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
        

        <div style="">
      
          <!-- Begin Page Content -->
          <div class="container-fluid">

                <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">All TRAINING APPLICATION</h1>
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
                          <!--<th class="text-center">CP</th>-->
                          <!--<th class="text-center">Post</th>-->
                          <th class="text-center">Name</th>
                          <th class="text-center">E-mail ID</th>
                          <th class="text-center">Phone Number</th>
                          <th class="text-center">cv</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Delete</th>
                          <!--<th class="text-center">View Details</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_training_application();
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                //   echo '<td>';
                                //   if($r[$i]['cp'] == 0){
                                //   echo 'Direct';   
                                //   }
                                //   else{
                                //       $cp_id = $r[$i]['cp'];
                                //     $q = $N->fetch_CP_by_id($cp_id);
                                //     echo $q[0]['name'];
                                //   }
                                //   echo '</td>';
                                //   echo '<td>'.$r[$i]['postname'].'</td>';
                                  echo '<td>'.$r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname'].'</td>';
                                  echo '<td>'.$r[$i]['email'].'</td>';
                                  echo '<td>'.$r[$i]['phone1'].'</td>';
                                  echo '<td><a target="_blank" href="../admin-panel/uploads/training/'.$r[$i]['cv'].'">'.$r[$i]['cv'].'</a></td>';
                                  echo '<td>'.$r[$i]['date'].'</td>';
                                  echo '<td><a href="Training.php?id='.$r[$i]['id'].'"><i class="fa fa-trash" aria-hidden="true"></i>
                                  </a></td>';
                                //   echo '<td><a target="_blank" href="view_candidate_details.php?id='.$r[$i]['id'].'"><i class="fa fa-eye" aria-hidden="true"></i>
                                //   </a></td>';
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


<script type="text/javascript">
      function same(){
        if(document.getElementById("sameAs").value === 'off'){
          var flag = document.getElementById("sameAs").value;
          console.log(flag + 'asil');
          document.getElementById("sameAs").value = 'on';
          console.log(document.getElementById("sameAs").value + 'hol');

          var vill = document.getElementById('village1').value;
          var po = document.getElementById('postoffice1').value;
          var ps = document.getElementById('policestation1').value;
          var dist = document.getElementById('district1').value;
          var state = document.getElementById('state1').value;
          var pin = document.getElementById('pinnumber1').value;

          document.getElementById('village2').value = vill;
          document.getElementById('postoffice2').value = po;
          document.getElementById('policestation2').value = ps;
          document.getElementById('district2').value = dist;
          document.getElementById('state2').value = state;
          document.getElementById('pinnumber2').value = pin;


        }
        else if(document.getElementById("sameAs").value === 'on'){
          var flag = document.getElementById("sameAs").value;
          console.log(flag + 'asil');
          document.getElementById("sameAs").value = 'off';
          console.log(document.getElementById("sameAs").value + 'hol');

          document.getElementById('village2').value = null;
          document.getElementById('postoffice2').value = null;
          document.getElementById('policestation2').value = null;
          document.getElementById('district2').value = null;
          document.getElementById('state2').value = null;
          document.getElementById('pinnumber2').value = null;
        }
        else{
          console.log('ako nohol');
        }
      }

      function samemobile(){
        if(document.getElementById("sameAsmobile").value === 'off'){
          var flag = document.getElementById("sameAsmobile").value;
          console.log(flag + 'asil');
          document.getElementById("sameAsmobile").value = 'on';
          console.log(document.getElementById("sameAsmobile").value + 'hol');

          var mob = document.getElementById('mobile1').value;
          console.log(mob);

          document.getElementById('mobile2').value = mob;
        }
        else if(document.getElementById("sameAsmobile").value === 'on'){
          var flag = document.getElementById("sameAsmobile").value;
          console.log(flag + 'asil');
          document.getElementById("sameAsmobile").value = 'off';
          console.log(document.getElementById("sameAsmobile").value + 'hol');

          document.getElementById('mobile2').value = null;
          
        }
        else{
          console.log('ako nohol');
        }
      }
    </script>


</body>

</html>
