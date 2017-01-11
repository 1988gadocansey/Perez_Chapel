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
             $code=substr(strtoupper($config_file->CHURCH_NAME),0,3).date("Y")."/G/".$help->getGroupCode();
                                         
            //$data = "GROUP_CODE='$_POST[group_code]',LEADER='$_POST[group_leader]',NAME='$_POST[group_name]',DAYS='$days',TITLE='$_POST[group_title]',FIRSTNAME='$_POST[group_firstname]',LASTNAME='$_POST[group_lastname]',OTHERNAMES='$_POST[group_othernames]',ARCHIVED='',CONTACT='',DECEASED='$_POST[group_deceased]',GENDER='$_POST[group_gender]',DOB='$dob',AGE='$age',MARITAL_STATUS='$_POST[group_marital_status]',ANNIVERSARY='',EMAIL='$_POST[group_email]',PHONE='$_POST[group_phone]',TELEPHONE='$_POST[group_telephone]', RESIDENTIAL_ADDRESS='$_POST[group_residential]',CONTACT_ADDRESS='$_POST[group_address]',HOMETOWN='$_POST[group_hometown]',REGION='$_POST[group_region]',COUNTRY='$_POST[group_country]',SECURITY_CODE='',RECEIPT='$_POST[group_receipt]',GIVING_NUMBER='$_POST[group_giving_number]',FAMILY_RELATIONSHIP='$_POST[group_relationship]',MUSIC_TEAM='$_POST[group_team]',DEMOGRAPHICS='$demography',SERVICE_TYPE='$service',LOCATION='$_POST[group_location]',OCCUPATION='$_POST[group_occupation]',PLACE_OF_WORK='$_POST[group_workplace]',NEXT_OF_KIN='$_POST[group_kname]',NEXT_OF_KIN_ADDRESS='$_POST[group_kaddress]',NEXT_OF_KIN_PHONE='$_POST[group_kphone]',PEOPLE_CATEGORY='$_POST[group_category]',MINISTRY='$_POST[group_ministry]',LANGUAGES='$language',ETHNIC='$_POST[group_ethnic]',ACCESS='$access_',DEPARTMENT='$department',SUNDAY_SCHOOL_GRADE='$_POST[group_school_grade]',REPORT='$_POST[group_report]',VOLUNTEER='$_POST[volunteer]',SMS_SUBSCRIBE_SCHEDULES='$_POST[group_sms_schedule]',SMS_SUBSCRIBE='$_POST[group_sms]',EMAIL_UNSUBSCRIBE_SCHEDULES='$_POST[group_email_unsubscribes_schedule]',EMAIL_UNSUBSCRIBE='$_POST[group_email_unsubscribes]'";
           $data="`GROUP_CODE`='$code', `NAME`='$_POST[group_name]', `LEADER`='$_POST[group_leader]', `CATEGORIES`='$_POST[group_category]', `LOCATION`='$_POST[group_location]', `END_DATE`='$enddate', `START_DATE`='$startdate', `DAYS`='$days', `END_TIME`='$_POST[group_endtime]', `START_TIME`='$_POST[group_starttime]', `FREQUENCY`='$_POST[group_frequency]', `DEPARTMENTS`='$department', `DEMOGRAPHICS`='$demography', `ADDRESS`='$_POST[group_address]', `STATUS`='$_POST[group_status]'";
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
                      $help->UpdateGroupCode();
