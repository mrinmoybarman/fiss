<?php
if(isset($_POST['submit'])){
  include("admin-panel/config/connect.php");
  include("admin-panel/config/class.php");
  $core=core::getInstance();

  $post = addslashes(strip_tags(trim($_POST['post'])));
  $firstname = addslashes(strip_tags(trim($_POST['fname'])));
  $middlename = addslashes(strip_tags(trim($_POST['mname'])));
  $lastname = addslashes(strip_tags(trim($_POST['lname'])));
  $fathersname = addslashes(strip_tags(trim($_POST['fathersname'])));
  $mothersname = addslashes(strip_tags(trim($_POST['mothersname'])));
  $gender = addslashes(strip_tags(trim($_POST['gender'])));
  $meritalstatus = addslashes(strip_tags(trim($_POST['mstatus'])));
  $dob = addslashes(strip_tags(trim($_POST['dob'])));
  
  $vill1 = addslashes(strip_tags(trim($_POST['village1'])));
  $po1 = addslashes(strip_tags(trim($_POST['postoffice1'])));
  $ps1 = addslashes(strip_tags(trim($_POST['policestation1'])));
  $dist1 = addslashes(strip_tags(trim($_POST['district1'])));
  $state1 = addslashes(strip_tags(trim($_POST['state1'])));
  $pin1 = addslashes(strip_tags(trim($_POST['pinnumber1'])));

  $vill2 = addslashes(strip_tags(trim($_POST['village2'])));
  $po2 = addslashes(strip_tags(trim($_POST['postoffice2'])));
  $ps2 = addslashes(strip_tags(trim($_POST['policestation2'])));
  $dist2 = addslashes(strip_tags(trim($_POST['district2'])));
  $state2 = addslashes(strip_tags(trim($_POST['state2'])));
  $pin2 = addslashes(strip_tags(trim($_POST['pinnumber2'])));

  $phone1 = addslashes(strip_tags(trim($_POST['mobile1'])));
  $phone2 = addslashes(strip_tags(trim($_POST['mobile2'])));
  $email = addslashes(strip_tags(trim($_POST['email'])));

  $expected = addslashes(strip_tags(trim($_POST['Expacted'])));
  $why = addslashes(strip_tags(trim($_POST['why'])));

  date_default_timezone_set('Asia/Kolkata'); 

  //generating application number
  $part1 = date('s');
  $part2 = substr($phone1, -3);
  $part3 = date('y');
  $app_id = $part1.$part2.$part3.rand(000,999);

  $date = date('d-m-y');
  
  $t=time();
  $orderId = md5(($t.'8638746692'));

  if($_FILES["fileToUpload"]["name"] != NULL){

      $filepath=date('d-F-Y').$_FILES["fileToUpload"]["name"];
      $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
      if($ext == "PDF" || $ext == "pdf" || $ext == "jpg" || $ext == "JPG" || $ext == "jpeg" || $ext == "JPEG" || $ext == "PNG" || $ext == "png"){

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"admin-panel/uploads/cv/".$filepath)){

          $sql = "INSERT INTO `jobapply` (`id`, `postname`, `firstname`, `middlename`, `lastname`, `fathersname`, `mothersname`, `gender`, `meritalstatus`, `dob`, `vill1`, `po1`, `ps1`, `dist1`, `state1`, `pin1`, `vill2`, `po2`, `ps2`, `dist2`, `state2`, `pin2`, `phone1`, `whatsapp`, `email`, `cv`, `date`, `expected_salery`, `why`, `order_id`, `app_id`) VALUES (NULL, '$post', '$firstname', '$middlename', '$lastname', '$fathersname ', '$mothersname ', '$gender', '$meritalstatus', '$dob', '$vill1', '$po1', '$ps1', '$dist1', '$state1', '$pin1', '$vill2', '$po2', '$ps2', '$dist2', '$state2', '$pin2', '$phone1', '$phone2', '$email', '$filepath', '$date', '$expected', '$why', '$orderId', '$app_id');";



          $stmt = $core->dbh->prepare($sql);
          if($stmt->execute()){
            // echo'<script>alert("You have applied Successfully. Proceed to Payment . . .");window.location.href="payment.php?orderId='.$orderId.'";</script>';
            echo'<script>alert("You have applied Successfully.");window.location.href="index.php";</script>';
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
?>
<!DOCTYPE html>
<html>
<?php include 'head.php';?>
  <head>
  	<?php include 'navbar.php';?>
    <div class="content">
    		<div class="container" style="margin-bottom: 50px;margin-top:50px;">
          <div class="top-content">
            <h1>Apply Now</h1>
            <h4><i>Please Fill Up The Form To Continue</i></h4>
          </div>
          <form method="POST" action="job_apply.php" enctype="multipart/form-data">
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
            <div class="form-group">
              <label for="fileToUpload">Select document ( pdf/jpeg Format ):</label>                            
              <input type="file" name="fileToUpload" accept=".pdf,.PDF,.JPEG,.jpeg,.JPG,.jpg,.PNG,.png" required/>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
      	</div>
  	</div>
  	<?php include 'footer.php';?>
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
    <script>
      function addeducation(){
        var i= 0;
        alert(i);
        i++;
        alert(i);
      }
    </script>
  </head>