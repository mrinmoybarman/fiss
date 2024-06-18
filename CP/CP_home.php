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
  $name = addslashes(strip_tags(trim($_POST['name'])));
  $phone = addslashes(strip_tags(trim($_POST['phone'])));
  $email = addslashes(strip_tags(trim($_POST['email'])));
  $service = addslashes(strip_tags(trim($_POST['service'])));
  $massage = addslashes(strip_tags(trim($_POST['msg'])));

  $date = date('d-m-y');

      $core = core::getInstance();
      $q = 'INSERT INTO `enquiry` (`e_id`, `e_name`, `e_mail`, `e_phone`, `e_msg`, `e_date`, `service`, `cp`, `branch`) VALUES (NULL, :name, :mail, :phone, :msg, :edate, :service, :cp, :branch);';
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':name',$name,PDO::PARAM_STR);
      $stmt->bindParam(':mail',$email,PDO::PARAM_STR);
      $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
      $stmt->bindParam(':msg',$massage,PDO::PARAM_STR);
      $stmt->bindParam(':edate',$date,PDO::PARAM_STR);
      $stmt->bindParam(':service',$service,PDO::PARAM_STR);
      $stmt->bindParam(':cp',$CP,PDO::PARAM_INT);
      $stmt->bindParam(':branch',$branch,PDO::PARAM_STR);
      if($stmt->execute()){
        echo'<script>alert("Your Request Sent Successfully");
          window.location.href="My_Clients.php";
        </script>';
      }
      else print_r($stmt->errorInfo());

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

    <div style="">
      
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

          <!-- Content Row -->
        <div class="row">

            <!-- New Queries -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Massages</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0<?php //echo $total_members;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-4x fa-envelope"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- destinations -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Clients</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php //echo '&#8377; '.number_format($wb,2); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-4x fa-picture-o"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Amount payable -->
            <!-- <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Packages</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">0 <?php //echo '&#8377;'.number_format($amount_payable,2); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-4x fa-credit-card"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
        </div>

        <hr/>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Apply New Client</h1>
          </div>

          <div class="row">

            <div class="col-md-6" style="margin:auto;background:#dce775;border-radius:5px;padding:20px;">
              <form action="CP_home.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Name:</label>
                  <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                  <label for="title">Phone Number:</label>
                  <input type="text" class="form-control" name="phone">
                </div>
                <div class="form-group">
                  <label for="title">Email:</label>
                  <input type="text" class="form-control" name="email">
                </div>
                <div class="form-group">
                  <label for="title">Select Service:</label>
                  <select type="text" class="form-control" name="service">
                    <option>Security Management Service</option>
                    <option>Housekeeping and Hospitably</option>
                    <option>Quick Response Team (CRT)</option>
                    <option>Travel Secunty Managment</option>
                    <option>Building Maintenance and Assest Management</option>
                    <option>Access Control</option>
                    <option>Guest House Management</option>
                    <option>Event Security Managment</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="title">Massege:</label>
                  <textarea class="form-control" name="msg"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Apply</button>
              </form>
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
