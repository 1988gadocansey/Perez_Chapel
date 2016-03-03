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
            <script>
                window.onload = function() {
                var c = document.getElementById('platypus');
                c.onclick = function() {
                  if (c.checked == true) {document.getElementById('answer').style.display = 'inline';}
                  else {document.getElementById('answer').style.display = '';
                  }
                }
              }
            
            </script>
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
	<!-- #end header -->

	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- main-navigation -->
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
                    <link rel="stylesheet" href="assets/styles/plugins/select2.css">
                    <link rel="stylesheet" type="text/css" href="assets/scripts/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
                    <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                        <div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add a Family</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="addFamily?sms=1" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                      
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <form action="addFamily?" method="post" class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                                                                <input type="hidden" value="<?php echo $rtmt->ID ?>" name="check"/>

                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Family Code <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                        <input type="text" name="code" readonly=""  class="form-control check-duplicates" value="<?php echo $_SESSION[family_] ?>" autocomplete="off">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Last Name <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" name="lastname" id="member_lastname" class="form-control check-duplicates" value="<?php echo $rtmt->LASTNAME ?>" autocomplete="off">

                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Email Address</label>
                                                                <div class="col-lg-8">
                                                                    <input type="email" name="email" value="<?php echo $rtmt->EMAIL; ?>" class="form-control check-duplicates"   autocomplete="off">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Telephone Number<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="phone" class="form-control" value="<?php echo  $rtmt->PHONE; ?>" autocomplete="off">
                                                                </div>
                                                            </div>
                                                             <div class="form-group">
                                                                <label class="col-lg-4 control-label">City<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="city" class="form-control" value="<?php echo  $rtmt->CITY; ?>" autocomplete="off">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-sm-6">


                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Address<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="address" class="form-control" value="<?php echo  $rtmt->ADDRESS; ?>" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Region <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                       <select id="regions" name="region" required=""   data-placeholder="Select a region" class="form-control">

                                                                        <option value=''>Choose region</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['NAME']; ?>" <?php
                                                                            if ($rtmt->REGION == $row['NAME']) {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>        ><?php echo $row['NAME']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>
                                                             <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Country <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                        <select id="countryd" name="country" required=""   data-placeholder="Select nationality" class="form-control">

                                                                        <option value=''> Countries</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_country");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['Name']; ?>" <?php
                                                                            if ($rtmt->COUNTRY == $row['Name']) {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>        ><?php echo $row['Name']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>

                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="save" class="btn btn-success">Send <i class="fa fa-save"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
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
                                               <button data-target="#sms"  data-toggle="modal"  style="margin-top: -17px;margin-left: -25px"  title="Add new family"    class="btn btn-primary waves-effect btn-sm">Add a Family<i class="fa fa-users"></i></button> 

                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Bordered</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">Striped</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                
                                                        <table  width=" " border="0">
                                        <tr>


                                     <td width="20%">

                                    <select id="sunday" class='form-control select2_sample1'     style="margin-left:-3%; width:105% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?family='+escape(this.value);" >
                                <option value=''>Filter by Families</option>
                                        <option value='All family'>All Families</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT DISTINCT * FROM perez_family");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[family]==$row['LASTNAME']){echo 'selected="selected"'; }?> value="<?php echo $row['LASTNAME']; ?>"        ><?php echo $row['LASTNAME']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             
				 
                               <td>&nbsp;</td>
                                 <td width="25%">
                                   <select id="marital" class='form-control' style="margin-left:0%;  width:96% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?city='+escape(this.value);"     >
                                       <option value=''>Filter by Cities</option>
                                        <option value='All city'>All Cities</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT DISTINCT ID,CITY FROM perez_family");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['CITY']; ?>"   <?php if($_SESSION[city]==$row['CITY']){echo "selected='selected'";} ?>      ><?php echo $row['CITY']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                         <td width="25%">
                                   <select id="region"  class='form-control' style="margin-left:3%;  width:101% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?region='+escape(this.value);"     >
                                       <option value=''>Filter by region</option>
                                        <option value='All region'>All Regions</option>
                                                       <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['NAME']; ?>" <?php
                                                                            if ($_SESSION[region]== $row['NAME']) {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>        ><?php echo $row['NAME']; ?></option>

                                                                        <?php } ?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                                           
                                          
                                           <td width="25%">
                                            <select id="title"  class='form-control' style="margin-left:-33%;  width:145% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?nation='+escape(this.value);"     >
                                            <option value=''>Filter by country</option>
                                            <option value='All country'>All Countries</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_country");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['Name']; ?>"   <?php if($_SESSION[nation]==$row['Name']){echo "selected='selected'";} ?>      ><?php echo $row['Name']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>
                                        </tr>
                                       </table>
                                                
                                                <!-- end filters   -->
                                                 
                                                 
                                                          <div class="table-responsive">
                                                    <?php
                                                                                               
                                                            $region=$_SESSION[region];
                                                            
                                                            $nation=$_SESSION[nation];
                                                            $city=$_SESSION[city];
                                                            $family=$_SESSION[family];
                                                            
                                            

                                                             
                                                            if($family=="All family" or $family==""){ $family=""; }else {$family_="and LASTNAME = '$family' "  ;}
                                                            if($city=="All city" or $city=="" ){ $city=""; }else {$city_=" and CITY = '$city' "  ;}
                                                            if($region=="All region" or $region=="" ){ $region=""; }else {$region_=" and REGION = '$region' "  ;}
                                                            if($nation=="All country" or $nation=="" ){ $nation=""; }else {$nation_=" and COUNTRY = '$nation' "  ;}
                                                            
                                                            $query="SELECT  * FROM  perez_service_type  where 1   $family_    $nation_ $region_ $city_  " ;
                                                            $_SESSION[last_query]=$query; 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                              <p>&nbsp;</p>
                                                <table id="studentm" class="table table-condensed table-hover" >
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                            <th class="col-lg-1"><button type="button"  onclick="return confirm('Are you sure you want to delete this members??')" class="btn btn-default btn-sm md md-delete"></th>
                                                             
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
                                                            <th style='text-align:center;' colspan='2'>Actions</th>
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
                                                               <td>
                                                                       <div class="ui-checkbox ui-checkbox-success ml5">
                                                                               <label><input type="checkbox"><span></span>
                                                                               </label>
                                                                       </div>
                                                                </td>
                                                             
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
                                                    <br/>
                                                <center><?php
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                 ?></center>
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

	<?php include("./_library_/_includes_/theme.inc"); ?>
        
        <script src="assets/scripts/vendors.js"></script>
	<script src="assets/scripts/plugins/screenfull.js"></script>
	<script src="assets/scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/scripts/plugins/waves.min.js"></script>
         <script src="assets/scripts/plugins/select2.min.js"></script>
         <script src="assets/scripts/jquery.dataTables.min.js"></script>
        <script src="assets/scripts/dataTables.bootstrap.min.js"></script>
        <script src="assets/scripts/dataTables.keyTable.min.js"></script>
          <script src="scripts/plugins/jquery.dataTables.min.js"></script>
	<script src="scripts/app.js"></script>
	 
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-elements.init.js"></script>
          <script type="text/javascript">
           $(document).ready(function() {
    var selected = [];
 
    $("#studentm").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "datatables/students.php",
        "rowCallback": function( row, data ) {
            if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        }
    });
 
    $('#students tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
 
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    } );
} );
        
        </script>
        <?php include("_library_/_includes_/export.php"); ?>
       
             
            
            
          
         
</body>

</html>