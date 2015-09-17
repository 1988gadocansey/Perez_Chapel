<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Messages
 *
 * @author Gad Ocansey
 */
namespace classes;
class Messages {
    public $sql;
    //put your code here
    function  __construct() {
        global $sql,$session;
        $this->session= $session;
        $this->sql = $sql;
    }

   
/* messages  by ID of users
 * Note here that SESSION of users
 * are picked automatically
 */
 
    public function getMessageBy( ){
 
       $query = "SELECT * FROM tbl_mails WHERE USER_ID=".$this->sql->Param('a')." AND READ_='0'";
   
    
        $stmt = $this->sql->Prepare($query);
        $stmt =$this->sql->Execute($stmt,array($_SESSION[ID]));
        $obj = $stmt->FetchNextObject();
        
         return $obj;
    }
      public function getSender($ID){
 
       $query = "SELECT USERNAME FROM tbl_account  WHERE ID=".$this->sql->Param('a')."  ";
   
    
        $stmt = $this->sql->Prepare($query);
        $stmt =$this->sql->Execute($stmt,array($ID));
        $obj = $stmt->FetchNextObject();
        
         return $obj->USERNAME;
    }

    

    
}
?>
