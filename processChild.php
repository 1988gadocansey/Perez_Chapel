<?php
session_start();
require 'vendor/autoload.php';

 require '_library_/_includes_/config.php';
 $help = new _classes_\helpers();
$name=$_POST['name'];
$dob=$_POST['dob'];

 
$member=!empty($_POST['member']) ? trim($_POST['member']) :"";

 
if(count($name)!=count($dob)){
  $payment_request['status']="error";
  $payment_request['message']="Please fill in all portions of the form!!";
    ajaxCompleteAndExit($payment_request,"add_children.php");
}

 


$counter=count($name);
//echo $counter;
for($i=0;$i<$counter;$i++){
       $code=$help->getCode("CHILD");
  $query=$sql->Prepare("INSERT INTO perez_children(NAME,DOB,CODE,PARENT_ID) VALUES('$name[$i]','$dob[$i]','$code','$member' )");
     $insert_new_payment_result= $sql->Execute($query);
     if(!$insert_new_payment_result){
         
     }


      if($insert_new_payment_result){
          
           if (!$_FILES["images"]["name"][$i]) {
                echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                $error = 1;
            }
            //check if file type is jpeg 
            elseif ($_FILES["images"]["type"][$i] != "image/jpeg" and $_FILES["images"]["type"][$i] != "image/pjpeg") {
             //  header("location:addMember?error=1&&member=$_SESSION[member]&&error=Picture format not accepted");
                $error = 2;
            } elseif (($_FILES["images"]["size"][$i] ) > 2097152) {
                 //header("location:addMember?error=1&&member=$_SESSION[member]");
                $error = 3;
            }

            

              if ($error > 0) {
        
                } else {
                    
                  $destination = "photos/children/$code.jpg";
                   
                    move_uploaded_file($_FILES["images"]["tmp_name"][$i], $destination);

                    if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                       // header("location:addMember?success=1&&member=$_SESSION[member]");
                    }
                }
          
          
          
          
          
          
        $insert_new_payment_success['name'][]=$name[$i];
        $insert_new_payment_success['dob'][]=$dob[$i];
            $code=$help->updateCode("CHILD");
     }
     
}

 

if (isset($insert_new_payment_success) && !empty($insert_new_payment_success)) {

    $success_count = count($insert_new_payment_success['name']);
    $processed_Request['message'][] = "**----------------------------------------**";
    $processed_Request['message'][] = "<br/>Successfully Saved the Following Child(Children) <br/>";

    for ($i = 0; $i < $success_count; $i++) {
        $success_msg = "[name] : " . $insert_new_payment_success['name'][$i] . " ";
        $success_msg.="[dob] : " . $insert_new_payment_success['dob'][$i] . " ";

        $processed_Request['message'][] = $success_msg;
        $_SESSION['message'] = $processed_Request;
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
