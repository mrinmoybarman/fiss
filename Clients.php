<?php
error_reporting(0);
include "admin-panel/config/connect.php";
include "admin-panel/config/class.php";
?>
<!DOCTYPE html>
<html>
<?php include 'head.php';?>
  <head>
  	<?php include 'navbar.php';?>
    	<div class="content">
    		<div class="container" style="margin-top:50px;min-height:70vh;">
          <div class="top-content" style="margin:20px 0 ;">
            <h1>Our Clients</h1>
            <!-- <p>Choose World Class Security Services Provide By us</p> -->
          </div>
          <div class="row" style="margin-bottom:30px;">
            <div class="owl-carousel owl-theme">
<?php
  $N = new master();
  $r = $N->fetch_clients();
  for($i=0;$i<sizeof($r);$i++){
?>              
              <div class="item" style="height:200px;"> 
                <img src="admin-panel/uploads/client/<?php echo $r[$i]['thumbnail']?>" class="img-responsive" style="margin:auto;height:100px;width:auto;"/>
                <h2 class="text-center" style="margin:20px 0;font-size:20px;"><?php echo $r[$i]['name']; ?></h2>  
              </div>
<?php 
  }
?>
            </div>
          </div>
    		</div>

  	</div>
  	<?php include 'footer.php';?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/owl.carousel.js"></script>
    <script>
    $('.owl-carousel').owlCarousel({
    // loop:true,
    margin:20,
    nav:true,
    dots:true,
    lpop:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
      }
    })
  </script>
  </head>
</html>