<?php
error_reporting(1);
session_start();
require 'vendor/autoload.php';
require '_library_/_includes_/config.php';
$login=new _classes_\Login();
$sms=new _classes_\smsgetway();

$payment_type_input=$_POST['paymentType'];
$amt_input=$_POST['amt'];
$date=$_POST['date'];
$giving_number=$_POST['giving_number'];
$m_id=!empty($_POST['m_id']) ? trim($_POST['m_id']) :"";

$entered_by_username=$_SESSION[ID] ;
 




if(count($payment_type_input)!=count($amt_input) && count($payment_type_input)!=count($year_input)){
  $payment_request['status']="error";
  $payment_request['message']="Please fill in all portions of the form!!";
    ajaxCompleteAndExit($payment_request,"make_general_payment.php");
}


$get_payment_type_query =$sql->Prepare("SELECT * FROM perez_church_payment_type_info ORDER by payment_type_name  ASC");
$get_payment_type_result = $sql->Execute($get_payment_type_query);
if ($get_payment_type_result) {

  while ($get_payment_type_row = $get_payment_type_result->FetchRow()) {
    $payment_types[$get_payment_type_row['payment_type_name']] = $get_payment_type_row['payment_type_name'];
  }
}


$counter=count($payment_type_input);

for($i=0;$i<$counter;$i++){
    $event="General Payments";
$activity="$_SESSION[USERNAME] has received GHC$amt_input[$i] from $_POST[name]";
$hashkey = $_SERVER['HTTP_HOST'];
$remoteip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$mac = $login->getMac();
$sessionId = session_id();
$stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                $sql->Execute($stmt);

  $insert_new_payment_individual=$sql->Prepare("INSERT INTO perez_church_payments(giving_number,payment_status,payment_name,amount,date,entered_by_username,member) VALUES('$giving_number','enabled','$payment_type_input[$i]','$amt_input[$i]',CURDATE(),'$entered_by_username','$m_id') ");
  print_r($insert_new_payment_individual);   
  $insert_new_payment_result= $sql->Execute($insert_new_payment_individual);
     if(!$insert_new_payment_result){
        $insert_new_payment_errors['payment_type'][]=$payment_type_input[$i];
        $insert_new_payment_errors['payment_form_name'][]=$payment_types[$payment_type_input[$i]];
        $insert_new_payment_errors['payment_amount'][]=$amt_input[$i];
         // $query_list[]= $insert_new_payment_individual;

     }


      if($insert_new_payment_result){
        $insert_new_payment_success['payment_type'][]=$payment_type_input[$i];
        $insert_new_payment_success['payment_form_name'][]=$payment_types[$payment_type_input[$i]];
        $insert_new_payment_success['payment_amount'][]=$amt_input[$i];
          //$query_list[]= $insert_new_payment_individual;
     }
}

if(isset($insert_new_payment_errors) && !empty($insert_new_payment_errors)){
   $processed_Request['status']="error";
   $error_count=count($insert_new_payment_errors['payment_amount']);
   
   $processed_Request['message'][]="Error Saving the Following Payment(s) <br/>";

   for($i=0;$i<$error_count;$i++){
   $error_msg="[Type] : ".$insert_new_payment_errors['payment_type_name'][$i]." ";
   $error_msg.="[Amount] : ".$insert_new_payment_errors['payment_amount'][$i]." ";
   
   $processed_Request['message'][]=$error_msg;
  $_SESSION['message']=$processed_Request;
 }

 if(isset($insert_new_payment_success) && !empty($insert_new_payment_success)){

   $success_count=count($insert_new_payment_success['payment_amount']);
   $processed_Request['message'][]="**----------------------------------------**";
   $processed_Request['message'][]="<br/>Successfully Saved the Following Payment(s) <br/>";

   for($i=0;$i<$success_count;$i++){
   $success_msg="[Type] : ".$insert_new_payment_success['payment_form_type'][$i]." ";
   $success_msg.="[Amount] : ".$insert_new_payment_success['payment_amount'][$i]." ";
   
   $processed_Request['message'][]=$success_msg;
  $_SESSION['message']=$processed_Request;
 }
   
 }
 
}


if(!isset($insert_new_payment_errors) && empty($insert_new_payment_errors) && !empty($insert_new_payment_success)){
   $processed_Request['status']="success";
   $success_count=count($insert_new_payment_success['payment_amount']);
   
   $processed_Request['message'][]="Successfully Saved the Following Payment(s) <br/>";

   $amount_paid=0;
   for($i=0;$i<$success_count;$i++){
   $success_msg="[Type] : ".$insert_new_payment_success['payment_form_name'][$i]." ";
   $success_msg.="[Amount] : ".$insert_new_payment_success['payment_amount'][$i]." ";
   $success_msg.="[Month] : ".$insert_new_payment_success['payment_month'][$i]." <br/>";
   $amount_paid+=$insert_new_payment_success['payment_amount'][$i];
   $processed_Request['message'][]=$success_msg;
  $_SESSION['message']=$processed_Request;
 }
      
}


  function ajaxCompleteAndExit($status,$exit_location){
    //function for essentially exiting after all actions in this page have been completed
    //takes a status type, a message and a location
    if(!empty($_POST['requestType']) && $_POST['requestType']=='ajax'){
      //echo '{"status":"'.$status.'","message":"'.$message.'"}';
      echo json_encode($status);
      exit;
    }
    else {      
      header("Location: '$exit_location'");
      echo '<script>Window.location.href="members.php" </script>';
      exit;
    }
  }

?>
