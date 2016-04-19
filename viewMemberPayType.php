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
$login = new _classes_\Login();

if (isset($_POST[submit])) {

    $name = strip_tags($_POST['name']);
    // check if member exist ...//
    $query1 = $sql->Prepare("INSERT INTO perez_member_payment_type SET payment_type_name='$name',status='enabled'");
    $query = $sql->Execute($query1);
     
    if ($query) {
        header("location:viewMemberPayType.php?success=1");
    } else {
        header("location:create_member_payment.php?error=1");
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
					<li> Fund Administration</li>
					<li class="active"><a href="#">Members Payment Types</a></li>
				</ol>
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

                                            <table class="table table-striped display" id="mem">
                                            <thead>
                                            
                                            <th>Payment Type Name</th>
                                            <th>Status</th>
                                             
                                            </thead>
                                             
                                            <tbody>
                                                
                                               
                                                 </tbody>
                                            
                                        </table>


                                    </div>
                                </div>
                            </div>

                            



                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

          

<?php include("./_library_/_includes_/js.php"); ?>

              
<script type="text/javascript">
            $(document).ready(function() {
            $('#mem').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": "datatables/memPTypes.php"
            } );
        } );
        
        </script> 
            </body>

            </html>