<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $sms=new _classes_\smsgetway();
        if(isset($_GET[member])){
           $_SESSION[member]=$_GET[member];
        }
          
        if (isset($_GET['upload'])) {
           $member=$_SESSION[member];

            if (!$_FILES["images"]["name"]) {
                echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                $error = 1;
            }
            //check if file type is jpeg 
            elseif ($_FILES["images"]["type"] != "image/jpeg" and $_FILES["images"]["type"] != "image/pjpeg") {
               header("location:addMember?error=1&&member=$_SESSION[member]&&error=Picture format not accepted");
                $error = 2;
            } elseif (($_FILES["images"]["size"] ) > 2097152) {
                 header("location:addMember?error=1&&member=$_SESSION[member]");
                $error = 3;
            }

            

              if ($error > 0) {
        
                } else {
                    
                  $destination = "photos/members/$member.jpg";
                   
                    move_uploaded_file($_FILES["images"]["tmp_name"], $destination);

                    if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                        header("location:addMember?success=1&&member=$_SESSION[member]");
                    }
                }
         } // end upload
         
    // 
      if(isset($_POST[save])){
           $code=$help->getCode("ACCOUNT");
           $member_code=$_POST[member_code];
            $age = $help->age($_POST[member_dob], "us");
            $id=$_POST[check];
            if(empty($_POST[member_password1])&&empty($_POST[member_password2])){
                $password=$help->autopassword();
            }
            else{
                $password=md5($_POST[member_password1]);
            }
            $joined = strtotime($_POST[member_joined]);
            $baptised = strtotime($_POST[member_baptised]);
            $dob = strtotime($_POST[member_dob]);
            $demography = implode(",",$_POST["demographic"]);
            $access_ = implode(",",$_POST["access"]);
            $department= implode(",",$_POST["member_department"]);
            $service= implode(",",$_POST["member_service"]);
            $language= implode(",",$_POST["member_language"]);
            $group= implode(",",$_POST["group"]);
            $data = "MEMBER_CODE='$_POST[member_code]',BARCODE='',DATE_JOINED='$joined',DATE_BAPTISTED='$baptised',TITLE='$_POST[member_title]',FIRSTNAME='$_POST[member_firstname]',LASTNAME='$_POST[member_lastname]',OTHERNAMES='$_POST[member_othernames]',ARCHIVED='',CONTACT='',DECEASED='$_POST[member_deceased]',GENDER='$_POST[member_gender]',DOB='$dob',AGE='$age',MARITAL_STATUS='$_POST[member_marital_status]',ANNIVERSARY='',EMAIL='$_POST[member_email]',PHONE='$_POST[member_phone]',TELEPHONE='$_POST[member_telephone]', RESIDENTIAL_ADDRESS='$_POST[member_residential]',CONTACT_ADDRESS='$_POST[member_address]',HOMETOWN='$_POST[member_hometown]',REGION='$_POST[member_region]',COUNTRY='$_POST[member_country]',SECURITY_CODE='',RECEIPT='$_POST[member_receipt]',GIVING_NUMBER='$_POST[member_giving_number]',FAMILY_RELATIONSHIP='$_POST[member_relationship]',MUSIC_TEAM='$_POST[member_team]',DEMOGRAPHICS='$demography',SERVICE_TYPE='$service',LOCATION='$_POST[member_location]',OCCUPATION='$_POST[member_occupation]',PLACE_OF_WORK='$_POST[member_workplace]',NEXT_OF_KIN='$_POST[member_kname]',NEXT_OF_KIN_ADDRESS='$_POST[member_kaddress]',NEXT_OF_KIN_PHONE='$_POST[member_kphone]',PEOPLE_CATEGORY='$_POST[member_category]',MINISTRY='$_POST[member_ministry]',LANGUAGES='$language',ETHNIC='$_POST[member_ethnic]',ACCESS='$access_',DEPARTMENT='$department',SUNDAY_SCHOOL_GRADE='$_POST[member_school_grade]',REPORT='$_POST[member_report]',VOLUNTEER='$_POST[volunteer]',SMS_SUBSCRIBE_SCHEDULES='$_POST[member_sms_schedule]',SMS_SUBSCRIBE='$_POST[member_sms]',EMAIL_UNSUBSCRIBE_SCHEDULES='$_POST[member_email_unsubscribes_schedule]',EMAIL_UNSUBSCRIBE='$_POST[member_email_unsubscribes]',FAMILY='$_POST[family]',GROUPS='$group'";
            trim($data);
            if($_POST[member_send_login]=="yes"){
                   $message="Here is your member portal login details Username='$_POST[member_username]',Password=$_POST[member_password1]";
                     $sms->sendSMS1($_POST[member_phone], $message); 
               }
               if (empty($id)) {
                    $query2 = $sql->Prepare("INSERT INTO perez_members  SET $data ");
                    $query = $sql->Prepare("INSERT INTO perez_members_auth(USER,USERNAME,PASSWORD)VALUES('$_POST[member_code]','$_POST[member_username]','$password')");
                     $query3 =$sql->Prepare("INSERT INTO tbl_accounts(ACCOUNT_NAME,PARENT_ACCOUNT,ACCOUNT_DESCRIPTION,AFFECTS,ACCOUNT_BALANCE,ACCOUNT_CODE,BALANCE_TYPE,BUSINESS_PERSON,BANK_ACCOUNT_NUM)VALUES ('$member_code','2','created ledger account for member','Balance Sheet','0','$code','Debit','$business_person','$account_number')");

                    $update = 1;
                }
                else{
                $query2 = $sql->Prepare("UPDATE  perez_members  SET $data WHERE ID='$_POST[check]'");
                    $query = $sql->Prepare("UPDATE perez_members_auth SET USER='$_POST[member_code]',USERNAME='$_POST[member_username]',PASSWORD='$password' WHERE USER='$_POST[member_code]'");
                    //print_r($query2);
                }
                if ($sql->Execute($query) &&  $sql->Execute($query2) &&  $sql->Execute($query3)) {
                   if($update==1){
                        $help->UpdateIndexno();
                          $help->UpdateCode("ACCOUNT");
                   }

                     header("location:members?success=1&&member=$_SESSION[member]");
                } 
                else {
                      header("location:members?error=1&&member=$_SESSION[member]");
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
                    <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Members</li>
					<li class="active"><a href="#">Data</a></li>
				</ol>
                            <div><?php $notify->Message(); ?></div>
                            <?php
                                   
                                   $config_file=$help->getConfig() ;
                                    
                                
                                     if(isset($_GET[member])){
                                    $qt = $sql->Prepare("SELECT * FROM perez_members WHERE   MEMBER_CODE ='$_SESSION[member]'  ");

                                   $stmt = $sql->Execute($qt);
                                    $rtmt = $stmt->FetchNextObject();
                                    $person= $rtmt->MEMBER_CODE;
                                    $demo_array = explode(",",$rtmt->DEMOGRAPHICS);
                                    $access_array = explode(",",$rtmt->ACCESS);
                                    $department_array = explode(",",$rtmt->DEPARTMENT);
                                    $service_array = explode(",",$rtmt->SERVICE_TYPE);
                                    $language_array = explode(",",$rtmt->LANGUAGES);
                                     $group_array = explode(",",$rtmt->GROUPS);

                                   }
                                     
                                     elseif (isset ($_GET["new"])){
                                         if($config_file->MEMBER_ID_GEN==1){
                                             $_SESSION[member]="";
                                               $_SESSION[member_]=substr(strtoupper($config_file->CHURCH_NAME),0,3).date("Y").$help->getindexno();
                                         
                                               $_SESSION[member]=$_SESSION[member_];
                                         }
                                         else{
                                             
                                         }
                                        
                                    } 
                                    
                                   
                                    if(empty($_SESSION[member_]) || empty( $_SESSION[member])){
                                         $_SESSION[member_]=$rtmt->MEMBER_CODE;
                                         $_SESSION[member]=$rtmt->MEMBER_CODE;
                                    }
                                   
                                 
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

                                                        If you'd like more information on any of the areas mentioned, you can always visit our 'Getting Started Page' for more information. We also have a How-To area, where you can find full setup instructions for each of the <?php echo $config_file->CHURCH_NAME;  ?> features. If there's anything we miss in this guide, or if you have any further questions, be sure to contact our support team for assistance..


                                                    </div>
                                                </div>
                                            </div>	 


                                        </div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <!-- inline form -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default panel-hovered panel-stacked mb30">
 
<div class="panel-body">
    


    <Center> <h4 class="form-header">Personal Information</h4></center>
    <hr>
    <div class="row">
        <div style="float: right;margin-top: -1%">
            <center> <span class="label label-success">Only jpg file accept and maximum should be 2MB</span></center>
                                    <p></p>
                                    <div class="col-md-9" style="margin-left: 12%">
                                        <form action="addMember?upload=1" method="POST" enctype="multipart/form-data">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 186px;">
                                                    <img <?php 
echo $help->picture("photos/members/$person.jpg", 199) ?>  src="<?php echo file_exists("photos/members/$person.jpg") ? "photos/members/$person.jpg" : "photos/members/user.jpg"; ?>" alt=" Picture of member Here" data-toggle="modal" href="#modalWider"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            Select image </span>
                                                        <span class="fileinput-exists">
                                                            Change </span>
                                                        <input type="file" name="images" required="">
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>

                                                </div>
                                                    <?php if ($person == "") {

                                                        } else { ?><button type="submit" name="upload" class="btn btn-primary">upload</button><?php } ?>

                                            </div>

                                        </form>
                                    </div>

                                </div>
        <div class="col-sm-6">
            <form action="addMember?" method="post" class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                <input type="hidden" value="<?php echo $rtmt->ID ?>" name="check"/>
            <div class="form-group">
                <label class="col-lg-4 control-label">Title <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <select id="title" name="member_title" required="" class="form-control">
                         
												
                         <option <?php if($rtmt->TITLE=='Mr'){ echo 'selected="selected"'; }?> >Mr</option>
                        <option <?php if($rtmt->TITLE=='Mrs'){ echo 'selected="selected"'; }?> >Mrs</option>
                        <option <?php if($rtmt->TITLE=='Bishop'){ echo 'selected="selected"'; }?> >Bishop</option>
                         <option <?php if($rtmt->TITLE=='Prophet'){ echo 'selected="selected"'; }?> >Prophet</option>
                          <option <?php if($rtmt->TITLE=='Miss'){ echo 'selected="selected"'; }?> >Miss</option>
                           <option <?php if($rtmt->TITLE=='PhD'){ echo 'selected="selected"'; }?> >PhD</option>
                            <option <?php if($rtmt->TITLE=='Bishop'){ echo 'selected="selected"'; }?> >Bishop</option>
                             <option <?php if($rtmt->TITLE=='Evangelist'){ echo 'selected="selected"'; }?> >Evangelist</option>

                    </select>
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">First Name <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <input type="text" name="member_firstname" id="member_firstname" class="form-control check-duplicates" value="<?php echo $rtmt->FIRSTNAME ?>" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Last Name <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" name="member_lastname" id="member_lastname" class="form-control check-duplicates" value="<?php echo $rtmt->LASTNAME ?>" autocomplete="off">
                     
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Other Names  </label>
                <div class="col-lg-8">
                    <input type="text" name="member_othernames" id="member_" class="form-control check-duplicates" value="<?php echo $rtmt->OTHERNAMES ?>" autocomplete="off">
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Date Baptised  </label>
                <div class="col-lg-8">
                     <div class="input-group date" id="datepickerDemo1">
                         <input name="member_baptised" type="text" class="form-control" value="<?php echo date("m/d/Y",$rtmt->DATE_BAPTISTED); ?>"  name="member_baptist"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Date Joined  </label>
                <div class="col-lg-8">
                     <div class="input-group date" id="join">
                        <input type="text" class="form-control"   name="member_joined" value="<?php echo date("m/d/Y",$rtmt->DATE_JOINED); ?>"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Email Address</label>
                <div class="col-lg-8">
                    <input type="email" name="member_email" value="<?php echo $rtmt->MEMBER_EMAIL; ?>" class="form-control check-duplicates"   autocomplete="off">
                    <div class="item checkbox ui-checkbox ui-checkbox-primary">
                        <label>
                            <input type="checkbox" id="member_email_general" name="member_email_unsubscribes" <?php if($rtmt->EMAIL_UNSUBSCRIBE=="yes"){ echo "checked='checked'";} ?> value="yes"  ><span> Receive general emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from general emails sent from <?php echo $config_file->CHURCH_NAME;  ?>. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span>
                        </label>
                    </div>
                    <div class="item checkbox ui-checkbox ui-checkbox-info">
                        <label><input type="checkbox" id="member_email_scheduling" name="member_email_unsubscribes_schedule" <?php if($rtmt->EMAIL_UNSUBSCRIBE_SCHEDULES=="yes"){ echo "checked='checked'";} ?> value="yes"  checked><span> Receive scheduling emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from service scheduling emails sent from <?php echo $config_file->CHURCH_NAME;  ?>. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Telephone Number</label>
                <div class="col-lg-8">
                    <input type="text" name="member_telephone" class="form-control" value="<?php echo  $rtmt->TELEPHONE; ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Mobile Number</label>
                <div class="col-lg-8">
                    <input type="text" name="member_phone" class="form-control check-duplicates" value="<?php echo  $rtmt->PHONE; ?>" autocomplete="off">
                    <div class="item checkbox  ui-checkbox ui-checkbox-primary">
                            <label class="">
                                <input type="checkbox" name="member_sms" value="yes" <?php if($rtmt->SMS_SUBSCRIBE=="yes"){ echo "checked='checked'";} ?>><span>Receive general messages <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from general SMS messages sent from <?php echo $config_file->CHURCH_NAME;  ?>. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span></label>
                        </div>
                        <div class="item checkbox ui-checkbox ui-checkbox-success">
                            <label class="">
                                <input type="checkbox" name="member_sms_schedule" value="yes" <?php if($rtmt->SMS_SUBSCRIBE_SCHEDULES=="yes"){ echo "checked='checked'";} ?>><span>Receive scheduling messages  <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from service scheduling SMS messages sent from <?php echo $config_file->CHURCH_NAME;  ?>. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span></label>
                        </div>
                </div>
            </div>
            <div class="form-group"><label class="col-lg-4 control-label">Gender</label>
                <div class="col-lg-8">
                    <select name="member_gender" class="form-control" id="gender" required="">
                        <option value=""></option>
                         <option value="Male"    <?php if ($rtmt->GENDER == "Male") {
                                    echo "selected='selected'";
                                } ?>      >Male</option>
                                                        <option value="Female"    <?php if ($rtmt->GENDER == "Female") {
                                    echo "selected='selected'";
                                } ?>      >Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Languages Spoken</label>
                <div class="col-lg-8">
                    <select id="multiSelect" data-tags="true" multiple="multiple" name="member_language[]"      class="form-control">

                        <option value=''> select languages spoken</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_languages");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['NAME']; ?>" <?php
                            if (in_array($row['NAME'],$language_array)) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Member Category</label>
                <div class="col-lg-8">
                    <select id="category" name="member_category" required=""   data-placeholder="Select a Member category" class="form-control">

                        <option value=''> category</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_member_category");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->PEOPLE_CATEGORY == $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['CATEGORY']; ?></option>

                        <?php } ?>
                          
                    </select>
                    <p  class="text-danger text-right small"><a href="addCategory?new=1">Add New Category</a></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">Ministry Assigned</label>
                <div class="col-lg-8">
                    <select id="ministry" name="member_ministry" required=""   data-placeholder="Select a Member category" class="form-control">

                        <option value=''> Ministries</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_ministries");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->MINISTRY == $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                    <p  class="text-danger text-right small"><a href="addMinistry?new=1">Add New Ministry</a></p>
                </div>
            </div>
                <div class="form-group">
                <label class="col-lg-4 control-label">Belongs to Family</label>
                <div class="col-lg-8">
             <select id="family" name="family"      class="form-control">

                        <option value=''> families</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM  perez_family");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->FAMILY == $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['CODE']."/".$row['LASTNAME']."/". $row['ADDRESS']; ?></option>

                        <?php } ?>
                          
                    </select>
                </div>
            </div>
           <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Belongs to Group</label>
                <div class="col-lg-8">
                    <select id="service" data-tags="true" multiple="multiple" name="group[]"      class="form-control">

                        <option value=''> select group </option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_group");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if (in_array($row['ID'],$group_array)) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Date of Birth</label>
                <div class="col-lg-8">
                    <div class="input-group date" id="datepickerDemo">
                        <input type="text" class="form-control" required="" name="member_dob" value="<?php echo date("m/d/Y",$rtmt->DOB); ?>"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Member Code <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <input type="text" name="member_code"  required="" class="form-control check-duplicates" value="<?php echo $_SESSION[member_] ?>" readonly="" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Ethnic group</label>
                <div class="col-lg-8">
                    <select id="ethnic"    name="member_ethnic"     data-placeholder="Ethnic group" class="form-control">

                        <option value=''> select ethnic group</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_ethnic");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['NAME']; ?>" <?php
                            if ($rtmt->ETHNIC == $row['NAME']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                    
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group date-picker-member_birthday-age">
                <label class="col-lg-4 control-label">Deceased</label>
                <div class="col-lg-8">
                    <div class="ui-radio ui-radio-success">
                        <label class="radio-inline">
                            <input type="radio" name="member_deceased" value="No"   <?php
                            if ($rtmt->DECEASED=='No') {
                                 echo "checked='checked'";
                            }
                            ?>/>
                            <span> Alive</span> </label>
                        <label class="radio-inline">
                            <input type="radio" name="member_deceased"  value="Yes" <?php
                            if ($rtmt->DECEASED=='Yes') {
                                echo "checked='checked'";
                            }
                            ?>/>
                            <span> Deceased </span></label>

                         
                    </div>


                </div>

            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <div class="input-field">
                    <label class="col-lg-4 control-label">Family Relationship</label>
                    <div class="col-lg-8"> 
                        <select name="member_relationship" class="form-control" required="" id="personSelect">
                            <option value="">-- None --</option>
                            <option value="Father" <?php if($rtmt->FAMILY_RELATIONSHIP=="Father"){echo "selected='selected'";} ?>>Father</option>
                            <option value="Mother"<?php if($rtmt->FAMILY_RELATIONSHIP=="Mother"){echo "selected='selected'";} ?>>Mother</option>
                            <option value="Uncle" <?php if($rtmt->FAMILY_RELATIONSHIP=="Uncle"){echo "selected='selected'";} ?>>Uncle</option>
                            <option value="Wife" <?php if($rtmt->FAMILY_RELATIONSHIP=="Wife"){echo "selected='selected'";} ?>>Wife</option>
                            <option value="Husband" <?php if($rtmt->FAMILY_RELATIONSHIP=="Husband"){echo "selected='selected'";} ?>>Husband</option>
                            <option value="Daughter" <?php if($rtmt->FAMILY_RELATIONSHIP=="Daughter"){echo "selected='selected'";} ?>>Daughter</option>
                            <option value="Son" <?php if($rtmt->FAMILY_RELATIONSHIP=="Son"){echo "selected='selected'";} ?>>Son</option>
                       </select>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <div class="input-field">
                    <label class="col-lg-4 control-label">Sunday School Grade</label>
                    <div class="col-lg-8">
                        <select name="member_school_grade" class="form-control" id="sunday">
                            <option value="">-- None --</option>
                            <option value="Nursery/Pre-school" <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Nursery/Pre-school"){echo "selected='selected'";} ?>>Nursery/Pre-school</option>
                            <option value="Kindergarten"  <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Kindergarten"){echo "selected='selected'";} ?>>Kindergarten</option>
                            <option value="Primary" <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Primary"){echo "selected='selected'";} ?>>Primary</option>
                            <option value="Junior" <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Junior"){echo "selected='selected'";} ?>>Junior</option>
                            <option value="Senior" <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Senior"){echo "selected='selected'";} ?>>Senior</option>
                            <option value="Adult" <?php if($rtmt->SUNDAY_SCHOOL_GRADE=="Adult"){echo "selected='selected'";} ?>>Adult</option>
                        </select>
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Marital Status</label>
                <div class="col-lg-8">
                    <select name="member_marital" class="form-control" id="marital">
                        <option value=""></option>
                        <option value="single"<?php if($rtmt->MARITAL_STATUS=="single"){echo "selected='selected'";} ?>>Single</option>
                        <option value="engaged" <?php if($rtmt->MARITAL_STATUS=="engaged"){echo "selected='selected'";} ?>>Engaged</option>
                        <option value="married" <?php if($rtmt->MARITAL_STATUS=="married"){echo "selected='selected'";} ?>>Married</option>
                        <option value="defacto" <?php if($rtmt->MARITAL_STATUS=="defacto"){echo "selected='selected'";} ?>>Partner</option>
                        <option value="widowed" <?php if($rtmt->MARITAL_STATUS=="widowed"){echo "selected='selected'";} ?>>Widowed</option>
                        <option value="divorced" <?php if($rtmt->MARITAL_STATUS=="divorced"){echo "selected='selected'";} ?>>Divorced</option>
                        <option value="separated" <?php if($rtmt->MARITAL_STATUS=="seperated"){echo "selected='selected'";} ?>>Separated</option>
                    </select>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Anniversary</label>
                <div class="col-lg-8">
                    <div class="input-group date" id="datepickerDemo1">
                        <input type="text" class="form-control" name="member_anniversary" value="NEW"/>
                         
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
             
            <div class="form-group">
                <label class="col-lg-4 control-label">Receipt Name <i class="fa fa-question-circle fa-fw" title="The name this person requires on their tax receipt." data-toggle="tooltip"></i></label>
                <div class="col-lg-8">
                 <input type="text" name="member_receipt" value="<?php echo $rtmt->RECEIPT; ?>" class="form-control"   autocomplete="off">
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Giving Number <i class="fa fa-question-circle fa-fw" title="A unique privacy number for tax deductible giving." data-toggle="tooltip"></i></label>
                <div class="col-lg-8">
                    <input type="text" name="member_giving_number" value="<?php echo $rtmt->GIVING_NUMBER; ?>" class="form-control"   autocomplete="off">
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Access Permissions <i class="fa fa-question-circle fa-fw" title="This determines what access this person has." data-toggle="tooltip"></i></label>
                <div class="col-lg-8"><div data-multi-select="access[]">
                        <div class="checkbox-group">
                            <div  class="item checkbox ui-checkbox ui-checkbox-primary">
                                <label class="">
                                    <input type="checkbox" name="access[]" value="Admins" <?php if(in_array("Admins",  $access_array)){ echo "checked='checked'";} ?> ><span>Admins</span>
                                </label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-pink">
                                <label class="">
                                    <input type="checkbox" name="access[]" value="Leaders" <?php if(in_array("Leaders",  $access_array)){ echo "checked='checked'";} ?> ><span>Leaders</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-info">
                                <label class="">
                                    <input type="checkbox" checked="" name="access[]" value="Members" <?php if(in_array("Members",  $access_array)){ echo "checked='checked'";} ?> ><span>Members</span></label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="has_access" value="1">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        
        <center>  <h4 class="form-header">Other Relevant Information</h4></center>
            <hr>
        
        
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Occupation <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <input type="text" name="member_occupation" value="<?PHP echo $rtmt->OCCUPATION ?> "required="" class="form-control check-duplicates"   autocomplete="off">
                        
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">Place of work <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <input type="text" name="member_workplace" required=""id="member_firstname" class="form-control check-duplicates"  value="<?PHP echo $rtmt->PLACE_OF_WORK ?>" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Next of Kin Name <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" required="" name="member_kname" id="member_lastname" class="form-control check-duplicates" value="<?PHP echo $rtmt->NEXT_OF_KIN ?>" autocomplete="off">
                     
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Next of Kin Phone  </label>
                <div class="col-lg-8">
                    <input type="text" required="" name="member_kphone" id="member_" class="form-control check-duplicates" value="<?PHP echo $rtmt->NEXT_OF_KIN_PHONE ?>" autocomplete="off">
                   
                </div>
            </div>
           
             
            <div class="form-group">
                <label class="col-lg-4 control-label">Next of Kin Address</label>
                <div class="col-lg-8">
                    <input type="text" name="member_kaddress" required=""class="form-control" value="<?PHP echo $rtmt->NEXT_OF_KIN_ADDRESS ?>" autocomplete="off">
                </div>
            </div>
           <p>&nbsp;</p>
             
             
            
             
        
            <div class="form-group">
                <label class="col-lg-4 control-label">Service Type</label>
                <div class="col-lg-8">
                    <select id="service" data-tags="true" multiple="multiple" name="member_service[]"      class="form-control">

                        <option value=''> select services </option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_service_type");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if (in_array($row['ID'],$service_array)) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['SERVICE']; ?></option>

                        <?php } ?>
                          
                    </select>
                    
                </div>
            </div>
             
            
             
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                    <label class="col-lg-4 control-label">Country of residence <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <select id="country" name="member_country" required=""   data-placeholder="Select nationality" class="form-control">

                        <option value=''> Countries</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_country");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['Name']; ?>" <?php
                            if ($rtmt->COUNTRY == $row['Name']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['Name']; ?></option>

                        <?php } ?>
                          
                    </select>
                        
                    </div>
                </div>
            </div>
            <p>&nbsp;</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Region <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                       <select id="region" name="member_region" required=""   data-placeholder="Select a region" class="form-control">

                        <option value=''>Choose region</option>

                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['NAME']; ?>" <?php
                            if ($rtmt->REGION == $row['NAME']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>

                    </select>
  
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Contact Address <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" name="member_address"  required="" class="form-control check-duplicates" value="<?php echo $rtmt->CONTACT_ADDRESS ?>">
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Residential Address  </label>
                <div class="col-lg-8">
                    <input type="text" name="member_residential" id="member_" class="form-control check-duplicates" value="<?php echo $rtmt->RESIDENTIAL_ADDRESS ?>" autocomplete="off">
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Home Town  </label>
                <div class="col-lg-8">
                    <input type="text" name="member_hometown" id="member_" required="" class="form-control check-duplicates" value="<?php echo $rtmt->HOMETOWN ?>" autocomplete="off">
                   
                </div>
            </div>
            
             
             
        </div>
    </div>
    <p>&nbsp;</p>
    <div class="row">
        <div class="col-sm-6">
            <h4 class="form-header">Branch</h4>
            <hr>
            <p class="form-description">Choose the branch this person is assigned to.</p>
            <div class="form-group">
                <label class="col-lg-4 control-label">Locations <i class="fa fa-question-circle fa-fw" title="The locations this person attends" data-toggle="tooltip"></i></label>
                <div class="col-lg-8">
                    <select   data-tags="true"  required="" name="member_location"  id="branch"   data-placeholder="This person is in which location" class="form-control">

                        <option value=''>Choose Location</option>

                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_branches");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->LOCATION == $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME'] . " " . $row['LOCATION'] . " - " . $row['REGION']; ?></option>

                        <?php } ?>

                    </select>

                </div>

            </div>

        </div>
        
        <div class="col-sm-6">
            <h4 class="form-header">Demographics</h4><p class="form-description">Choose the demographics of this person.</p>
            <hr>
            <div class="form-group"><label class="col-lg-4 control-label">Demographics <i class="fa fa-question-circle fa-fw" title="The demographics of this person." data-toggle="tooltip"></i></label><div class="col-lg-8"><div data-multi-select="demographic[]"><div class="checkbox-group">
                            <div class="item checkbox  ui-checkbox ui-checkbox-primary">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" <?php if(in_array("Adults",  $demo_array)){ echo "checked='checked'";} ?> value="Adults"><span>Adults</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-info">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" <?php if(in_array("Families",  $demo_array)){ echo "checked='checked'";} ?> value="Families"><span>Families</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-warning">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" value="Youlth" <?php if(in_array("Youlth",  $demo_array)){ echo "checked='checked'";} ?>><span>Youth</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-danger">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" value="Children" <?php if(in_array("Children",  $demo_array)){ echo "checked='checked'";} ?>><span>Children</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-danger">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" value="Old Age" <?php if(in_array("Old Age",  $demo_array)){ echo "checked='checked'";} ?>><span>Old Age</span></label>
                            </div>
                            <div class="item checkbox ui-checkbox ui-checkbox-danger">
                                <label class="">
                                    <input type="checkbox" name="demographic[]" value="Ophans" <?php if(in_array("Children",  $demo_array)){ echo "checked='checked'";} ?>><span>Orphans</span></label>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div><hr>
    <h4 class="form-header">Volunteer</h4>
    
    <p class="form-description">These are the main personal details for this person.</p>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Volunteer <i class="fa fa-question-circle fa-fw" title="Check this box if this person is a volunteer." data-toggle="tooltip"></i>
                </label>
                <div class="col-lg-8">
                    <div class="checkbox  ui-checkbox ui-checkbox-primary"><label>
                            <input type="checkbox" name="volunteer" <?php if($rtmt->VOLUNTEER=="yes"){echo "checked='checked'";} ?> value="yes"> <span>Yes</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Username</label>
                <div class="col-lg-8">
                    <input type="text" name="member_username" id="member_username" class="form-control"  autocomplete="off" autocapitalize="none" autocapitalize="off" autocorrect="off" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Password</label>
                <div class="col-lg-8">
                    <input type="password" name="member_password1" class="form-control" autocomplete="off">
                    <input type="password" name="member_password2" class="form-control" autocomplete="off">
                    <p class="help-block">Leave blank to automatically generate a password</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Send Login?</label>
                <div class="col-lg-8">
                    <div class="checkbox ui-checkbox ui-checkbox-pink">
                        <label>
                            <input type="checkbox" name="member_send_login" value="yes" checked=""><span> Send these login details to the new user via sms?</span></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Reports To</label>
                <div class="col-lg-8">
                    <select id="report" data-tags="true" multiple="multiple" name="member_report"     data-placeholder="This person reports to who??" class="form-control">

                        <option value=''>Choose member</option>

                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT ID,MEMBER_CODE,TITLE,FIRSTNAME,LASTNAME,OTHERNAMES FROM perez_members");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->REPORT == $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['TITLE'] . " " . $row['SURNAME'] . " " . $row['FIRSTNAME'] . " " . $row['OTHERNAMES']; ?></option>

                        <?php } ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Departments <i class="fa fa-question-circle fa-fw" title="Departments are the different areas of serving in the church. Choose what departments this person serves within." data-toggle="tooltip"></i>
                </label>
                <div class="col-lg-8">		  
                     <select id="dept" data-tags="true" multiple="multiple" name="member_department[]"     data-placeholder="Department the person belong" class="form-control">

                        <option value=''>Choose department</option>

                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM perez_departments WHERE PARENT!='0'");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if (in_array($row[ID], $department_array)) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME'] ; ?></option>

                        <?php } ?>

                    </select>
                </div>
            </div>
        </div>
    </div>
     
    <p>&nbsp;</p>
    <center>
        <div class="form-btn form-btn-bottom">
            <button type="submit" name="save" class="btn btn-primary">
                <i class="fa fa-save"></i>Save</button>
        </div></center>


</form>

</div>

</div> <!-- #end panel body -->
</div> <!-- #end panel -->
</div>

</div>
			</div>
			

		</div>

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>
        
	<?php include("./_library_/_includes_/js.php"); ?>
        
         
         
</body>

</html>