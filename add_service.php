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
        if(isset($_GET[service])){
             $_SESSION[service]=$_GET[service];
        }
          
         
      if(isset($_POST[save])){
             
            $name=$_POST["name"];
            $type=$_POST["type"];
            $venue =$_POST["venue"];
            $theme=$_POST["theme"];
            $publish=$_POST["publish"];
            $frequency=$_POST["frequency"];
             
            $members = implode(",",$_POST["attendant"]);
             
            $guest= implode(",",$_POST["guest"]);
             
            $id=$_POST[check];
            
         
            $defaultName = strip_tags($_POST[serviceTimeName]);
            $defaultfrom = strip_tags($_POST[serviceTimeFrom]);
            $defaultto = strip_tags($_POST[serviceTimeTo]);
            
            $othername=strip_tags($_POST[oServiceTimeName]);
            $othertimefrom=strip_tags($_POST[oServiceTimeFrom]);
            $othertimeto=strip_tags($_POST[oServiceTimeTo]);
            
            $code=$help->getCode('SERVICE');
            
            $datefrom=strip_tags($_POST[datefrom]);
            $dateto=strip_tags($_POST[dateto]);
            $session=strip_tags($_SESSION['ID']);
          $data="code='$code',`type`='$type', `name`='$name', `theme`='$theme', `guests`='$guest', `venue`='$venue', `startDate`='$datefrom', `endDate`='$dateto', `startName`='$defaultName', `startTime`='$defaultfrom', `endTime`='$defaultto', `otherStartTimeName`='$othername', `otherStartTime`='$othertimefrom', `otherEndTime`='$othertimeto', `frequency`='$frequency', `attendants`='$members', `publish`='$publish',createdby='$session'";
           //print_r(trim($data));
             
               if (empty($id)){
                    $query2 = $sql->Prepare("INSERT INTO perez_services  SET $data ");
                     
                    $update = 1;
                    $_SESSION[in]=$update;
                }
                else{
                $query2 = $sql->Prepare("UPDATE  perez_services  SET $data WHERE ID='$_POST[check]'");
                     
                }
                if ($sql->Execute($query2)) {
                   if($update==1){
                        $help->UpdateCode('SERVICE');
                   }

                    header("location:allservice?success=1");
                } 
                else {
                    header("location:add_service");
                }
        }
?>  
      <?php include("./_library_/_includes_/header.inc"); ?>
          
  <body id="app" class="app off-canvas">

   <!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
	<!-- #end header -->


    <!-- main-container -->
    <div class="main-container clearfix">
		<!-- content-here -->
		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Services</li>
					<li class="active"><a href="#">Create a Service</a></li>
				</ol>
                            <div><?php $notify->Message(); ?></div>
                            <?php
                                    $config_file=$help->getConfig() ;
                                    if(isset($_GET[service])){
                                        $serviceCat=$_GET[service];
                                        $query = $sql->Prepare("SELECT * FROM perez_service_type WHERE   ID ='$serviceCat'  ");
                                      
                                        $stmt = $sql->Execute($query);
                                        $rtmt = $stmt->FetchNextObject();
                                    }
                                
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
                                            	 


                                        </div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <!-- inline form -->
<div class="row">
    <div class="col-sm-12" style="margin-left: -12px">
<div class="panel panel-default panel-hovered panel-stacked mb30">
 
<div class="panel-body">
    


    <Center> <h4 class="form-header">Add Service</h4></center>
    <hr>
    <div class="row">
        
 
	<form action="" method="post">
		<input type="hidden" name="save" value="1">

			 
		
			<h3 class="form-header">Service Type</h3>

			<p class="form-description">You can choose a predefined Service Type which will automatically fill in the name &amp; times.</p>

			<div class="form-group">
                   
                    <div class="check-duplicates-popover-parent">
                        <select onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?service='+escape(this.value);"  name="type" required="" style="width:130px" class=" ">
                         <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT * FROM `perez_service_type` ");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($row['ID']==$_SESSION[service]) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $row['NAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                        
                    </div>
                </div>
           

		
		<h3 class="form-header">Name and Date(s)</h3>
		<p class="form-description">The service name and date of service . If service between or more date then add start and end date</p>

		<div class="form-group">
			<label class="control-label">Publish</label>
			<div class="checkbox">
				<label><input type="checkbox" name="publish" value="1" class="box" checked> Yes</label>
			</div>
		</div>

		<div class="row"><div class="col-sm-6">

                        <div class="form-group">
                            <label class="">Service Name <span class="text-danger">*</span></label>
                             
                                <div class="check-duplicates-popover-parent">
                                    <input type="text" name="name"   class="form-control check-duplicates" placeholder="name of service" value="<?php echo $rtmt->NAME ?>" autocomplete="off">

                                </div>
                             
                        </div>
