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
        
        
?>
       
<?php include("./_library_/_includes_/header.inc"); ?>
<p>&nbsp;</p>
<?php
    if(isset($_GET[service])){
    $qt = $sql->Prepare("SELECT distinct member FROM `perez_service_attendance` WHERE  service ='$_GET[service]' and status='Present' ");

    $stmt = $sql->Execute($qt);
    while($rtmt=$stmt->FetchRow()){
    $attendant[]=$rtmt['member'];
   
    }
     $serviceObject=$help->getServiceName($_GET[service]);
     
     $realMembers=  implode(",", $attendant);
      
}

?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">

 <div class="content-container" id="content">
<div class="page page-ui-tables">
				  <div style="margin-top:31px;float:right">
                                                     
                                                             <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                                                             <button   class="btn btn-success  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="javascript:printDiv('print')" title="click to print"><i class="fa fa-print"></i>Print</button>
                                                     
                                              </div>
                            <div class="page-wrap">
                            <div class="col-md-12" >
                                        <div id='print' class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                    
                        
     <center><p class="text-bold">Attendance Sheet for <?php echo $serviceObject->NAME;  ?> , <?php echo $serviceObject->STARTDATE ." - " . $serviceObject->ENDDATE ." At ".$serviceObject->VENUE;  ?> </p></center>
    <hr>                                          
    <div class="card-body card-padding">
                                                      
                                                    <div class="row">
                                                        <?php
                                                        
                                                        
                                                             $query="SELECT  * FROM  perez_members  where 1 AND ID IN ($realMembers)" ;
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
                                                            
                                                            <th>Member Code</th>
                                                             <th>Photo</th>
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
                                                                 <td style="text-align:"><?php echo $rtmt[MEMBER_CODE] ?></td>
                                                           
                                                               <td><a><img  <?php   $pic=  $help->pictureid($rtmt[MEMBER_CODE]); echo $help->picture("photos/members/$pic.JPG",'90')  ?>   src="photos/members/<?php echo $pic;?>.jpg" alt=" Picture of member Here"    /></a></td>
                                                             <td style="text-align:"><?php echo $rtmt[TITLE]." ". $rtmt[LASTNAME]." ,".$rtmt[FIRSTNAME]." ".$rtmt[OTHERNAMES] ?></td>
                                                              
                                                             <td style="text-align:">
                                                                 
                                                                 <div class="item checkbox ui-checkbox ui-checkbox-info">
                                                                     <label>
                                                                         <input readonly="" type="checkbox" checked="" name="status[]" value="Present" 
                                                                                    ><span>Present</span></label>
                                                                         </div>
                                                             </td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                        
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                 
                                         <?php }else{
                                                            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                                  Oh snap! No Members to display 
                                                              </div>";
                                               }?>
                                            
                                                        
                                                         
                                                    </div>
                                                
                                                  
                                                 </div>
                                              
                                          
                                                            
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
                $('#gads').DataTable( {
                    
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