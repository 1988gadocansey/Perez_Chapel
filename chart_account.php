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
        if(isset($_GET[item])){
            $query=$sql->Prepare("DELETE FROM tbl_accounts WHERE ACCOUNT_ID='$_GET[item]'");
            if($sql->Execute($query)){
               $ledger->updateLedgers($_GET[item]);
               $login->setLog("Account/Ledger Deletion", "$_SESSION[USERNAME] has deleted ". $ledger->getLedgerName($_GET[item])." ");
                
                header("location:chart_account?success=1");
                     
           }
           else{
                header("location:chart_account?error=1");
           }
        }
        if(isset($_POST[go])){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
        if($_GET[ledger]){
        $_SESSION[parent_account]=$_GET[ledger];
        }
        if($_GET[effects]){
        $_SESSION[effects]=$_GET[effects];
        }
        ////////////////////////////////
        // Creating and updating ledgers//
        ///////////////////////////////
       if(isset($_POST[create])){ 
              $account_id= $_POST['account_id'];
              $account_name= $_POST['account'];
              $account_type= $_POST['type'];
              $balance_type= $_POST['balance_type'];
              $account_balance= $_POST['balance'];
              $description= $_POST['description'];
              $affects= implode(",",$_POST['affects']);  
              $account_number=$_POST['account_number'];
              $code=$help->getCode("ACCOUNT");
               $a=  time();
                //strtotime($a);
                //strtotime(time());
              $date= date("t/m/Y",strtotime(a));
               
           if(empty($_POST[key])){
               $query =$sql->Prepare("INSERT INTO tbl_accounts(ACCOUNT_NAME,PARENT_ACCOUNT,ACCOUNT_DESCRIPTION,AFFECTS,ACCOUNT_BALANCE,ACCOUNT_CODE,BALANCE_TYPE,BUSINESS_PERSON,BANK_ACCOUNT_NUM,PERIOD)VALUES ('$account_name','$account_type','$description','$affects','$account_balance','$code','$balance_type','$business_person','$account_number','$date')");
                $sql->Execute(trim($query) );
               $in=$sql->Prepare("SELECT MAX(ACCOUNT_ID) AS ACCOUNT FROM tbl_accounts");
               $out=$sql->Execute($in);
               $result=$out->FetchNextObject();
               $account_key=$result->ACCOUNT;
               if($balance_type=='Credit'){
               $query2 =$sql->Prepare("INSERT INTO  tbl_general_ledger(GENERAL_LEDGER_DESC,ACCOUNT_ID,GENERAL_LEDGER_CREDIT,PERIOD) VALUES('Opening Balances','$account_key','$account_balance','$date') ");
               }
               else{
                  $query2 =$sql->Prepare("INSERT INTO  tbl_general_ledger(GENERAL_LEDGER_DESC,ACCOUNT_ID,GENERAL_LEDGER_DEBIT,PERIOD) VALUES('Opening Balances','$account_key','$account_balance','$date') ");
               
               }
               
               $a=1;
           }
           else{
                $query1 =$sql->Prepare("UPDATE tbl_accounts SET ACCOUNT_NAME='$account_name',PARENT_ACCOUNT='$account_type',ACCOUNT_DESCRIPTION='$description',AFFECTS='$affects',ACCOUNT_BALANCE='$account_balance',ACCOUNT_CODE='$code',BALANCE_TYPE='$balance_type',BUSINESS_PERSON='$business_person',BANK_ACCOUNT_NUM='$account_number' WHERE ACCOUNT_ID='$_POST[key]'");
                if($balance_type=='Credit'){
               $query2 =$sql->Prepare("UPDATE  tbl_general_ledger SET GENERAL_LEDGER_DESC='Opening Balances',GENERAL_LEDGER_CREDIT='$account_balance', TRANSFERED='0' WHERE ACCOUNT_ID='$_POST[key]' ");
               }
               else{
                  $query2 =$sql->Prepare("UPDATE  tbl_general_ledger SET GENERAL_LEDGER_DESC='Opening Balances',GENERAL_LEDGER_DEBIT='$account_balance',TRANSFERED='0' WHERE ACCOUNT_ID='$_POST[key]' ");
               
               }
           }
              $sql->Execute(trim($query1) );
           $last=$sql->Execute(trim($query2) );
            if($a==1){
                $help->UpdateCode("ACCOUNT");
            }
          if($last){
                //$ledger->prepareLedger();
             
             $login->setLog("Ledger/Account Creation","$_SESSION[USERNAME] has Created  $account_name ledger with amount GHC $account_balance");

                     header("location:chart_account?success=1");
               
            }
            else{
                    header("location:chart_account?error=1");
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
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                    <div class="modal fade" id="mount" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Account Ledger</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" class="form-horizontal row-border"   id="form" data-validate="parsley" >
                                               <div class="form-group">
                                                   <input type="hidden" class="form-control" required="required" name="key"value="<?php $rows->ID  ?>" >

                                                <label class="col-sm-3 control-label">Account Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" required="required" name="account">

                                                </div>

                                            </div>
                                               <div class="form-group">

                                                <label class="col-sm-3 control-label">Account Code</label>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" required="required" readonly="" name="code" value="<?php echo $help->getCode("ACCOUNT"); ?>">

                                                </div>

                                            </div>
                                              <div class="form-group">
                                                <span id="balance">
                                                <label class="col-sm-3 control-label">Account Balance</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control"  name="balance"   data-type="digits">

                                                </div>
                                               </span>
                                            </div>
                                             <div class="form-group">
                                                 <span id='spryselect'>
                                                <label for="fieldname" class="col-md-3 control-label">Balance type</label>
                                                <div class="col-md-6">
                                                     <select class="form-control" name='balance_type'id='b'  required="required">
                                                            <option value=''>select balance type</option>
                                                            <option value='Credit'>Credit</option>
                                                            <option value='Debit'>Debit</option>

                                                       </select>

                                                </div>
                                                 </span>
                                             </div>
                                            <div class="form-group">
                                                 <span id='spryselect'>
                                                <label for="fieldname" class="col-md-3 control-label">Account Type</label>
                                                <div class="col-md-6">
                                                     <select class="form-control" name='type'  required="" onchange="getBank(this.value)">
                                                            <option value=''>select parent account</option>
                                                                                    
                                                              <?php 
                                                              global $sql;

                                                              $query2=$sql->Prepare("SELECT  * FROM tbl_parent_account");


                                                                $query=$sql->Execute( $query2);


                                                             while( $row = $query->FetchRow())
                                                               {

                                                               ?>
                                                               <option value="<?php echo $row['PARENT_ACCOUNT_ID']; ?>"   <?php if($_SESSION[parent_account]==$row['PARENT_ACCOUNT']){echo "selected='selected'";} ?>      ><?php echo   $row['PARENT_NAME']; ?></option>

                                                            <?php }?>
                                                       </select>

                                                </div>
                                                 </span>
                                             </div>
                                               <div id="bank">

                                              </div>
                               

                                               <div class="form-group">
                                                <label class="col-sm-3 control-label">Affects</label>
                                                <div class="col-sm-6">
                                                    <label class="checkbox-inline">
                                                      <input name='affects[]' type="checkbox" id="inlinecheckbox1" value="Profit and Loss"> Profit and Loss
                                                    </label>
                                                    <label class="checkbox-inline">
                                                      <input name='affects[]' type="checkbox" id="inlinecheckbox2" value="Balance Sheet"> Balance Sheet
                                                    </label>
                                                    <label class="checkbox-inline">
                                                      <input name='affects[]' type="checkbox" id="inlinecheckbox3" value="Income and Expenditure"> Income and Expenditure
                                                    </label>
                                                    <label class="checkbox-inline">
                                                      <input name='affects[]' type="checkbox" id="inlinecheckbox3" value="Receipts and Payments"> Receipts and Payments
                                                    </label>
                                                </div>
                                            </div>



                                            <div style="">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Account Description</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="description"   rows="2" data-trigger="hover" data-toggle="popover" data-content="click on the rectangular box at the extreme right to get fullscreen notepad" data-original-title="Notepad"></textarea>
                                                </div>
                                            </div>
                                            </div>



                                            <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="btn-toolbar">
                                                        <button type="submit" name="create" class="btn-primary btn btn-success">Submit</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
                    
                                            
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Chart of Accounts</li>
					<li class="active"><a href="#">Members</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						        
                                                <div style="margin-top:-2.5%;float:right">
                                                     
                                                       <button  style="margin-top: -59px"  data-target="#mount" data-toggle="modal"  class="btn btn-success waves-effect">Create Ledger<i class="md md-filter"></i></button>
                                                        <button  style="margin-top:-58px"  data-target="#recycle" data-toggle="modal"  class="btn btn-danger waves-effect">Restore Deleted Ledgers<i class="md md-filter"></i></button>
                                                        <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                             
                     
                                        <table  width=" " border="0">
                                                             <tr>


                                          <td width="25%">
                                            <select class='form-control'  style="margin-left:131%;  width:108% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?effects='+escape(this.value);"     >
                                            <option value=''>Filter by Effects</option>
                                            <option value='All effect'>All Effects</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT DISTINCT AFFECTS FROM tbl_accounts");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['AFFECTS']; ?>"   <?php if($_SESSION[effects]==$row['AFFECTS']){echo "selected='selected'";} ?>      ><?php echo $row['AFFECTS']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left:-88%;  width:104% "  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?ledger='+escape(this.value);"   id=""  >
                                            <option value=''>Filter by account types</option>
                                            <option value='All ledger'>All ledgers</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT DISTINCT PARENT_ACCOUNT FROM tbl_accounts");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['PARENT_ACCOUNT']; ?>"   <?php if($_SESSION[parent_account]==$row['PARENT_ACCOUNT']){echo "selected='selected'";} ?>      ><?php echo  $ledger->getParent($row['PARENT_ACCOUNT']); ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>
                                                <td>
                                                    <form action="chart_account?" method="post" >
                                            <td width="25%">


                                                <input type="text" name ="search" placeholder="type search item here..."required="" style="margin-left:45%; width:88%;" class="form-control" id=" "  >

                                            </td>
                                            <td>&nbsp;</td>
                                             <td width="25%">
                                            <select class='form-control'  name='content' required="" style="margin-left: 41%; width: 58%;" id="f" >
                                                <option value=''>search by</option>
                                                <option value='ACCOUNT_NAME'<?php if($_SESSION[conthhent]=='SURNAME'){echo 'selected="selected"'; }?>>Account Name</option>
                                                <option value='ACCOUNT_CODE'<?php if($_SESSION[status]=='FIRSTNAME'){echo 'selected="selected"'; }?>>Account Code</option>
                                                 
                                           </select>

                                             </td>
                                        <td>&nbsp;</td>
                                        <td width="25%">
                                              <button type="submit" name="go" style="margin-left: 22%; width: 65px;" class="btn btn-primary">Search</button>
                                        </td>
                                            </tr>  

                                        </form>
                                                </td>
                                        </tr>
                                       </table>
      
                        <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->

                                                 <hr>
                                                <div class="table-responsive">
                        <a onclick="javascript:printDiv('print')" title="Click to print report"><i class="fa fa-print"></i></a>                                                           
                       <div id="print">
                         <?php
                         $affect=$_SESSION[effects];
                         $parent=$_SESSION[parent_account];
                         $search=trim($_POST[search]);
                         $content=trim($_POST[content]);

                         if($affect=="All effect" or $affect==""){ $affect=""; }else {$affect_=" and  account.AFFECTS = '$affect' "  ;}
                         if($parent=="All ledger" or $parent==""){ $parent=""; }else {$parent_="and account.PARENT_ACCOUNT = '$parent' "  ;}
                         if($search=="" ){ $search=""; }else {$search_="AND account.$content LIKE '$search' "  ;}
 
                        $query ="SELECT *  FROM tbl_accounts AS account JOIN tbl_parent_account AS type ON account.PARENT_ACCOUNT=type.PARENT_ACCOUNT_ID WHERE account.ACTION='0'$affect_ $parent_ $search_ ";
                       //print_r($query);
                        $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                           $recordsFound =$rs->_maxRecordCount;    // total record found
                          if (!$rs->EOF) 

                        {


                     echo " <table id=\"assesment\" class=\"table   display\">";//start table

                         echo" <thead>
                         <tr>
                            <th>NO</th>
                            <th>ACCOUNT CODE</th>
                            <th class=' '>ACCOUNT NAME</th>

                            <th>ACCOUNT TYPE</th>

                            <th>AFFECTS</th>
                            <th>BALANCE (GHC)</th>
                            <th class='text-center'>ACTIONS</th>
                    
                        </tr>
                        </thead>
                    <tbody>";

 
         echo "</thead>";
          
         
	$count=0;
           while($rtmt=$rs->FetchRow()){
                $count++;

           // $end1=date("dS F Y",strtotime($end));
		 //extract row
            //this will make $row['firstname'] to
            //just $firstname only
            
              

              
        $parent_name = $ledger->getParent($rtmt[PARENT_ACCOUNT]);
        $parent_id = $ledger->getGroupId($parent_name);
        echo "<tr>";
        echo "<td>$count</td>";
        echo "<td>$rtmt[ACCOUNT_CODE]</td>";
        echo "<td style='text-align: ;'>$rtmt[ACCOUNT_NAME]</td>";

        echo "<td >" . $parent_name . "</td>";
        echo "<td  >" . $ledger->getAffect($rtmt[ACCOUNT_ID]) . "</td>";
        echo "<td style='text-align:'>" . $ledger->getLedgerBalancePeriod($rtmt[ACCOUNT_ID],date('t/m/Y')) . "</td>";
        echo" <td style='text-align:center;'colspan='3'>
                         
                       
                        
          <a style=\"cursor: pointer\" title=\"click to view transactions\" onclick=\"return MM_openBrWindow('view_transactions?item=$rtmt[ACCOUNT_ID]','','menubar=yes,width=700,height=450')\"   ><i class='fa fa-database'></i>View Report </a>
           <a style=\"cursor: pointer\" title=\"click to edit\" onclick=\"return MM_openBrWindow('ledger_edit?item=$rtmt[ACCOUNT_ID]','','menubar=yes,width=700,height=450')\"   ><i class='fa fa-edit'></i>Edit </a>
            
           
            <a href='chart_account?item=$rtmt[ACCOUNT_ID]' onclick=\"return confirm('Are you sure you want to delete this account')\" style='position:relative;' class='deleteBtn customBtn'><i class='fa fa-trash-o'></i>delete</a>

        </td>";


        echo "</tr>";  
         
		}
                   
            echo "</table> 
            <br/>
                                                <center>";
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                  echo"</center>";
           } else{
                        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                              Oh snap!. No record to display 
                    </div>";
                       }
              ?>



                          <small>  Generated on <?php echo gmdate("D, d M Y H:i:s") . " GMT";?></small>

                      </div>
                      </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	<?php include("./_library_/_includes_/theme.inc"); ?>

	<?php include("./_library_/_includes_/theme.inc"); ?>
        
	<?php include("./_library_/_includes_/js.php"); ?>
        
        <script src="assets/scripts/app.js"></script>
        <script src="assets/scripts/plugins/jquery.dataTables.min.js"></script>
	
	<script src="assets/scripts/tables.init.js"></script>
 <?php include("_library_/_includes_/export.php");  ?>
         
</body>

</html>