</div></div>
			<h3 class="form-header">Dates</h3>
		<p class="form-description">Add the service dates here</p>

		<div class="form-group">
			<ul data-form-list="times" class="list-addremove" >
							<li data-sortable-id="1" class="form-inline">
					 
					<div class="form-group">
						<div class="input-group time">
							 <div class="input-group date" id="datepickerDemo1">
                                                                <input name="datefrom" type="text" class="form-control" value="<?php echo date("m/d/Y",$rtmt->START_DATE); ?>"   />
                                                               <span class="input-group-addon">
                                                                   <i class=" fa fa-calendar"></i>
                                                               </span>
                                                        </div>
                                                         
						</div>
					</div>
					<div class="form-group">
						<div class="input-group time">
		<div class="input-group date" id="datepickerDemo">
                         <input name="dateto" type="text" class="form-control" value="<?php echo date("m/d/Y",$rtmt->START_DATE); ?>"  name="member_baptist"/>
                        <span class="input-group-addon">
                            <i class=" fa fa-calendar"></i>
                        </span>
                    </div>
               
						</div>
					</div>
					 
				</li>
							</ul>
		</div>


		

		<h3 class="form-header">Times</h3>
		<p class="form-description">Add the service meeting time here. If you have more than one service (e.g. an 8:30 AM and a 10:00 AM service) you can add them here as well. Giving times a name is optional, but might help your member to understand.</p>

		<div class="form-group">
			<ul data-form-list="times" class="list-addremove" >
							<li data-sortable-id="1" class="form-inline">
					<div class="form-group">
						<input type="text" name="serviceTimeName" class="field-time-name form-control" value="<?php echo $rtmt->DEFAULT_TIME_NAME; ?>" placeholder="Name">
					</div>
					<div class="form-group">
						<div class="input-group time">
							 <input type="text" name="serviceTimeFrom" class="form-control time-picker" value="<?php echo $rtmt->DEFAULT_TIME_FROM; ?>" placeholder="hh:mm AM">
                      
                                                        <div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group time">
		<input type="text" name="serviceTimeTo" class="form-control time-picker" value="<?php echo $rtmt->DEFAULT_TIME_TO; ?>" placeholder="hh:mm AM"/>
                      <div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					 
				</li>
							</ul>
		</div>

		<h3 class="form-header">Other Times</h3>
		<p class="form-description">Here you can add other times (such as rehearsals) attached to this service. These will also show up on the roster, so make sure you give them names that are easy to understand by your volunteers.</p>

		
		<div class="form-group">
			<ul data-form-list="times" class="list-addremove" >
							<li data-sortable-id="1" class="form-inline">
					<div class="form-group">
						<input type="text" name="oServiceTimeName" class="field-time-name form-control" value="<?php echo $rtmt->OTHER_TIME_NAME; ?>" placeholder="Name">
					</div>
					<div class="form-group">
						<div class="input-group time">
							 <input type="text" name="oServiceTimeFrom" class="form-control time-picker" value="<?php echo $rtmt->OTHER_TIME_FROM; ?>" placeholder="hh:mm AM">
                      
                                                        <div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group time">
		<input type="text" name="oServiceTimeTo" class="form-control time-picker" value="<?php echo $rtmt->OTHER_TIME_TO; ?>" placeholder="hh:mm AM">
                      <div class="input-group-btn">
								<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
							</div>
						</div>
					</div>
					 
				</li>
							</ul>
		</div>
                
                <h3 class="form-header">Guest Speakers</h3>
		<p class="form-description">Here you can add guest speakers for the service from various branches.</p>

		
		<div class="form-group">
                     
                            <div class="form-group">
                                <select id="" name="guest[]" required=""   data-placeholder="Select  Guests" multiple="" >

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
                
                
                <h3 class="form-header">Attendants</h3>
		<p class="form-description">Here you can invite members for service</p>

		
		<div class="form-group">
                     
                            <div class="form-group">
                                <select id="" name="attendant[]" required=""   data-placeholder="Select  attendants" multiple="" >

                        <option value=''> Select attendants</option>
   
                        <?php
                        global $sql;

                        $query2 = $sql->Prepare("SELECT ID,MEMBER_CODE,FIRSTNAME,LASTNAME,BRANCH FROM perez_members");


                        $query = $sql->Execute($query2);


                        while ($row = $query->FetchRow()) {
                            ?>
                            <option value="<?php echo $row['ID']; ?>" <?php
                            if ($rtmt->LEADER== $row['ID']) {
                                echo "selected='selected'";
                            }
                            ?>        ><?php echo $help->getLocation($row['BRANCH'])."".$row['MEMBER_CODE']."/".$row['FIRSTNAME']." ".$row['LASTNAME']; ?></option>

                        <?php } ?>
                          
                    </select>
                            </div>



                       
		</div>

                <h3 class="form-header">Theme for The service</h3>
		<p class="form-description">Here you create the theme for the service</p>

		
                <div class="form-group">
                     <div class="check-duplicates-popover-parent">
                         <input type="text" name="theme"   class="form-control check-duplicates" placeholder="theme of service" value="<?php echo $rtmt->THEME ?>" autocomplete="off">

                      </div>
                </div>
                
                
                <h3 class="form-header">Venue for The service</h3>
		<p class="form-description">Here you create venue for the service</p>

		
                <div class="form-group">
                     <div class="check-duplicates-popover-parent">
                         <input type="text" name="venue"   class="form-control check-duplicates" placeholder="venue of service" value="<?php echo $rtmt->NAME ?>" autocomplete="off">

                      </div>
                </div>
                
                
                 <h3 class="form-header">Frequency of service</h3>
		<p class="form-description">Here can choose the frequency of the service eg monthly, yearly, weekly,daily,quartely</p>

		
                <div class="form-group">
                     <div class="check-duplicates-popover-parent">
                         <select name="frequency"   id='marital' style="width:212px">
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
                
		<center>
        <div class="form-btn form-btn-bottom">
            <button type="submit" name="save" class="btn btn-success">
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