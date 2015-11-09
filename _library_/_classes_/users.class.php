<?php
namespace _classes_;
 
class Users {
    private $connect;
     public function __construct() {
         global $sql,$season;
          
         $this->connect=$sql;
     }
     // returns array of details about users
     public function  userDetails( ){
         $query = "SELECT * FROM perez_auth  WHERE ID =".$this->connect->Param('a')." ";
			$stmt = $this->connect->Prepare($query);
			 $stmt = $this->connect->Execute($stmt,array($_SESSION["ID"]));
			  print $this->connect->ErrorMsg();
			
			if($stmt){		

				if($stmt->RecordCount() > 0){
					
				 
                                    return  $stmt->FetchNextObject();
				 
                                }
                        }
                         
     }
     // return info about particular user
      public function  user($id){
         $query = "SELECT * FROM perez_auth  WHERE ID =".$this->connect->Param('a')." ";
			$stmt = $this->connect->Prepare($query);
			 $stmt = $this->connect->Execute($stmt,array($id));
			  print $this->connect->ErrorMsg();
			
			if($stmt){		

				if($stmt->RecordCount() > 0){
					
				 
                                    return  $stmt->FetchNextObject();
				 
                                }
                        }
                         
     }
     
          
}
