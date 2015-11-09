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
          $user=new _classes_\Users();
          
        
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
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                    
                                            
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Systems</li>
					<li class="active"><a href="#">User Accounts</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						        
                                                <div style="margin-top:-2.5%;float:right">
                                                       <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                             
                                         <table  width=" " border="0">
                                         <tr>

                                         <form action="users" method="post" class="form-horizontal row-border"   id="form">

                                         <td>
                                                <select class="form-control" name='username'id='source' style="margin-left:10%"    >
                                                    <option value=''>Filter by disabled accounts</option>
                                                  
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
                                          
                                           <td width="25%">
                                             
<td>
                                                <select class="form-control" name='username'id='source' style="margin-left:-142%;width: 197%"    >
                                                    <option value=''>Filter by role types</option>
                                                  
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
                                            
                                            
                                           </td>
                                           <td>&nbsp;</td>
                                           <td>
                                                <select class="form-control" name='type'id='source' style="margin-left:-19%;width:120%"    >
                                                    <option value=''>Filter by Active Accounts</option>
                                                  
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT DISTINCT EVENT_TYPE  FROM perez_system_log");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                       
                                                                    ?>
                                                                    <option value="<?php echo $EVENT_TYPE; ?>"><?php echo $EVENT_TYPE; ?></option>
                                                              <?php }?>

                                                        </select>
                                                   </td>
                                                    <td>
                                                <select class="form-control" name='username'id='source' style="margin-left:8%"    >
                                                    <option value=''>Select user account</option>
                                                  
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

                                                        
                                                    </tr>
                                                   </table>
                                                </form>
      
                           <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->
        <div class="table-responsive">
               <a onclick="javascript:printDiv('print')" title="Click to print report"><i class="fa fa-print"></i></a>                                                           
              <div id="print">
                <?php
                $affect=$_SESSION[effects];
                $parent=$_SESSION[parent_account];


                if($affect=="All effect" or $affect==""){ $affect=""; }else {$affect_=" and  account.AFFECTS = '$affect' "  ;}
                if($parent=="All ledger" or $parent==""){ $parent=""; }else {$parent_="and account.PARENT_ACCOUNT = '$parent' "  ;}




                    $query ="SELECT * FROM `perez_auth` ";
                   //print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                       $recordsFound =$rs->_maxRecordCount;    // total record found
                      if (!$rs->EOF) 

                    {


                 echo " <table id='assesment' class='table  table-hover'";//start table

                          ?> <thead>
                        <tr>
                                    <th data-column-id="kk" data-type="numeric">#</th>
                                   
                                    <th data-column-id="USERNAME" data-type=" ">USERNAME</th>
                                    
                                    <th data-column-id="USER DESIGNATION">USER DESIGNATION</th>
                                    <th data-column-id="USER SINCE" data-order="asc" style="text-align:center">USER SINCE</th>
                                     
                                     <th data-column-id="LOGIN CONFIGURATION" data-order="asc" style="text-align:center">IP ADD</th>
                                     <th data-column-id="ACCOUNT STATUS" data-order="asc" style="text-align:center">ACCOUNT STATUS</th>
                                     <th data-column-id="LAST LOGIN" data-order="asc" style="text-align:center">LAST LOGIN</th>
                                      <th data-column-id="LAST LOGIN" data-order="asc" style="text-align:center">LAST LOGOUT</th>
                                      <th>ACTIONS</th>
                                     
                                       </tr>
                            </thead><?php
                           echo" <tbody>";





                    echo "</thead>";

         
	 
           $count=0;
                    while($rt=$rs->FetchRow()){
                                    $count++;
                                     $person=$user->user($rt[USERNAME]);
                       ?>
                                    <tr>
                                    <td><?php  echo $count; ?></td>
                                     <td style="text-align:left"><?php  echo $rt[USERNAME]; ?></td> 
                                   
                                      
                                      <td style="text-align:center"><?php  echo $rt[USER_TYPE] ?></td>
                                    <td style="text-align:center"><?php  echo date("d/m/Y",$rt[USER_SINCE] )?></td>
                                    <td style="text-align:center"><?php  echo $rt[NET_ADD] ?></td>
                                    <td style="text-align:center"><?php    if($rt[ACTIVE]==1){echo"Enabled";}else{echo "Disabled";} ?></td>
                                    <td style="text-align:center"><?php  echo date("d/m/Y h:m:s",$rt[LAST_LOGIN]) ?></td>
                                    <td style="text-align:center"><?php  echo date("d/m/Y h:m:s",$rt[LAST_LOGOUT]) ?></td>
                                    
                                    <?php
                                        echo" <td style='text-align:center;'colspan='3'>
                         
                       
                        
                                            <a style=\"cursor: pointer\" title=\"click to view transactions\" onclick=\"return MM_openBrWindow('view_transactions?item=$rtmt[ACCOUNT_ID]','','menubar=yes,width=700,height=450')\"   ><i class='fa fa-edit'></i>Permissions </a>
                     


                                              <a href='charts_account?item=$rtmt[ACCOUNT_ID]' onclick=\"return confirm('Are you sure you want to delete this account')\" style='position:relative;' class='deleteBtn customBtn'><i class='fa fa-trash-o'></i>delete</a>

                                          </td>";
                                    
                                    ?>  
                                
                                
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