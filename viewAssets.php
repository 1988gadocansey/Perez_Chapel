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
        
        if($_GET[location]){
        $_SESSION[location]=$_GET[location];
        }
        
        if(isset($_GET[item])){
            $asset=$_GET[item];
             $query=$sql->Prepare("DELETE FROM tbl_fixed_assets_manager WHERE ID='$asset'");
             
            if($sql->Execute($query)){
                header("location:viewAssets.php?success=1");
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
					<li>Assets</li>
					<li class="active"><a href="#">View Assets</a></li>
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
                                                <select class="form-control"    style="margin-left: 12px" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?location='+escape(this.value);"   >
                                                    <option value=''>Select asset location</option>
                                                    <option value="All locations">All Locations</option>
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT * FROM `perez_departments` ");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                       
                                                                    ?>
                                                                    <option value="<?php echo $ID; ?>"><?php echo $NAME; ?></option>
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
                 
                $locations=$_SESSION['location'];
                if ($locations== "All locations" or $locations == "") {
                    $location = "";
                }  
               
                  else {
                    $location = " and FIXED_ASSET_LOCATION = '$locations' ";
                }






$query ="SELECT * FROM `tbl_fixed_assets_manager` WHERE 1 $location ";
                   print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                       $recordsFound =$rs->_maxRecordCount;    // total record found
                      if (!$rs->EOF) 

                    {


                 echo " <table id='assesment' class='table  table-hover'>"//start table

                          ?> <thead>
                        <tr>
                            <th data-column-id="kk" data-type="numeric">#</th>

                                <th data-column-id="USERNAME" data-type=" ">ASSET CODE</th>

                                <th data-column-id="USER DESIGNATION">ASSET NAME</th>
                                <th data-column-id="USER SINCE" data-order="asc" >ASSET CATEGORY</th>

                                <th data-column-id="ACCOUNT STATUS" data-order="asc" style="text-align:">LOCATION</th>
                                <th data-column-id="LAST LOGIN" data-order="asc" style="text-align:">DESCRIPTION</th>
                                 <th data-column-id="USER SINCE" data-order="asc" >COST</th>
                                 <th data-column-id="USER SINCE" data-order="asc" >SERIAL </th>
                                 <th data-column-id="USER SINCE" data-order="asc" >DATE</th>
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
                                     <td style="text-align:left"><?php  echo $rt[FIXED_ASSET_CODE]; ?></td> 
                                   
                                      
                                    <td style="text-align:"><?php  echo $rt[FIXED_ASSET_NAME] ?></td>
                                    <td style="text-align:"><?php  echo $rt[FIXED_ASSET_CATEGORY] ?></td>
                                    <td style="text-align:"><?php  echo $help->getAssetLocation($rt[FIXED_ASSET_LOCATION] )?></td>
                                    <td style="text-align:"><?php  echo $rt[FIXED_ASSET_DESCRIPTION] ?></td>
                                   <td style="text-align:">GHc<?php echo $rt[FIXED_ASSET_COST] ?></td>
                                   <td style="text-align:"><?php  echo $rt[FIXED_ASSET_SERIAL_NUMBER] ?></td>
                                   <td style="text-align:"><?php  echo $rt[FIXED_ASSETS_DATE_PURCHASE] ?></td>
                                   <td><a href="addAssets.php?asset=<?php echo $rt[ID]?>" ><i class='fa fa-edit'></i></a> 
                                    <a href='viewAssets.php?item=<?php echo $rt[ID]?>' onclick="return confirm('Are you sure you want to delete this account')" style='position:relative;' class='deleteBtn customBtn'><i class='fa fa-trash-o'></i></a></td> 
                                      
                                
                                
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