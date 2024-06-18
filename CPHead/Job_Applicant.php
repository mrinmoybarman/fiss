<?php
include_once('../admin-panel/config/sessioncheck_cphead.php');
include_once 'CPHead_Class.php';
$user_cp = $_SESSION['CPHead_user_id'];
$N = new master();
$r = $N->find_CP_ID($user_cp);
for($i=0;$i<sizeof($r);$i++){
  $CP = $r[$i]['id'];
  $branch = $r[$i]['branch'];
}

// if(isset($_POST['submit'])){
//   $core=core::getInstance();

//   echo $post = addslashes(strip_tags(trim($_POST['post'])));
//   echo $firstname = addslashes(strip_tags(trim($_POST['fname'])));
//   echo $middlename = addslashes(strip_tags(trim($_POST['mname'])));
//   echo $lastname = addslashes(strip_tags(trim($_POST['lname'])));
//   echo $fathersname = addslashes(strip_tags(trim($_POST['fathersname'])));
//   echo $mothersname = addslashes(strip_tags(trim($_POST['mothersname'])));
//   echo $gender = addslashes(strip_tags(trim($_POST['gender'])));
//   echo $meritalstatus = addslashes(strip_tags(trim($_POST['mstatus'])));
//   echo $dob = addslashes(strip_tags(trim($_POST['dob'])));
  
//   echo $vill1 = addslashes(strip_tags(trim($_POST['village1'])));
//   echo $po1 = addslashes(strip_tags(trim($_POST['postoffice1'])));
//   echo $ps1 = addslashes(strip_tags(trim($_POST['policestation1'])));
//   echo $dist1 = addslashes(strip_tags(trim($_POST['district1'])));
//   echo $state1 = addslashes(strip_tags(trim($_POST['state1'])));
//   echo $pin1 = addslashes(strip_tags(trim($_POST['pinnumber1'])));

//   echo $vill2 = addslashes(strip_tags(trim($_POST['village2'])));
//   echo $po2 = addslashes(strip_tags(trim($_POST['postoffice2'])));
//   echo $ps2 = addslashes(strip_tags(trim($_POST['policestation2'])));
//   echo $dist2 = addslashes(strip_tags(trim($_POST['district2'])));
//   echo $state2 = addslashes(strip_tags(trim($_POST['state2'])));
//   echo $pin2 = addslashes(strip_tags(trim($_POST['pinnumber2'])));

//   echo $phone1 = addslashes(strip_tags(trim($_POST['mobile1'])));
//   echo $phone2 = addslashes(strip_tags(trim($_POST['mobile2'])));
//   echo $email = addslashes(strip_tags(trim($_POST['email'])));

//   echo $expected = addslashes(strip_tags(trim($_POST['Expacted'])));
//   echo $why = addslashes(strip_tags(trim($_POST['why'])));

//   date_default_timezone_set('Asia/Kolkata'); 

//   $date = date('d-m-y');

//   if($_FILES["fileToUpload"]["name"] != NULL){

//       echo $filepath=date('d-F-Y').$_FILES["fileToUpload"]["name"];
//       $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
//       if($ext == "PDF" || $ext == "pdf"){

//         if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../admin-panel/uploads/cv/".$filepath)){

//           $sql = "INSERT INTO `jobapply` (`id`, `postname`, `firstname`, `middlename`, `lastname`, `fathersname`, `mothersname`, `gender`, `meritalstatus`, `dob`, `vill1`, `po1`, `ps1`, `dist1`, `state1`, `pin1`, `vill2`, `po2`, `ps2`, `dist2`, `state2`, `pin2`, `phone1`, `whatsapp`, `email`, `cv`, `date`, `cp`, `expected_salery`, `why`, `branch`) VALUES (NULL, '$post', '$firstname', '$middlename', '$lastname', '$fathersname ', '$mothersname ', '$gender', '$meritalstatus', '$dob', '$vill1', '$po1', '$ps1', '$dist1', '$state1', '$pin1', '$vill2', '$po2', '$ps2', '$dist2', '$state2', '$pin2', '$phone1', '$phone2', '$email', '$filepath', '$date', '$CP', '$expected', '$why', '$branch');";
          

