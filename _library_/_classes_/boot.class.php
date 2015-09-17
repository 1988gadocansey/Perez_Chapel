<?php


/**
 * Description of boot
 *
 * @author Senior Software Eng
 */
namespace _classes_;
use _classes_\Login;
class Boot {
    public function __construct(){
             $app=new \_classes_\Login();
             if($app->getMac()){
                 
             }
             else{
                 die("Server misconfigured");
             }
	}
    public function __clone(){
             
	}
    public function run(){
        ?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
   
  <title>Login Page | Perez Temple</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="login/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="login/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="login/css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="login/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="login/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="login/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="login/images/logo.png" alt="" class="Perez Temple">
            <p class="center login-form-text">The Ultimate Church App</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" type="text">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" type="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
              <table>
                  <tr>
                      <Td><button type="submit" class="btn waves-effect waves-light col s12">Login</button></Td>
                      <td><button type="submit" class="btn waves-effect waves-light col s12">  facebook</button></td>
                  </tr>
              </table>
          </div>
        </div>
        <div class="row">
            <center><small style="font-size: 11px">&copy <?php echo date ("Y"); ?> | Parez Chapel -  Designed By Gad Ocansey +233505284060</small></center>         
        </div>

      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="login/js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="login/js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="login/js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="login/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="login/js/plugins.js"></script>

</body>

</html>
        <?php
        $app=new \_classes_\Login();
         
        if(isset($_GET['action'])=='login'){

          
          $app->signin($_POST['username'], $_POST['password']);
         
        } 
        
    }
     
}
