<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $destination = "uploads"; // destination for uploads
        if(isset($_POST[submit])){
            
             
            //check if file type is jpeg 
            if ($_FILES["pastor_signature"]["type"]!="image/jpeg" and $_FILES["file"]["type"]!="image/pjpeg"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["pastor_signature"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/pastor.jpg";
                move_uploaded_file($_FILES["pastor_signature"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $pastor=1;
                }
            }
            
            // assistant pastor signature
            if ($_FILES["ass_signature"]["type"]!="image/jpeg" and $_FILES["file"]["type"]!="image/pjpeg"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["ass_signature"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/assistant_pastor.jpg";
                move_uploaded_file($_FILES["ass_signature"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $assistant=1;
                }
            }
            
            // accountant signature
             if ($_FILES["accountant_signature"]["type"]!="image/jpeg" and $_FILES["file"]["type"]!="image/pjpeg"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["accountant_signature"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/accountant.jpg";
                move_uploaded_file($_FILES["accountant_signature"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $accountant=1;
                }
            }
            
            // finance director signature
             if ($_FILES["director_signature"]["type"]!="image/jpeg" and $_FILES["file"]["type"]!="image/pjpeg"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["director_signature"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/finance.jpg";
                move_uploaded_file($_FILES["director_signature"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $finance=1;
                }
            }
            
             // letterhead  
             if ($_FILES["letterhead"]["type"]!="image/png" and $_FILES["file"]["type"]!="image/png"  ){echo " <font color='red' style='text-decoration:blink'>Only jpeg formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["letterhead"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/letterhead.png";
                move_uploaded_file($_FILES["letterhead"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $letterhead=1;
                }
            }
            
            // logo
             if ($_FILES["logo"]["type"]!="image/png" and $_FILES["file"]["type"]!="image/png"  ){echo " <font color='red' style='text-decoration:blink'>Only png formats accepted </font>";   		$error=2;  }
            elseif (($_FILES["logo"]["size"] ) > 2097152) {
                echo " <font color='red'> File size must be less than 2 MB</font>";
                $error = 3;
            }



            if ($error > 0) {

            } else {
                $destination_ = "$destination/logo.png";
                move_uploaded_file($_FILES["logo"]["tmp_name"], $destination_);

                if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                     $logo=1;
                }
            }
            
            // do other form processing
             
                 
                $data="CHURCH_NAME='$_POST[name]',CHURCH_LOGO='$logo',CHURCH_ADDRESS='$_POST[address]',CHURCH_PHONE='$_POST[phone]',CHURCH_PHONE2='$_POST[phone2]',CHURCH_FACEBOOK='$_POST[facebook]',CHURCH_FACEBOOK_PASSWORD='$_POST[fbookpass]',CHURCH_WHATSAPP='$_POST[whatsapp]',SMS_URL='$_POST[url]' ,CHURCH_EMAIL='$_POST[email]',CHURCH_LETHERHEAD='$letterhead',CHURCH_HEAD_PASTOR='$_POST[pastor]',CHURCH_ACCOUNTANT='$_POST[accountant]',CHURCH_FINANCE_DIRECTOR='$_POST[finance]',CHURCH_ASSISTANT_PASTOR='$_POST[ass_pastor]',CHURCH_HEAD_PASTOR_SIGN_FILE='$pastor',CHURCH_ASSISTANT_PASTOR_SIGN_FILE='$assistant',CHURCH_ACCOUNTANT_SIGN='$accountant',CHURCH_FINANCE_SIGN='$finance',SMS_ALERT='$_POST[sms_]',EMAIL_ALERT='$_POST[email_]',MEMBER_ID_GEN='$_POST[member]',UPDATED_BY='$_SESSION[ID]'";
                
                $query=$sql->Prepare("INSERT INTO perez_config SET $data  ON DUPLICATE KEY UPDATE $data");
               //print_r($query);
                if($sql->Execute($query)){
                    header("location:setup.php?success=1");
                }
                else{
                   header("location:setup.php?error=1");
                }
            
            
            
        }
        
        if(isset($_POST[sub_branch])){
            $data="NAME='$_POST[bname]',CODE='$_POST[bcode]',LOCATION='$_POST[blocation]',CIRCUIT='$_POST[bcircuit]',DISTRICT='$_POST[bdistrict]',REGION='$_POST[region]',ADDRESS='$_POST[baddress]',PHONE='$_POST[bphone]'";
            $query=$sql->Prepare("INSERT INTO perez_branches SET $data  ON DUPLICATE KEY UPDATE $data");
            print_r($query); 
            if($sql->Execute($query)){
                    header("location:setup.php?success=1");
                }
                else{
                    header("location:setup.php?error=1");
                }
        }
        // delete a branch
          if(isset($_GET[delete])){
           // $data="NAME='$_POST[bname]',CODE='$_POST[bcode]',LOCATION='$_POST[blocation]',CIRCUIT='$_POST[bcircuit]',DISTRICT='$_POST[bdistrict]',REGION='$_POST[region]',ADDRESS='$_POST[baddress]',PHONE='$_POST[bphone]'";
            $query=$sql->Prepare("DELETE FROM perez_branches WHERE CODE='$_GET[delete]' ");
            print_r($query); 
            if($sql->Execute($query)){
                    header("location:setup.php?success=1");
                }
                else{
                    header("location:setup.php?error=1");
                }
        }
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<script src= "assets/ajax.googleapis.com_ajax_libs_angularjs_1.3.14_angular.min.js"></script>
<body id="app" class="app off-canvas">
     
	<!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
	<!-- #end header -->

	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- main-navigation -->
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
                    <link rel="stylesheet" href="assets/styles/plugins/select2.css">
                    <link rel="stylesheet" type="text/css" href="assets/scripts/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>System Setups</li>
					<li class="active"><a href="#">Setup</a></li>
				</ol>
                            <div><?php $notify->Message(); ?></div>
                            <?php
                                
                                     
                                    $query = $sql->Prepare("SELECT * FROM perez_config  ");

                                    $stmt = $sql->Execute($query);
                                    $rows = $stmt->FetchNextObject();
                                 
                                ?>
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
					<!-- row -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <div><strong>System Setup Procedures:</strong>
                                                        <br/>
                                                        
                                                        

                                                        To navigate through the guide, use the buttons in the bottom right-hand corner. Each step will take you to a different area of the system and give a quick explanation of its functions and features. We'll always remember what step you're up to, so feel free to have a look around before moving forward! You can always come back if you need to clarify.

                                                        If you'd like more information on any of the areas mentioned, you can always visit our 'Getting Started Page' for more information. We also have a How-To area, where you can find full setup instructions for each of the App features. If there's anything we miss in this guide, or if you have any further questions, be sure to contact our support team for assistance..


                                                    </div>
                                                </div>
                                            </div>	 


                                        </div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                                                <div class="table-responsive">

                                                    <div class="clearfix tabs-vertical">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#tab-vertical-info" data-toggle="tab">Church Information</a></li>
                                                            <li><a href="#tab-vertical-branch" data-toggle="tab">Add Branches</a></li>
                                                            <li><a href="#tab-vertical-demo" data-toggle="tab">Add Demographics</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab-vertical-info" animated fadeInDown>

                                                                <div class="clearfix">
                                                                    <p><h5>Fields marked in red</h5></p>
                                                                    <form role="form" class="form-horizontal" method="POST" enctype="multipart/form-data"> <!-- form horizontal acts as a row -->
                                                                        <!-- normal control -->
                                                                         
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Name of Church <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="name" required="" value="<?php echo $rows->CHURCH_NAME; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Address <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="address" required="" value="<?php echo $rows->CHURCH_ADDRESS; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Email <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="email" class="form-control" name="email" required="" value="<?php echo $rows->CHURCH_EMAIL; ?>">
                                                                            </div>
                                                                        </div>
                                                                       
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Phone 1 <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="phone" required="" value="<?php echo $rows->CHURCH_PHONE; ?>">
                                                                                <p class="text-danger text-right xsmall">eg +233505284060</p>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label class="col-md-3 control-label">Phone 2 <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="phone2" required="" value="<?php echo $rows->CHURCH_PHONE2; ?>">
                                                                                <p class="text-danger text-right xsmall">eg +233505284060</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Whatsapp Number  </label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="whatsapp"  value="<?php echo $rows->CHURCH_WHATSAPP; ?>">
                                                                                <p  class="text-danger text-right xsmall">eg +233505284060</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">SMS Url  </label>
                                                                            <div class="col-md-6">
                                                                                <input type="url" class="form-control" name="url" required="" value="<?php echo $rows->SMS_URL; ?>" >
                                                                                <p  class="text-danger text-right xsmall">eg http://www.gadtxt.com/perez</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
											<label class="col-md-3 control-label">Facebook Account</label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon  fa fa-facebook-f"></span>
                                                                                                        <input type="text" class="form-control" name="facebook" value="<?php echo $rows->CHURCH_FACEBOOK; ?>">
												</div>
											</div>
									</div>
                                                                         <div class="form-group">
                                                                            <label class="col-md-3 control-label">Facebook Password  </label>
                                                                            <div class="col-md-6">
                                                                                <input type="password" class="form-control" name="fbookpass" value="<?php echo $rows->CHURCH_FACEBOOK_PASSWORD; ?>">
                                                                                
                                                                            </div>
                                                                        </div>

                                                                        <!-- with hint -->
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Head Pastor Name <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="pastor" required="" value="<?php echo $rows->CHURCH_HEAD_PASTOR; ?>" >
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Head Pastor Signature <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/pastor.jpg", 105) ?>  src="<?php echo file_exists("$destination/pastor.jpg") ? "$destination/pastor.jpg" : "$destination/user.jpg"; ?>" alt=" pastor's logo" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select signature to upload   </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="pastor_signature"  >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Assistant Pastor Name <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="ass_pastor" required="" value="<?php echo $rows->CHURCH_ASSISTANT_PASTOR; ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Assistant Pastor Signature </label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/assistant_pastor.jpg", 105) ?>  src="<?php echo file_exists("$destination/assistant_pastor.jpg") ? "$destination/assistant_pastor.jpg" : "$destination/user.jpg"; ?>" alt=" assistant pastor's signature" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select signature to upload   </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="ass_signature"  >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label class="col-md-3 control-label">Finance Director <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="finance" required=""  value="<?php echo $rows->CHURCH_FINANCE_DIRECTOR; ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Finance Director Signature  </label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/finance.jpg", 105) ?>  src="<?php echo file_exists("$destination/finance.jpg") ? "$destination/finance.jpg" : "$destination/user.jpg"; ?>" alt=" finance director signature" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select signature to upload   </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="director_signature"  >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Accountant <span class="error">*</span></label>
                                                                            <div class="col-md-6">
                                                                                <input type="text" class="form-control" name="accountant" required="" value="<?php echo $rows->	CHURCH_ACCOUNTANT; ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">Accountant Signature  </label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/accountant.jpg", 105) ?>  src="<?php echo file_exists("$destination/accountant.jpg") ? "$destination/accountant.jpg" : "$destination/user.jpg"; ?>" alt=" accountant's signature" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select signature to upload (.png) </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="accountant_signature"  >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                             <div class="form-group">
                                                                            <label class="col-md-3 control-label">Letterhead <span class="error">*</span>  </label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/letterhead.png", 105) ?>  src="<?php echo file_exists("$destination/letterhead.png") ? "$destination/letterhead.png" : "$destination/user.jpg"; ?>" alt=" letterhead" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select letterhead to upload (.png) </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="letterhead"  >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                                                         <div class="form-group">
                                                                            <label class="col-md-3 control-label">Logo <span class="error">*</span> </label>
                                                                            <div class="col-md-6">
                                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                                        <img <?php echo $help->picture("$destination/logo.png", 105) ?>  src="<?php echo file_exists("$destination/logo.png") ? "$destination/logo.png" : "$destination/user.png"; ?>" alt=" logo here" />
                                                                                    </div>
                                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="btn default btn-file">
                                                                                            <span class="fileinput-new">
                                                                                                Select logo to upload (.png) </span>
                                                                                            <span class="fileinput-exists">
                                                                                                Change </span>
                                                                                            <input type="file" name="logo" >
                                                                                        </span>
                                                                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                                                            Remove </a>

                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                         
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">  SMS Alert??</label>
                                                                            <div class="col-md-6">
                                                                              <div class="ui-toggle ui-toggle-sm ui-toggle-pink mb10">
												 
												<label class="ui-toggle-inline">
                                                                                                    <input type="checkbox" name="sms_"checked value="1"  required=""> 
													<span></span>
												</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">  Email Alert??</label>
                                                                            <div class="col-md-6">
                                                                              <div class="ui-toggle ui-toggle-sm ui-toggle-success mb10">
												 
												<label class="ui-toggle-inline">
                                                                                                    <input type="checkbox" name="email_"checked value="1" required=""  > 
													<span></span>
												</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label class="col-md-3 control-label">  System Generated ID for Members</label>
                                                                            <div class="col-md-6">
                                                                              <div class="ui-toggle ui-toggle-sm ui-toggle-warning mb10">
												 
												<label class="ui-toggle-inline">
                                                                                                    <input type="checkbox" required="" name="member"checked value="1"  > 
													<span></span>
												</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                       
                                                                        <div class="clearfix right">
                                                                            <button class="btn btn-primary mr5" name="submit" type="submit">Submit</button>
                                                                            <button  type="reset"class="btn btn-default">Cancel</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="tab-vertical-branch">
                                                                <?php
                                                                   /* $query = $sql->Prepare("SELECT * FROM perez_branches  ");

                                                                    $stmt = $sql->Execute($query);
                                                                    $rows = $stmt->FetchNextObject();
                                                                */
                                                                ?>
                                                                <h5 class="mt0">Create your some branches here</h5>
                                                                <form action="setup.php" method="post">
                                                                <div class="clearfix">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch Code</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" required="" class="form-control" name="bcode" value="<?php echo $rows->CODE ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                        
                                                                            <div class="col-md-5">
                                                                                  <div class="form-group">
                                                                                      <label class="control-label col-md-3">Branch Name</label>
                                                                                      <div class="col-md-9">
                                                                                          <input type="text" class="form-control"   name="bname" value="<?php echo $rows->NAME ?>">
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                         
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch Location</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" required="" class="form-control" name="blocation" value="<?php echo $rows->LOCATION ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch Address</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" required="" class="form-control" name="baddress" value="<?php echo $rows->ADDRESS ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                     </div>
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch Circuit</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" class="form-control"   name="bcircuit" value="<?php echo $rows->Circuit ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch District</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" class="form-control"   name="bdistrict" value="<?php echo $rows->DISTRICT ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                       <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Region</label>
                                                                                <div class="col-md-9">
                                                                                    <select id="personSelect" name="region" required="" style="width: 100%" data-placeholder="Select a person" class="form-control">
													 
                                                                                                            <option value=''>Choose region</option>

                                                                                                            <?php
                                                                                                            global $sql;

                                                                                                            $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                                                                                                            $query = $sql->Execute($query2);


                                                                                                            while ($row = $query->FetchRow()) {
                                                                                                                ?>
                                                                                                                <option value="<?php echo $row['NAME']; ?>" <?php
                                                                                                                if ($rows->REGION == $row['NAME']) {
                                                                                                                    echo "selected='selected'";
                                                                                                                }
                                                                                                                ?>        ><?php echo $row['NAME']; ?></option>

                                                                                                        <?php } ?>

                                                                                                        </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label class="control-label col-md-3">Branch Phone</label>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" class="form-control"   name="bphone" value="<?php echo $rows->PHONE ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                    <p></p>
                                                                    
                                                                    <center>  <div class="clearfix leftm">
                                                                            <button class="btn btn-primary mr5" name="sub_branch" type="submit">Submit</button>
                                                                            <button  type="reset"class="btn btn-default">Cancel</button>
                                                                        </div></center>
                                                                    
                                                                </form>
                                                                <p>&nbsp;</p>
                                                                <p>BRANCHES</p>
                                                                     <div class="table-responsive">
                                                                         <div ng-app="myApp" ng-controller="customersCtrl"> 

                                                                             <table  id="data-table-command" class="table table-striped table-hover">
                                                                                 <tr>
                                                                                 <thead>

                                                                                 <th style="text-align:">CODE</th>
                                                                                 <th>NAME</th>
                                                                                 <th>LOCATION</th>
                                                                                 <th>ADDRESS</th>
                                                                                 <th>CIRCUIT</th>
                                                                                 <th>DISTRICT</th>
                                                                                 <th>REGION</th>
                                                                                 <th>PHONE</th>


                                                                                 <th colspan="3" style="text-align: center">ACTION</th>
                                                                                 </thead>
                                                                                 </tr>
                                                                                 <tr ng-repeat="x in names">
                                                                                     <td>{{x.CODE}}</td>
                                                                                     <td>{{x.NAME}}</td>
                                                                                     <td style="text-align:">{{x.LOCATION}}</td>
                                                                                     <td>{{x.ADDRESS}}</td>
                                                                                     <td>{{x.CIRCUIT}}</td>
                                                                                     <td>{{x.DISTRICT}}</td>
                                                                                     <td>{{x.REGION}}</td>
                                                                                     <td>{{x.PHONE}}</td>
                                                                                     <td style="text-align: center"><a href="setup?delete={{x.CODE}}" onclick="return confirm(confirm('Are you sure you want to delete this account??'))"><i class="fa fa-trash"  title="Delete this account"></i></a></td>
                                                                                     
                                                                                 </tr>
                                                                             </table>

                                                                         </div>


                                                                     </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- tab style --> 
                                                    <div>

                                                    </div>
                                                </div>
                                            </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>
        
        <script src="assets/scripts/vendors.js"></script>
	<script src="assets/scripts/plugins/screenfull.js"></script>
	<script src="assets/scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/scripts/plugins/waves.min.js"></script>
	<script src="assets/scripts/plugins/select2.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-colorpicker.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-slider.min.js"></script>
	<script src="assets/scripts/plugins/summernote.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-datepicker.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-elements.init.js"></script>
        <script type="text/javascript" src="assets/scripts/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
        <?php include("_library_/_includes_/export.php"); ?>
        <script>
                    var app = angular.module('myApp', []);
                app.controller('customersCtrl', function($scope, $http) {
                   $http.get("branch_json.php")
                   .success(function (response) {$scope.names = response.records;});
                });
        </script>
          
         
</body>

</html>