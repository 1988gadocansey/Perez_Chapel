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

  $date=strtotime(NOW);
                 $password=md5($_POST[password]);
	 	$stmt=$sql->Prepare("INSERT INTO  perez_auth (USER,USER_SINCE,USER_TYPE,USERNAME,PASSWORD,EMAIL) VALUES('$_POST[member]','$date','$_POST[designation]','$_POST[username]','$password','$_POST[email]')");
               
                if($sql->Execute($stmt)){
                    header("location:viewUsers.php?success=1");
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
                 

                <div class="page-wrap">
                    <div class="note note-success note-bordered">
                        <h4>Creating Users</h4>

                        <div><?php $notify->Message(); ?></div>
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12">
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div>

                                        <form action="addUsers.php?add=1" method="POST" class="form-horizontal" role="form">
                                                 <div class="card-body card-padding">
                                                  <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Workers</label>
                                                         <div class="col-md-6">
                                                              <select class="form-control" name='member'   required="" >
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
                                                     <div class="form-group">
                                                         <label for="inputEmail3"    class="col-sm-2 control-label">Username</label>
                                                         <div class="col-md-6">
                                                             <input type="text" required=""name="username"  class="form-control input-sm" id="input"   >

                                                         </div>
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputEmail3"    class="col-sm-2 control-label">Email</label>
                                                         <div class="col-md-6">
                                                             <input type="email" name="email"  class="form-control input-sm" id="input"   >

                                                         </div>
                                                     </div>
                                                     <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                                        <div class="col-md-6">

                                                               
                                                                    <input type="password" required="" name="password"  class="form-control input-sm" id="password"   >
                                                              
                                                        </div>
                                                     </div>
                                                      <div class="form-group">
                                                      <span id="spryconfirm1">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                                                        <div class="col-md-6">

                                                              
                                                                    <input type="password" required="" name=" "  class="form-control input-sm" id="confirm"   >
                                                              
                                                               <span class="confirmRequiredMsg"><br />
           													Enter the same  password as above</span><span class="confirmInvalidMsg"><br />The passwords don't match.</span></span>
                                                         </div>
                                                           
                                                     </div>
                                                      <div class="form-group">
                                                         <label for="inputPassword3" class="col-sm-2 control-label">User Role</label>
                                                         <div class="col-md-6">
                                                            <select class='form-control'    required="" name="designation" >
                                                                <option value=''>select role</option>
                                                                <option value='Head Pastor'>Head Pastor</option>
                                                                <option value='Assistant Pastor'>Assistant Pastor</option>
                                                                 <option value='Administrator'>Systems Administrator</option>
                                                                <option value='Data Entry Clerk'>Data Entry Clerk</option>
                                                               <option value='Accountant'>Accountant</option>
                                                               <option value='Elder'>Elder</option>
                                                               <option value='Church Admin'>Church Administrator</option>
                                                               <option value='Sunday School Teacher'>Sunday School Teacher</option>
                                                              </select>
                                                             </div>
                                                         
                                                     </div>
                                                      
                                                      
                                                 </div>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i>Save changes</button>
                                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        </div>
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
            <link href="assets/spryassets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
            <link href="assets/spryassets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />	 
            <script src="assets/spryassets/SpryValidationPassword.js" type="text/javascript"></script>
            <script src="assets/spryassets/SpryValidationConfirm.js" type="text/javascript"></script>

            <script type="text/javascript">
           var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {validateOn:["blur"]});
  
          var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"]});
          var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
            </script>
            </body>

            </html>