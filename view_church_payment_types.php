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
      $login = new _classes_\Login();

        
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_church_payment_type_info WHERE payment_type_id='$_GET[delete]'");
            if($sql->Execute($query)){
                 $event="Deletion";
                    $activity="$_SESSION[USERNAME] has delete general payment type";
                    $hashkey = $_SERVER['HTTP_HOST'];
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $mac = $login->getMac();
                    $sessionId = session_id();
                    $stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                    $sql->Execute($stmt);
                header("location:view_church_payment_types?success=1");
            }
        }
  /////////////////////////////////////////////////////////////////////////////
        // upload csv
        if(isset($_POST[go])){
     
              	//check if file path is empty
            $extension= end(explode(".", basename($_FILES['file']['name'])));
             if($extension== 'csv'){

            
                    if (!$_FILES["file"]["name"]) {
                        echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                        $error = 1;
                    }

                    elseif (($_FILES["file"]["size"] ) > 25000000) {
                        echo "Only pictures of size less than 250 kb accepted";
                        $error = 3;
                    }

                    $name = $_FILES["file"]["name"];
                    //$var= $name.$_SESSION[area];

                    if ($error > 0) {

                    } else {

                        $destination = "uploads/$name";
                        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
                        if (move_uploaded_file) {

                            # create new parseCSV object.
                            $csv = new parseCSV();
                          # Parse '_books.csv' using automatic delimiter detection...
                            $csv->auto($destination);


                            //print_r($csv->data);

                            foreach ($csv->data as $key => $row) { 

                               // print_r( $row);


                                    $query=$sql->Prepare("INSERT INTO  `perez_members` SET   `MEMBER_CODE`='$row[MEMBER_CODE]', `BARCODE`='$row[BARCODE]', `DATE_JOINED`='$row[DATE_JOINED]', `DATE_BAPTISTED`='$row[DATE_BAPTISTED]', `TITLE`='$row[TITLE]', `FIRSTNAME`='$row[FIRSTNAME]', `LASTNAME`='$row[LASTNAME]', `OTHERNAMES`='$row[OTHERNAMES]', `ARCHIVED`='$row[ARCHIVED]', `CONTACT`='$row[CONTACT]', `DECEASED`='$row[DECEASED]', `GENDER`='$row[GENDER]', `DOB`='$row[DOB]', `AGE`='$row[AGE]', `MARITAL_STATUS`='$row[MARITAL_STATUS]', `ANNIVERSARY`='$row[ANNIVERSARY]', `EMAIL`='$row[EMAIL]', `PHONE`='$row[PHONE]', `TELEPHONE`='$row[TELEPHONE]', `VOLUNTEER`='$row[VOLUNTEER]', `RESIDENTIAL_ADDRESS`='$row[RESIDENTIAL_ADDRESS]', `CONTACT_ADDRESS`='$row[CONTACT_ADDRESS]', `HOMETOWN`='$row[HOMETOWN]', `REGION`='$row[RELIGION]', `COUNTRY`='$row[COUNTRY]', `SECURITY_CODE`='$row[SECURITY_CODE]', `RECEIPT`='$row[RECEIPT]', `GIVING_NUMBER`='$row[GIVING_NUMBER]', `FAMILY_RELATIONSHIP`='$row[FAMILY_RELATIONSHIP]', `MUSIC_TEAM`='$row[MUSIC_TEAM]', `DEMOGRAPHICS`='$row[DEMOGRAPHICS]', `SERVICE_TYPE`='$row[SERVICE_TYPE]', `LOCATION`='$row[LOCATION]', `BRANCH`='$row[BRANCH]', `OCCUPATION`='$row[OCCUPATION]', `PLACE_OF_WORK`='$row[PLACE_OF_WORK]', `NAME_OF_SPOUSE`='$row[NAME_OF_SPOUSE]', `OCUPATION_OF_SPOUSE`='$row[OCUPATION_OF_SPOUSE]', `SPOUSE_PHONE`='$row[SPOUSE_PHONE]', `SSNIT`='$row[SSNIT]', `NEXT_OF_KIN`='$row[NEXT_OF_KIN]', `NEXT_OF_KIN_ADDRESS`='$row[NEXT_OF_KIN_ADDRESS]', `NEXT_OF_KIN_PHONE`='$row[NEXT_OF_KIN_PHONE]', `FATHERS_NAME`='$row[FATHERS_NAME]', `FATHERS_DOB`='$row[FATHERS_DOB]', `MOTHERS_NAME`='$row[MOTHERS_NAME]', `MOTHERS_DOB`='$row[MOTHERS_DOB]', `PHONE2`='$row[PHONE2]', `PEOPLE_CATEGORY`='$row[PEOPLE_CATEGORY]', `MINISTRY`='$row[MINISTRY]' ");
                                    if($sql->Execute($query)){
                                        header("location:dashboard?success=1");
                                    }

                                }


                }


            }
          }
        }
          if(isset($_POST[sms])){
              $q = $_SESSION[last_query];
                $query2 = $sql->Prepare($q);
                $rt = $sql->Execute($query2);

                While ($stmt = $rt->FetchRow()) {
                    $arrayphone = $stmt[PHONE];

                    if ($a = $sms->sendSMS1($arrayphone, $_POST[message])) {
                        $_SESSION[last_query] = "";

                        header("location:members?success=1");
                    }
                }
             }
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
     
	<!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
