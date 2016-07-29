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
        if($_GET[region]){
        $_SESSION[region]=$_GET[region];
        }
        if($_GET[city]){
        $_SESSION[city]=$_GET[city];
        }
         
        if($_GET[family]){
        $_SESSION[family]=$_GET[family];
        }
        
        if($_GET[nation]){
        $_SESSION[nation]=$_GET[nation];
        }
        
         
        /*
         * deleting a family
         */
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_family WHERE CODE='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:addFamily?success=1");
            }
            else{
                header("location:addFamily?error=1");
            }
        }
         
         
    //////////////////////////////////////////////////
      if(isset($_POST[save])){
             
            $id=$_POST[check];
             
             
            $data = "CODE='$_POST[code]',LASTNAME='$_POST[lastname]',PHONE='$_POST[phone]',EMAIL='$_POST[email]',ADDRESS='$_POST[address]',REGION='$_POST[region]',COUNTRY='$_POST[country]',CITY='$_POST[city]'";
            trim($data);
             
               if (empty($id)) {
                    $query2 = $sql->Prepare("INSERT INTO perez_family  SET $data ");
                    
                    $update = 1;
                }
                else{
                $query2 = $sql->Prepare("UPDATE  perez_family  SET $data WHERE ID='$_POST[check]'");
                    
                }
                if (  $sql->Execute($query2)) {
                   if($update==1){
                        $help->UpdateIndexno();
                   }

                     header("location:addFamily?success=1&&member=$_SESSION[family]");
                } 
                else {
                      header("location:addFamilys?error=1&&member=$_SESSION[family]");
                }
        }
        
/////////////////////////////////////////////////////////////////////////
                               $config_file=$help->getConfig() ;
                                    
                                
                                     if(isset($_GET[member])){
                                 /*   $qt = $sql->Prepare("SELECT * FROM perez_members WHERE   MEMBER_CODE ='$_SESSION[family]'  ");

                                   $stmt = $sql->Execute($qt);
                                    $rtmt = $stmt->FetchNextObject();
                                    $person= $rtmt->MEMBER_CODE;
                                    $demo_array = explode(",",$rtmt->DEMOGRAPHICS);
                                    $access_array = explode(",",$rtmt->ACCESS);
                                    $department_array = explode(",",$rtmt->DEPARTMENT);
                                    $service_array = explode(",",$rtmt->SERVICE_TYPE);
                                    $language_array = explode(",",$rtmt->LANGUAGES);
                                  * 
                                  */

                                   }
                                     
                                     elseif (isset ($_GET["new"])){
                                         if($config_file->MEMBER_ID_GEN==1){
                                             $_SESSION[family]="";
                                               $_SESSION[family_]=substr(strtoupper($config_file->CHURCH_NAME),0,3)."/FAM/".date("Y")."/".$help->getindexno();
                                         
                                               $_SESSION[family]=$_SESSION[family_];
                                         }
                                         else{
                                             
                                         }
                                        
                                    } 
                                    
                                   
                                    if(empty($_SESSION[family_]) || empty( $_SESSION[family])){
                                         $_SESSION[family_]=$rtmt->MEMBER_CODE;
                                         $_SESSION[family]=$rtmt->MEMBER_CODE;
                                    }
  
?>  
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
     
	<!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
<script src="assets/scripts/vendors.js"></script>
 	 

		<!-- content-here -->
		<div class="content-container" id="content">
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Services</li>
					<li class="active"><a href="#">Types</a></li>
				</ol>
                            <div><?php $notify->Message(); ?></div>
                       
                                
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
					<!-- row -->
                                        
                                <div class="row">
                                   
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="add_service_type.php"  style="margin-top: -17px;margin-left: -25px"  title="Add new service type"    class="btn btn-primary waves-effect btn-sm">Add New Service Category<i class="fa fa-users"></i></a> 

                                                
                                            </div>
                                            <div class="panel-body">
                                                 
                                                 
                                                          <div class="table-responsive">
                                                    <?php
                                                                                               
                                                             
                                                            $query="SELECT  * FROM  perez_service_type  where 1  " ;
                                                            $_SESSION[last_query]=$query; 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                              <p>&nbsp;</p>
                                                               <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                                                  
                                                <table id="gad" class="table table-condensed table-hover" >
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                              
                                                            <th> Code</th>
                                                            <th>Admin View</th>
                                                            <th>Volunteer View</th>
                                                            <th>Default Name </th>
                                                            <th>Default Time from </th>
                                                              
                                                            <th>Default Time to</th>
                                                            <th>Other Name</th>
                                                            <th>Other Time from</th>
                                                           <th>Other Time To</th>
                                                            <th>Department</th>
                                                            <th style='text-align:center;' colspan=' '>Actions</th>
                                                        </tr>
                                                    </thead>
                                                     <tbody>
                                                        <?php

                                                          $count=0;
                                                           while($rtmt=$rs->FetchRow()){
                                                                                   $count++;


                                                              ?>
                                                           <tr>
                                                               <td><?php echo $count ?></td>
                                                               
                                                             
                                                             <td style="text-align:"><?php echo $rtmt[CODE] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[ADMIN_NAME] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[VOLUNTEERS_NAME]; ?></td>
                                                             <td style="text-align:"><?php echo  $rtmt[DEFAULT_TIME_NAME]; ?></td>
                                                              
                                                             <td style="text-align:"><?php echo $rtmt[DEFAULT_TIME_FROM] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[DEFAULT_TIME_TO] ?></td>
                                                              
                                                             <td style="text-align:"><?php echo $rtmt[OTHER_TIME_NAME] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[OTHER_TIME_FROM] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[OTHER_TIME_TO] ?></td>
                                                              <td style="text-align:"><?php echo $rtmt[SERVICE_PLAN_DEPARTMENT] ?></td>
                                                             <td style='text-align:center;'>
                                                                 <a style='position:relative;' onclick="return confirm('Are you sure you want to delete <?php echo $rtmt[LASTNAME] ?> Family??')" href="addFamily?delete=<?php echo  $rtmt[CODE] ?>"Delete<i class="fa fa-trash" title="click to delete"></i>  </a> 
                                                                 <a style="cursor: pointer" title="click to edit" onclick="return MM_openBrWindow('edit_family.php?item=<?php echo $rtmt[ID] ?>','','menubar=yes,width=700,height=450')"   ><i class='fa fa-edit'></i> </a>
                                                               
                                                            </td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                    </tbody>
                                                </table>
                                                 
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

</body>

</html>