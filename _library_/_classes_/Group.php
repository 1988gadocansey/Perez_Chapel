<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Group
 *
 * @author Senior Software Eng
 */
namespace _classes_;
class Group {
     private $connect;
    public function __construct() {
        global $sql;
        $this->connect=$sql;
    }
     public function getGroupCategory($group) {
          
       
        $STM2 = $this->connect->Prepare("SELECT NAME FROM perez_group_category WHERE ID='$group' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        $stmt=$row->FetchNextObject();
        return $stmt->NAME;
        }
    }
     public function getLocation($id) {
          
       
        $STM2 = $this->connect->Prepare("SELECT NAME,LOCATION FROM perez_branches  WHERE ID='$id' ");
        $row= $this->connect->Execute($STM2);
        if($row){
        $stmt=$row->FetchNextObject();
        return $stmt->NAME."-".$stmt->LOCATION;
        }
    }
}
