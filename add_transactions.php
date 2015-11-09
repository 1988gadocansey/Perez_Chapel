<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        $crypt=new _classes_\cryptCls();
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $config_file=$help->getConfig() ;
        $ledger=new _classes_\Ledger();                           
        $login=new _classes_\Login();
        
        if(isset($_POST[submit])){
            
            $amount=  $_POST['amount'];
            $naration=  $_POST['naration'];
       
            $tag= $_POST['tag'];
            $receiver=$ledger->getAccount_key($_POST['receiver']);
            $date=date("d/m/Y");
            $actor=$_SESSION['ID'];
            $giver=$ledger->getAccount_key($_POST['giver']);
            $period=date('t/m/Y');
            $type= $_POST['type'];
        
            $code=$help->getCode("MEMO");
            $query = "INSERT INTO `tbl_general_ledger_transactions` (  `CHEQUE_NUMBER`, `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `DEBIT`, `CREDIT`, `TAG`,TRANSACTION_ID, TRANSACTION_TYPE,`ACTOR`) VALUES (  '$cheque','$date','$period', '$receiver', '$naration', '$amount', '', '$tag','$code','$type', '$actor')";
            $query2 = "INSERT INTO `tbl_general_ledger_transactions` (  `CHEQUE_NUMBER`, `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `DEBIT`, `CREDIT`, `TAG`,TRANSACTION_ID, TRANSACTION_TYPE,`ACTOR`) VALUES (  '$cheque','$date','$period', '$giver', '$naration', '', '$amount', '$tag','$code','$type', '$actor')";

            $stmt = $sql->Prepare($query);
            $stmt2 = $sql->Prepare($query2);
            $sql->Execute($stmt);
            $sql->Execute($stmt2);
            $help->UpdateCode("MEMO");
            $lg = $ledger->getAccount($receiver);
            $give=$ledger->getAccount($giver);
            $a=$login->setLog("Transaction","$_SESSION[USERNAME] has $type    GHC $amount  from $give to $lg");
            if($a){
                              header("location:add_transactions?success=1");
                  }
              else{
                   header("location:add_transactions?success=1");
              }
    }
?>
<?php include("./_library_/_includes_/header.inc"); ?>
 <?php 
        $result = $sql->Prepare("SELECT *  FROM  tbl_transaction_type ORDER BY typename  ");
$result_=$sql->Execute($result);
	$a = "";
		while($row = $result_->FetchRow()){
			 $a = $a . "'".$row['typename']."',";
		}
		
		echo "<script type='text/javascript'>
				var trans = [".$a."];
				</script>
				";
				
   
                    $result = $sql->Prepare("SELECT *  FROM tbl_accounts WHERE ACTION='0'  ");
$result_=$sql->Execute($result);
	$a = "";
		while($row = $result_->FetchRow()){
			 $a = $a . "'".$row['ACCOUNT_NAME']."',";
		}
		
		echo "<script type='text/javascript'>
				var giver = [".$a."];
				</script>
				";
                  $result = $sql->Prepare("SELECT *  FROM tbl_accounts WHERE ACTION='0'  ");
$result_=$sql->Execute($result);
	$a = "";
		while($row = $result_->FetchRow()){
			 $a = $a . "'".$row['ACCOUNT_NAME']."',";
		}
		
		echo "<script type='text/javascript'>
				var receiver = [".$a."];
				</script>
				";
   ?>