<script src="assets/scripts/vendors.js"></script>
 	 
	<!-- main-container -->
	<div class="main-container clearfix">
		 
		<!-- content-here -->
		<div class="content-container" id="content">
                    
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Church Finance</li>
					<li class="active"><a href="#">General Payment Types</a></li>
				</ol>
                             
                        
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:31px;float:right">
                                                     
                                                             <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                     
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="margin-left: -22px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                                                
                                               
                                                <!-- end filters   -->
                                                   <div class="table-responsive">
                                                        <hr>
                                                    <?php
                                                                                               
                                                             
                                                            $query="SELECT * FROM `perez_church_payment_type_info`  " ;
                                                            $_SESSION[last_query]=$query; 
                                                           // print_r($query);
                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="gad" class="table  table-striped table-hover" >
                                                    
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                            <th>Payment Type Name</th>
                                                            <th>Status</th>
                                                            
                                                             
                                                            <th   style="text-align: center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                                                    <tbody>
                                                        <?php

                                                          $count=0;
                                                           while($rtmt=$rs->FetchRow()){
                                                                                   $count++;


                                                              ?>
                                                           <tr>
                                                             <td><?php echo $count ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[payment_type_name] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[status] ?></td>
                                                              
                                                             <td  style="text-align:center">
                                                                 <a href="create_church_payment?type=<?php echo  $rtmt[payment_type_id] ?>&&update"> <i class="fa fa-edit" title="click to edit info"></i></a> 
                                                                 <a onclick="return confirm('Are you sure you want to delete  <?php echo $rtmt[payment_type_name] ?> ??')" href="view_church_payment_types?delete=<?php echo  $rtmt[payment_type_id] ?>"><i class="fa fa-trash" title="click to delete"></i> </a></td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                
                                         <?php }else{
                                                            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                                  Oh snap! Something went wrong. No record to display 
                                                              </div>";
                                               }?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	</div> <!-- #end main-container -->
        <script src="assets/scripts/jquery-2.1.1.min.js"></script>
       
	<script src="assets/scripts/jquery.dataTables.min.js"></script>
        <script src="assets/scripts/dataTables.bootstrap.min.js"></script>
          
        <script src="assets/scripts/dataTables.keyTable.min.js"></script>
        
     
       <script>
            $(document).ready(function() {
                $('#gad').DataTable( {
                    
                } );
            } );
        </script>
          
        
<script src="assets/scripts/select2.min.js"></script>
       
        <script>
                 $(document).ready(function(){
                    $('select').select2({ width: "resolve" });


                  });
        </script>
           <?php include("_library_/_includes_/export.php"); ?> 
</body>

</html>