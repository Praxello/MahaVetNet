<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
extract($_POST);
$response = null;
if(isset($_POST['branchId']) && isset($_POST['center']) && isset($_POST['mobile'])){
   $email_to = "vikaspawar3110@gmail.com";

   $name = $_POST['center']; // required
   $email_from = 'support@mahavetnet.com'; // required
   $branchid = $_POST['branchId']; // required
   $email_subject = 'Change VD Details';
 
   $email_message = "<b>Details of VD:</b><br><br>";

   $email_message .= "Center: ".$name."<br>";
   $email_message .= "BranchId: ".$branchid."<br>";
   $email_message .= "Mobile Number: ".$mobile."<br>";

// create email headers
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'Cc:sunnypinjanpatil@gmail.com,'."\r\n";
$headers .= 'Cc:sunny.pinjan@praxello.com,'."\r\n";
$headers .= 'Cc:pvn2266@gmail.com,'."\r\n";
$headers .= "From:".$email_from."\r\n";
//$headers = 'From: '.$email_to."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();
if(@mail($email_to, $email_subject, $email_message, $headers)){
   $response = array('Message' => "Thank You for contact us.", 'Responsecode' => 200);
  }else{
   $response = array('Message' => "Mail is not send", 'Responsecode' => 200); 
  }
}
else{
   $response = array('Message' => "Parameter Missing", 'Responsecode' => 401); 
}  
exit(json_encode($response));
?>