//           $stmt = $core->dbh->prepare($sql);
//           if($stmt->execute()){
//             echo'<script>alert("You have applied Successfully !");window.location.href="My_Job_Applicant.php";</script>';
//           }
//           else print_r($stmt->errorInfo());

//         }
//         else{
//           echo'<script>alert("Error Uploading File !");</script>';
//         }
//       }
//       else{
//         echo'<script>alert("Please Select a Valid File !");</script>';
//       }
//   }
//   else{
//     echo'<script>alert("Please Select a File !");</script>';
//   }

// }
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
      
       
        <!-- <!-- Begin Page Content --
        <div class="container-fluid">

          <!-- Page Heading --
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Apply New Job Applicant</h1>
          </div>

          <div class="row">

            <div class="col-md-10" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form method="POST" action="My_Job_Applicant.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="selectpost">Select Post</label>
              <select class="form-control"  aria-describedby="Select Post" name="post">
                <option value="">Select Post</option>
                <option value="Security Guard">Security Guard</option>
                <option value="House Keeping">House Keeping</option>
                <option value="Hospitality">Hospitality</option>
                <option value="Bouncer">Bouncer</option>
              </select>
              <small class="form-text text-muted">Select Post That you are applied for.</small>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" name="fname" aria-describedby="firstname" placeholder="Enter First Name" required/>
                  <small class="form-text text-muted">Enter First Name</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="middlename">Middle Name</label>
                  <input type="text" class="form-control"  name="mname" aria-describedby="middlename" placeholder="Enter Middle Name">
                  <small class="form-text text-muted">Enter Middle Name</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="lname" class="form-control" aria-describedby="lastname" placeholder="Enter Last Name" required/>
                  <small id="emailHelp" class="form-text text-muted">Enter Last Name</small>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="fathersname">Fathers Name</label>
              <input type="text" class="form-control" aria-describedby="fathersname" name="fathersname" placeholder="Enter Fathers Name">
              <small class="form-text text-muted">Enter Father's Name</small>
            </div>

            <div class="form-group">
              <label for="fathersname">Mothers Name</label>
              <input type="text" class="form-control" aria-describedby="mothersname" name="mothersname" placeholder="Enter Mothers Name">
              <small class="form-text text-muted">Enter Mothers Name</small>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Select Gender</label>
                  <select class="form-control"  aria-describedby="Select Post" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <small class="form-text text-muted">Select Gender</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">Select Marrital Status</label>
                  <select class="form-control"  aria-describedby="Select Post" name="mstatus" required>
                    <option value="">Select Marrital Status</option>
                    <option value="Married">Married</option>
                    <option value="Unmarried">Unmarried</option>
                  </select>
                  <small class="form-text text-muted">Select Marrital Status</small>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="dob">Date Of Birth</label>
              <input type="date" class="form-control" aria-describedby="dob" name="dob" required/>
              <small class="form-text text-muted">Select Date Of Birth</small>
            </div>

            <h4>Present Address</h4>
            <hr/>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dob">Village</label>
                  <input type="text" class="form-control" aria-describedby="village" name="village1" id="village1" required/>
                  <small class="form-text text-muted">Enter Your Village</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">Post Office</label>
                  <input type="text" class="form-control" aria-describedby="postoffice" name="postoffice1" id="postoffice1" required/>
                  <small class="form-text text-muted">Enter Your Post Office</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">Police Station</label>
                  <input type="text" class="form-control" aria-describedby="policestation" name="policestation1" id="policestation1"  required/>
                  <small class="form-text text-muted">Enter Your Police Station</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">District</label>
                  <input type="text" class="form-control" aria-describedby="district" name="district1" id="district1" required/>
                  <small class="form-text text-muted">Enter Your District</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">State</label>
                  <input type="text" class="form-control" aria-describedby="state" name="state1" id="state1" required/>
                  <small class="form-text text-muted">Enter Your State</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">PIN Number</label>
                  <input type="text" class="form-control" aria-describedby="pinnumber" name="pinnumber1" id="pinnumber1" required/>
                  <small class="form-text text-muted">Enter Your Pin Number</small>
                </div>
              </div>
            </div>

            <h4>Parmanent Address</h4>
            <p><input type="checkbox" id="sameAs" onclick="same()" value="off"/> <strong>Same As Present Address</strong></p>
            <hr/>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="dob">Village</label>
                  <input type="text" class="form-control" aria-describedby="village" name="village2" id="village2" required/>
                  <small class="form-text text-muted">Enter Your Village</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">Post Office</label>
                  <input type="text" class="form-control" aria-describedby="postoffice" name="postoffice2" id="postoffice2" required/>
                  <small class="form-text text-muted">Enter Your Post Office</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">Police Station</label>
                  <input type="text" class="form-control" aria-describedby="policestation" name="policestation2" id="policestation2" required/>
                  <small class="form-text text-muted">Enter Your Police Station</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">District</label>
                  <input type="text" class="form-control" aria-describedby="district" name="district2" id="district2" required/>
                  <small class="form-text text-muted">Enter Your District</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">State</label>
                  <input type="text" class="form-control" aria-describedby="state" name="state2" id="state2" required/>
                  <small class="form-text text-muted">Enter Your State</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="dob">PIN Number</label>
                  <input type="text" id="pinnumber2" class="form-control" aria-describedby="pinnumber" name="pinnumber2" required/>
                  <small class="form-text text-muted">Enter Your Pin Number</small>
                </div>
              </div>
            </div>
            <hr/>

            <h4>Contact Details</h4>
            <hr/>
            <div class="row">
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="mobile">Mobile Number</label>
                  <input type="text" id="mobile1" class="form-control" aria-describedby="mobilenumber" name="mobile1"  id="mobile1" required/>
                  <small class="form-text text-muted">Enter Your Mobile Number</small>
                </div>
              </div>
              <div class="col-md-6">            
                <div class="form-group">
                  <label for="mobile">Whatsapp Number  &nbsp;&nbsp;&nbsp;&nbsp;<input style="margin-left:40px;"type="checkbox" id="sameAsmobile" onclick="samemobile()" value="off"/> <strong>Same As Mobile Number</strong></label>
                  <input type="text" class="form-control" aria-describedby="mobilenumber" name="mobile2" id="mobile2" required/>
                  <small class="form-text text-muted">Enter Your Whatsapp Number</small>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mobile">E-mail Id</label>
              <input type="email"  class="form-control" aria-describedby="emailid" name="email" required/>
              <small class="form-text text-muted">Enter Your Email ID</small>
            </div>
            <hr/>
            <h4>Salary Details</h4>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fileToUpload">Expacted Salary</label>                            
                  <input type="text" class="form-control" name="Expacted" required/>
                </div>    
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fileToUpload">Describe Why ?</label>                            
                  <textarea name="why" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <hr/>

            <h4>Upload CV</h4>
            <hr/>
            <div class="form-group">
              <label for="fileToUpload">Select document ( pdf Format ):</label>                            
              <input type="file" name="fileToUpload" required/>
            </div>
            <hr/>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
            </div>

          </div>
        
        </div> -->

        <div style="">
      
          <!-- Begin Page Content -->
          <div class="container-fluid">

                <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">My JOB APPLICATION </h1>
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
                          <th class="text-center">Post</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">E-mail ID</th>
                          <th class="text-center">Phone Number</th>
                          <th class="text-center">cv</th>
                          <th class="text-center">Date</th>
                          <th class="text-center">Delete</th>
                          <th class="text-center">View Details</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                              $N = new master();
                              $r = $N->fetch_job_application();
                              for($i=0;$i<sizeof($r);$i++){
                                echo '<tr>';
                                  $j = $i+1;
                                  echo '<td>'.$j.'</td>';
                                  echo '<td>'.$r[$i]['postname'].'</td>';
                                  echo '<td>'.$r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname'].'</td>';
                                  echo '<td>'.$r[$i]['email'].'</td>';
                                  echo '<td>'.$r[$i]['phone1'].'</td>';
                                  echo '<td><a target="_blank" href="uploads/cv/'.$r[$i]['cv'].'">'.$r[$i]['cv'].'</a></td>';
                                  echo '<td>'.$r[$i]['date'].'</td>';
                                  echo '<td><a href="job_application.php?id='.$r[$i]['id'].'"><i class="fa fa-trash" aria-hidden="true"></i>
                                  </a></td>';
                                  echo '<td><a target="_blank" href="view_candidate_details.php?id='.$r[$i]['id'].'"><i class="fa fa-eye" aria-hidden="true"></i>
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
