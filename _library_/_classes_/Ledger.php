<?php
/**
 * Handles all things concerning ledgers
 *
 * @author Gad Ocansey
 */
namespace _classes_;

class Ledger {
     private $connect;
     public static $instance;
  public function __construct() {
            global $sql,$season;
          
         $this->connect=$sql;
             $actor=$_SESSION['ID'];
 
            date_default_timezone_set('GMT');
    }
   
        
        // get payment type
        public function getPaymentType($type){
         $con=  Core::getInstance();
        $ss=$con->dbh->query("select * from tbl_payment_method WHERE PAYMENT_METHOD_ID='$type' ");
         $result = $ss->fetchAll();
                  foreach ($result as $output)
                        {
                            extract($output);

                              return $PAYMENT_METHOD_NAME;

                         }
        }

        //get general ledger accounts types here
  
  public function prepareLedger(){
         $date= date("d/m/Y");
    $period=date("t/m/Y");
    $helper=new helpers();
    $memo_id=$helper->getMemo();
    $counter=$this->connect->Prepare("SELECT * FROM tbl_general_ledger WHERE   TRANSFERED='0' AND PERIOD='$period'");
    $stmt=$this->connect->Execute($counter);
    $count=$stmt->RecordCount();
    
     
                $STM2 = $this->connect->Prepare("SELECT * FROM tbl_general_ledger WHERE    TRANSFERED='0'  AND PERIOD='$period' ");     
                $result = $this->connect->Execute($STM2);
                 
              while($rtmt=$result->FetchRow()){
                {
                    $count++;
                    $memo="GL".$count;
                    extract($rtmt);
                    echo $account= $ACCOUNT_ID;
                       
                         if(!empty($GENERAL_LEDGER_DEBIT)){
                             $balance="Debit";
                             $amount=$GENERAL_LEDGER_DEBIT;
                         }
                         else{
                             $balance="Credit";
                             $amount=$GENERAL_LEDGER_CREDIT;
                         }
                        echo $balance;
                   print_r(     $rtmt = $this->connect->Prepare("SELECT * FROM tbl_general_ledger_transactions WHERE    NARRATIVE='Opening Balances' AND ACCOUNT='$account' AND PERIOD='$period' "));     
                        $out = $this->connect->Execute($rtmt);
                        $a=$out->FetchNextObject();
                        if($out->RecordCount()==0){
                                if($balance=='Credit'){
                                    
                                  $qt=$this->connect->Prepare("INSERT INTO `tbl_general_ledger_transactions` (   `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `CREDIT`,TRANSACTION_ID, `ACTOR`) VALUES (  '$date','$period', '$ACCOUNT_ID', 'Opening Balances', '$amount', '$memo_id', '$_SESSION[ID]')");
                                  $this->connect->Execute($qt);
                                  $rtmt=$this->connect->Prepare("update tbl_general_ledger SET TRANSFERED='1' WHERE ACCOUNT_ID='$account'");
                                  $this->connect->Execute($rtmt);
                                  $helper->UpdateMemo();
                                }
                                elseif($balance=='Debit'){
                                    
                                   $qt=$this->connect->Prepare("INSERT INTO `tbl_general_ledger_transactions` (   `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `DEBIT`,TRANSACTION_ID, `ACTOR`) VALUES ( '$date','$period', '$ACCOUNT_ID', 'Opening Balances', '$amount', '$memo_id', '$_SESSION[ID]')");
                                  $this->connect->Execute($qt);
                                  $rtmt=$this->connect->Prepare("update tbl_general_ledger SET TRANSFERED='1' WHERE ACCOUNT_ID='$account'");
                                  $this->connect->Execute($rtmt);
                                  $helper->UpdateMemo();
                                }
                                 
                         }  
                         // update opening balances
                         else{
                             if($balance=='Credit'){
                                    
                                  $qt=$this->connect->Prepare("UPDATE `tbl_general_ledger_transactions` SET  CREDIT='$amount' WHERE ACCOUNT='$account'");
                                  $this->connect->Execute($qt);
                                  $rtmt=$this->connect->Prepare("update tbl_general_ledger SET TRANSFERED='1' WHERE ACCOUNT_ID='$account'");
                                  $this->connect->Execute($rtmt);
                                  
                                }
                                elseif($balance=='Debit'){
                                    
                                   $qt=$this->connect->Prepare("UPDATE `tbl_general_ledger_transactions` SET  DEBIT='$amount' WHERE ACCOUNT='$account'");
                                  $this->connect->Execute($qt);
                                  $rtmt=$this->connect->Prepare("update tbl_general_ledger SET TRANSFERED='1' WHERE ACCOUNT_ID='$account'");
                                  $this->connect->Execute($rtmt);
                                  
                                }
                         }
                         
                }

                      
              }
        
  }
  // this method will be call after an account is deleted
   public function updateLedgers($ledgers){
           
                    $query = $this->connect->Prepare("UPDATE tbl_general_ledger SET ACTION='1' WHERE ACCOUNT_ID='$ledgers'");
                    $query2 = $this->connect->Prepare("UPDATE tbl_general_ledger_transactions SET ACTION='1' WHERE ACCOUNT='$ledgers'");
                    $query3 = $this->connect->Prepare("UPDATE tbl_accounts SET ACTION='1' WHERE ACCOUNT_ID='$ledgers'");

                    $this->connect->Execute($query);
                    $this->connect->Execute($query2);
                    $this->connect->Execute($query3);
                  
    }
    public function updateAccount($id){
          
              $query=$this->connect->Prepare("DELETE FROM tbl_accounts WHERE ACCOUNT_CODE='$id'");
              return  $result=$this->connect->Execute($query);
    }
  //get parent account name of a sub account posted in the ledger
  public function getParent($parent){
      
               $STM2 = $stmt=$this->connect->Prepare("SELECT * FROM tbl_parent_account WHERE PARENT_ACCOUNT_ID='$parent'  ");
               $result=$this->connect->Execute($STM2);
                 
                if($result->RecordCount() > 0){


                   $rtmt=$result->FetchNextObject();
                   return $rtmt->PARENT_NAME;

               }
  }
   
