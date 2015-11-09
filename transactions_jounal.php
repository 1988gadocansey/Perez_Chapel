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
                     
                    
                                            
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Finance</li>
					<li class="active"><a href="#">Transactions Ledger</a></li>
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

                                                             <form action="transactions_jounal" method="post" class="form-horizontal row-border"   id="form">
                
                                          <td width="25%">
                                              
                                              

                                              <input placeholder="date from" id="datepickerDemo1" name="start" type="text" class="form-control"     required=""/>
 
                                             
                                          </td> 
                                           <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                             

                                               <input placeholder="date to" style="margin-left:10%" id="datepickerDemo" name="end" type="text" class="form-control"     required=""/>

                                            
                                            
                                           </td>
                                           <td>&nbsp;</td>
                                           <td>
                                                <select class="form-control" name='ledger'id='source' style="margin-left:20%"   required="">
                                                    <option value=''>Select Accounts</option>
                                                  
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT *  FROM tbl_general_ledger");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                        $account=$ledger->getLedgerName($ACCOUNT_ID);
                                                                    ?>
                                                                    <option value="<?php echo $ACCOUNT_ID; ?>"><?php echo $account; ?></option>
                                                              <?php }?>

                                                </select>
                                           </td>
                                           <td>&nbsp;</td>
                                           <td>
                                               <select required="" class="form-control" name='period' required="" style="margin-left: 28%"   >
                                            <option value=''>select period</option>
                                                <?php 


 

                                                     $num=0;
                                                     $query2 = $sql->Prepare("SELECT DISTINCT PERIOD  FROM tbl_general_ledger_transactions");


                                                     $query = $sql->Execute($query2);
                                                     while ($row = $query->FetchRow()) {
                                                    
                                                         extract($row);
                                                    
                                                     ?>
                                                     <option value="<?php echo $PERIOD; ?>"><?php echo $PERIOD; ?></option>

                                               <?php }?>
                                            </select>
                                           </td>
                                           <td>
                                               <button style="margin-left: 48%" type="submit" name="submit"class="btn-primary btn btn-success">search</button>
                                           </td>
                                        </tr>
                                       </table>
                            </form>
      
                        <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->

                                                 <hr>
                                 <div class="table-responsive">
               <a onclick="javascript:printDiv('print')" title="Click to print report"><i class="fa fa-print"></i></a>                                                           
              <div id="print">
                <?php
                if(isset($_POST['submit'])){
                     
                            $end_date=date("Y-m-d",  strtotime($_POST[end]));
                            $start_date=date("Y-m-d",  strtotime($_POST[start]));
                            $period=$_POST[period];
                            $ledger1=$_POST[ledger];
                            $end="WHERE  TRANS_DATE  BETWEEN '$start_date' AND '$end_date' AND PERIOD='$period' AND ACCOUNT='$ledger1' ORDER BY ACCOUNT";
                    }
                


                    $query ="SELECT  *  FROM tbl_general_ledger_transactions  $end";
                   print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                       $recordsFound =$rs->_maxRecordCount;    // total record found
                      if (!$rs->EOF) 

                    {


                echo "<table  class='table  table-hover' id='assesment'>";//start table
                  if(!empty($start_date) ){
                    echo"<center><b>TRANSACTION JOURNAL FROM ".date("d/m/Y",  strtotime($_POST[start]))." TO ".date("d/m/Y",  strtotime($_POST[end]));"</b></center>";
                    //creating our table heading
                  }
                  else{
                      echo"<center><b>TRANSACTION JOURNAL AS AT ".strtoupper (date("t/m/Y"))." </b></center>";
                    //creating our table heading
                  }
                    echo "<thead>";
                     echo "<th>NO</th>";
                    echo "<th>DATE</th>";
                    echo "<th style='text-align:center'>MEMO</th>";
                    echo "<th>NARRATIVE</th>";
                    echo "<th>ACCOUNT</th>";
                    echo "<th>TRANSACTION TYPE</th>";
                    echo "<th style='text-align:center'>DEBIT GHC</th>";
                    echo "<th style='text-align:center'>CREDIT GHC</th>";



               echo "</thead>";
             
                echo "<tbody>";


                $count=0;
           while($rtmt=$rs->FetchRow()){
                $count++;

                extract($rtmt);
                if(empty($DEBIT)){
                    $DEBIT="";
                }
                else if(empty($CREDIT)){
                    $CREDIT="";
                }

            echo "<tr>
                    <td>$count</td>
                  <td>".$TRANS_DATE."</td>
                  <td style='text-align:center'>".$TRANSACTION_ID."</td>   
                   <td>". $NARRATIVE."</td>
                  <td>".$ledger->getLedgerName($ACCOUNT)."</td>
                   <td>".$TRANSACTION_TYPE."</td>  
                    <td style='text-align:center'>".$DEBIT."</td>
                   <td style='text-align:center'>".$CREDIT."</td>";
            if(!empty($_GET[tag])){
                  echo " 
                   <td style='text-align:center'>".$ledger->getTag($TAG)."</td>";
              }
             echo"</tr>";
         
         
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