<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of skeleton
 * @package classes
 * @access public
 * @author Administrator
 */
 
namespace _classes_;
class skeleton {
    public function __construct() {
        
    }
    public function getTitle(){
        return "Students Information System | Takoradi Polytechnic";
    }
    public function getHeaderTitle(){
        echo " Tpoly Admissions";
    }
    public function footer(){
        $right= "&copy Copyright ".date('Y')." Takoradi Polytechnic | TPCONNECT TEAM";
        return $right;
    }
}
