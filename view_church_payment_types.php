<?php
 error_reporting(1);
 
include('inc/config.php');
$page['title'] = 'Example - table usage';

# delete handler
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($_POST['action'] == 'delete') {
		# delete some records
		$sql = 'DELETE FROM  perez_church_payment_type_info WHERE payment_type_id = :id';
		$stmt = cnn()->prepare($sql);
		$stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
		$stmt->execute();
		exit(true);
	}
}

# table
$sql['table'] = 'perez_church_payment_type_info';
 
# cols array(column, alias, asc/desc, type)
$sql['cols'][] = array('payment_type_id', 'id');
 
$sql['cols'][] = array('payment_type_name', 'name', 'asc');
$sql['cols'][] = array('status', 'status');
$sql['cols'][] = array('payment_type_id', 'action_edit');
$sql['cols'][] = array('payment_type_id', 'action_delete');

 
/*
# SPECIFIC sql options

# filters
$sql['filters'][] = array('user.name LIKE :name', ':name', "%Veronica%", PDO::PARAM_STR);
$sql['filters'][] = array('user.id_level = :id_level', ':id_level', 2, PDO::PARAM_INT);

# group
$sql['groupby'] = 'exchange.id_exchange'; */
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
     <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.bootbox.js"></script>
<script src="assets/js/jquery.datatables.js"></script>
<script src="assets/js/jquery.accounting.js"></script>
<script src="assets/js/jquery.timeout.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script src="assets/js/jquery.datepicker.js"></script>

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
					<li class="active"><a href="#">Church Payment Types</a></li>
				</ol>
                <div class="page-wrap">
                    <div class="note note-success note-bordered">


                        
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12">
                               <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div>

                                            <?php grid($sql)?>


                                    </div>
                                </div>
                            </div>

                            



                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

          

<?php include("./_library_/_includes_/js.php"); ?>

              
 
            </body>

            </html>