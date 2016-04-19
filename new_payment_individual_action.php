<?php
session_start();
 require '_library_/_includes_/config.php';


// 	$str = 'ministers_appreciation_retirement_amount';
// 	$chars = explode('_', $str,-1);
// 	echo "<pre>";
// 	print_r($chars);
// 	print_r($payment_types);
// 	echo "</pre>";

$payment_type_input=$_POST['paymentType'];
$amt_input=$_POST['amt'];
$month_input=$_POST['month'];
$year_input=$_POST['year'];
 
$m_id=!empty($_POST['m_id']) ? trim($_POST['m_id']) :"";

$entered_by_username=$_SESSION[ID] ;
$entered_by_real_name=$_SESSION['USERNAME'];

if(count($payment_type_input)!=count($amt_input) && count($payment_type_input)!=count($year_input)){
  $payment_request['status']="error";
  $payment_request['message']="Please fill in all portions of the form!!";
    ajaxCompleteAndExit($payment_request,"addMemberPayment.php");
}


$get_payment_type_query =$sql->Prepare("SELECT * FROM perez_individual_payment_type ORDER by payment_form_name  ASC");
$get_payment_type_result = $sql->Execute($get_payment_type_query);
if ($get_payment_type_result) {

  while ($get_payment_type_row = $get_payment_type_result->FetchRow()) {
    $payment_types[$get_payment_type_row['payment_type_name']] = $get_payment_type_row['payment_form_name'];
  }
}


$counter=count($payment_type_input);

for($i=0;$i<$counter;$i++){
  $insert_new_payment_individual=$sql->Prepare("INSERT INTO perez_member_payments(payment_status,system_id,amount,month,year,entered_by_username,entered_by_real_name,payment_type_name,date_of_payment) VALUES('enabled','$m_id','$amt_input[$i]','$month_input[$i]','$year_input[$i]','$entered_by_username','$entered_by_real_name','$payment_type_input[$i]',CURDATE()) ");
     $insert_new_payment_result= $sql->Execute($insert_new_payment_individual);
     if(!$insert_new_payment_result){
        $insert_new_payment_errors['payment_type'][]=$payment_type_input[$i];
        $insert_new_payment_errors['payment_form_name'][]=$payment_types[$payment_type_input[$i]];
        $insert_new_payment_errors['payment_amount'][]=$amt_input[$i];
        $insert_new_payment_errors['payment_month'][]=$month_input[$i];
       // $query_list[]= $insert_new_payment_individual;

     }


      if($insert_new_payment_result){
        $insert_new_payment_success['payment_type'][]=$payment_type_input[$i];
        $insert_new_payment_success['payment_form_name'][]=$payment_types[$payment_type_input[$i]];
        $insert_new_payment_success['payment_amount'][]=$amt_input[$i];
        $insert_new_payment_success['payment_month'][]=$month_input[$i];
        //$query_list[]= $insert_new_payment_individual;
     }
}

if(isset($insert_new_payment_errors) && !empty($insert_new_payment_errors)){
   $processed_Request['status']="error";
   $error_count=count($insert_new_payment_errors['payment_amount']);
   
   $processed_Request['message'][]="Error Saving the Following Payment(s) <br/>";

   for($i=0;$i<$error_count;$i++){
   $error_msg="[Type] : ".$insert_new_payment_errors['payment_form_name'][$i]." ";
   $error_msg.="[Amount] : ".$insert_new_payment_errors['payment_amount'][$i]." ";
   $error_msg.="[Month] : ".$insert_new_payment_errors['payment_month'][$i]." <br/>";
   $processed_Request['message'][]=$error_msg;
  $_SESSION['message']=$processed_Request;
 }

 if(isset($insert_new_payment_success) && !empty($insert_new_payment_success)){

   $success_count=count($insert_new_payment_success['payment_amount']);
   $processed_Request['message'][]="**----------------------------------------**";
   $processed_Request['message'][]="<br/>Successfully Saved the Following Payment(s) <br/>";

   for($i=0;$i<$success_count;$i++){
   $success_msg="[Type] : ".$insert_new_payment_success['payment_form_name'][$i]." ";
   $success_msg.="[Amount] : ".$insert_new_payment_success['payment_amount'][$i]." ";
   $success_msg.="[Month] : ".$insert_new_payment_success['payment_month'][$i]." <br/>";
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
