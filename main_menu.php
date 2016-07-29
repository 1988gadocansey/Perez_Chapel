<?php 
error_reporting(0);
require '_library_/_includes_/config.php';?>
<!DOCTYPE html>
<html>

    <head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="Perez Chapel">
	<meta name="keywords" content="Perez Chapel">
	<meta name="author" content="Gad Ocansey">
	<!-- <base href="/"> -->

	<title>EagleApp | Dashboard</title>
        <style>
       [class^="md-"] {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    font-size-adjust: none;
    font-stretch: normal;
    font-feature-settings: normal;
    font-language-override: normal;
    font-kerning: auto;
    font-synthesis: weight style;
    font-variant: normal;
    font-size: inherit;
    text-rendering: auto;
}
        </style>
	<!-- Icons -->
        <link rel="stylesheet" href="assets/fonts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/styles/material-design-iconic-font.mine7ea.css">
	<!-- Plugins -->
        <link rel="stylesheet" href="assets/styles/plugins/c3.css">
        <link rel="stylesheet" href="assets/styles/plugins/waves.css">
        <link rel="stylesheet" href="assets/styles/plugins/perfect-scrollbar.css">

	<link rel="stylesheet" href="assets/scripts/buttons.dataTables.min.css">
	<!-- Css/Less Stylesheets -->
	<link rel="stylesheet" href="assets/styles/bootstrap.min.css">
	<link rel="stylesheet" href="assets/styles/main.min.css">
        <!--<link rel="stylesheet" href="assets/styles/materialadminb0e2.css"> -->
  <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
                    <link rel="stylesheet" href="assets/scripts/plugins/datetimepicker/bootstrap-datetimepicker.css">
                  <link rel="stylesheet" href="assets/styles/plugins/select2.css">
                    <link rel="stylesheet" type="text/css" href="assets/scripts/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
                    <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
                    <link rel="stylesheet" href="assets/scripts/plugins/datetimepicker/bootstrap-datetimepicker.css">
                    <link rel="stylesheet" href="assets/styles/dataTables.bootstrap.min.css">
	 
                 <link rel="stylesheet" href="assets/styles/jquery.dataTables.min.css">
	   <link rel="stylesheet" href="assets/styles/jquery.dataTables.min.css">
	   
                    
                    <style>
    #data-table-command  tr:hover{
        
        background-color: #FFFCBE;
    }
    #assesment  tr:hover{
        
        background-color: #FFFCBE;
    }
    #bill  tr:hover{
        
        background-color: #FFFCBE;
    }
    .form-header {
    margin: 16px 0px 8px;
    padding-bottom: 4px;
    border-bottom: 2px solid #777;
}

</style>
	<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script>
                    function inse(inco){
                    var curr=document.getElementById('sms');
                    curr.value=curr.value+"["+inco+"]"
                    }
</script>
<script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;


    }
</script>
</head>

    <body>

      <!-- Navbar
      ================================================== -->

   <?php 
   if(!empty($_SESSION['ID']) ){
   

  }
  else {
    header('Location: logout.php');
        echo '<script>Window.location.href="index.php " </script>';
      exit;
  }

  ?>

  <!-- Subhead
  ================================================== -->
  <!-- <header class="jumbotron subhead" id="overview">
    <div class="container">
      <h1>Scaffolding</h1>
      <p class="lead">Bootstrap is built on responsive 12-column grids, layouts, and components.</p>
    </div>
  </header> -->

 
<style>
    .error{
        color:red;
    }
    p{
        width: 190px;
    }
