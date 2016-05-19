<?php
require '_ini_.php';
require 'vendor/autoload.php';
require '_library_/_includes_/config.php';
require '_library_/_includes_/app_config.inc';
include('parsecsv.lib.php');
$crypt = new _classes_\cryptCls();
$member = new _classes_\Members();
$help = new _classes_\helpers();
$notify = new _classes_\Notifications();
$config_file = $help->getConfig();
$ledger = new _classes_\Ledger();
if (isset($_POST[submit])) {

     $help->create_backup();
     
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
                 

                <div class="page-wrap">
                    <div class="note note-success note-bordered">


                        <div><?php $notify->Message(); ?></div>
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12">
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div>

                                        <form action="" method="post"class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                                            <p>&nbsp;</p>

                                             


                                          
                                            <center> <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <div class="btn-toolbar">
                                                                <button type="submit" name="submit"class="btn-primary btn btn-success"><i class="fa fa-database"></i>Backup Database</button>
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </center>
                                        </form>


                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

          

<?php include("./_library_/_includes_/js.php"); ?>

            <script src="assets/scripts/form-elements.init.js"></script>
             

            </body>

            </html>