   public function getSourceDoc($id){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts WHERE ACCOUNT_ID='$id'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                    if($id<=0){
                       return $id; 
                    }
                    else{
                    return $ACCOUNT_NAME;}
                      
                 }
                 
  }
  // returns the account id of a business person
    public function getAccount_ID($person){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_general_ledger WHERE ACCOUNT_ID='$person'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $ACCOUNT_ID;
                      
                 }
  }
    public function getAccountCode($id){
       
            $STM2 = $this->connect->Prepare("SELECT ACCOUNT_CODE FROM tbl_accounts WHERE ACCOUNT_ID='$id' OR ACCOUNT_NAME='$id'  ");
           $query=$this->connect->Execute($STM2);
           $result=$query->FetchNextObject();
           return $result->ACCOUNT_CODE;
           
            
  }
   public function getTransaction($type){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_transaction_type WHERE typeid='$type'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $typename;
                      
                 }
  }
  // 
  // get parent id when name is given//
  public function getGroupId($parent_name){
  
     
               $STM2 = $stmt=$this->connect->Prepare("SELECT * FROM tbl_parent_account WHERE PARENT_ACCOUNT_ID='$parent'  ");
               $result=$this->connect->Execute($STM2);
                 
                if($result->RecordCount() > 0){


                   $rtmt=$result->FetchNextObject();
                   return $rtmt->PARENT_ACCOUNT_ID;

               }
  }
  
  //retrive which report the account affect. eg p & l or
