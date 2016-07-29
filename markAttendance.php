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
        if(isset($_POST['save'])){
            $service=$_POST['service'];
            $member=$_POST['member'];
            $status=$_POST['status'];
            $count=$_POST[upper];
             print_r($serviceArr);
            for($i=0;$i<$count;$i++){
                $memberArr=$member[$i];
                $serviceArr=$service;
               
                $statusArr=$status[$i];
                $query=$sql->Prepare("INSERT INTO perez_service_attendance (service,member,status) VALUES('$serviceArr','$memberArr','$status')");
                if($sql->Execute($query)){
                    
                }
                
            }
             //header("location:attendance?success=1");
        }
        
?>
       
<?php include("./_library_/_includes_/header.inc"); ?>
<p>&nbsp;</p>
<?php
    if(isset($_GET[service])){
    $qt = $sql->Prepare("SELECT attendants FROM `perez_services` WHERE  ID ='$_GET[service]'  ");

    $stmt = $sql->Execute($qt);
    $rtmt = $stmt->FetchNextObject();
    $attendant=$rtmt->ATTENDANTS;
     $serviceObject=$help->getServiceName($_GET[service]);

}

?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">

 <div class="content-container" id="content">
<div class="page page-ui-tables">
				 
                            <div class="page-wrap">
                            <div class="col-md-12" >
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                    
                        
<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
    <input type="hidden" name="service" value="<?php echo $_GET[service];  ?>"/>
    <center><p class="text-bold">Attendance Sheet for <?php echo $serviceObject->NAME;  ?> , <?php echo $serviceObject->STARTDATE ." - " . $serviceObject->ENDDATE ." At ".$serviceObject->VENUE;  ?> </p></center>
    <hr>                                          
    <div class="card-body card-padding">
                                                      
                                                    <div class="row">
                                                        <?php
                                                        
                                                        
                                                             $query="SELECT  * FROM  perez_members  where 1 AND ID IN ($attendant)" ;
                                                            $_SESSION[last_query]=$query; 
                                                           // print_r($query);
                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="gad" class="table   display" >
                                                     
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                             <th>Photo</th>
                                                            <th>Member Code</th>
                                                            <th>Name</th>
                                                            
                                                            <th style="text-align: ">Actions</th>
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
                                                    <input type="hidden" name="member[]" value="<?php echo $rtmt[ID] ?>"/>
                                                             <td><a><img  width="80" height="60"<?php   $pic=  $help->pictureid($rtmt[MEMBER_CODE]);  $help->picture("photos/members/$pic.JPG")  ?>   src="<?php echo file_exists("photos/members/$pic.JPG") ? "photos/members/$pic.JPG":"photos/members/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                                             <td style="text-align:"><?php echo $rtmt[MEMBER_CODE] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[TITLE]." ". $rtmt[LASTNAME]." ,".$rtmt[FIRSTNAME]." ".$rtmt[OTHERNAMES] ?></td>
                                                              
                                                             <td style="text-align:">
                                                                 
                                                                 <div class="item checkbox ui-checkbox ui-checkbox-info">
                                                                     <label>
                                                                     <input type="checkbox" checked="" name="status[]" value="Present" 
                                                                                    ><span>Tick to mark presence</span></label>
                                                                         </div>
                                                             </td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                         <input type="hidden" name="upper" value="<?php echo $count++;?>" id="upper" />
                                
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                 
                                         <?php }else{
                                                            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                                  Oh snap! No Members to display 
                                                              </div>";
                                               }?>
                                            
                                                        ?>
                                                         
                                                    </div>
                                                <div align="center">
                                                      
                                                    <button type="submit" name="save" class="btn btn-success">Save <i class="fa fa-save"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                              
                                            </form>
                                                            
 </div>
</div>
                            </div>
</div>
 </div>
 </body>
        <?php include("./_library_/_includes_/theme.inc"); ?>
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