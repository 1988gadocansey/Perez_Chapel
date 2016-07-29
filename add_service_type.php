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
            $adminView=strip_tags($_POST[admin]);
            $volunteer=strip_tags($_POST[volunteer]);
            $defaultName = strip_tags($_POST[defaultName]);
            $defaultfrom = strip_tags($_POST[defaultTimeFrom]);
            $defaultto = strip_tags($_POST[defaultTimeTo]);
            $othername=strip_tags($_POST[otherName]);
            $othertimefrom=strip_tags($_POST[otherTimeFrom]);
            $othertimeto=strip_tags($_POST[otherTimeTo]);
              
            $department=strip_tags($_POST["department"]);
            $code="ST".$help->getServiceType();
            
            $data=" CODE='$code',`ADMIN_NAME`='$adminView', `VOLUNTEERS_NAME`='$volunteer', `DEFAULT_TIME_NAME`='$defaultName', `DEFAULT_TIME_FROM`='$defaultfrom', `DEFAULT_TIME_TO`='$defaultto', `OTHER_TIME_NAME`='$othername', `OTHER_TIME_FROM`='$othertimefrom', `OTHER_TIME_TO`='$othertimeto', `SERVICE_PLAN_DEPARTMENT`='$departments', ACTOR='$_SESSION[ID]'";
           print_r( trim($data));
             
           // upload picture here
           if (!$_FILES["images"]["name"]) {
                echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                $error = 1;
            }
            //check if file type is jpeg 
            elseif ($_FILES["images"]["type"] != "image/jpeg" and $_FILES["images"]["type"] != "image/pjpeg") {
                   $error = 2;
            } elseif (($_FILES["images"]["size"] ) >400000) {
                      $error = 3;
            }

            

              if ($error > 0) {
        
                } else {
                    
                  $destination = "photos/services/$code.jpg";
                   
                    move_uploaded_file($_FILES["images"]["tmp_name"], $destination);

                    if (move_uploaded_file) {//echo "<font color='red' style='text-decoration:blink'> Picture uploaded  successfully </font>" ;
                        
                    }
                }
           
           
           
           
           
           
           
           
               if (empty($id)) {
                    $query2 = $sql->Prepare("INSERT INTO perez_service_type  SET $data ");
                     
                    $insert = 1;
                    $_SESSION[in]=$update;
                }
                else{
                $query2 = $sql->Prepare("UPDATE  perez_service_type  SET $data WHERE ID='$_POST[check]'");
                     
                }
                if ($sql->Execute($query2)) {
                   if($insert==1){
                        $help->UpdateServiceType();
                   }

                    header("location:add_service_type?success=1&&group=$_SESSION[group]");
                } 
                else {
                    header("location:add_service_type?error=1&&group=$_SESSION[group]");
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
        <!-- main-navigation -->
       
        <!-- #end main-navigation -->

        <!-- content-here -->		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Services</li>
					<li class="active"><a href="#">Add service categories</a></li>
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
                                    <!-- Basic Table -->
                                    <!-- inline form -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default panel-hovered panel-stacked mb30">
 
<div class="panel-body">
    


    <Center> <h5  >Add Service Type</h5></center>
    <hr>
     
		<form action="" name="serviceType"  method="post" enctype="multipart/form-data" v-form>
			<input type="hidden" name="check" value="<?php echo $servic->ID;?>">
		
			 
		
                        <h5 class="form-header">Details</h5>
                        <hr>
			<p class="form-description">Enter a descriptive name for this Service Type in the 'Type Name'.  Enter a name for this type of service which is displayed to your volunteers.</p>
		
			<div class="row"><div class="col-sm-6">

				<div class="form-group">
					<label class="control-label">Name (admin  only sees this)</label>
					<input type="text" name="admin"  maxlength="255" class="form-control" required>
				</div>
	
				
			<div class="form-group">
				<label class="control-label">Name (volunteers see this)</label>
                                <input type="text" name="volunteer"  required="" v-model="volunteer"v-form-ctrl  maxlength="255" class="form-control">
			</div>
                                   
			
			</div></div>
		
			<h5 class="form-header">Times</h5>
			<p class="form-description">Here you can add the default times for this Service Type. You can add more than one time if this Service Type has multiple services. These can be changed when adding a service if required.</p>

			<div class="form-group">
				<ul data-form-list="times" class="list-addremove">
                                <li data-sortable-id="1" class="form-inline">
						 	<div class="form-group">
                                                            <input type="text" name="defaultName" required="" class="field-time-name form-control form-control-auto"  placeholder="Name">
						</div>
						<div class="form-group">
							<div class="input-group time">
								<input type="text" name="defaultTimeFrom"  class="form-control time-picker"  placeholder="hh:mm AM">
								<div class="input-group-btn">
									<button type="button"  class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group time">
                                                            <input type="text" name="defaultTimeTo" required=""class="form-control time-picker"  placeholder="hh:mm AM">
								<div class="input-group-btn">
									<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
								</div>
							</div>
						</div>
						 
					</li>
									</ul>
			</div>

			<h5 class="form-header">Other Times</h5>
			<p class="form-description">Here you can add other times (such as rehearsal times) to the Service Type. These can be changed when adding a service if required.</p>
			
			<div class="form-group">
				<ul data-form-list="other_times" class="list-addremove">
									<li data-sortable-id="1" class="form-inline">
						 	<div class="form-group">
							<input type="text" name="otherName" class="field-time-name form-control"  placeholder="Name">
						</div>
						 
						<div class="form-group">
							<div class="input-group time">
								<input type="text" name="otherTimeFrom" class="form-control time-picker"   v-model="othertimefrom"v-form-ctrl placeholder="hh:mm AM">
								                
							</div>
						</div>
						<div class="form-group">
							<div class="input-group time">
                                                            <input type="text" name="otherTimeTo" required="" class="form-control time-picker"  placeholder="hh:mm AM">
								<div class="input-group-btn">
									<button type="button" class="btn btn-action dropdown-toggle" data-toggle="dropdown" tabindex="-1"><i class="fa fa-clock-o"></i></button>
								</div>
							</div>
						</div>						
						 
					</li>
									</ul>
			</div>
		
			<h5 class="form-header">Service Plan Logo</h5>
			<p class="form-description">Here you can upload a logo that will be placed at the top of your Service Plan when a service is printed. Allowed image files:JPG, PNG &amp; GIF</p>
		
				
			<div class="form-group">
                            <center>only jpg accepted, maximum size 400kb</center>
				  <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 186px;">
                                                    <img <?php 
echo $help->picture("photos/service/$person.jpg", 199) ?>  src="<?php echo file_exists("photos/services/$person.jpg") ? "photos/members/$person.jpg" : "photos/members/user.jpg"; ?>" alt=" Service Banner here" data-toggle="modal" href="#modalWider"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new">
                                                            Select image </span>
                                                        <span class="fileinput-exists">
                                                            Change </span>
                                                        <input type="file" name="images"  >
                                                    </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                        Remove </a>

                                                </div>
                                                     

                                                        
                                            </div>
			</div>

			<h5 class="form-header">Service Plan Departments</h5>
			<p class="form-description">Departments reponsible for the service</p>

			    <div class="col-sm-6">
            <div class="form-group">
                <label class="col-lg-4 control-label">Departments <i class="fa fa-question-circle fa-fw" title="Departments are the different areas of serving in the church. Choose what departments this person serves within." data-toggle="tooltip"></i>
                </label>
                <div class="col-lg-8">		  
                    <select id="gender" data-tags="true"  name="department" multiple=""    data-placeholder="Department responsible for service" class="form-control">

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
                        
                 
                        
                        
                        
                        
    <center><div class="form-btn form-btn-bottom"><button type="submit"v-show="serviceType.$valid"  name="save" class="btn btn-primary"><i class="fa fa-check"></i>Save</button></center></div>
	
		</form>


</div>

</div> <!-- #end panel body -->
</div> <!-- #end panel -->
</div>

</div>
			</div>
			

		</div>

	</div> <!-- #end main-container -->
  
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
         
     
         <script>


 

var vm = new Vue({
  el: "#apps",
  ready : function() {
  },
 data : {
    
    
  },
   
})

</script>
</body>

</html>