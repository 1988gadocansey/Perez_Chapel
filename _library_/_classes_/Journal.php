<?php
 
/**
 * Handling every journal level transaction
 *  17/09/2014
 * @author Gad Ocansey
 */
 
include_once ('core_database.php');
 
$actor=$_SESSION['ID'];
  
 
 
class Journal {
    //put your code here
    public function __construct() {
         date_default_timezone_set('GMT');
    }
    //get total gross total  on purchase journal
       public function getPurchaseJournalGross($periodFrom,$periodTo,$supplier,$term){
          $con=  Core::getInstance();
          
            
          if($term==''){

                 $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom' AND  '$periodTo' AND SUPPLIER='$supplier' ";

                  
                }
                elseif($supplier==''){

                 $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' AND PAYMENT_TERM='$term' ";
 
                }
              elseif(!empty($supplier) && !empty($term) ){

                 
                  $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' AND SUPPLIER='$supplier' AND PAYMENT_TERM='$term' ";
                 
                }
                
                $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' ";
                
                $query=$con->dbh->query("SELECT SUM(GROSS) AS total  FROM tbl_purchase_register $end" );

                $STMrecords = $query->fetchAll();
                 foreach($STMrecords as $row)
                     {

                               return abs($row['total']);

                     }
          
          
      }
      
      // get net total on purchase journal
       //get total gross total  on purchase journal
       public function getPurchaseJournalTotal($periodFrom,$periodTo,$supplier,$term){
              $con=  Core::getInstance();
              if($term==''){

                 $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' AND SUPPLIER='$supplier' ";

                
                }
                elseif($supplier==''){

                 $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' AND PAYMENT_TERM='$term' ";

                 
                }
                elseif(!empty($supplier) && !empty($term) ){

                 
                  $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' AND SUPPLIER='$supplier' AND PAYMENT_TERM='$term' ";
                 
                }
                
                $end="WHERE   DATE_CREATED  BETWEEN '$periodFrom'  AND  '$periodTo' ";

                
                $query=$con->dbh->query("SELECT SUM(AMOUNT) AS total  FROM tbl_purchase_register $end" );

                $STMrecords = $query->fetchAll();
                 foreach($STMrecords as $row)
                     {

                               return abs($row['total']);

                     }
          }
          
          public function getAccountAutocomplete($code) {
            $id= explode('-', $code);
            $newcode=$id[0];
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts WHERE   ACCOUNT_CODE='$newcode' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    extract($output);
                      
                      return  $ACCOUNT_ID;
                      
                 }
         }
          public function getCashbookAutocomplete($code) {
            $id= explode('-', $code);
            $newcode=$id[0];
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_accounts WHERE   ACCOUNT_NAME='$newcode' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    extract($output);
                      
                      return  $ACCOUNT_ID;
                      
                 }
         }
         
         public function getDiscountAutocomplete($code) {
            $id= explode('-', $code);
            $newcode=$id[0];
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_discount WHERE   NARATION='$newcode' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    extract($output);
                      
                      return  $ID;
                      
                 }
         }
         public function getTypeAutocomplete($code) {
             
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_transaction_type WHERE   typename='$code' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    extract($output);
                      
                      return  $typeid;
                      
                 }
         }
         public function getTransactionType($code) {
             
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_transaction_type WHERE   typename='$code' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    extract($output);
                      
                      return  $typename;
                      
                 }
         }
         public function getApproval() {  
            $con=  Core::getInstance();
            $STM2 = $con->dbh->query("SELECT * FROM tbl_payment_voucher WHERE  STATUS='0' ");
            $result = $STM2->fetchAll();
             foreach ($result as $output)
                {
                    if(!empty($output)){
                      $statement="There are vouchers awaiting approval aready.please check up on them before creating new one.Thanks";
                      $reponse="<div class='alert alert-dismissable alert-danger'>
                                <strong>Invalid amount!</strong>   $statement 
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                </div>";
                      return $reponse ;
                     }
                     else{
                         return 1;
                     }
                 }
         }
          
         public function getVoucherTotal($actor,$code){
              $con=  Core::getInstance();
      $query=$con->dbh->query("SELECT SUM(AMOUNT) AS total  FROM tbl_payment_voucher WHERE ACTOR='$actor'AND CODE='$code' AND SUBMITED='1' " );

                $STMrecords = $query->fetchAll();
                 foreach($STMrecords as $row)
                     {

                               return abs($row['total']);

                     }
         }
          
          public function getPVDetails($actor,$code){
              $con=  Core::getInstance();
      $query=$con->dbh->query("SELECT *  FROM tbl_payment_voucher WHERE ACTOR='$actor'AND CODE='$code' AND SUBMITED='1' " );

                $STMrecords = $query->fetchAll();
                 foreach($STMrecords as $row)
                     {

                               return   $row;

                     }
         }
         
      

}   

$journal=new  Journal();
   $a= $journal->getPVDetails('1', 'PV6000');
//echo $a[2];

 