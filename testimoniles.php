		<div class="con-in">
			<div class="container">
				<div class="wmuSlider example1">
					<div class="wmuSliderWrapper">
<?php
  error_reporting(0);
  include_once'admin-panel/config/connect.php';
  include_once'admin-panel/config/class.php';
  $N = new master();
  $r = $N->fetch_Testimoniels();
  for($i=0;$i<sizeof($r);$i++){
?>
						<article class="testimoniel-item">
							<div class=" item-in">
							        <img src="admin-panel/uploads/testimoniels/<?php echo $r[$i]['img']?>" class="test-img"/>
							    
								<p><?php echo $r[$i]['details'];?></p>
								<br/><h6><?php echo $r[$i]['name']; ?></h6>
								<span><?php echo $r[$i]['position']; ?></span>
							</div>	
						</article>
<?php
}
?>
						
					</div>
					<ul class="wmuSliderPagination">
<?php
for($i=0;$i<sizeof($r);$i++){
?>
						<li><a href="#" class=""><?php echo $i;?></a></li>
<?php } ?>
					</ul>
				</div>
				<script src="js/jquery.wmuSlider.js"></script> 
				<script>
					$('.example1').wmuSlider();         
				</script> 	           	         

				<!---->

				
			</div>
		</div>