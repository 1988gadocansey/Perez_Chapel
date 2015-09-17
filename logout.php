<?php
     require 'vendor/autoload.php';
      include "_library_/_includes_/config.php";
     global $session,$sql;
     $auth= new _classes_\Login();
     $date=  strtotime(NOW);
     $stmt=$sql->Prepare("UPDATE tbl_auth SET LAST_LOGOUT='$date' WHERE ID='$_SESSION[ID]'");
     $sql->Execute($stmt);
     $auth->logout("out");
     
      