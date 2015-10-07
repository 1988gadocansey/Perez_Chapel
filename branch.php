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
         if($_GET[branch]){
        $_SESSION[branch]=$_GET[branch];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
        }
         
        if($_GET[ministry]){
        $_SESSION[ministry]=$_GET[ministry];
        }
        if($_GET[deceased]){
        $_SESSION[deceased]=$_GET[deceased];
        }
        if($_GET[category]){
        $_SESSION[category]=$_GET[category];
        }
        if($_GET[team]){
        $_SESSION[team]=$_GET[team];
        }
        if($_GET[service]){
        $_SESSION[service]=$_GET[service];
        }
        if($_GET[demo]){
        $_SESSION[demo]=$_GET[demo];
        }
        if($_GET[country]){
        $_SESSION[nation]=$_GET[country];
        }
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_members WHERE MEMBER_CODE='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:members?success=1");
            }
        }
  /////////////////////////////////////////////////////////////////////////////
        
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
					<li>Church Administration</li>
					<li class="active"><a href="#">Branches / Locations</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:-2.5%;float:right">
                                                     
                                                     <button  style="margin-top: -59px" name="mail"  class="btn btn-success waves-effect">Mail<i class="md md-email"></i></button>
                                                        <button  style="margin-top: -59px"  data-target="#mount" data-toggle="modal"  class="btn btn-success waves-effect">Import csv<i class="md md-cloud-upload"></i></button>
                                                          <button  style="margin-top: -59px"   class="btn btn-pink waves-effect" data-target="#sms"  data-toggle="modal">Send SMS<i class="md md-sms"></i></button>
                                                        <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" data-toggle="dropdown"><i class="md md-save"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'csv',escape:'false'});"><img src='assets/icons/csv.png' width="24"/> CSV</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'txt',escape:'false'});"><img src='assets/icons/txt.png' width="24"/> TXT</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});"><img src='assets/icons/xls.png' width="24"/> XLS</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'doc',escape:'false'});"><img src='assets/icons/word.png' width="24"/> Word</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'powerpoint',escape:'false'});"><img src='assets/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'png',escape:'false'});"><img src='assets/icons/png.png' width="24"/> PNG</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'pdf',escape:'false'});"><img src='assets/icons/pdf.png' width="24"/> PDF</a></li>
                                                         </ul>
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="addBranch.php?new=1"  style="margin-top: -16px;margin-left: -25px"  title="Add new branch"  class="btn btn-success btn-sm waves-effect">Add Branch<i class="fa fa-plus-circle"></i></a> 
                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Bordered</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">Striped</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                        <table  width=" " border="0">
                                        <tr>


                                     <td width="20%">

                                    <select class='form-control select2_sample1'     style="margin-left:-3%; width:75% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?branch='+escape(this.value);" >
                                <option value=''>Filter by branch</option>
                                        <option value='All branch'>All Branches</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT * FROM perez_branches");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[branch]==$row['CODE']){echo 'selected="selected"'; }?> value="<?php echo $row['CODE']; ?>"        ><?php echo $row['NAME']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             
				 
                               <td>&nbsp;</td>
                                <td width="25%">
                                     <select class='form-control'      style="margin-left:-14%;  width:48% " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='Male'<?php if($_SESSION[gender]=='Male'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='Female'<?php if($_SESSION[gender]=='Female'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                                </td>
                              <td width="25%">
                                   <select class='form-control' style="margin-left:-60%;  width:69% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?ministry='+escape(this.value);"     >
                                       <option value=''>Filter by Ministries</option>
                                        <option value='All ministry'>All Ministries</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_ministries");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[ministry]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                         <td width="25%">
                                   <select class='form-control' style="margin-left:-87%;  width:80% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?category='+escape(this.value);"     >
                                       <option value=''>Filter by member category</option>
                                        <option value='All category'>All Categories</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_member_category");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[category]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['CATEGORY']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                          <td width="25%">
                                            <select class='form-control' style="margin-left:-503%;  width:358% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?service='+escape(this.value);"     >
                                            <option value=''>Filter by Service category</option>
                                            <option value='All service'>All Service</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_service_type");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[service]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['SERVICE']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                          
                                          <td width="25%">
                                            <select class='form-control' style="margin-left:-392%;  width:565% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?demo='+escape(this.value);"     >
                                            <option value=''>by demographics</option>
                                            <option value='All demographics'>All Demographics</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_demographics");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[demographics]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>   
                                                
                                                    <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left:-51%;  width:565% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?team='+escape(this.value);"     >
                                            <option value=''>filter by team</option>
                                            <option value='All team'>All Teams</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_team");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[team]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left:256%;  width:565% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?country='+escape(this.value);"     >
                                            <option value=''>filter by country</option>
                                            <option value='All country'>All Countries</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_country");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['Code']; ?>"   <?php if($_SESSION[nation]==$row['Code']){echo "selected='selected'";} ?>      ><?php echo $row['Name']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>
                                        </tr>
                                       </table>
                                                </div>
                                                <!-- end filters   -->
                                                 
                                                 
                                                                         <div class="table-responsive">
                                                                         <div ng-app="myApp" ng-controller="customersCtrl"> 

                                                                             <table  id="data-table-command" class="table table-striped table-hover">
                                                                                 <tr>
                                                                                 <thead>
                                                                                 <th>#</th>
                                                                                 <th style="text-align:">CODE</th>
                                                                                 <th>NAME</th>
                                                                                 <th>LOCATION</th>
                                                                                 <th>ADDRESS</th>
                                                                                 <th>CIRCUIT</th>
                                                                                 <th>DISTRICT</th>
                                                                                 <th>REGION</th>
                                                                                 <th>PHONE</th>


                                                                                 <th colspan="3" style="text-align: center">ACTION</th>
                                                                                 </thead>
                                                                                 </tr>
                                                                                 <tr ng-repeat="x in names">
                                                                                     <td>{{x.COUNT}}</td>
                                                                                     <td>{{x.CODE}}</td>
                                                                                     <td>{{x.NAME}}</td>
                                                                                     <td style="text-align:">{{x.LOCATION}}</td>
                                                                                     <td>{{x.ADDRESS}}</td>
                                                                                     <td>{{x.CIRCUIT}}</td>
                                                                                     <td>{{x.DISTRICT}}</td>
                                                                                     <td>{{x.REGION}}</td>
                                                                                     <td>{{x.PHONE}}</td>
                                                                                     <td style="text-align: center"><a href="setup?delete={{x.CODE}}" onclick="return confirm(confirm('Are you sure you want to delete this account??'))"><i class="fa fa-trash"  title="Delete this account"></i></a></td>
                                                                                     
                                                                                 </tr>
                                                                             </table>

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

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>
 <script src= "assets/ajax.googleapis.com_ajax_libs_angularjs_1.3.14_angular.min.js"></script>
 <?php include("./_library_/_includes_/scripts.inc") ?>

 <?php include("_library_/_includes_/export.php");  ?>
 <script>
                    var app = angular.module('myApp', []);
                app.controller('customersCtrl', function($scope, $http) {
                   $http.get("branch_json.php")
                   .success(function (response) {$scope.names = response.records;});
                });
 </script>
</body>

</html>