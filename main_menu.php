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

    <body style="padding:3px!important;">

      <!-- Navbar
      ================================================== -->

   <?php 
   if(!empty($_SESSION['ID']) ){
   

  }
  else {
    header('Location: logout.php');
        echo '<script>Window.location.href="logout.php " </script>';
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
</style>
<ul class="list-unstyled left-elems">
			<!-- nav trigger/collapse -->
			 
			<!-- #end nav-trigger -->

			 

			<!-- site-logo for mobile nav -->
			<header class="site-head" id="site-head">
		
                            <ul class="list-unstyled left-elems">
			<!-- nav trigger/collapse -->
			<li>
				<a href="javascript:;" class="nav-trigger ion ion-drag"></a>
			</li>
			<!-- #end nav-trigger -->

			<!-- Search box -->
			<li>
				<div class="form-search hidden-xs">
					<form id="site-search" action="javascript:;">
						<input type="search" class="form-control" placeholder="Type here for search...">
						<button type="submit" class="ion ion-ios-search-strong"></button>
					</form>
				</div>
			</li>	<!-- #end search-box -->

			<!-- site-logo for mobile nav -->
			<li>
				<div class="site-logo visible-xs">
					<a href="javascript:;" class="text-uppercase h3">
						<span class="text">Perez Chapel</span>
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
					<li><a href="profilr"><span class="ion ion-person">&nbsp;&nbsp;</span>Profile</a></li>
					<li><a href="settings"><span class="ion ion-settings">&nbsp;&nbsp;</span>Settings</a></li>
					<li class="divider"></li>
					<li><a href="lock"><span class="ion ion-lock-combination">&nbsp;&nbsp;</span>Lock Screen</a></li>
					<li><a href="logout"><span class="ion ion-power">&nbsp;&nbsp;</span>Logout</a></li>
				</ul>
			</li>
			<!-- #end profile-drop -->

			<!-- sidebar contact -->
			 
		</ul>
<body>
   <aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
             <div class="md-card-content">
                <div class=" uk-accordion"  data-uk-accordion>
                    
                    <h3 class="uk-accordion-title">
                       <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                       <span class="menu_title">Start Ups</span>
                     </h3>                    
                    <div class="uk-accordion-content">

                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('setup') }}" > <i class='fa fa-plus-circle'></i> Church Setup </a></span>
                                </p>
                           
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('createDepartment') }}" > <i class='fa fa-folder-open'></i> Create Departments </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{  url('addDemographics') }} " ><i class='fa fa-plus-circle'></i>  Demographics </a></span>
                                </p>
                               <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('membersCategories') }}" > <i class='fa fa-folder-open'></i> Member Categories </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addBranches') }}" ><i class='fa fa-plus-circle'></i>  Create Flows </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{url('addMinistries') }}" > <i class='fa fa-folder-open'></i> View Flows </a></span>
                                </p>
                                
                                
                            
                     </div>
                  
                    <h3 class="uk-accordion-title">
                          <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Member Management</span>
                        </h3>
                        <div class="uk-accordion-content">
<p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addMembers') }}" > <i class='fa fa-plus-circle'></i> Add New Member </a></span>
                                </p>
                           
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('viewMembers') }}" > <i class='fa fa-folder-open'></i> View Members </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addMemberCategory') }}" ><i class='fa fa-plus-circle'></i>  Create Members Categories </a></span>
                                </p>
                               <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('membersCategories') }}" > <i class='fa fa-folder-open'></i> View Member Categories </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addFlows') }}" ><i class='fa fa-plus-circle'></i>  Create Flows </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('flows') }}" > <i class='fa fa-folder-open'></i> View Flows </a></span>
                                </p>
                                

                        </div>

                     <h3 class="uk-accordion-title">
                        <span class="menu_icon"><i class="fa fa-database"></i></span>
                        <span class="menu_title">Transactions Manager</span>
                     </h3>                    
                    <div class="uk-accordion-content">

                                <p class=''><a target='main'  href="{{ url('journal_entry') }}"  ><i class='fa fa-file-text'></i>  Journal Entry </a></p>
                         <p class=''><a target='main'  href="{{ url('journal_inquiry') }}"  ><i class='fa fa-file-text'></i>  Journal Inquiry </a></p>
                         
                           
                            
                        </div>
                      
                    
                        <h3 class="uk-accordion-title" onclick="">
                            <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                            <span class="menu_title">Settings</span>
                        </h3>
                        <div class="uk-accordion-content">
                        <p class=''><a target='main'  href='{{ url('reset') }}' ><i class='fa fa-file-text'></i>  Reset Account </a></p>

                          <p class=''><a target='main'  href='{{ url('system_log') }}' ><i class='fa fa-file-text'></i>  View Log </a></p>
                       <p class=''><a target='main'  href='{{ url('users') }}' ><i class='fa fa-file-text'></i>  Users </a></p>


                        <p class=''><a target='main' onclick="window.parent.location='{!! url("logout")!!}'"  href="{{ url('logout') }}" ><i class='fa fa-file-text'></i>  Logout </a></p>
                  
                            
                        </div>
                  
                  
                </div>
   
   
   </aside>
    
    
    
    
</body>
     <?php include("./_library_/_includes_/scripts.inc") ?>
<script src="assets/scripts/jquery.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
       <script src="assets/js/holder/holder.js"></script>
      <script src="assets/js/google-code-prettify/prettify.js"></script>

      <script src="assets/js/application.js"></script>

   <script src="assets/js/jquery.validate.min.js"></script>
      <script src="assets/js/jquery.form.js"></script>
      <script src="assets/js/jquery.printelement.js"></script>


            <script>
  $(document).ready(function(){
        var originalLeft = parseInt($(".span2").css('left'));
        var originalRight = parseInt($(".span2").css('right'));
        var originalSpan10 = parseInt($(".span10").css('left'));
        $('.span10').css('left', originalRight + 100+"px");
        console.log(originalSpan10);
    // $(window).scroll(function(){

    //       //$(' .span2').css('position','absolute');
    //       $('.span2').css('left', originalLeft - $(this).scrollLeft()+"px");
    //   });

    $('.accordion-bodyys a ').on('click',function(e){
      e.preventDefault();
      var linkURL=$(this).prop('href');
      //&preventCache="+new Date();
      var newDate=new Date().getTime();
      $('#content').empty().load(linkURL+'?_'+newDate);

    });

    // $(' .accordion-heading').on('hover',function(e){
    //   $(e.target).trigger('click');

    // });
  });
  </script>

    </body>
  </html>
