 <?php 
 @session_start();
   if(!empty($_SESSION['ID'])){

  }
  else {
    @header('Location: logout.php');
        echo '<script>Window.location.href="logout.php " </script>';
      exit;
  }

  ?>
<frameset cols="250px,920px " noresize="noresize" >
<frame src="top_frame.php" scrolling="yes" />
<frame src="" name="content_frame"  scrolling="yes" />
</frameset>
