<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        
        $group=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $sms=new _classes_\smsgetway();
        if(isset($_GET[group])){
             $_SESSION[group]=$_GET[group];
        }
          
        if (isset($_GET['upload'])) {
           $group=$_SESSION[group];

            if (!$_FILES["images"]["name"]) {
                echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                $error = 1;
            }
            //check if file type is jpeg 
            elseif ($_FILES["images"]["type"] != "image/jpeg" and $_FILES["images"]["type"] != "image/pjpeg") {
               header("location:addGroup?error=1&&group=$_SESSION[group]&&error=Picture format not accepted");
                $error = 2;
            } elseif (($_FILES["images"]["size"] ) > 2097152) {
                 header("location:addGroup?error=1&&group=$_SESSION[group]");
                $error = 3;
            }

            

              if ($error > 0) {
        
                } else {
                    
                  $destination = "photos/groups/$group.jpg";
                   
                    move_uploaded_file($_FILES["images"]["tmp_name"], $destination);

                    if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                        header("location:addGroup?success=1&&group=$_SESSION[group]");
                    }
                }
         } // end upload
         
    // 
      if(isset($_POST[save])){
             
            $startdate = strtotime($_POST[group_startdate]);
            $enddate = strtotime($_POST[group_enddate]);
             
            $demography = implode(",",$_POST["demographic"]);
             
            $department= implode(",",$_POST["group_department"]);
             $days= implode(",",$_POST["days"]);
            $id=$_POST[check];
            //$data = "GROUP_CODE='$_POST[group_code]',LEADER='$_POST[group_leader]',NAME='$_POST[group_name]',DAYS='$days',TITLE='$_POST[group_title]',FIRSTNAME='$_POST[group_firstname]',LASTNAME='$_POST[group_lastname]',OTHERNAMES='$_POST[group_othernames]',ARCHIVED='',CONTACT='',DECEASED='$_POST[group_deceased]',GENDER='$_POST[group_gender]',DOB='$dob',AGE='$age',MARITAL_STATUS='$_POST[group_marital_status]',ANNIVERSARY='',EMAIL='$_POST[group_email]',PHONE='$_POST[group_phone]',TELEPHONE='$_POST[group_telephone]', RESIDENTIAL_ADDRESS='$_POST[group_residential]',CONTACT_ADDRESS='$_POST[group_address]',HOMETOWN='$_POST[group_hometown]',REGION='$_POST[group_region]',COUNTRY='$_POST[group_country]',SECURITY_CODE='',RECEIPT='$_POST[group_receipt]',GIVING_NUMBER='$_POST[group_giving_number]',FAMILY_RELATIONSHIP='$_POST[group_relationship]',MUSIC_TEAM='$_POST[group_team]',DEMOGRAPHICS='$demography',SERVICE_TYPE='$service',LOCATION='$_POST[group_location]',OCCUPATION='$_POST[group_occupation]',PLACE_OF_WORK='$_POST[group_workplace]',NEXT_OF_KIN='$_POST[group_kname]',NEXT_OF_KIN_ADDRESS='$_POST[group_kaddress]',NEXT_OF_KIN_PHONE='$_POST[group_kphone]',PEOPLE_CATEGORY='$_POST[group_category]',MINISTRY='$_POST[group_ministry]',LANGUAGES='$language',ETHNIC='$_POST[group_ethnic]',ACCESS='$access_',DEPARTMENT='$department',SUNDAY_SCHOOL_GRADE='$_POST[group_school_grade]',REPORT='$_POST[group_report]',VOLUNTEER='$_POST[volunteer]',SMS_SUBSCRIBE_SCHEDULES='$_POST[group_sms_schedule]',SMS_SUBSCRIBE='$_POST[group_sms]',EMAIL_UNSUBSCRIBE_SCHEDULES='$_POST[group_email_unsubscribes_schedule]',EMAIL_UNSUBSCRIBE='$_POST[group_email_unsubscribes]'";
           $data="`GROUP_CODE`='$_POST[group_code]', `NAME`='$_POST[group_name]', `LEADER`='$_POST[group_leader]', `CATEGORIES`='$_POST[group_category]', `LOCATION`='$_POST[group_location]', `END_DATE`='$enddate', `START_DATE`='$startdate', `DAYS`='$days', `END_TIME`='$_POST[group_endtime]', `START_TIME`='$_POST[group_starttime]', `FREQUENCY`='$_POST[group_frequency]', `DEPARTMENTS`='$department', `DEMOGRAPHICS`='$demography', `ADDRESS`='$_POST[group_address]', `STATUS`='$_POST[group_status]'";
           print_r( trim($data));
             
               if (empty($id)) {
                    $query2 = $sql->Prepare("INSERT INTO perez_group  SET $data ");
                     
                    $update = 1;
                    $_SESSION[in]=$update;
                }
                else{
                $query2 = $sql->Prepare("UPDATE  perez_group  SET $data WHERE ID='$_POST[check]'");
                     
                }
                if ($sql->Execute($query2)) {
                   if($update==1){
                        $help->UpdateGroupCode();
                   }

                    header("location:group?success=1&&group=$_SESSION[group]");
                } 
                else {
                    header("location:group?error=1&&group=$_SESSION[group]");
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
                    <link rel="stylesheet" href="assets/scripts/plugins/datetimepicker/bootstrap-datetimepicker.css">
                   
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
                                    
                                
                                     if(isset($_GET[group])){
                                    $qt = $sql->Prepare("SELECT * FROM perez_group WHERE   GROUP_CODE ='$_SESSION[group]'  ");
                                      
                                   $stmt = $sql->Execute($qt);
                                    $rtmt = $stmt->FetchNextObject();
                                     //$person= $rtmt->GROUP_CODE;
                                    $demo_array = explode(",",$rtmt->DEMOGRAPHICS);
                                     
                                    $department_array = explode(",",$rtmt->DEPARTMENTS);
                                      $days_array = explode(",",$rtmt->DAYS);
                                    

                                   }
                                     
                                     elseif (isset ($_GET["new"])){
                                         if($config_file->GROUP_ID_GEN==1){
                                             $_SESSION[group]="";
                                               $_SESSION[group_]=substr(strtoupper($config_file->CHURCH_NAME),0,3).date("Y")."/G/".$help->getGroupCode();
                                         
                                               $_SESSION[group]=$_SESSION[group_];
                                               $person=$_SESSION[group_];
                                         }
                                         else{
                                             
                                         }
                                        
                                    } 
                                    
                                   
                                    if(empty($_SESSION[group_]) || empty( $_SESSION[group])){
                                         $_SESSION[group_]=$rtmt->GROUP_CODE;
                                         $_SESSION[group]=$rtmt->GROUP_CODE;
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
                                                        
                                                        

                                                        To navigate through the guide, use the buttons in the bottom right-hand corner. Each step will take you to a different area of the system and give a quick explanation of its functions and features. We'll always regroup what step you're up to, so feel free to have a look around before moving forward! You can always come back if you need to clarify.

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
    


    <Center> <h4 class="form-header">Add Service</h4></center>
    <hr>
    <div class="row">
        
 
	<form action="/admin/services/add_service/" method="post">
		<input type="hidden" name="save" value="1">

			 
		
			<h3 class="form-header">Service Type</h3>

			<p class="form-description">You can choose a predefined Service Type which will automatically fill in the name &amp; times.</p>

			<div class="row"><div class="col-sm-6">

			
							<div class="form-group">
					<label class="control-label">Type</label>

					<div class="service-type-select"></div>

				</div>

			
			</div></div>

		
		<h3 class="form-header">Name and Date(s)</h3>
		<p class="form-description">The service name will automatically be filled in when you select a Service Type above. This can be changed to any name that you like. You can also add multiple services at once by choosing more than one date.</p>

		<div class="form-group">
			<label class="control-label">Publish</label>
			<div class="checkbox">
				<label><input type="checkbox" name="service_status" value="published" class="box" checked> Yes</label>
			</div>
		</div>

		<div class="row"><div class="col-sm-6">

			<div class="form-group">
				<label class="control-label">Name</label>
				<input name="service_name" type="text" value="" maxlength="255" class="form-control">
			</div>

			<div class="form-group">
				<label class="control-label">Date</label>
					<ul class="service-dates list-addremove">
											<li data-id="1" class="form-inline">
							<div class="form-group">
								<div class="input-group date date-service">
							    <input type="text" name="serviceDateValue[1]" value="02/29/2016" class="form-control field-date-value" placeholder="mm/dd/yyyy">
							   <div class="input-group-btn"><button type="button" class="btn btn-action dropdown-toggle" tabindex="-1"><i class="fa fa-calendar-o"></i></button></div>
								</div>
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-add add-service-date"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-delete delete-service-date" style="display: none"><i class="fa fa-minus"></i></button>
							</div>
						</li>
											</ul>
				</div>

			<div class="form-btn form-btn-left">
				<a href="#" class="btn btn-add bulk-add" data-modal="bulk-add" data-target="#bulk-add"><i class="fa fa-plus"></i>Bulk Add</a>
			</div>

		</div></div>

		<h3 class="form-header">Times</h3>
		<p class="form-description">Add the service meeting time here. If you have more than one service (e.g. an 8:30 AM and a 10:00 AM service) you can add them here as well. Giving times a name is optional, but might help your volunteers to understand.</p>

		<div class="form-group">
			<ul data-form-list="times" class="list-addremove" >
							<li data-sortable-id="1" class="form-inline">
					<div class="form-group">
						<input type="text" name="serviceTimeName[1]" class="field-time-name form-control" value="" placeholder="Name">
					</div>
					<div class="form-group">
						<div class="input-group time">
							<input type="text" name="serviceTimeValue[1]" class="field-time-value form-control" value="" placeholder="hh:mm AM">
							<div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group time">
							<input type="text" name="serviceTimeTo[1]" class="field-time-to form-control" value="" placeholder="hh:mm AM">
							<div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-add add"><i class="fa fa-plus"></i></button>
						<button type="button" class="btn btn-delete delete"><i class="fa fa-minus"></i></button>
					</div>
				</li>
							</ul>
		</div>

		<h3 class="form-header">Other Times</h3>
		<p class="form-description">Here you can add other times (such as rehearsals) attached to this service. These will also show up on the roster, so make sure you give them names that are easy to understand by your volunteers.</p>

		<div class="form-group">
			<ul data-form-list="other_times">
							<li data-sortable-id="1" class="form-inline">
					<div class="form-group">
						<input type="text" name="serviceOtherTimeName[1]" class="field-time-name form-control" value="" placeholder="Name">
					</div>
					<div class="form-group">
						<span class="custom-select">
							<select name="serviceOtherTimeType[1]" class="field-time-type form-control" data-default-value="rehearsal">
								<option value="rehearsal">Rehearsal</option>
								<option value="other">Other</option>
							</select>
						</span>
					</div>
					<div class="form-group">
						<div class="input-group time">
							<input type="text" name="serviceOtherTimeValue[1]" class="field-time-value form-control" value="" placeholder="hh:mm AM">
							<div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group time">
							<input type="text" name="serviceOtherTimeTo[1]" class="field-time-to form-control" value="" placeholder="hh:mm AM">
							<div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-add add"><i class="fa fa-plus"></i></button>
						<button type="button" class="btn btn-delete delete"><i class="fa fa-minus"></i></button>
					</div>
				</li>
							</ul>
		</div>

		<div class="form-btn form-btn-bottom"><button type="submit" class="btn btn-save"><i class="fa fa-check"></i>Save</button></div>

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
        <script src="assets/scripts/plugins/moment.min.js"></script>

        <script src="assets/scripts/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>

        <script>
            //Time
            if ($('.time-picker')[0]) {
                $('.time-picker').datetimepicker({
                    format: 'LT'
                });
            }
        </script>
         
         
</body>

</html>