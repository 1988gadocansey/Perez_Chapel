<?php
        include("_library_/_includes_/initialize.php");
       
      include "_library_/_includes_/config.php";
      $sql;
     
     $date=  strtotime(NOW);
     $stmt=$sql->Prepare("UPDATE perez_auth SET LAST_LOGOUT='$date' WHERE ID='$_SESSION[ID]'");
     $sql->Execute($stmt);
     header('Location: index.php');
    echo "<script>Window.location.href='index.php ' </script>";
    @session_destroy();
    $_SESSION=array();
    exit;

     logOut();
     
      ?>
<script type="text/javascript"> 
    if (self.parent.frames.length != 0){
        self.parent.location=document.location.href;
    }
</script>