public function getAffect($account){
  //  $id=  $this->getParentId($parent_name);
   
             $STM2 =$this->connect->Prepare("SELECT * FROM tbl_accounts WHERE ACCOUNT_ID='$account'  ");
              $result=$this->connect->Execute($STM2);
                
                 if($result->RecordCount() > 0){


                   $rtmt=$result->FetchNextObject();
                   return $rtmt->AFFECTS;

               }
  }
  public function getTag($id){
  //  $id=  $this->getParentId($parent_name);
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_general_ledger_tag WHERE  ID='$id'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                     
                      
                      return $output['TAG'];
                      
                 }
  }
  //get total receipts
  
  public function getReceipts($account,$period,$periodFrom,$periodTo,$tag){
        
          $con=  Core::getInstance();
           
                if($periodFrom=="" &&$periodTo=="" && $tag==""){
                 
                     $end="";
                } 
                elseif(!empty($periodFrom) && !empty($periodTo) && !empty ($tag)){
                     $end=" AND ledger.PERIOD  BETWEEN '$periodFrom'  AND  '$periodTo' AND TAG='$tag' ";
                }
                elseif(empty($periodFrom) && empty($periodTo) && !empty ($tag)){
                     $end="  AND TAG='$tag' ";
                }
                else{
                     $end="AND ledger.PERIOD  <= '$period'";
                }
             
       print_r(   $query=$con->dbh->query("SELECT SUM(DEBIT) AS debit, SUM(CREDIT) as credit FROM tbl_general_ledger_transactions  AS ledger JOIN tbl_accounts AS account ON ledger.ACCOUNT=account.ACCOUNT_ID WHERE account.PARENT_ACCOUNT='13' AND ledger.ACCOUNT='$account' $end" ));
         
          $STMrecords = $query->fetchAll();
           foreach($STMrecords as $row)
               {
                         
                        
                       $difference= abs( $row['debit'] - $row['credit']); 
                  return $sum + $difference=$difference;
                   
                
                 
               }
          
      
  }
  // get account name in general ledger
  public function getAccount($ledger_id){
     
     $STM2 = $this->connect->Prepare("SELECT * FROM tbl_accounts AS account JOIN tbl_general_ledger AS ledger ON account.ACCOUNT_ID=ledger.ACCOUNT_ID WHERE ledger.ACCOUNT_ID='$ledger_id' ORDER BY account.ACCOUNT_NAME ASC  ");
            $result=$this->connect->Execute($STM2);
            $rtmt=$result->FetchNextObject();
                 
                 return  $rtmt->ACCOUNT_NAME;
  }
  // get account id based on account/ledger name
  public function getAccount_key($ledger_name){
     
     $STM2 = $this->connect->Prepare("SELECT * FROM tbl_accounts WHERE ACCOUNT_NAME='$ledger_name'    ");
            $result=$this->connect->Execute($STM2);
            $rtmt=$result->FetchNextObject();
                 
                 return  $rtmt->ACCOUNT_ID;
  }
  
  
  
  
  
  
  //get ledger number
  public function getLedgerNo($account){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_general_ledger  WHERE ACCOUNT_ID='$account'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $GENERAL_LEDGER_MEMO;
                      
                 }
  }
  //get general ledger name from account id
   
  public function getLedgerName($account){
     
             $STM2 = $this->connect->Prepare("SELECT * FROM tbl_general_ledger  WHERE ACCOUNT_ID='$account'  ");
             $result=$this->connect->Execute($STM2);
             $rtmt=$result->FetchNextObject();
            return  $this->getAccount($rtmt->ACCOUNT_ID);
                 
  }
   public function ExistPurchaseAccount(){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts  WHERE ACCOUNT_NAME LIKE '%Creditor%' OR PARENT_ACCOUNT LIKE '%19%' OR PARENT_ACCOUNT LIKE '%8%'  ");
             $result = $STM2->fetchAll();
                if(empty($result)){
                    
                    return 0;
                }else{
                    return 1;
                }
  }
   public function ExistVendorAccount(){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts  WHERE ACCOUNT_NAME LIKE '%Supplier%' OR PARENT_ACCOUNT LIKE '%19%' OR ACCOUNT_NAME LIKE'%Account Payable%' OR PARENT_ACCOUNT LIKE '%8%'  ");
             $result = $STM2->fetchAll();
                if(empty($result)){
                    
                    return 0;
                }else{
                    return 1;
                }
  }
   public function getPurchaseAccount(){
       
     $con=  Core::getInstance();
     if($this->ExistPurchaseAccount()==1){
     $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts  WHERE ACCOUNT_NAME LIKE '%Purchase%'  ");
             $result = $STM2->fetchAll();
                 foreach ($result as $output)
                {
                    extract($output);
                      
                      return $ACCOUNT_ID;
                      
                 }
     }
  }
  
  public function getAccountType($account){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_parent_account  WHERE PARENT_ACCOUNT_ID='$account'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                    extract($output);
                      
                      return $TYPE;
                      
                 }
  }
  //get income and expenditure balance
  public function getIncomeAndExpenditure_Balance($period){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT * FROM tbl_balances  WHERE PERIOD='$period'  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                     return $output;
                      
                        
                      
                 }
  }
  
  //GET INCOME TAX
  public function getIncomeTax(){
     $con=  Core::getInstance();
     $STM2 = $con->dbh->query("SELECT COMPANY_TAX_ID FROM tbl_company_info  ");
             $result = $STM2->fetchAll();
                foreach ($result as $output)
                {
                     return $output[COMPANY_TAX_ID];
                      
                        
                      
                 }
  }
 
  //posting at the end of the day
    public function toLedgers(){
          $con=  Core::getInstance();
         try{
              $con->dbh->beginTransaction();
              $STM4 = $con->dbh->query("INSERT INTO tbl_sales_ledger (DATE,ACCOUNT,MEMO,DEBIT,CREDIT)VALUE('$date','$acount','$memo','$amount','0.00')");
         }
       catch(Exception $message){
        $con->dbh->rollBack();
        $message->getMessage();

       }         
    }
    //get the account the fixed asset belong to. this will be call at delete time
    public function getMotherAccount($ID){
         $con=  Core::getInstance();
        $query=$con->dbh->query("SELECT FIXED_ASSET_ACCOUNT FROM tbl_fixed_assets_manager WHERE ID='$ID'" );
         
        $STMrecords = $query->fetchAll();
        foreach($STMrecords as $row)
               {
                        //extract row
                   //this will make $row['firstname'] to
                   //just $firstname only
                   extract($row);
                   return $FIXED_ASSET_ACCOUNT;
               }
      }
      // ask accountant which time should system balance of the accounts
      public function balanceBooks(){
          $con=  Core::getInstance();
          // check if time is 4:30pm and date is last day of month
          if(date('M j Y g:i A', strtotime('$period'))){
          try{
              $con->dbh->beginTransaction();
               $input=$con->prepare("SELECT SUM(DEBIT) AS debit, SUM(CREDIT) as credit FROM tbl_general_ledger_transactions WHERE MONTH(TRANS_DATE) = MONTH('$period')" );
             $input->execute();
             
             $result = $input->fetchAll();
                    foreach($result as $output)
                   { 
                        //if the balance is a debit balance
                      echo  $difference= $output['debit'] - $output['credit']; 
                        if($output['debit']>$output['credit']){
                             
                             $query = "INSERT INTO `tbl_general_ledger_transactions` ( `CHEQUE_NUMBER`, `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `DEBIT`, `CREDIT`, `TAG`, `ACTOR`) VALUES ('$source', '$cheque','$date','$period', '$ledger', 'Balance b/f', '$difference', '0.000', '', '')";

                             $stmt = $con->prepare( $query );

                             $stmt->execute();
                        }
                        //else then is a credit balance
                        else{
                            $difference= $output['debit'] - $output['credit']; 
                             $query = "INSERT INTO `tbl_general_ledger_transactions` ( `CHEQUE_NUMBER`, `TRANS_DATE`, `PERIOD`, `ACCOUNT`, `NARRATIVE`, `DEBIT`, `CREDIT`, `TAG`, `ACTOR`) VALUES ('$source', '$cheque','$date','$period', '$ledger', 'Balance b/f', '0.000', '$difference', '', '')";

                             $stmt = $con->prepare( $query );

                             $stmt->execute();
                        }
                      
                   }
              
                 }
              catch(Exception $message){
                $con->dbh->rollBack();
                $message->getMessage();

             }        
          }
      }

      public function getLedgerBalance($account,$periodFrom,$periodTo,$tag){
           
          
          // this is for trial balance purposes where we need only balances for a specific time range
          if ($tag=='') {
                $end="WHERE  ACCOUNT='$account' AND TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo'   ";
               }
                
                else {
                     $end="WHERE ACCOUNT='$account' AND TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo' AND TAG='$tag'  ";
                  
             }
               
          $query=$this->connect->Prepare("SELECT SUM(DEBIT) AS debit, SUM(CREDIT) as credit FROM tbl_general_ledger_transactions $end" );
          $result=$this->connect->Execute($query);
        $rtmt=$result->FetchNextObject();
                        
                    return   $difference=abs( ($rtmt->DEBIT) - ($rtmt->CREDIT)); 
            
         }
      
      //get the type of balance on an account.
      public function getBalanceType($account,$periodFrom,$periodTo,$tag){
         
          
          if ($tag=='') {
                $end="WHERE  ACCOUNT='$account' AND TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo'   ";
               }
                
                else {
                     $end="WHERE ACCOUNT='$account' AND TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo' AND TAG='$tag'  ";
                  
             }
              
          $query=$this->connect->Prepare("SELECT ACCOUNT,SUM(DEBIT) AS debit, SUM(CREDIT) as credit FROM tbl_general_ledger_transactions $end" );
         $stmt=$this->connect->Execute($query);
          $row =$stmt->FetchNextObject();
                 
                    if($row->DEBIT > $row->CREDIT){
                         return $balance="Debit";
                     } 
                elseif($row->CREDIT>$row->DEBIT){
                         return $balance="Credit";
                     } 
                 
          
      }
