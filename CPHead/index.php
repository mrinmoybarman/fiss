<?php
include_once "../admin-panel/config/connect.php";
include_once "../admin-panel/config/class.php";

if (isset($_SESSION['CP_user_id']) && isset($_SESSION['CP_id'])) {
    header('location:CP_home.php');
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

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="../admin-panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
   <script type="text/javascript" src="../js/jquery.js"></script>

  <!-- Custom styles for this template-->
  <link href="../admin-panel/css/sb-admin-2.min.css" rel="stylesheet">
  <style>
	.bg-login-image {
		background: url(../admin-panel/img/rhino.jpg);
		background-position: left;
		background-size: cover;
	}
  </style>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back CP Head !</h1>
                  </div>
                  <form method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="user_id" placeholder="Enter User ID">
                    </div>
                    <div class="form-group">
                      <input type="password" name="pwd" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    
					<button type="submit" name="login" class="btn btn-primary btn-user btn-block" id="login">Login</button>

                  </form>
                  <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../admin-panel/vendor/jquery/jquery.min.js"></script>
  <script src="../admin-panel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../admin-panel/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../admin-panel/js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
            $( "form" ).on( "submit", function( event ) {
              event.preventDefault();
              $.ajax({
                beforeSend:function() {
                  $("#login").html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
                },
                complete:function(){
                $("#login").remove();
                },
                type:'POST',
                url:'CPHead_login_check.php',
                data:$( this ).serialize(),
                success:function(d){
                  if(d==0) {alert("Invalid user id/password");window.location.href="index.php";}
                  else if(d==1) window.location.href="CPHead_home.php";
                }
              });

            });
  </script>

</body>

</html>