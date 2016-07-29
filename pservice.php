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
             
            
        $_SESSION[datefrom]="";
        $_SESSION[dateto]="";
         
                                                             
         
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
					<li class="active"><a href="#">Past Services</a></li>
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
                                                      
                                                             
                                                            $query="SELECT  * FROM perez_services  where 1 AND startDate<NOW() ";
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


                                                              ?>
                                                           <tr>
                                                               <td><?php echo $count ?></td>
                                                              <td style="text-align:"><?php echo $help->getServiceTypeName($rtmt[type]) ?></td>
                                                           
                                                             <td style="text-align:"><?php echo $rtmt[name] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[theme] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[venue] ?></td>
                                                             
                                                             <td style="text-align:"><?php echo $rtmt[guests] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[attendants] ?></td>
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
                                                                  No Past Services to display 
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