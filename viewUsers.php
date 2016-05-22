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
       // $user=new _classes_\Users();
        if($_GET[user]){
        $_SESSION[user]=$_GET[user];
        }
        if($_GET[type]){
        $_SESSION[type]=$_GET[type];
        }
        if($_GET[roles]){
        $_SESSION[roles]=$_GET[roles];
        }
        
        if(isset($_GET[id])){
            $person=$_GET[id];
            $status=$_GET[type];
            $query=$sql->Prepare("UPDATE perez_auth SET ACTIVE='$status' WHERE ID='$person'");
            if($sql->Execute($query)){
                header("location:viewUsers.php?success=1");
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
					<li>Users</li>
					<li class="active"><a href="#">User Accounts</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						        
                                                <div style="margin-top:-2.5%;float:right">
                                                       <button   class="btn btn-success  waves-effect waves-button dropdown-toggle btn-sm" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="width:1200px;margin-left: -95px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                               <form action="users" method="post" class="form-horizontal row-border"   id="form">

                                         <table  width=" " border="0">
                                         <tr>

                                       
                                                 
                                           <td width="25%">
                                             
                                           <td>
                                               <select class="form-control" name='username' style=""  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?roles='+escape(this.value);"  >
                                                   <option value=''>Filter by role types</option>
                                                   <option value="All roles">All roles</option>
                                                   <?php
                                                   $STM = $sql->prepare("SELECT  DISTINCT USER_TYPE  FROM perez_auth");
                                                   $stmt = $sql->Execute($STM);

                                                   $num = 0;
                                                   while ($row = $stmt->FetchRow()) {
                                                       extract($row);
                                                       ?>
                                                       <option value="<?php echo $USER_TYPE; ?>"><?php echo $USER_TYPE; ?></option>
                                                   <?php } ?>

                                               </select>
                                           </td>


                                           
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                           <td>&nbsp;</td>
                                           <td>
                                                <select class="form-control" name='type'  style="margin-left: "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?type='+escape(this.value);"  >
                                                    <option value=''>Filter by Active Accounts</option>
                                                    <option value="All types">All types</option>
                                                    <option value='1'>Active Accounts</option>
                                                    <option value='0'>Disabled Accounts</option>
                                                  
                                                              

                                                        </select>
                                                   </td>
                                                   <td></td>
                                                    <td>
                                                <select class="form-control" name='username'  style="margin-left: 12px" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?user='+escape(this.value);"   >
                                                    <option value=''>Select user account</option>
                                                    <option value="All users">All users</option>
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT  DISTINCT ID, USERNAME  FROM perez_auth");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                       
                                                                    ?>
                                                                    <option value="<?php echo $ID; ?>"><?php echo $USERNAME; ?></option>
                                                              <?php }?>

                                                                    </select>
                                                               </td>
                                                       <td>&nbsp;</td>
                                                       <td>&nbsp;</td>
                                                       <td>&nbsp;</td>
                                                       <td>
                                                          <img src="assets/images/printer.png"onclick="javascript:printDiv('print')" title="Click to print repo "/>                                                           
             
                                                       </td>
                                                        
                                                    </tr>
                                                   </table>
                                                </form>
      
                           <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->
        <div class="table-responsive">
              <div id="print">
                  
                <?php
                $roles=$_SESSION['roles'];
                $users=$_SESSION['user'];
                $types=$_SESSION['type'];
                if ($roles== "All roles" or $roles == "") {
                    $roles = "";
                } else {
                    $roles_ = " and  USER_TYPE = '$roles' ";
                }
                if ($types == "All types" or $types == "") {
                    $types = "";
                } else {
                    $type_ = "and ACTIVE = '$types' ";
                }
                if ($users == "All users" or $users == "") {
                    $users = "";
                } else {
                    $user_ = " and ID = '$users' ";
                }






$query ="SELECT * FROM `perez_auth` WHERE 1 $user_ $roles_ $type_ ";
                   //print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                       $recordsFound =$rs->_maxRecordCount;    // total record found
                      if (!$rs->EOF) 

                    {


                 echo " <table id='assesment' class='table  table-hover'>"//start table

                          ?> <thead>
                        <tr>
                            <th data-column-id="kk" data-type="numeric">#</th>

                                <th data-column-id="USERNAME" data-type=" ">Username</th>

                                <th data-column-id="USER DESIGNATION">User Type</th>
                                <th data-column-id="USER SINCE" data-order="asc" >User since</th>

                                <th data-column-id="ACCOUNT STATUS" data-order="asc" style="text-align:">Account Status</th>
                                <th data-column-id="LAST LOGIN" data-order="asc" style="text-align:">Last Login</th>
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
                                     <td style="text-align:left"><?php  echo $rt[USERNAME]; ?></td> 
                                   
                                      
                                    <td style="text-align:"><?php  echo $rt[USER_TYPE] ?></td>
                                    <td style="text-align:"><?php  echo date("d/m/Y",$rt[USER_SINCE] )?></td>
                                   
                                    <td style="text-align:center"><?php    if($rt[ACTIVE]==1){echo"Enabled";}else{echo "Disabled";} ?></td>
                                    <td style="text-align:"><?php  echo date("d/m/Y h:m:s",$rt[LAST_LOGIN]) ?></td>
                                     
                                    <?php
                                        echo" <td style='text-align:;'colspan='2'>";
                                                 if($rt[ACTIVE]==1){
                         
                                                 ?>
                        
                                            <a href="viewUsers.php?id=<?php echo $rt[ID]?>&type=0" style="cursor: pointer" title="click to view transactions" onclick="return ('Are you sure you want to disable this account')"   ><i class='fa fa-lock'></i>Disable </a>
                     
                                            <?php    }else{?>

                                              <a href='viewUsers.php?id=<?php echo $rt[ID]?>&type=1' onclick="return confirm('Are you sure you want to enabled this account')" style='position:relative;' class='deleteBtn customBtn'><i class='fa fa-unlock'></i>Activate</a>
                                            <?php }?>
                                          </td> 
                                    
                                      
                                
                                
                                     </tr>
                                    <?php }  
                   
            echo "</table> 
            <br/>
                                                <center>";
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                  echo"</center>";
                        } else{
                                     echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                           Oh snap!. No record to display 
                   </div>";
                      }
             ?>
 
     
    
            <small>  Generated on <?php echo gmdate("D, d M Y H:i:s") . " GMT";?></small>
 
        </div>
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