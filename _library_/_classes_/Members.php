<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Members
 *
 * @author Senior Software Eng
 */
namespace _classes_;
class Members {
     private $connect;
    public function __construct() {
        global $sql;
        $this->connect=$sql;
    }
    public function getBranch($branch) {
          
       
        $STM2 = $this->connect->Prepare("SELECT NAME FROM perez_branches  WHERE ID='$branch' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        $stmt=$row->FetchNextObject();
        return $stmt->NAME;
        }
    }
    public function getMinistry($ministry) {
          
       
        $STM2 = $this->connect->Prepare("SELECT NAME FROM perez_ministries  WHERE ID='$ministry' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        $stmt=$row->FetchNextObject();
        return $stmt->NAME;
        }
    }
    public function getTotalMember_byGroup($group) {
          
       
        $STM2 = $this->connect->Prepare("SELECT COUNT(*) AS TOTAL FROM perez_members  WHERE GROUPS LIKE '%$group%' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        $stmt=$row->FetchNextObject();
        return $stmt->TOTAL;
        }
    }
}
