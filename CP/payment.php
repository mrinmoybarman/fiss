<?php
include("../admin-panel/config/connect.php");
include("../admin-panel/config/class.php");

$secretKey = "6485494d6d340e4d8ea9462de8dc64f4439e92e3"; // my secret key can be found on the dashboard
$appId = '13515076ed770d036e153f4428051531'; //app id generated from the dashboard

//now we will search for the applicant with the order id;
$orderId = $_GET['orderId']; //generated from my system

$N = new master();
$r = $N->fetch_job_application_by_order_id($orderId);
for($i=0;$i<sizeof($r);$i++){
  $customerName = $r[$i]['firstname'].' '.$r[$i]['middlename'].' '.$r[$i]['lastname']; //name of the customer
  $customerPhone = $r[$i]['phone1']; //phone nymber of the customer
  $customerEmail = $r[$i]['email']; //mail of the customer
  $app_id = $r[$i]['AppId'];
}

$core = core::getInstance();
$query = "INSERT INTO `Payment_details` (`order_id`, `customer_name`, `customer_email`, `customer_phone`, `app_id`) VALUES ('$orderId', '$customerName', '$customerEmail', '$customerPhone', '$app_id');";
$stmt = $core->dbh->prepare($query);
if($stmt->execute()){
    $orderAmount = '300'; //amount to be paid 300
    $orderNote = 'Job Application Fees'; // order note 
    $returnUrl = 'https://www.fissecurity.com/CP/PaymentConformation.php'; //after completion of the payment all response will be posted to this page

    $postData = array(
        "appId" => $appId,
        "orderId" => $orderId,
        "orderAmount" => $orderAmount,
        "orderNote" => $orderNote,
        "customerName" => $customerName,
        "customerPhone" => $customerPhone,
        "customerEmail" => $customerEmail, 
        "returnUrl" => $returnUrl
    );
    // get secret key from your config
    ksort($postData);
    $signatureData = "";
    foreach ($postData as $key => $value){
      $signatureData .= $key.$value;
    }
    $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
    $signature = base64_encode($signature);
    
}
else print_r($stmt->errorInfo());


// $customerName = 'Developer Test'; //name of the customer
// $customerPhone = '8638746692'; //phone nymber of the customer
// $customerEmail = 'mrinmoybarman82@gmail.com'; //mail of the customer
// https://www.cashfree.com/checkout/post/submit
 ?>

<form id="redirectForm" method="post" action="https://www.cashfree.com/checkout/post/submit">

<!--<form id="redirectForm" method="post" action="https://test.cashfree.com/billpay/checkout/post/submit">-->
<input type="hidden" name="appId" value="<?php echo $appId ; ?>"/>
<input type="hidden" name="orderId" value="<?php echo $orderId ; ?>"/>
<input type="hidden" name="orderAmount" value="<?php echo $orderAmount ; ?>"/>
<input type="hidden" name="orderNote" value="<?php echo $orderNote ; ?>"/>
<input type="hidden" name="customerName" value="<?php echo $customerName ; ?>"/>
<input type="hidden" name="customerEmail" value="<?php echo $customerEmail ; ?>"/>
<input type="hidden" name="customerPhone" value="<?php echo $customerPhone ; ?>"/>
<input type="hidden" name="returnUrl" value="<?php echo $returnUrl ; ?>"/>
<input type="hidden" name="signature" value="<?php echo $signature; ?>"/>
</form>
<div style="display: flex;align-items: center;justify-content: center;height: 100%;width: 100%;">
<img src="https://oaec.org/wp-content/plugins/fundlycrm/assets/images/npe-redirecting.gif" style="width:80%"/>
</div>
<script>
  setTimeout(function() {
       document.forms['redirectForm'].submit();
    }, 5000);
</script>