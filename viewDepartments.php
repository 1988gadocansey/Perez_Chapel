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
        $config_file=$help->getConfig() ;
        $ledger=new _classes_\Ledger();                           
        $login=new _classes_\Login();
         if($_GET['parent']){
        $_SESSION['parent']=$_GET['parent'];
        }
         if($_POST[go]){
        $_SESSION[search]=$_POST[search];
       
        }
        
        if(isset($_GET[id])){
            $department=$_GET[id];
            $confirm=$help->confirmDelete('perez_members', 'DEPARTMENT', $department,'LIKE');
            if($confirm==0){
                $query=$sql->Prepare("DELETE FROM perez_departments  WHERE ID='$department' AND PARENT!='$department'");
                if($sql->Execute($query)){
                    //logging
                    $dpat=$help->getDepartmentName($department);
                    $event="Deletes";
                    $activity="$_SESSION[USERNAME] has delete $dpat department";
                    $hashkey = $_SERVER['HTTP_HOST'];
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $mac = $login->getMac();
                    $sessionId = session_id();
                    $stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                    $sql->Execute($stmt);

                    header("location:viewDepartments.php?success=1");
                }
            }
            else{
                   header("location:viewDepartments.php?exist=1");
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

        <!-- content-here -->
        <div class="content-container" id="content">

                                    
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li><?php echo $config_file->CHURCH_NAME;  ?></li>
					<li class="active"><a href="#">Departments</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						        
                                                <div style="margin-top:-2.5%;margin-left:1022px">
                                                       <button   class="btn btn-success  waves-effect waves-button dropdown-toggle btn-sm" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                               <form action="" method="post" class="form-horizontal row-border"   id="form">

                                         <table  width=" " border="0">
                                         <tr>

                                       
                                                 
                                           <td width="25%">
                                             
                                           <td>
                                               <select style="width:230px" name='parent' onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?parent='+escape(this.value);"  >
                                                            <option value=''>select parent department </option>
                                                            <option value="all departments">All parent department</option>
                                                                <?php
                                                            $STM = $sql->Prepare("SELECT DISTINCT PARENT  FROM perez_departments WHERE PARENT!=''");
                                                            $rowa = $sql->Execute($STM);

                                                            $num = 0;
                                                            while ($row = $rowa->FetchRow()) {
                                                                extract($row);
                                                                ?>
                                                            <option <?php if($_SESSION['parent']==$PARENT){echo "selected='selected'";} ?>  value="<?php echo $PARENT; ?>"><?php echo $help->getDepartmentName($PARENT); ?></option>

                                                            <?php } ?>
                                                        </select>
                                           </td>


                                           
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                                      
                                            </form>
                                                <form action="" method="POST">
                                                       <td>
                                                            
                                                      
                                                           <input style="" required="" type="search" placeholder="Search here" name="search" id="member_" class="form-control check-duplicates" >

                                                        
                                                        </td>
                                                      <td>
                                                          <button type="submit" name="go" style="margin-left: 22px;width:   " class="btn btn-success   btn-search">Search<i class="fa fa-search"></i></button>
                           
                                                       </td>
                                                     
                                                </form>
                                                <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                                 <td>
                                                          <img src="assets/images/printer.png"onclick="javascript:printDiv('print')" title="Click to print repo "/>                                                           
                                                       
                                                       </td>
                                            </tr>
                                                   </table>
                                                
      
                           <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->
        <div class="table-responsive">
              
                  
                <?php
                $dept=$_SESSION['parent'];
                $search=$_POST[search];
                                                         
                if ($dept == "all departments" or $dept == "") {
                    $dept = "";
                } else {
                    $dept_ = " and PARENT = '$dept' ";
                }
                  if($search=="" ){ $search=""; }else {$search_="AND NAME LIKE '%$search%' "  ;}







$query ="SELECT * FROM `perez_departments` WHERE 1 $dept_  $search_ ORDER BY NAME ASC";
                   //print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                       $recordsFound =$rs->_maxRecordCount;    // total record found
                      if (!$rs->EOF) 

                    {


                  
                          ?> 
            <div id="print">
                  <table id='assesment' class='table table-striped table-hover' >
                      <center><h5 class="text-success"><?php echo $recordsFound?> Records</h5></center>
                  <thead>
                        <tr>
                            <th>#</th>

                                <th>Department</th>

                                <th>Parent Department</th>
                                <th>Actions</th>

                            </tr>
                     </thead><?php
                           echo" <tbody>";





                    echo "</thead>";

         
	 
           $count=0;
                    while($rt=$rs->FetchRow()){
                                    $count++;
                                    // $person=$user->user($rt[USERNAME]);
                       ?>
                                    <tr>
                                    <td><?php  echo $count; ?></td>
                                     <td style="text-align:left"><?php  echo $rt[NAME]; ?></td> 
                                   
                                      
                                     <td style="text-align:"><?php echo $help->getDepartmentName($rt["PARENT"]) ?></td>
                                     
                                    <td style='text-align:'colspan='2'> 

                                          <a href="createDepartment.php?id=<?php echo $rt[ID] ?>&type=0" style="cursor: pointer" title="click to edit department"  ><i class='fa fa-edit'></i>Edit </a>

                                        <a href="viewDepartments.php?id=<?php echo $rt[ID] ?>&type=0" style="cursor: pointer" title="click to delete department" onclick="return confirm ('Are you sure you want to delete this department')"   ><i class='fa fa-lock'></i>Delete </a>

                                      
                                    </td> 
                                     
                                     </tr>
                                    <?php }  
                   
                                                echo "</table>   </div>
                                                <br/>
                                                <center>";
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                  echo"</center>";
                                            } 
                                            
                          else{
                             echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                   <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                   Oh snap!. No record to display 
                                       </div>";
                                          }
             ?>
 
     
    
            
      
        </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	<?php include("./_library_/_includes_/js.php"); ?>
        
         
</body>

</html>