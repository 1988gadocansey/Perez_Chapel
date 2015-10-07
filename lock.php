<?php 
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
         
        $_fire_=new \_classes_\Login();
        $_fire_->displayMessage();
?>
<?php   include("./_library_/_includes_/header.inc");  ?>
<body id="app" class="app off-canvas body-full">
	

	
	<!-- main-container -->
	<div class="main-container clearfix">
		


		<!-- content-here -->
		<div class="content-container" id="content">
			 <center> <p class="label label-success">Your login session has expired login to continue</p></center>
			<div class="page page-auth clearfix">

				<div class="auth-container lock-screen">


                                   
					<div class="form-container">
                                           
					<div class="profile clearfix mb30" style="border: 1px solid transparent">
							<img src="photos/avatars/<?php echo $_SESSION[USERNAME]?>.jpg"  width="110" height="100" alt="profile pic">
							<h4 class="name"><?php echo  $_SESSION[USERNAME] ?></h4>
                                                        <p><?php echo $_SESSION[level] ?></p>
                                                        
						</div>
                                            <form class="form-horizontal" action="lock.php?auth=expired" method="POST">
							<div class="md-input-container md-float-label">
                                                            <input type="password"  class="md-input" required="" name="password">
								<label>Password</label>
							</div>
							<button class="btn btn-success btn-block">Unlock</button>
						</form>
					</div>



				</div>

			</div>
		</div> 
		<!-- #end content-container -->

	</div> <!-- #end main-container -->

 
        <script src="assets/scripts/vendors.js"></script>
 
</body>

</html>