<body id="app" class="app off-canvas">
     
	<!-- header -->
	<header class="site-head" id="site-head">
		<link rel="stylesheet" type="text/css" href="autocompletion/jquery.autocomplete.css"  /> 

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
                     
                    
                                            
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Finance</li>
					<li class="active"><a href="#">Add Transactions</a></li>
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
                           
                               <form action="add_transactions" method="post"class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                 <p>&nbsp;</p>
               <!--<div class="form-group">
                <span id="item">
                <label class="col-sm-3 control-label">Transaction Date</label>
                <div class="col-sm-6">
                    
                       <input id="Datepicker1" name="date" type="text" class="form-control"     required=""/>
                       
                    
                </div>
               </span>
              </div>-->
               
                 <div class="form-group">
                 <span id='spryselect'>
		<label for="fieldname" class="col-md-3 control-label">General Ledger Tag</label>
		<div class="col-md-6">
                     <select class="form-control" name='tag'id='type'   >
                            <option value=''>select tag</option>
                                                <?php 


 

                                                     $num=0;
                                                     $query2 = $sql->Prepare("SELECT *  FROM tbl_general_ledger_tag");


                                                     $query = $sql->Execute($query2);
                                                     while ($row = $query->FetchRow()) {
                                                    
                                                         extract($row);
                                                    
                                                     ?>
                                                     <option value="<?php echo $ID; ?>"><?php echo $TAG; ?></option>

                                               <?php }?>
                       </select>
                     
		</div>
                 </span>
	     </div>
                <div class="form-group">
                 <span id='spryselect'>
		<label for="fieldname" class="col-md-3 control-label">Select Giving Account</label>
		<div class="col-md-6">
                    <select class="form-control" name='giver'id='type'   >
                            <option value=''>select tag</option>
                                                <?php 


 

                                                     $num=0;
                                                     $query2 = $sql->Prepare("SELECT *  FROM tbl_accounts WHERE ACTION='0'");


                                                     $query = $sql->Execute($query2);
                                                     while ($row = $query->FetchRow()) {
                                                    
                                                         extract($row);
                                                    
                                                     ?>
                                                     <option value="<?php echo $ACCOUNT_NAME; ?>"><?php echo $ACCOUNT_NAME; ?></option>

                                               <?php }?>
                       </select> 
		</div>
                 </span>
	     </div>
               
               <div class="form-group">
                 <span id='spryselect'>
		<label for="fieldname" class="col-md-3 control-label">Receiving Account</label>
		<div class="col-md-6">
                     <select class="form-control" name='receiver'id='type'   >
                            <option value=''>select tag</option>
                                                <?php 


 

                                                     $num=0;
                                                     $query2 = $sql->Prepare("SELECT *  FROM tbl_accounts WHERE ACTION='0'");


                                                     $query = $sql->Execute($query2);
                                                     while ($row = $query->FetchRow()) {
                                                    
                                                         extract($row);
                                                    
                                                     ?>
                                                     <option value="<?php echo $ACCOUNT_NAME; ?>"><?php echo $ACCOUNT_NAME; ?></option>

                                               <?php }?>
                       </select> 
                     
		</div>
                 </span>
	     </div>
               <div class="form-group">
                <label class="col-sm-3 control-label">Amount GHC</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control"   name="amount" required="required">
                     
              </div>
                
            </div>
               
          
             <div class="form-group">
                 
		<label for="fieldname" class="col-md-3 control-label">Transaction type</label>
		<div class="col-md-6">
                     
                     <select class="form-control" name='type'id='genderf'   >
                            <option value=''>select tag</option>
                                                <?php 


 

                                                     $num=0;
                                                     $query2 = $sql->Prepare("SELECT *  FROM  tbl_transaction_type ORDER BY typename");


                                                     $query = $sql->Execute($query2);
                                                     while ($row = $query->FetchRow()) {
                                                    
                                                         extract($row);
                                                    
                                                     ?>
                                                     <option value="<?php echo $typename; ?>"><?php echo $typename; ?></option>

                                               <?php }?>
                       </select> 
                    
		</div>
                  
	     </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Naration</label>
                <div class="col-sm-6">
                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="naration"   rows="2" data-trigger="hover" data-toggle="popover" data-content="click on the rectangular box at the extreme right to get fullscreen notepad" data-original-title="Notepad"></textarea>
                </div>
            </div>
             
            
            
            <center>
            <div class="panel-footer">
                 <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="btn-toolbar">
                        <button type="submit" name="submit"class="btn-primary btn btn-success">Accept</button>
                        <button type="reset" class="btn btn-primary" > Clear</button>
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
 <script type='text/javascript' src="autocompletion/jquery.js"></script>
 <script type='text/javascript' src="autocompletion/jquery.autocomplete.js"></script>
 
 
                    <script type="text/javascript">
  
//var other_options =  ['Phone Numbers', 'Email', 'Address', 'Local Congregation','Males', 'Females' ];
 $().ready(function() {
		
	 
	$("#transaction").autocomplete(trans, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
        $("#account").autocomplete(trans, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
	
	});
 	$("#giver").autocomplete(giver, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: true,
		scrollHeight: 220,
	
	});
        $("#receiver").autocomplete(receiver, {
		minChars: 0,
		max: 12,
		autoFill: true,
		mustMatch: true,
		matchContains: true,
		scrollHeight: 220,
	
	});
 });
 </script>
	 
	<?php include("./_library_/_includes_/js.php"); ?>
       
 <script src="assets/scripts/form-elements.init.js"></script>
        
         
</body>

</html>