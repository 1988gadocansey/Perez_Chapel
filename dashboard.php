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
			<!-- dashboard page -->
			<div class="page page-dashboard">

				<div class="page-wrap">

					<div class="row">
						<!-- dashboard header -->
						<div class="col-md-12">
							<div class="dash-head clearfix mt15 mb20">
								<div class="left">
									<h4 class="mb5 text-light">Welcome to Materia</h4>
									<p class="small"><strong>AngularJS</strong> admin app</p>
								</div>
								<div class="right mt10">
									<span data-Type="bar" data-BarColor="#4CAF50" class="sparkline">10,8,4,10,7,0,3,4,6,5,9,12,9</span>
									<h5 class="text-bold mb0 mt5">$1,33,404</h5>
								</div>
							</div>
						</div>
					</div> <!-- #end row -->

					<!-- mini boxes -->
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="panel panel-default mb20 mini-box panel-hovered">
								<div class="panel-body">
									<div class="clearfix">
										<div class="info left">
											<h4 class="mt0 text-primary text-bold">$30,200</h4>
											<h5 class="text-light mb0">All Earnings</h5>
										</div>
										<div class="right ion ion-ios-pulse icon"></div>
									</div>
								</div>
								<div class="panel-footer clearfix panel-footer-sm panel-footer-primary">
									<p class="mt0 mb0 left">% change</p>
									<span class="sparkline right" data-Type="bar" data-BarColor="#fff" data-Width="1.15em" data-Height="1.15em">10,8,9,3,5,8,5</span>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6">
							<div class="panel panel-default mb20 mini-box panel-hovered">
								<div class="panel-body">
									<div class="clearfix">
										<div class="info left">
											<h4 class="mt0 text-success text-bold">320K+</h4>
											<h5 class="text-light mb0">Page Views</h5>
										</div>
										<div class="right ion ion-ios-people-outline icon"></div>
									</div>
								</div>
								<div class="panel-footer clearfix panel-footer-sm panel-footer-success">
									<p class="mt0 mb0 left">% change</p>
									<span class="right sparkline" data-Type="bar" data-BarColor="#fff" data-Width="1.15em" data-Height="1.15em">3,5,9,8,6,10</span>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6">
							<div class="panel panel-default mb20 mini-box panel-hovered">
								<div class="panel-body">
									<div class="clearfix">
										<div class="info left">
											<h4 class="mt0 text-info text-bold">110</h4>
											<h5 class="text-light mb0">Task Completed</h5>
										</div>
										<div class="right ion ion-ios-flask-outline icon"></div>
									</div>
								</div>
								<div class="panel-footer clearfix panel-footer-sm panel-footer-info">
									<p class="mt0 mb0 left">% change</p>
									<span class="right sparkline" data-Type="bar" data-BarColor="#fff" data-Width="1.15em" data-Height="1.15em">5,9,9,8,6,6</span>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-sm-6">
							<div class="panel panel-default mb20 mini-box panel-hovered">
								<div class="panel-body">
									<div class="clearfix">
										<div class="info left">
											<h4 class="mt0 text-pink text-bold">10K+</h4>
											<h5 class="text-light mb0">Downloads</h5>
										</div>
										<div class="right ion ion-ios-cloud-download-outline icon"></div>
									</div>
								</div>
								<div class="panel-footer clearfix panel-footer-sm panel-footer-pink">
									<p class="mt0 mb0 left">% change</p>
									<span class="sparkline right" data-Type="bar" data-BarColor="#fff" data-Width="1.15em" data-Height="1.15em">6,4,9,10,6,2</span>
								</div>
							</div>
						</div>
						<!-- #end mini boxes -->
					</div> <!-- #end row -->

					<!-- row -->
					<div class="row">

						<!-- Analytics -->
						<div class="col-md-7">
							<div class="panel panel-default mb20 panel-hovered analytics">
								<div class="panel-heading">Analytics</div>
								<div class="panel-body">
									<div id="c3chartAnalytics"></div>
									
									<div class="inline-charts mt30">
										<ul class="list-unstyled clearfix">
											<li class="col-md-3 col-xs-6">
												<span class="sparkline" data-FillColor="#fff" data-LineColor="#3F51B5" data-Width="3em" data-Height="3em">9,3,5,8,6,5,2,0,7,5</span>
												<p class="mt5"><strong>Downloads</strong></p>
											</li>
											<li class="col-md-3 col-xs-6">
												<span class="sparkline" data-LineColor="#FDD835" data-FillColor="#fff"  data-Width="3em" data-Height="3em">2,3,5,9,8,6,9,10,4</span>
												<p class="mt5"><strong>Uploads</strong></p>
											</li>
											<li class="col-md-3 col-xs-6">
												<span class="sparkline" data-FillColor="#fff" data-LineColor="#4CAF50" data-Width="3em"  data-Height="3em">3,5,9,8,6,10,2,8,7</span>
												<p class="mt5"><strong>Page Views</strong></p>
											</li>
											<li class="col-md-3 col-xs-6">
												<span class="sparkline" data-FillColor="#fff" data-LineColor="#E91E63" data-Width="3em" data-Height="3em">3,5,9,8,6,9,7,4,10</span>
												<p class="mt5"><strong>Unique Visits</strong></p>
											</li>
										</ul>
									</div>
								</div>
							</div>
							
						</div> <!-- #end analytics -->


						<!-- recent activities -->
						<div class="col-md-5">
							<div class="panel panel-default mb20 activities">
								<div class="panel-heading">Activities</div>
								<div class="panel-body">
									<ul class="list-unstyled">
										<li class="primary">
											<span class="point"></span>
											<span class="time small text-muted">2 mins ago</span>
											<p>Jonathan attend a meeting.</p>
										</li>
										<li class="success">
											<span class="point"></span>
											<span class="time small text-muted">1 hour ago</span>
											<p>Designed the wordpress theme</p>
										</li>
										<li class="warning">
											<span class="point"></span>
											<span class="time small text-muted">4:30 p.m</span>
											<p>Lily created her account.</p>
										</li>
										<li class="info">
											<span class="point"></span>
											<span class="time small text-muted">2 days ago</span>
											<p>Your domain will expired in 13 days.</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- #end recent activities -->
						

						<div class="col-md-5">
							<div class="panel panel-default mb20 panel-hovered">
								<div class="panel-heading">Usage Stats</div>
								<div class="panel-body">
									<ul class="list-unstyled">
										<li class="col-md-4 col-sm-4">
											<div data-percent="80" class="easypiechart storageOpts">
												<div class="data">
													<strong class="xsmall">80%</strong>
													<p class="xsmall">Storage</p>
												</div>
											</div>
										</li>
										<li class="col-md-4 col-sm-4">
											<div data-percent="35" class="easypiechart serverOpts">
												<div class="data">
													<strong class="xsmall">35%</strong>
													<p class="xsmall">Server</p>
												</div>
											</div>
										</li>
										<li class="col-md-4 col-sm-4">
											<div data-percent="54" class="easypiechart clientOpts">
												<div class="data">
													<strong class="xsmall">54%</strong>
													<p class="xsmall">Client</p>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div> <!-- #end row -->

							<!-- row -->
					<div class="row">

						<!-- profile -->
						<div class="col-md-4 col-sm-6">
							<div class="panel panel-default mb20 panel-hovered profile-widget">
								<div class="panel-body">
									<div class="clearfix mb15 top-info">
										<div class="left-side">
											<h3 class="text-light mt0">Robert Smith</h3>
											<p><strong>About:&nbsp;</strong>WebDesigner</p>
											<p><strong>Hobbies:&nbsp;</strong>Listening Music, learn new things and playing guitar.</p>
											<p>
												<strong>Skills: </strong> 
												<label class="label label-pink">html5</label>
												<label class="label label-pink">css3</label>
												<label class="label label-pink">jquery</label>
											</p>
										</div>
										<div class="right-side">
											<img src="images/admin.jpg" alt="user">
											<div class="rating text-warning">
												<input type="hidden" class="rating-control" value="4" data-filled="fa fa-star" data-empty="fa fa-star-o" />
											</div>
										</div>
									</div>
									<ul class="user-badges list-unstyled row">
										<li class="col-xs-4">
											<i class="ion ion-ios-chatboxes-outline text-success"></i>
											<strong>192</strong>
											<button class="btn btn-success btn-xs mt15">View</button>
										</li>
										<li class="col-xs-4">
											<i class="ion ion-ios-heart-outline text-primary"></i>
											<strong>5K+</strong>
											<button class="btn btn-info btn-xs mt15">Follow</button>
										</li>
										<li class="col-xs-4">
											<i class="ion ion-ios-body text-danger"></i>
											<strong>32</strong>
											<button class="btn btn-primary btn-xs mt15">Profile</button>
										</li>
									</ul>
								</div> <!-- #end panel-body -->
							</div>
						</div>

						<!-- browser share -->
						<div class="col-md-4 col-sm-6">
							<div class="panel panel-default mb20 panel-hovered">
								<div class="panel-heading">Browser Share</div>
								<div class="panel-body text-center">
									<div id="c3chartbrowsershare"></div>
								</div>
							</div>
						</div>

						
						<!-- list widgets -->
						<div class="col-md-4 col-sm-12">
							<div class="panel panel-default mb20 list-widget">
								<ul class="list-unstyled clearfix">
									<li>
										<i class="fa fa-file-o"></i>
										<span class="text">File List</span>
										<span class="badge badge-xs badge-primary right">100</span>
									</li>
									<li>
										<i class="fa fa-comments-o"></i>
										<span class="text">Messages</span>
										<span class="badge badge-xs badge-info right">40+</span>
									</li>
									<li>
										<i class="fa fa-bullhorn"></i>
										<span class="text">Notifications</span>
										<span class="badge badge-xs badge-success right">22</span>
									</li>
									<li>
										<i class="fa fa-hdd-o"></i>
										<span class="text">Bandwidth usage</span>
										<span class="badge badge-xs badge-danger right">80%</span>
									</li>
									<li>
										<i class="fa fa-microphone"></i>
										<span class="text">Calls Attended</span>
										<span class="badge badge-xs badge-info circle right">5</span>
									</li>
									<li>
										<i class="fa fa-bookmark-o"></i>
										<span class="text">Bookmarks Today</span>
										<span class="badge badge-xs circle badge-warning right">2</span>
									</li>
									<li>
										<i class="fa fa-bug"></i>
										<span class="text">Bug Fix Today</span>
										<span class="badge badge-xs circle badge-danger right">8</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- #end row -->

					<!-- row -->
					<div class="row">
						
						<!-- todo list -->
						<div class="col-md-5">
							<div class="panel panel-default panel-hovered mb20 todo" id="todoApp">
							    <div class="panel-heading">
							    	<span>Todo List</span>
							    </div>
							    <div class="panel-body">
							    	<ul class="list-unstyled todo-list">
							    		<!-- this will be add via jquery, as we don't have ngrepeat in jquery like angular -->
							    		<!-- <li>
							    			<div class="ui-checkbox ui-checkbox-pink">
							    				<label>
							    					<input type="checkbox" class="toggle"/>
							    					<span></span>
							    				</label>
							    			</div>

							    			<div class="todo-title">
							    				{{todo.title}}
							    				<form class="todo-edit">
							    					<input type="text"/>
							    				</form>
							    			</div>
							    			<span class="destroy ion ion-close right"></span>
							    		</li> -->
							    	</ul>
							    	<!-- Add todo input -->
							    	<form id="input-todo" class="input-todo">
							    		<input placeholder="Write some todo task here..." type="text">
							    	</form>
							    </div> <!-- #end panel-body -->
							    <div class="panel-footer todo-foot clearfix" id="todo-filters">
							    	<div class="left">
							    		<button class="btn btn-pink btn-xs right toggle-all">Toggle All</button>
							    	</div>
							    	<div class="right">
							    		<span class="remaining btn btn-xs btn-default">left</span>
							    		<button class="btn btn-pink btn-xs clear-completed">Clear Completed</button>
							    	</div>
							    </div>
							</div> <!-- #end panel -->
						</div>
						<!-- #end todo-list -->


						<!-- Project stats -->
						<div class="col-md-7">
							<div class="panel panel-default mb20 panel-hovered project-stats table-responsive">
								<div class="panel-heading">Project Stats</div>
								<div class="panel-body">	
									<table class="table">
										<thead>
											<tr>
												<th>Id</th>
												<th class="col-sm-5">Project</th>
												<th class="col-sm-1">Progress</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>101</td>
												<td>Designing Wordpress Theme</td>
												<td class="text-center">
													<span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">2,8</span>
												</td>
												<td>20<sup>th</sup> Jan 2015</td>
											</tr>

											<tr>
												<td>220</td>
												<td>Convert to SASS</td>
												<td class="text-center">
													<span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span>
												</td>
												<td>28<sup>th</sup> Jan 2015</td>
											</tr>

											<tr>
												<td>310</td>
												<td>Adding animations to template</td>
												<td class="text-center">
													<span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">7,3</span>
												</td>
												<td>02<sup>nd</sup> Feb 2015</td>
											</tr>

											<tr>
												<td>405</td>
												<td>Lorem ipsum dolar sit amet</td>
												<td class="text-center">
													<span class="sparkline" data-Type="pie" data-SliceColors="[#4CAF50,#eee]" data-Width="2em" data-Height="2em">4,6</span>
												</td>
												<td>28<sup>th</sup> Mar 2015</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div> 
					</div> <!-- #end row -->

				</div> <!-- #end page-wrap -->
			</div>
			<!-- #end dashboard page -->
		</div>

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>

 <?php include("./_library_/_includes_/scripts.inc") ?>
</body>

</html>