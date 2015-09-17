<div class="page-header-menu "  >
		<div class="container">
			 
                    <div style="float:right;margin-left: 0px">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="photos/workers/gad.jpg" style="width:40px;height:40px;margin-top: 3%">
                            &nbsp;<span style="color:white;margin-top: 2%" class="username username-hide-mobile">Welcome &nbsp; <?php echo strtoupper($_SESSION[USERNAME] )?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li>
								<a href="extra_profile.html">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="page_calendar.html">
								<i class="icon-calendar"></i> My Calendar </a>
							</li>
							<li>
								<a href="inbox.html">
								<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								3 </span>
								</a>
							</li>
							 
							<li class="divider">
							</li>
							<li>
								<a href="extra_lock.html">
								<i class="icon-lock"></i> Lock Screen </a>
							</li>
							<li>
								<a href="logout.php">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
                        |&nbsp;<span style="color: white" class="username username-hide-mobile"> <?php echo  $_SESSION["level"] ?></span>
                         
                    </div>
                    
			 
			<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                         
                        <div class="hor-menu  ">
				<ul class="nav navbar-nav">
                                    <li style="margin-left: -44px; font-weight: bolder">
                                        <a style="font-weight: bolder"href="dashboard.php" class="iconify">
                                                
                                               SRMS </a>
                                        </li>
					<li>
                                                <a href="dashboard.php" class="iconify">
                                                <i class="icon-home"></i>
                                                Home </a>
                                        </li>
					 
					 <?php require 'menu.php'; ?>
					 
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->