 <?php 
  
   if(!isset($_SESSION['ID']) ){

  }
  else {
    @header('Location: logout.php');
        echo '<script>Window.location.href="logout.php " </script>';
      exit;
  }

  ?>
<frameset cols="185px,900px " noresize="noresize" >
<frame src="top_frame.php" scrolling="yes" />
<frame src="dashboard.php" name="content_frame"  scrolling="yes" />
</frameset>
