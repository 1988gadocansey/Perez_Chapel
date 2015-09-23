<?php session_start(); ?>
<div class="nav-head">
				<!-- site logo -->
                                <a href="dashboard.php" class="site-logo text-uppercase">
                                    <img src="login/images/logo.png" style="width: 43px;height:44px;margin-left: -28%"/>
                                    <span style="font-size: 14px" class="text">Perez Chapel</span>
				</a>
			</div>

			<!-- Site nav (vertical) -->
                        <nav class="site-nav clearfix" role="navigation">
				<div class="profile clearfix mb15">
                                    <img  src="photos/avatars/<?php echo $_SESSION[USERNAME]?>.jpg" alt="user">
					<div class="group">
						<h5 class="name"><?php echo $_SESSION[USERNAME] ?></h5>
						<small class="desig text-lowercase"><?php echo $_SESSION[level] ?></small>
					</div>
				</div>

				<!-- navigation -->
				<ul class="list-unstyled clearfix nav-list mb15">
					 <?php require 'menu.php'; ?>
				</ul> <!-- #end navigation -->
			</nav>
                        <!-- nav-foot -->
			<footer class="nav-foot">
				<p>2015 &copy;<?php echo date("Y"); ?> <span>Perez Chapel | Designed by Gad | 0505284060</span></p>
			</footer>