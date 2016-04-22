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

    $member = strip_tags($_POST['member']);
     
        header("location:add_children.php?member=$member");
     
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

                                        <form action="addChild.php?submit=1" method="post"class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                                            <p>&nbsp;</p>

                                            <div class="form-group">

                                                <label for="fieldname" class="col-md-3 control-label">Select member</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name='member'id='title'  required="" >
                                                        <option value=''>select member</option>
                                                        <?php
                                                        $num = 0;
                                                        $query2 = $sql->Prepare("SELECT *  FROM perez_members");


                                                        $query = $sql->Execute($query2);
                                                        while ($row = $query->FetchRow()) {
                                                            ?>
                                                            <option value="<?php echo $row[ID]; ?>"><?php echo $row[MEMBER_CODE] . ' - ' . $row[TITLE] . ' ' . $row[FIRSTNAME] . ' ' . $row[LASTNAME] . ' ' . $row[OTHERNAMES]; ?></option>

                                                        <?php } ?>
                                                    </select>

                                                </div>

                                            </div>



                                            <center>
                                                <div class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <div class="btn-toolbar">
                                                                <button type="submit" name="submit"class="btn-primary btn btn-success">Accept</button>
                                                                <button type="reset" class="btn btn-default-light" > Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div></center>
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