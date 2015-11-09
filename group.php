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
         $groups=new _classes_\Group();
        $sms=new _classes_\smsgetway();
         if($_GET[department]){
        $_SESSION[department]=$_GET[department];
        }
        if($_GET[location]){
        $_SESSION[location]=$_GET[location];
        }
         
        if($_GET[day]){
        $_SESSION[day]=$_GET[day];
        }
        if($_GET[end]){
        $_SESSION[end]=  strtotime($_GET[end]);
        }
        if($_GET[start]){
        $_SESSION[start]=  strtotime($_GET[start]);
        }
         
        if($_GET[category]){
        $_SESSION[category]=$_GET[category];
        }
        if($_GET[frequency]){
        $_SESSION[frequency]=$_GET[frequency];
        }
         
        if($_GET[demo]){
        $_SESSION[demo]=$_GET[demo];
        }
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
         
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_group WHERE GROUP_CODE='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:group?success=1");
            }
        }
           
?>
<?php include("./_library_/_includes_/header.inc"); ?>
 <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
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
					<li>Group Management</li>
					<li class="active"><a href="#">Groups</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:-2.5%;float:right">
                                                    <a href="members"  class="btn btn-success  waves-effect waves-button dropdown-toggle" style="margin-top: -59px"><i class="md md-sms"></i> Contact group by sms</a>
                                                     
                                                                        <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="addGroup?new=1"  style="margin-top: -17px;margin-left: -25px"  title="create a new group"  class="btn btn-pink waves-effect btn-sm">Create Groups<i class="fa fa-plus-circle"></i></a>
                                                 
                                               
                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Table View</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">List View</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                 <div class="table-responsive">
                                                        <table  width=" " border="0">
                                                            <tr>


                                                                <td width="20%">

                                                                    <select class='form-control select2_sample1'     style="margin-left:0%; width:90% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?department='+escape(this.value);" >
                                                                        <option value=''>Filter by departments</option>
                                                                        <option value='All department'>All Department</option>
                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_departments WHERE PARENT!='0'");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option <?php if ($_SESSION[department] == $row['NAME']) {
                                                                            echo 'selected="selected"';
                                                                        } ?> value="<?php echo $row['NAME']; ?>"        ><?php echo $row['NAME']; ?></option>

                                                                        <?php } ?>
                                                                    </select>

                                                                </td>


                                                                <td>&nbsp;</td>
                                                                <td width="25%">
                                                                    <select class='form-control' style="margin-left:-6%;  width:69% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?location='+escape(this.value);"     >
                                                                        <option value=''>Filter by Location</option>
                                                                        <option value='All location'>All Location</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT DISTINCT ID,LOCATION,NAME FROM perez_branches");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['ID']; ?>"   <?php if ($_SESSION[location] == $row['ID']) {
                                                                            echo "selected='selected'";
                                                                        } ?>      ><?php echo $row['NAME']."-".$row['LOCATION']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                </td>     
                                                                <td>&nbsp;</td>
                                                                <td width="25%">
                                                                    <select class='form-control' style="margin-left:-34%;  width:53% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?day='+escape(this.value);"     >
                                                                        <option value=''>Filter by days</option>
                                                                        <option value='All day'>All day</option>
                                                                        <option value='Monday'<?php if ($_SESSION[day] =="Monday") {
                                                                            echo "selected='selected'";
                                                                        } ?>>Monday</option>
                                                                        <option <?php if ($_SESSION[day] =="Tuesday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Tuesday'>Tuesday</option>
                                                                        <option <?php if ($_SESSION[day] =="Wednesday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Wednesday'>Wednesday</option>
                                                                        <option <?php if ($_SESSION[day] =="Thursday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Thursday'>Thursday</option>   
                                                                        <option <?php if ($_SESSION[day] =="Friday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Friday'>Friday</option>
                                                                        <option <?php if ($_SESSION[day] =="Saturday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Saturday'>Saturday</option>

                                                                        <option <?php if ($_SESSION[day] =="Sunday") {
                                                                            echo "selected='selected'";
                                                                        } ?> value='Sunday'>Sunday</option>

                                                                    </select>

                                                                </td>     
                                                                <td>&nbsp;</td>
                                                                <td width="25%">
                                                                    <select class='form-control' style="margin-left:-74%;  width:64% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?frequency='+escape(this.value);"     >
                                                                        <option value=''>Filter by frquency</option>
                                                                        <option value='All frequency'>All frequencies</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT DISTINCT FREQUENCY FROM perez_GROUP");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['FREQUENCY']; ?>"   <?php if ($_SESSION[frequency] == $row['FREQUENCY']) {
                                                                            echo "selected='selected'";
                                                                        } ?>      ><?php echo $row['FREQUENCY']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                </td>     
                                                                <td>&nbsp;</td>

                                          <td width="25%">
                                            <select class='form-control' style="margin-left:-492%;  width:291% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?demo='+escape(this.value);"     >
                                            <option value=''>by demographics</option>
                                            <option value='All demographics'>All Demographics</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_demographics");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID'] ?>"   <?php if($_SESSION[demographics]==$row['NAME']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>   
                                                
                                                    <td>&nbsp;</td>
                                                            <form>
                                           <td width="25%">
                                             <div class="input-group date" id="datepickerDemo" style="margin-left: -210%;width: 209%">
                                                 <input type="text" class="form-control" required="" name="member_dob" value="<?php echo date("m/d/Y", $_SESSION[start]); ?>" placeholder="group starts" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?start='+escape(this.value);"   />
                                                 <span class="input-group-addon">
                                                     <i class=" fa fa-calendar"></i>
                                                 </span>
                                             </div>
                                           </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                               <div class="input-group date" id="datepickerDemo1" style="margin-left: -96%;width: 207%">
                                                   <input type="text" class="form-control" required="" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?end='+escape(this.value);" placeholder="group ends.." name="member_dob" value="<?php echo date("m/d/Y", $_SESSION[end]); ?>" />
                                                <span class="input-group-addon">
                                                    <i class=" fa fa-calendar"></i>
                                                </span>
                                            </div>

                                           </td>
                                           <td>&nbsp;</td>
                                           
                                          </form>
                                        </tr>
                                       </table>
                                            
                                       <br/>
                                       <table>
                                           <tr>
                                          <form action="group?" method="post" >
                                            <td width="25%">


                                                <input type="text" name ="search" placeholder="type search item here..."required="" style="margin-left:2%; width:168%;" class="form-control" id=" "  >

                                            </td>
                                            <td>&nbsp;</td>
                                             <td width="25%">
                                            <select class='form-control'  name='content' required="" style="margin-left: 93%; width: 97%;"  >
                                                <option value=''>search by</option>

                                               <option value='GROUP_CODE'<?php if($_SESSION[content]=='SURNAME'){echo 'selected="selected"'; }?>>Group code</option>
                                               <option value='NAME'<?php if($_SESSION[status]=='FIRSTNAME'){echo 'selected="selected"'; }?>>Group Name</option>
                                                
                                           </select>

                                             </td>
                                        <td>&nbsp;</td>
                                        <td width="25%">
                                              <button type="submit" name="go" style="margin-left: 78%; width: 65px;" class="btn btn-primary">Go</button>
                                        </td>
                                            </tr>  

                                        </form>

                                               
                                       </table>
                                </div>
                                               
                                                <!-- end filters   -->
                                                 
                                                 <hr>
                                                <div class="table-responsive">
                                                    <?php
                                                                                               
                                                            $department=$_SESSION[department];
                                                            $day=$_SESSION[day];
                                                            $ministry=$_SESSION[ministry];
                                                            $start=$_SESSION[start];
                                                             $end=$_SESSION[end];
                                                            $location=$_SESSION[location];
                                                            $demo=$_SESSION[demo];
                                                            $frequency=$_SESSION[frequency];
                                                            $category=$_SESSION[category];
                                                            $search=$_POST[search];
                                                            $content=$_POST[content];
                                            

                                                            if($department=="All department" or $department==""){ $department=""; }else {$department_=" and  DEPARTMENTS = '$department' "  ;}
                                                            if($end=="All " or $end==""){ $end=""; }else {$end_=" and  END_DATE = '$end' "  ;}
                                                            if($start=="All " or $start==""){ $start=""; }else {$start_=" and  START_DATE = '$start' "  ;}
                                            
                                                            if($day=="All day" or $day=="" ){ $day=""; }else {$day_=" and DAYS LIKE '%$day%' "  ;}
                                                              if($location=="All location" or $location=="" ){ $location=""; }else {$location_=" and LOCATION = '$location' "  ;}
                                                           if($demo=="All demographics" or $demo=="" ){ $demo=""; }else {$demo_=" and DEMOGRAPHICS LIKE '%$demo%' "  ;}
                                                           if($frequency=="All frequency" or $frequency=="" ){ $frequency=""; }else {$frequency_=" and FREQUENCY = '$frequency' "  ;}
                                                            if($category=="All category" or $category=="" ){ $category=""; }else {$category_=" and CATEGORY = '$category' "  ;}
                                                            if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '%$search%' "  ;}

                                                            $query="SELECT  * FROM  perez_group  where 1 $department_     $search_ $day_   $location_ $category_ $demo_ $frequency_  $search_" ;
                                                           print_r( $_SESSION[last_query]=$query); 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="assesment" class="table   display" >
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                             <th></th>
                                                               <th>Logo</th>
                                                            <th>Name</th>
                                                            <th>Category</th>
                                                            <th>Locations</th>
                                                            <th>Days</th>
                                                             
                                                            <th>Start Time</th>
                                                            <th>End Time </th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Address</th>
                                                            <th>Members</th>
                                                            <th>Active</th>
                                                             
                                                            <th colspan="5"  >Actions</th>
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
                                                                       <div class="ui-checkbox ui-checkbox-primary ml5">
                                                                               <label><input type="checkbox"><span></span>
                                                                               </label>
                                                                       </div>
                                                                </td>
                                                                <td><a href="addGroup.php?group=<?php echo  $rtmt[GROUP_CODE] ?>&&update"><img   <?php   $pic=  $help->pictureid($rtmt[GROUP_CODE]); echo $help->picture("photos/groups/$pic.jpg",70)  ?>   src="<?php echo file_exists("photos/groups/$pic.jpg") ? "photos/groups/$pic.jpg":"photos/groups/users.jpg";?>" alt="group logo here"    /></a></td>
                                                                <td style="text-align:"><?php echo $rtmt[NAME] ?></td>
                                                                <td style="text-align:"><?php echo $groups->getGroupCategory($rtmt[CATEGORIES]) ?></td>
                                                                <td style="text-align:"><?php echo $groups->getLocation($rtmt[LOCATION]) ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[DAYS] ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[START_TIME] ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[END_TIME] ?></td>
                                                                        <td style="text-align:"><?php echo date("d/m/Y", $rtmt[START_DATE]); ?></td>
                                                                        <td style="text-align:"><?php echo date("d/m/Y", $rtmt[END_DATE]); ?></td>

                                                            
                                                             <td style="text-align:"><?php echo $rtmt[ADDRESS] ?></td>
                                                             <td style="text-align:center"><?php echo $member->getTotalMember_byGroup($rtmt[ID]); ?></td>
                                                             <td style="text-align:center"><?php if($rtmt[STATUS]==1){echo "Active";}else{echo "Inactive";} ?></td>
                                                              
                                                             <td><a href="addGroup?group=<?php echo  $rtmt[GROUP_CODE] ?>&&update">Edit <i class="md md-edit" title="click to edit info"></i></a> 
                                                                  
                                                             
                                                             <a onclick="return confirm('Are you sure you want to delete this person??')" href="group?delete=<?php echo  $rtmt[GROUP_CODE] ?>">Delete<i class="md md-delete" title="click to delete"></i> </a></td>
                                                            
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
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>
<script src="assets/scripts/vendors.js"></script>
<script src="assets/scripts/plugins/screenfull.js"></script>
	<script src="assets/scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/scripts/plugins/waves.min.js"></script>
	<script src="assets/scripts/plugins/select2.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-colorpicker.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-slider.min.js"></script>
	<script src="assets/scripts/plugins/summernote.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-datepicker.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-elements.init.js"></script>
        <script src="assets/scripts/plugins/jquery.dataTables.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/tables.init.js"></script>
 <?php include("_library_/_includes_/export.php");  ?>
        <script>
            $(document).ready(function() {
                $('#gad').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis'
                    ]
                } );
            } );
        </script>
</body>

</html>