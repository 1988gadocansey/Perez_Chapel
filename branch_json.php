<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
ini_set('display_errors', 0);
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';
   //require '_library_/_includes_/app_config.inc';
  
$result = $sql->Prepare("SELECT * FROM `perez_branches`");
$result_=$sql->Execute($result);

$outp = "";
$count=0;
while($rs = $result_->FetchRow()) {
$count++;
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"NAME":"'  . $rs["NAME"] . '",';
    
    $outp .= '"CODE":"'   . $rs["CODE"]        . '",';
    $outp .= '"LOCATION":"'   . $rs["LOCATION"]       . '",';
    $outp .= '"DISTRICT":"'   . $rs["DISTRICT"]       . '",';
    $outp .= '"REGION":"'   . $rs["REGION"]       . '",';
    $outp .= '"PHONE":"'   . $rs["PHONE"]       . '",';
     $outp .= '"ADDRESS":"'   . $rs["ADDRESS"]       . '",';
    $outp .= '"CIRCUIT":"'. $rs["CIRCUIT"]     . '"}'; 
     
}
$outp ='{"records":['.$outp.']}';
 

echo($outp);

?> 