//                   if($update==1){
//                      
//                   }

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
       
        <!-- #end main-navigation -->

        <!-- content-here -->
        <div class="content-container" id="content">





		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Groups</li>
					<li class="active"><a href="#">Add new group</a></li>
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
                                     $_SESSION[group]=$rtmt->GROUP_CODE;
                                     $_SESSION[group_]=$rtmt->GROUP_CODE;

                                   }
                                     
                                     elseif (isset ($_GET["new"])){
                                         if($config_file->GROUP_ID_GEN==1){
                                             $_SESSION[group]="";
                                             
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
                                             


                                        </div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <!-- inline form -->
<div class="row">
 <div class="col-md-12" style="width:900px;margin-left: -95px">
                                  
<div class="panel panel-default panel-hovered panel-stacked mb30">
 
<div class="panel-body">
    


    <Center> <h4 class="form-header">Create Group</h4></center>
    <hr>
    <div class="row">
        <div style="float: right;margin-top: -1%">
            <center> <span class="label label-success">Only jpg file accept and maximum should be 2MB</span></center>
                                    <p></p>
                                    <div class="col-md-9" style="margin-left: 12%">
                                        <form action="addGroup?upload=1" method="POST" enctype="multipart/form-data">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 186px;">
                                                    <img <?php  $person=$_SESSION[group_];
echo $help->picture("photos/groups/$person.jpg", 199) ?>  src="<?php echo file_exists("photos/groups/$person.jpg") ? "photos/groups/$person.jpg" : "photos/groups/user.jpg"; ?>" alt=" Picture of group Here" data-toggle="modal" href="#modalWider"/>
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
                                                    <?php   if ($_SESSION[in] == "") {

                                                        } else { ?><button type="submit" name="upload" class="btn btn-primary">upload</button><?php } ?>

                                            </div>

                                        </form>
                                    </div>

                                </div>
        <div class="col-sm-6">
            <form action="addGroup?" method="post" class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                <input type="hidden" value="<?php echo $rtmt->ID ?>" name="check"/>
            <div class="form-group">
                <label class="col-lg-4 control-label">Select group category <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <select id="title" name="group_category" required="" class=" ">
                         <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT DISTINCT ID,NAME FROM perez_group_category");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->CATEGORIES==$row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Group Name <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <input type="text" name="group_name"   class="form-control check-duplicates" value="<?php echo $rtmt->NAME ?>" autocomplete="off">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                  <label class="col-lg-4 control-label">Branch <i class="fa fa-question-circle fa-fw" title="which branch does this group belongs to" data-toggle="tooltip"></i></label>
                <div class="col-lg-8">
                    <select   data-tags="true"  required="" name="group_location"  id="branch"   data-placeholder="This group is in which location" >

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
            <div class="form-group">
                <label class="col-lg-4 control-label">Frequency </label>
                <div class="col-lg-8">
                    <select name="group_frequency"   id='marital'>
                            <option value="">-- None --</option>
                            <option <?php  if ($rtmt->FREQUENCY == "Daily") {
                                echo "selected='selected'";
                            } ?> value="Daily">Daily</option>
                            <option <?php  if ($rtmt->FREQUENCY == "Weekly") {
                                echo "selected='selected'";
                            } ?> value="Weekly">Weekly</option>
                            <option <?php  if ($rtmt->FREQUENCY == "Monthly") {
                                echo "selected='selected'";
                            } ?>value="Monthly">Monthly</option>
                            
                            <option value="Yearly" <?php  if ($rtmt->FREQUENCY == "Yearly") {
                                echo "selected='selected'";
                            } ?>>Yearly</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Start Date  </label>
                <div class="col-lg-8">
                     <div class="input-group date" id="datepickerDemo1">
                         <input name="group_startdate" type="text" class="form-control" value="<?php echo date("m/d/Y",$rtmt->START_DATE); ?>"  name="member_baptist"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">End Date  </label>
                <div class="col-lg-8">
                     <div class="input-group date" id="join">
                        <input type="text" class="form-control"   name="group_enddate" value="<?php echo date("m/d/Y",$rtmt->END_DATE); ?>"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
                   
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Address</label>
                <div class="col-lg-8">
                    <input type="text" name="group_address" value="<?php echo $rtmt->ADDRESS; ?>" class="form-control check-duplicates"   autocomplete="off">
                     
                </div>
            </div>
                <div class="form-group">
                <label class="col-lg-4 control-label">Group Leader</label>
                <div class="col-lg-8">
                    <select id="category" name="group_leader" required=""   data-placeholder="Select a Member category"  >

                        <option value=''> Select leader</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT ID,MEMBER_CODE,FIRSTNAME,LASTNAME FROM perez_members");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->LEADER== $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['MEMBER_CODE']."-".$row['FIRSTNAME']." ".$row['LASTNAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                      </div>
            </div>
                <div class="form-group">
                <label class="col-lg-4 control-label">Start Time</label>
                <div class="col-lg-8">
                     
                
                <div class="input-group">
                        <input type="text" name="group_starttime" class="form-control time-picker" value="<?php echo $rtmt->START_TIME; ?>" placeholder="hh:mm AM">
                        <div class="input-group-btn">
                                <button type="button" class="btn btn-action dropdown-toggle"  data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
                        </div>
                </div></div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">End Time</label>
                <div class="col-lg-8">
                     
                
                <div class="input-group ">
                    <input type="text" name="group_endtime" class="form-control time-picker" value="<?php echo $rtmt->START_TIME; ?>" placeholder="hh:mm AM">
                    <div class="input-group-btn">
                            <button type="button" class="btn btn-action dropdown-toggle"  data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
                    </div>
            </div></div>
</div>
             
             
            
            
            
        </div>
        <div class="col-sm-6">
            
           
             
             
            <div class="form-group date-picker-member_birthday-age">
                <label class="col-lg-4 control-label">Group Status</label>
                <div class="col-lg-8">
                    <div class="ui-radio ui-radio-success">
                        <label class="radio-inline">
                            <input type="radio" name="group_status" value="1"   <?php
                            if ($rtmt->STATUS=='1') {
                                 echo "checked='checked'";
                            }
                            ?>/>
                            <span> Active</span> </label>
                        <label class="radio-inline">
                            <input type="radio" name="group_status"  value="0" <?php
                            if ($rtmt->STATUS=='0') {
                                echo "checked='checked'";
                            }
                            ?>/>
                            <span>Inactive </span></label>

                         
                    </div>


                </div>

            </div>
            <p>&nbsp;</p>
              
            <div class="form-group">
                <label class="col-lg-4 control-label">Meeting Days <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="check-duplicates-popover-parent">
                        <select id="gender" data-tags="true" multiple="multiple" name="days[]"     data-placeholder="Meeting days for meeting" class="form-control">

                        <option  <?php
                            if (in_array("Sundays", $days_array)) {
                                echo "selected='selected'";
                            }?>  value='Sundays'>Sundays</option>
                        <option <?php
                            if (in_array("Mondays", $days_array)) {
                                echo "selected='selected'";
                            }?>value='Mondays'>Mondays</option>
                        <option <?php
                            if (in_array("Tuesdays", $days_array)) {
                                echo "selected='selected'";
                            }?>value='Tuesdays'>Tuesdays</option>
                        <option <?php
                            if (in_array("Wednesdays", $days_array)) {
                                echo "selected='selected'";
                            }?> value='Wednesdays'>Wednesdays</option>
                        <option <?php
                            if (in_array("Thursdays", $days_array)) {
                                echo "selected='selected'";
                            }?> value='Thursdays'>Thursdays</option>
                        <option <?php
                            if (in_array("Fridays", $days_array)) {
                                echo "selected='selected'";
                            }?>value='Fridays'>Fridays</option>
                        <option <?php
                            if (in_array("Saturdays", $days_array)) {
                                echo "selected='selected'";
                            }?> value='Saturdays'>Saturdays</option>
                        </select>

                    </div>
                </div>
            </div>
    </div>
    </div>
     
    <p>&nbsp;</p>
    <div class="row">
        <div class="col-sm-6">
            <h4 class="form-header">Departments</h4>
            <hr>
            <p class="form-description">Choose the department this group is assigned to.</p>
            <div class="col-sm-9">
            <div class="form-group">
                <label class="col-lg-4 control-label">Departments <i class="fa fa-question-circle fa-fw" title="Departments are the different areas of serving in the church. Choose what departments this group belongs." data-toggle="tooltip"></i>
                </label>
                <div class="col-lg-8">		  
                     <select id="dept" data-tags="true" multiple="multiple" name="group_department[]"     data-placeholder="Department the group belongs" class="form-control">

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
                        </div>
                    </div>
                     
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