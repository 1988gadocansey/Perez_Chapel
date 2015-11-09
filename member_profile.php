<?php
require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        $crypt=new _classes_\cryptCls();
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $sms=new _classes_\smsgetway();
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Profile Page | Materialize - Material Design Admin Template</title>

  <!-- Favicons-->
  <link rel="icon" href="profile/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="profile/images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="profile/images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="profile/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="profile/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="profile/css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="profile/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="profile/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="profile/js/plugins/chartist-profile/js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>

<body>
  <!-- Start Page Loading -->
   
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
<Center>  <a href="members.php" style="position: relative" class="btn btn-success"><i class="md md-home" ></i>Close this page</a> </center>
  <header id="header" class="page-topbar">
        <!-- start header nav-->
       
  </header>
  <!-- END HEADER -->
                                  <?php
                                     
                                
                                     if(isset($_GET[page])){
                                    $qt = $sql->Prepare("SELECT * FROM perez_members WHERE   MEMBER_CODE ='$_GET[page]'  ");

                                         $stmt = $sql->Execute($qt);
                                         $rtmt = $stmt->FetchNextObject();
                                     
                                         $note=$help->getNotes($rtmt->ID);

                                   }?>
 

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">        

        <!--start container-->
        <div class="container">

          <div id="profile-page" class="section">
            <!-- profile-page-header -->
            <div id="profile-page-header" class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="activator" src="images/main.PNG" alt="user background">                    
                </div>
                <figure class="card-profile-image">
                    <img src="photos/members/<?php echo $rtmt->MEMBER_CODE;?>.jpg" alt="profile image" class="circle z-depth-2 responsive-img activator">
                </figure>
                <div class="card-content">
                  <div class="row">                    
                    <div class="col s3 offset-s2">                        
                        <h4 class="card-title grey-text text-darken-4"><small><i class="mdi-action-account-circle"></i><?php echo $rtmt->FIRSTNAME." ".$rtmt->LASTNAME;?></small></h4>
                        <p class="medium-small grey-text">Name</p>                        
                    </div>
                    <div class="col s2 center-align">
                        <h4 class="card-title grey-text text-darken-4"><small><i class="mdi-action-perm-phone-msg"></i><?php echo $rtmt->PHONE;?></small></h4>
                        <p class="medium-small grey-text">Phone</p>                        
                    </div>
                    <div class="col s2 center-align">
                        <h4 class="card-title grey-text text-darken-4"><i class="mdi-maps-pin-drop"></i><small><?php echo $help->getLocation($rtmt->LOCATION);?></small></h4>
                        <p class="medium-small grey-text">Location</p>                        
                    </div>                    
                    <div class="col s2 center-align">
                        <h4 class="card-title grey-text text-darken-4"><small><i class="mdi-action-wallet-membership"></i><?php echo date('F Y',$rtmt->DATE_JOINED); ?></small></h4>
                        <p class="medium-small grey-text">Member Since</p>                        
                    </div>                    
                    <div class="col s1 right-align">
                      <a class="btn-floating activator waves-effect waves-light darken-2 right">
                          <i class="mdi-action-perm-identity"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-reveal">
                    <p>
                      <span class="card-title grey-text text-darken-4">Roger Waters <i class="mdi-navigation-close right"></i></span>
                      <span><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</span>
                    </p>

                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    
                    <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                    <p><i class="mdi-communication-email cyan-text text-darken-2"></i> mail@domain.com</p>
                    <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                    <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p>
                </div>
            </div>
            <!--/ profile-page-header -->

            <!-- profile-page-content -->
            <div id="profile-page-content" class="row">
              <!-- profile-page-sidebar-->
              <div id="profile-page-sidebar" class="col s12 m4">
                <!-- Profile About  -->
                <div class="card light-blue">
                  <div class="card-content white-text">
                    <span class="card-title">Lastest Name</span>
                    <p style="text-align: justify"><?PHP echo $note->NOTE ?></p>
                  </div>                  
                </div>
                <!-- Profile About  -->

                <!-- Profile About Details  -->
                <ul id="profile-page-about-details" class="collection z-depth-1">
                  <li class="collection-item">
                    <div class="row">
                      <div class="col s5 grey-text darken-1"><i class="mdi-action-account-circle cyan-text text-darken-2"></i> People Category</div>
                      <div class="col s7 grey-text text-darken-4 right-align"><?php echo $help->getCategory($rtmt->PEOPLE_CATEGORY); ?></div>
                    </div>
                  </li>
                  <li class="collection-item">
                    <div class="row">
                      <div class="col s5 grey-text darken-1"><i class="mdi-communication-email cyan-text text-darken-2"></i> Email</div>
                      <div class="col s7 grey-text text-darken-4 right-align"><?php echo $rtmt->EMAIL ?></div>
                    </div>
                  </li>
                  <li class="collection-item">
                    <div class="row">
                      <div class="col s5 grey-text darken-1"><i class="mdi-social-domain cyan-text text-darken-2"></i> Lives in</div>
                      <div class="col s7 grey-text text-darken-4 right-align"><?php echo $rtmt->RESIDENTIAL_ADDRESS;?></div>
                    </div>
                  </li>
                  <li class="collection-item">
                    <div class="row">
                      <div class="col s5 grey-text darken-1"><i class="mdi-social-cake cyan-text text-darken-2"></i> Birth date</div>
                      <div class="col s7 grey-text text-darken-4 right-align"><?php echo date("j F Y",$rtmt->DOB)." ,".$rtmt->AGE."yrs";?></div>
                    </div>
                  </li>
                  
                  <li class="collection-item">
                    <div class="row">
                      <div class="col s5 grey-text darken-1"><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Permissions</div>
                      <div class="col s7 grey-text text-darken-4 right-align"><?php echo  $rtmt->ACCESS;?></div>
                    </div>
                  </li>
                </ul>
                <!--/ Profile About Details  -->

                <!-- Profile About  -->
                <div class="card amber darken-2">
                  <div class="card-content white-text center-align">
                    <p class="card-title"><i class="mdi-social-group-add"></i> 3685</p>
                    <p>Followers</p>
                  </div>                  
                </div>
                <!-- Profile About  -->
 

                <!-- task-card -->
                <form action="" method="POST">
                <ul id="task-card" class="collection with-header">
                  <li class="collection-header cyan">
                      <h5 class="task-card-title">Tasks</h5>
                      
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task1" name="volunteer" value="yes" <?php if($rtmt->VOLUNTEER=='yes'){echo "checked='checked'";} ?>/>
                      <label for="task1">Volunteering <a href="#" class="secondary-content"> </a>
                      </label>
                       
                  </li>
                  <li class="collection-item dismissable">
                      <?php if($rtmt->PEOPLE_FLOW!=""){?>
                      <input type="checkbox" id="task2" checked="checked" />
                     <?php } else{?>
                      <label for="task2"><i class="mdi-notification-sync" ></i>No Flow.     </label>
                      
                      <span class=""><a href="people_flows?person=<?php echo $_GET[page] ?>"> Click to add to People Flows</a></span>
                    <?php }?>
                  </li>
                  <li class="collection-item dismissable">
                       <?php if($rtmt->GROUPS!=""){?>
                      <input type="checkbox" id="task2" checked="checked" />
                    
                      <label for="task2"><i class="mdi-social-group-add" ></i><?php echo $rtmt->GROUPS ?>     </label>
                       <?php } else{?>
                      <span class=""><a href="groups?person=<?php echo $_GET[page] ?>">No group found. Click to add to Groups</a></span>
                    <?php }?>
                  </li>
                   <li class="collection-item dismissable">
                       
                      <label for="task4">Edit this member data</label>
                      <span class=""><a href="addMember.php?member=<?php echo $_GET[page] ?>">Click to edit all data</a></span>
                  </li>
                  <li class="collection-item dismissable">
                       
                      <label for="task4">Edit this member data</label>
                      <span class=""><a href="addMember.php?member=<?php echo $_GET[page] ?>">Click to edit all data</a></span>
                  </li>
                </ul>
                </form>
                <!-- task-card -->
 
 

                <!-- Map Card -->
                <div class="map-card">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <div id="map-canvas" data-lat="40.747688" data-lng="-74.004142"></div>
                        </div>
                        <div class="card-content">                    
                            <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                <i class="mdi-maps-pin-drop"></i>
                            </a>
                            <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Company Name LLC</a>
                            </h4>
                            <p class="blog-post-content">Some more information about this company.</p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Company Name LLC <i class="mdi-navigation-close right"></i></span>                   
                            <p>Here is some more information about this company. As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results.Some more information about this company.</p>
                            <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Manager Name</p>
                            <p><i class="mdi-communication-business cyan-text text-darken-2"></i> 125, ABC Street, New Yourk, USA</p>
                            <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                            <p><i class="mdi-communication-email cyan-text text-darken-2"></i> support@geekslabs.com</p>                    
                        </div>
                    </div>
                </div>
                <!-- Map Card -->


              </div>
              <!-- profile-page-sidebar-->

              <!-- profile-page-wall -->
              <div id="profile-page-wall" class="col s12 m8">
                <!-- profile-page-wall-share -->
                <div id="profile-page-wall-share" class="row">
                  <div class="col s12">
                    <ul class="tabs tab-profile z-depth-1 light-blue">
                      <li class="tab col s3"><a class="white-text waves-effect waves-light active" href="#UpdateStatus"><i class="mdi-communication-quick-contacts-mail"></i> ACTIVITIES</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#AddPhotos"><i class="mdi-action-assignment"></i> NOTES</a>
                      </li>
                      <li class="tab col s3"><a class="white-text waves-effect waves-light" href="#CreateAlbum"><i class="mdi-social-group-add"></i> FAMILY RECORDS</a>
                      </li>                      
                    </ul>
                    <!-- UpdateStatus-->
                    <div id="UpdateStatus" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">What's on your mind?</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                    <!-- AddPhotos -->
                    <div id="AddPhotos" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">Share your favorites photos!</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost2'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost2' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                    <!-- CreateAlbum -->
                    <div id="CreateAlbum" class="tab-content col s12  grey lighten-4">
                      <div class="row">
                        <div class="col s2">
                          <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-image-post">
                        </div>
                        <div class="input-field col s10">
                          <textarea id="textarea" row="2" class="materialize-textarea"></textarea>
                          <label for="textarea" class="">Create awesome album.</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col s12 m6 share-icons">
                          <a href="#"><i class="mdi-image-camera-alt"></i></a>
                          <a href="#"><i class="mdi-action-account-circle"></i></a>
                          <a href="#"><i class="mdi-hardware-keyboard-alt"></i></a>
                          <a href="#"><i class="mdi-communication-location-on"></i></a>
                        </div>
                        <div class="col s12 m6 right-align">
                           <!-- Dropdown Trigger -->
                            <a class='dropdown-button btn' href='#' data-activates='profliePost3'><i class="mdi-action-language"></i> Public</a>

                            <!-- Dropdown Structure -->
                            <ul id='profliePost3' class='dropdown-content'>
                              <li><a href="#!"><i class="mdi-action-language"></i> Public</a></li>
                              <li><a href="#!"><i class="mdi-action-face-unlock"></i> Friends</a></li>                              
                              <li><a href="#!"><i class="mdi-action-lock-outline"></i> Only Me</a></li>
                            </ul>

                            <a class="waves-effect waves-light btn"><i class="mdi-maps-rate-review left"></i>Post</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ profile-page-wall-share -->

                <!-- profile-page-wall-posts -->
                <div id="profile-page-wall-posts"class="row">
                  <div class="col s12">
                      <!-- medium -->
                      <div id="profile-page-wall-post" class="card">
                        <div class="card-profile-title">
                          <div class="row">
                            <div class="col s1">
                              <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-post-uer-image">                        
                            </div>
                            <div class="col s10">
                              <p class="grey-text text-darken-4 margin">John Doe</p>
                              <span class="grey-text text-darken-1 ultra-small">Shared publicly  -  26 Jun 2015</span>
                            </div>
                            <div class="col s1 right-align">
                              <i class="mdi-navigation-expand-more"></i>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col s12">
                              <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>.  I require little more information to use effectively.</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-image profile-medium">                          
                          <img src="profile/images/gallary/2.jpg" alt="sample" class="responsive-img profile-post-image profile-medium">                        
                          <span class="card-title">Card Title</span>
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action row">
                          <div class="col s4 card-action-share">
                            <a href="#">Like</a>                          
                            <a href="#">Share</a>
                          </div>
                          
                          <div class="input-field col s8 margin">
                            <input id="profile-comments" type="text" class="validate margin">
                            <label for="profile-comments" class="">Comments</label>
                          </div>                        
                        </div>                        
                      </div>

                      <!-- medium video -->
                      <div id="profile-page-wall-post" class="card">
                        <div class="card-profile-title">
                          <div class="row">
                            <div class="col s1">
                              <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-post-uer-image">                        
                            </div>
                            <div class="col s10">
                              <p class="grey-text text-darken-4 margin">John Doe</p>
                              <span class="grey-text text-darken-1 ultra-small">Shared publicly  -  26 Jun 2015</span>
                            </div>
                            <div class="col s1 right-align">
                              <i class="mdi-navigation-expand-more"></i>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col s12">
                              <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>.  I require little more information to use effectively.</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-image profile-medium">
                          <div class="video-container no-controls">
                            <iframe width="640" height="360" src="https://www.youtube.com/embed/10r9ozshGVE" frameborder="0" allowfullscreen></iframe>
                          </div>                          
                          <span class="card-title">Card Title</span>
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action row">
                          <div class="col s4 card-action-share">
                            <a href="#">Like</a>                          
                            <a href="#">Share</a>
                          </div>
                          
                          <div class="input-field col s8 margin">
                            <input id="profile-comments" type="text" class="validate margin">
                            <label for="profile-comments" class="">Comments</label>
                          </div>                        
                        </div>                        
                      </div>                      

                      <!-- small -->
                      <div id="profile-page-wall-post" class="card">
                        <div class="card-profile-title">
                          <div class="row">
                            <div class="col s1">
                              <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-post-uer-image">                        
                            </div>
                            <div class="col s10">
                              <p class="grey-text text-darken-4 margin">John Doe</p>
                              <span class="grey-text text-darken-1 ultra-small">Shared publicly  -  26 Jun 2015</span>
                            </div>
                            <div class="col s1 right-align">
                              <i class="mdi-navigation-expand-more"></i>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col s12">
                              <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>.  I require little more information to use effectively.</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-image profile-small">
                          <img src="profile/images/gallary/1.jpg" alt="sample" class="responsive-img profile-post-image">                        
                          <span class="card-title">Card Title</span>
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action row">
                          <div class="col s4 card-action-share">
                            <a href="#">Like</a>                          
                            <a href="#">Share</a>
                          </div>
                          
                          <div class="input-field col s8 margin">
                            <input id="profile-comments" type="text" class="validate">
                            <label for="profile-comments" class="">Comments</label>
                          </div>                        
                        </div>                        
                      </div>

                      <!-- small -->
                      <div id="profile-page-wall-post" class="card">
                        <div class="card-profile-title">
                          <div class="row">
                            <div class="col s1">
                              <img src="profile/images/avatar.jpg" alt="" class="circle responsive-img valign profile-post-uer-image">                        
                            </div>
                            <div class="col s10">
                              <p class="grey-text text-darken-4 margin">John Doe</p>
                              <span class="grey-text text-darken-1 ultra-small">Shared publicly  -  26 Jun 2015</span>
                            </div>
                            <div class="col s1 right-align">
                              <i class="mdi-navigation-expand-more"></i>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col s12">
                              <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>.  I require little more information to use effectively.</p>
                            </div>
                          </div>
                        </div>
                        <div class="card-image profile-large">
                          <img src="profile/images/gallary/3.jpg" alt="sample" class="responsive-img profile-post-image">                        
                          <span class="card-title">Card Title</span>
                        </div>
                        <div class="card-content">
                          <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action row">
                          <div class="col s4 card-action-share">
                            <a href="#">Like</a>                          
                            <a href="#">Share</a>
                          </div>
                          
                          <div class="input-field col s8 margin">
                            <input id="profile-comments" type="text" class="validate">
                            <label for="profile-comments" class="">Comments</label>
                          </div>                        
                        </div>                        
                      </div>
                  </div>                  
                </div>
                <!--/ profile-page-wall-posts -->

              </div>
              <!--/ profile-page-wall -->

            </div>
          </div>
        </div>
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

    

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

   
  


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="profile/js/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="profile/js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="profile/js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="profile/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="profile/js/plugins/chartist-profile/js/chartist.min.js"></script>  

    <!-- sparkline -->
    <script type="text/javascript" src="profile/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="profile/js/plugins/sparkline/sparkline-script.js"></script>
    
    <!-- google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="profile/js/plugins.js"></script>

     

    <!-- Toast Notification -->
    <script type="text/javascript">
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 1500);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5000);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 15000);
    });

    $(function() {
      // Google Maps  
      $('#map-canvas').addClass('loading');    
      var latlng = new google.maps.LatLng(40.6700, -73.9400); // Set your Lat. Log. New York
      var settings = {
          zoom: 10,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControl: false,
          scrollwheel: false,
          draggable: true,
          styles: [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}],
          mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
          navigationControl: false,
          navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},            
      };
      var map = new google.maps.Map(document.getElementById("map-canvas"), settings);

      google.maps.event.addDomListener(window, "resize", function() {
          var center = map.getCenter();
          google.maps.event.trigger(map, "resize");
          map.setCenter(center);
          $('#map-canvas').removeClass('loading');
      });

      var contentString =
          '<div id="info-window">'+
          '<p>18 McLuice Road, Vellyon Hills,<br /> New York, NY 10010<br /><a href="https://plus.google.com/102896039836143247306/about?gl=za&hl=en" target="_blank">Get directions</a></p>'+
          '</div>';
      var infowindow = new google.maps.InfoWindow({
          content: contentString
      });

      var companyImage = new google.maps.MarkerImage('../../../ashoka/images/map-marker.png',
          new google.maps.Size(36,62),// Width and height of the marker
          new google.maps.Point(0,0),
          new google.maps.Point(18,52)// Position of the marker 
      );

      var companyPos = new google.maps.LatLng(40.6700, -73.9400);

      var companyMarker = new google.maps.Marker({
          position: companyPos,
          map: map,
          icon: companyImage,
          title:"Shapeshift Interactive",
          zIndex: 3});

      google.maps.event.addListener(companyMarker, 'click', function() {
          infowindow.open(map,companyMarker);
          pageView('http://demo.geekslabs.com/#address');
      });
    });
    
    </script>
    
</body>


</html>