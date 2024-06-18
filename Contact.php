<?php
if(isset($_POST['submit'])){
  $name = addslashes(strip_tags(trim($_POST['name'])));
  $phone = addslashes(strip_tags(trim($_POST['phone'])));
  $email = addslashes(strip_tags(trim($_POST['email'])));
  $service = addslashes(strip_tags(trim($_POST['service'])));
  $massage = addslashes(strip_tags(trim($_POST['msg'])));

  $date = date('d-m-y');

  include_once 'admin-panel/config/connect.php';

      $core = core::getInstance();
      $q = 'INSERT INTO `enquiry` (`e_id`, `e_name`, `e_mail`, `e_phone`, `e_msg`, `e_date`, `service`) VALUES (NULL, :name, :mail, :phone, :msg, :edate, :service);';
      $stmt = $core->dbh->prepare($q);
      $stmt->bindParam(':name',$name,PDO::PARAM_STR);
      $stmt->bindParam(':mail',$email,PDO::PARAM_STR);
      $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
      $stmt->bindParam(':msg',$massage,PDO::PARAM_STR);
      $stmt->bindParam(':edate',$date,PDO::PARAM_STR);
      $stmt->bindParam(':service',$service,PDO::PARAM_STR);
      if($stmt->execute()){
        echo'<script>alert("Your Request Sent Successfully");
        </script>';
      }
      else print_r($stmt->errorInfo());

}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php';?>
  <head>
  	<?php include 'navbar.php';?>
    	<div class="content">
    		<div class="container">
          

<div class="contact">
    <div class="container">
      <div class="contact-top">
        <h1>Contact</h1>
      </div>
      <div class="contact-form">
        <div class="col-md-8 contact-grid">
          <form action="Contact.php" method="post">  
            <input type="text" placeholder="Name" name="name" required/>
            <input type="text" placeholder="Phone Number" name="phone" required/>
            <input type="text" placeholder="Email" name="email" required>
            <select style="width: 100%;padding: 1em;margin: 0.5em 0;background: none;outline: none;border: 1px solid #A09F9F;font-size: 1em;color: #A09F9F;" name="service">
              <option>Security Management Service</option>
              <option>Housekeeping and Hospitably</option>
              <option>Quick Response Team (CRT)</option>
              <option>Travel Secunty Managment</option>
              <option>Building Maintenance and Assest Management</option>
              <option>Access Control</option>
              <option>Guest House Management</option>
              <option>Event Security Managment</option>
            </input>
            <textarea cols="77" rows="3" name="msg">Message</textarea>
            <div class="send">
              <input type="submit" value="Send" name="submit">
            </div>
          </form>
        </div>
        <div class="col-md-4 contact-in">
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37494223.23909492!2d103!3d55!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x453c569a896724fb%3A0x1409fdf86611f613!2sRussia!5e0!3m2!1sen!2sin!4v1415776049771"></iframe>
          </div>
          <div class="address-more">
            
            <h4>Address</h4>
            <p>Office address: Kahilipara,Guwahati-19 (Assam)</p>
            <p>H.O.: Bhalukdubi,goalpara-783101(Assam)</p>
            <p>Contact No.: +91 9101704380,+91 9435058369,<br/>+91 9854050595</p>
            <p>Email:<a href="mailto:fss.grdaply101@gmail.com"> fss.grdaply101@gmail.com</a></p>
          </div>
          
        </div>
        
        
        <div class="clearfix"> </div>
      </div>
      
    </div>
  </div>

    		</div>
      
  	</div>
  	<?php include 'footer.php';?>
    
  </head>