<?php
ob_start();
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
            $query=$sql->Prepare("DELETE FROM perez_services WHERE ID='$_GET[delete]'");
            if($sql->Execute($query)){
                 $event="Deletion of services";
                    $activity="$_SESSION[USERNAME] has deleted   service";
                    $hashkey = $_SERVER['HTTP_HOST'];
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $mac = $login->getMac();
                    $sessionId = session_id();
                    $stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                    $sql->Execute($stmt);
                header("location:allservice?success=1");
            }
        }
  /////////////////////////////////////////////////////////////////////////////
     
     
          if(isset($_POST[sms])){
              
          $members = $_SESSION["mem"];
          $service = $_SESSION["service"];
          $message = $_POST[message];
          $query = $sql->Prepare("SELECT  * FROM  perez_members  where 1 AND ID IN ($members)");
          
         /// print_r($query);
          $rt = $sql->Execute($query);
 
         
          $queryString=$sql->Prepare("SELECT * FROM `perez_services`  WHERE ID='$service'");
          $rowSet=$sql->Execute($queryString);
          $resultSet=$rowSet->FetchNextObject();
          
            
           
          $name=$resultSet->NAME;
           
          $venue=$resultSet->VENUE;
          $startDate=$resultSet->STARTDATE;
          $endDate=$resultSet->ENDDATE;
          $startTime=$resultSet->STARTTIME;
          $endTime=$resultSet->ENDTIME;
           
            
          $newstring=str_replace("]", "", "$message");
           $finalstring=str_replace("[", "$", "$newstring");
          eval("\$finalstring =\"$finalstring\" ;");

        //print $finalstring;
           
          While ($stmt=$rt->FetchRow()) {
              $arrayphone= $stmt[PHONE];
              
             // print_r($arrayphone);
              if ($a = $sms->sendSMS1($arrayphone, $finalstring)) {
                  $_SESSION["mem"] = "";

                   header("location:members?success=1");
              }
          }
        }
             
              if(isset($_POST[go])){
             
                $_SESSION[datefrom]=$_POST[start];
                $_SESSION[dateto]=$_POST[end];
                $_SESSION[search] =$_POST[search];
                $startDate=date("d/m/Y",$_SESSION[datefrom]);
                $endDate=date("d/m/Y",$_SESSION[dateto]);

                }
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
       <!-- header -->
	<header class="site-head" id="site-head">
		<script src="assets/scripts/vendors.js"></script>
       
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
 	 
	<!-- main-container -->
	<div class="main-container clearfix">
		 
		<!-- content-here -->
		<div class="content-container" id="content">
                    
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Service Management</li>
					<li class="active"><a href="#">All services</a></li>
				</ol>
                            <div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Invite members to service through this message</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Insert the following placeholders into the message [name] [venue] [theme] [guest] [startDate] [endDate] <br/>[startTime] [endTime]</p>
                                            <form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">Message</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                 <textarea required="" class="form-control" name="message" rows="9" ></textarea>                                    
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="sms" class="btn btn-success">Send <i class="fa fa-phone"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
                      
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:31px;float:right">
                                                        <button  style="margin-top: -59px"   class="btn btn-pink waves-effect" data-target="#sms"  data-toggle="modal">Invite members by sms<i class="fa fa-phone"></i></button>
                                                      
                                                             <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                     
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="margin-left: -22px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                                       
                                        
                                         
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                        
                                           <form action="" method="post">
                                                    <table  width=" " border="0">
                                                            <tr>


                                                       
                                                
                                           <td width="25%">
                                             <div class="input-group date" id="datepickerDemo" style="">
                                                 <input type="text" class="form-control"   name="start"  placeholder="service date from "    />
                                                 <span class="input-group-addon">
                                                     <i class=" fa fa-calendar"></i>
                                                 </span>
                                             </div>
                                           </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                                <div class="input-group date" id="datepickerDemo1">
                                                   <input type="text" class="form-control"    name="end" placeholder="service end date " />
                                                <span class="input-group-addon">
                                                    <i class=" fa fa-calendar"></i>
                                                </span>
                                            </div>

                                           </td>
                                             <td>&nbsp;</td>
                                            <td>
                                                      
                                                    <input style="margin-left: -47px;width:131px" type="search" placeholder="Search here" name="search" id="member_" class="form-control check-duplicates" >

                                                        
                                                </td>
                                                   
                                           <td>&nbsp;</td>
                                        <td width="25%">
                                            <button type="submit" name="go" style="margin-left: 78px; width: 65px;" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </td>
                                           
                                         
                                        </tr>
                                       </table>
                                             </form>
                                       <br/>
                                     
                                </div>
                                               
                                               
                                                <!-- end filters   -->
                                                   <div class="table-responsive">
                                                        <hr>
                                                    <?php
                                                       $search=$_POST[search];
                                                     
                                                       if($_POST[start]=="" ){ $startDate_=""; }else {$startDate_="AND startDate BETWEEN '$_POST[start]' AND '$_POST[end]' "  ;}
                                                       if($search=="" ){ $search=""; }else {$search_="AND name LIKE '%$search%' "  ;}

                                                            $query="SELECT  * FROM perez_services  where 1 $startDate_ $search_" ;
                                                            $_SESSION[last_query]=$query; 
                                                           print_r($query);
                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="gad" class="table  table-striped table-hover" >
                                                    
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                            <th>Type</th>
                                                            <th>Name</th>
                                                            <th>Theme</th>
                                                            <th>Venue</th>
                                                            <th>Guest Speakers</th>
                                                            <th>Attendants</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                             
                                                            <th   style="text-align: center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <p align="center"style="color:red">  <?php echo $recordsFound ?> Service(s) </p>
                                                    <tbody>
                                                        <?php

                                                          $count=0;
                                                           while($rtmt=$rs->FetchRow()){
                                                                                   $count++;
                                                                                   $_SESSION['mem']=$rtmt[attendants];
                                                                                    $_SESSION['service']=$rtmt[id];

                                                              ?>
                                                           <tr>
                                                               <td><?php echo $count ?></td>
                                                              <td style="text-align:"><?php echo $help->getServiceTypeName($rtmt[type]) ?></td>
                                                           
                                                             <td style="text-align:"><?php echo $rtmt[name] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[theme] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[venue] ?></td>
                                                             
                                                             <td style="text-align:"><?php echo $rtmt[guests] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[attendants] ?></td>
                                                             
                                             <input type="hidden" value="<?php echo $rtmt[attendants] ?>" name="member"/>
                                                             <td style="text-align:" class="text-primary" <?php if($rtmt[startDate]==date("d/m/Y")){echo "class=\"text-success\"";}else{echo "class=\"text-primary\"";} ?>><?php echo  $rtmt[startDate] ?></td>
                                                               
                                                             <td style="text-align:"class="text-danger"><?php echo $rtmt[endDate] ?></td>
                                                             
                                                              <td style="text-align:"class="text-primary"><?php echo $rtmt[startTime] ?></td>
                                                              <td style="text-align:"class="text-danger"><?php echo $rtmt[endTime] ?></td>
                                                            
                                                             <td  style="text-align:center"> 
                                                                 <a href="printService.php"><i class="fa fa-print"></i></a>
                                                                 <a onclick="return confirm('Are you sure you want to delete this <?php echo $rtmt[name] ?> service??')" href="allservice?delete=<?php echo  $rtmt[id] ?>"><i class="fa fa-trash" title="click to delete"></i> </a></td>
                                                            
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