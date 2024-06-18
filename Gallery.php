<?php
error_reporting(0);
include "admin-panel/config/connect.php";
include "admin-panel/config/class.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include 'head.php';?>      
  </head>

  <body>
  	<?php include 'navbar.php';?>
    	<div class="content">
    		<div class="container" style="margin-top:50px;min-height:70vh;">
          <div class="top-content">
            <h1>Our Gallery</h1>
            <!-- <p>Choose World Class Security Services Provide By us</p> -->
          </div>
          <div class="row">
            <div id="aniimated-thumbnials">
              <?php
                $N = new master();
                $r = $N->fetch_gallery();
                for($i=0;$i<sizeof($r);$i++){

                  echo '<a href="admin-panel/uploads/gallery/'.$r[$i]['thumbnail'].'">
                          <img class="img-thumbnail" style="width:32%;" src="admin-panel/uploads/gallery/'.$r[$i]['thumbnail'].'" />
                        </a>';
                }
              ?>
            </div>
          </div>
    		</div>

  	</div>
  	<?php include 'footer.php';?>
    <script src="assets/js/jquery.min.js"></script>
    <!--//slider-js-->
    <!-- stats number counter-->
    <script src="assets/js/light.js"></script>
    <script src="assets/js/zoom-light.js"></script>
    <script src="assets/js/full-light.js"></script>
    <script src="assets/js/thumbnails-light.js"></script>
    <script>
      $('#aniimated-thumbnials').lightGallery({
          thumbnail:true,
          animateThumb: false,
          showThumbByDefault: true
      }); 
    </script>
  </body>
  </html>