</style>
<ul class="list-unstyled left-elems">
			<!-- nav trigger/collapse -->
			 
			<!-- #end nav-trigger -->

			 

			<!-- site-logo for mobile nav -->
			<header class="site-head" id="site-head"  style="background: none repeat scroll #607D8B ;width:255px;margin-left: -4px">
		
                            <ul class="list-unstyled left-elems">
			 

			<!-- site-logo for mobile nav -->
			<p>
                            <div class="site-logo visible-xs">
					 
						 <a href="" class="site-logo text-uppercase">
                                    <img src="login/images/logo.png" style="width: 43px;height:44px;margin-left: 8px "/>
                                    <span style="font-size: 14px;color:white" class="text">Perez Chapel Int</span>
				</a>
					 
				</div>
			</li> <!-- #end site-logo -->

			<!-- fullscreen -->
			<li class="fullscreen hidden-xs">
                            <a href="javascript:;"><i title="toggle fullscreen mode" class="ion ion-qr-scanner"></i></a>

			</li>	<!-- #end fullscreen -->

			<!-- notification drop -->
			<li class="notify-drop hidden-xs dropdown">
				<a href="javascript:;" data-toggle="dropdown">
					<i class="ion ion-android-notifications"></i>
					<span class="badge badge-danger badge-xs circle">3</span>
				</a>

				<div class="panel panel-default dropdown-menu">
					<div class="panel-heading">
						You have 3 new notifications 
						<a href="javascript:;" class="right btn btn-xs btn-pink mt-3">Show All</a>
					</div>
					<div class="panel-body">
						<ul class="list-unstyled">
							<li class="clearfix">
								<a href="javascript:;">
									<span class="ion ion-archive left bg-success"></span>
									<div class="desc">
										<strong>App downloaded</strong>
										<p class="small text-muted">1 min ago</p>
									</div>
								</a>
							</li>
							<li class="clearfix">
								<a href="javascript:;">
									<span class="ion ion-alert-circled left bg-danger"></span>
									<div class="desc">
										<strong>Application Error</strong>
										<p class="small text-muted">4 hours ago</p>
									</div>
								</a>
							</li>
							<li class="clearfix">
								<a href="javascript:;">
									<span class="ion ion-person left bg-info"></span>
									<div class="desc">
										<strong>New User Registered</strong>
										<p class="small text-muted">2 days ago</p>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>

			</li>	<!-- #end notification drop -->

		</ul>
                        </header>

			 
			 

		</ul>

		<ul class="list-unstyled right-elems">
			<!-- profile drop -->
			<li class="profile-drop hidden-xs dropdown">
				<a href="javascript:;" data-toggle="dropdown">
                                    <img src="photos/avatars/<?php echo $_SESSION[USERNAME]?>.jpg" alt="profile-pic">
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<p><a href="profilr"><span class="ion ion-person">&nbsp;&nbsp;</span>Profile</a></li>
					<p><a href="settings"><span class="ion ion-settings">&nbsp;&nbsp;</span>Settings</a></li>
					<li class="divider"></li>
					<p><a href="lock"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Lock Screen</a></li>
					<p><a href="logout"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
				</ul>
			</li>
			<!-- #end profile-drop -->

			<!-- sidebar contact -->
			 
		</ul>
    <body style="font-family: Roboto">
    <p>&nbsp;</p>
   <aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
             <div class="md-card-content">
                 <p>&nbsp;</p>
                 
                <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseThreesm" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-database"></i> System Setup
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThreesm">
                              
                                         <p>
                                             <i class='fa fa-database'></i><b><a target="content_frame" href="setup.php"> Run Setup</a></b>
                                        </p>
                                          <p>
                                             <i class='fa fa-plus-circle'></i><b><a target="content_frame" href="createDepartment.php"> Add Departments</a></b>
                                        </p>
                                         <p>
                                             <i class='fa fa-folder-open'></i><b><a target="content_frame" href="viewDepartments.php"> View Departments</a></b>
                                        </p>
                                         <p>
                                             <i class='fa fa-plus-circle'></i><b><a target="content_frame" href="addDemographics.php"> Add Demographics</a></b>
                                        </p>
                                         <p>
                                             <i class='fa fa-folder-open'></i><b><a target="content_frame" href="viewDemographics.php"> View Demographics</a></b>
                                        </p>
                                         <p>
                                             <i class='fa fa-plus-circle'></i><b><a target="content_frame" href="addMemberCat.php"> Create Member Categories</a></b>
                                        </p>
                                         <p>
                                             <i class='fa fa-folder-open'></i><b><a target="content_frame" href="viewMemberCat.php"> View Member Categories</a></b>
                                        </p>
                                       
                         </div> <!-- accordion-inner -->
                     </div> <!-- collapseTen-->
                     &nbsp;
                      <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseThreeSS" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-user-plus"></i> Branch Manager
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThreeSS">
                            <div class="panel-body">
                                <p class="">
                                    <p><a target='content_frame'  href="addCircuit.php" > <i class='fa fa-plus-circle'></i> Create Circuit </a> 
                                </p>
                           
                                <p class="">
                                    <p><a target='content_frame'  href="viewCircuits.php" > <i class='fa fa-folder-open'></i> View Circuits </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="addDistrict.php" > <i class='fa fa-plus-circle'></i> Add Districts </a> 
                                </p>
                           
                                <p class="">
                                    <p><a target='content_frame'  href="viewDistrict.php" > <i class='fa fa-folder-open'></i> View Districts </a> 
                                </p>
                                  <p class="">
                                  <p><a target='content_frame'  href="addBranch.php" > <i class='fa fa-plus-circle'></i> Add Branch </a> 
                                </p>
                               <p class="">
                               <p><a target='content_frame'  href="branch.php" > <i class='fa fa-folder-open'></i> View Branches </a> 
                                </p>
                                <!-- <p class="">
                                <p><a target='content_frame'  href="branch_stat.php" > <i class='fa fa-folder-open'></i> Growth Statistics </a> 
                                </p> -->
                                 
                                

                        </div>
                        </div>
                    </div>
            
  &nbsp; 
                    <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseThree" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-user-plus"></i> Members
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThree">
                            <div class="panel-body">
                                <p class="">
                                    <p><a target='content_frame'  href="addMember.php" > <i class='fa fa-plus-circle'></i> Add New Member </a> 
                                </p>
                           
                                <p class="">
                                    <p><a target='content_frame'  href="members.php" > <i class='fa fa-folder-open'></i> View Members </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="addChild.php" > <i class='fa fa-plus-circle'></i> Add Children </a> 
                                </p>
                           
                                <p class="">
                                    <p><a target='content_frame'  href="viewChild.php" > <i class='fa fa-folder-open'></i> View Children </a> 
                                </p>
                                 
                               <p class="">
                                    <p><a target='content_frame'  href="viewVisitors.php" > <i class='fa fa-folder-open'></i> View Visitors </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="viewfollow.php" > <i class='fa fa-folder-open'></i> View Follow up </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="addFamily.php" ><i class='fa fa-plus-circle'></i>Families </a> 
                                </p>
                                 
                                

                        </div>
                        </div>
                    </div>
  &nbsp;
                    <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseThrees" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-money"></i> Funds and Payments
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseThrees">
                            <div class="panel-body">
                                <p class=''><a target="content_frame"  href="create_church_payment.php"  ><i class='fa fa-plus-circle'></i>  Create Church Payments </a></p>
                                <p class=''><a target="content_frame"  href="view_church_payment_types.php"  ><i class='fa fa-folder-open'></i>  Church payment Types</a></p>
                              
                                <p class=''><a target="content_frame"  href="member_payment.php"  ><i class='fa fa-folder-open'></i> Make Church payments </a></p>
                                <p class="">
                                    <p><a target='content_frame'  href="create_member_payment.php" ><i class='fa fa-plus-circle'></i>Create Member Payments </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="viewChurchPayments.php" > <i class='fa fa-folder-open'></i> View Church Payments </a> 
                                </p> 
                                <p class="">
                                    <p><a target='content_frame'  href="member_payment.php" > <i class='fa fa-folder-open'></i> Make Member Payments </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="create_member_payment.php" ><i class='fa fa-plus-circle'></i>Create Fund Raising </a> 
                                </p>
                                <p class="">
                                    <p><a target='content_frame'  href="member_payment.php" > <i class='fa fa-folder-open'></i> Make Member Payments </a> 
                                </p>
                            
                                 <p class="">
                                    <p><a target='content_frame'  href="viewMembersPayment.php" > <i class='fa fa-folder-open'></i> View Member Payments </a> 
                                </p>
                                 
                                 <p class="">
                                    <p><a target='content_frame'  href="viewFundRaisings.php" > <i class='fa fa-folder-open'></i> View Fund Raising </a> 
                                </p> 
                            </div>
                        </div>
                    </div>
  &nbsp;
                     <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseT" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-user-plus"></i> Groups Manager
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseT">
                            <div class="panel-body">
                                 
                                <p class=''><a target="content_frame"  href="group_category.php"  ><i class='fa fa-folder-open'></i> Group Categories </a></p>
                               
                                <p class=''><a target="content_frame"  href="addGroup.php"  ><i class='fa fa-plus-circle'></i>  Create Groups </a></p>
                                <p class=''><a target="content_frame"  href="group.php"  ><i class='fa fa-folder-open'></i> View Groups </a></p>
                                 
                            </div>
                        </div>
                    </div>
  &nbsp;
  <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseTT" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-paperclip"></i> Service Manager
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseTT">
                            <div class="panel-body">
                                <p class=''><a target="content_frame"  href="add_service_type.php"  ><i class='fa fa-plus-circle'></i>  Add Service Categories </a></p>
                                <p class=''><a target="content_frame"  href="service_types.php"  ><i class='fa fa-folder-open'></i> Service Categories </a></p>
                                <p class=''><a target="content_frame"  href="add_service.php"  ><i class='fa fa-plus-circle'></i>  Add Services </a></p>
                                 <p class=''><a target="content_frame"  href="upservice.php"  ><i class='fa fa-folder-open'></i> View upcoming services </a></p>
                                <p class=''><a target="content_frame"  href="pservice.php"  ><i class='fa fa-folder-open'></i> View past services </a></p>
                                   <p class=''><a target="content_frame"  href="allservice.php"  ><i class='fa fa-folder-open'></i> View all services </a></p>
                         
                                    <p class=''><a target="content_frame"  href="attendance.php"  ><i class='fa fa-plus-circle'></i> Mark Service Attendance </a></p
                             
                                   </div>
                        </div>
                    </div>
   
   &nbsp;
                     <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseT2" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-user-plus"></i> Assets Manager
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseT2">
                            <div class="panel-body">
                                <p class=''><a target="content_frame"  href="addAssets.php"  ><i class='fa fa-plus-circle'></i>  Add Assets </a></p>
                                <p class=''><a target="content_frame"  href="viewAssets.php"  ><i class='fa fa-folder-open'></i> View Assets </a></p>
                                 
                            </div>
                        </div>
                    </div>
  &nbsp;
   
                     <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseT4" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-calendar-o"></i> Events Manager
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseT4">
                            <div class="panel-body">
                                <p class=''><a target="content_frame"  href="eventManager/index.php" target="_"><i class='fa fa-calendar'></i>  Events </a></p>
                                
                            </div>
                        </div>
                    </div>
   
   &nbsp;
                     <div class="panel-success panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="#collapseT21" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionDemo">
                                    <i class="fa fa-users"></i> Systems and Users
                                </a>
                            </h4>
                        </div>
                        <div class="panel-collapse collapse" id="collapseT21">
                            <div class="panel-body">
                                <p class=''><a target="content_frame"  href="addUsers.php"  ><i class='fa fa-plus-circle'></i>  Add Users </a></p>
                                <p class=''><a target="content_frame"  href="viewUsers.php"  ><i class='fa fa-folder-open'></i> View Users </a></p>
                                <p class=''><a target="content_frame"  href="backupDBMysqli.php"  ><i class='fa fa-database'></i> Backup Database </a></p>
                                <p class=''><a target="content_frame"  href="view_log.php"  ><i class='fa fa-folder-open'></i> View Systems Log </a></p>
                                <p class=''><a href="javascript://" onclick="self.parent.location='logout.php'" ><i class='fa fa-lock'></i> Logout </a></p>
                                
                            </div>
                        </div>
                    </div>
   </aside>
    
    
    
    
</body>
     <?php include("./_library_/_includes_/scripts.inc") ?>
<script src="assets/scripts/jquery.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
       <script src="assets/js/holder/holder.js"></script>
      
      <script src="assets/js/application.js"></script>

    

            

    </body>
  </html>
