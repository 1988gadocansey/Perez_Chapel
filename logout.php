<?php
        include("_library_/_includes_/initialize.php");
       
      include "_library_/_includes_/config.php";
      $sql;
     
     $date=  strtotime(NOW);
     $stmt=$sql->Prepare("UPDATE perez_auth SET LAST_LOGOUT='$date' WHERE ID='$_SESSION[ID]'");
     $sql->Execute($stmt);
     logOut();
     
      