//get total debit  all accounts
       public function getTotalDebit($periodFrom,$periodTo){
           
            
           $end="WHERE   TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo'   ";
              
           
          $query=$this->connect->Prepare("SELECT SUM(DEBIT) AS debit  FROM tbl_general_ledger_transactions $end" );
          $stmt=$this->connect->Execute($query);
          $row =$stmt->FetchNextObject();
            
                         
                        if($row->DEBIT==$row->CREDIT){
                            return $difference=0;
                        }
                        else{
                      return  $difference = abs($row->DEBIT ); 
                    
                        }
                 
               
          
      }
      
    //get total debit  all accounts
       public function getTotalCredit($periodFrom,$periodTo){
          
            
           $end="WHERE  TRANS_DATE  BETWEEN '$periodFrom'  AND  '$periodTo'   ";
             
          $query=$this->connect->Prepare("SELECT SUM(CREDIT) AS credit  FROM tbl_general_ledger_transactions $end" );
          $stmt=$this->connect->Execute($query);
          $row =$stmt->FetchNextObject();
            
                         if($row->DEBIT==$row->CREDIT){
                            return $difference=0;
                        }
                        else{
                        
                            return    $difference = abs($row->CREDIT ); 
                    
                         }
                 
                
          
      }
      public function getIncomeAndExpenditure($report,$start,$end,$amount,$period){
            
            $query=$this->connect->Prepare("SELECT * FROM tbl_balances WHERE PERIOD='$period'");
                 $result=$this->connect->Execute($query);
                if($result->RecordCount()=='0'){
                  $insert=$this->connect->Prepare(" INSERT INTO tbl_balances (REPORT,START,END,PERIOD,AMOUNT)VALUES('$report','$start','$end','$period','$amount')");
                  return $this->connect->Execute($insert);
                }else{
                 return   $insert=$this->connect->Prepare(" UPDATE tbl_balances SET REPORT='$report',START='$start',END='$end',PERIOD='$period',AMOUNT='$amount' WHERE PERIOD='$period'");
                     return $this->connect->Execute($insert);
                } 
      }

      //get balance for the period
      public function getLedgerBalancePeriod($account,$period ){
          
            $newcode=$account;
        
            
                
                 
                     $end="WHERE ACCOUNT='$newcode' AND PERIOD  <= '$period'   ";
                  
             
             
           $query=$this->connect->Prepare("SELECT SUM(DEBIT) AS debit, SUM(CREDIT) as credit FROM tbl_general_ledger_transactions $end" );
           $result=$this->connect->Execute($query);
           
               if($result->RecordCount() > 0){


                   $rtmt=$result->FetchNextObject();
                   
                   return abs(($rtmt->DEBIT) - ($rtmt->CREDIT));

               }
          
      }
}
 
 $ledger=new Ledger();
  