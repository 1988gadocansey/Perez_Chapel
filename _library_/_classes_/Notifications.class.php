<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace _classes_;

/**
 * Description of Notifications
 *
 * @author Administrator
 */
use classes\Core;
class Notifications {
    private $connect;
     public function __construct() {
           global $sql,$season;
           $this->connect=$sql;
		   
          
     }
    public function getIsOpen($year,$term){
         $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT STATUS FROM tbl_academic_constraints WHERE YEAR='$year' AND SEMESTER='$term' ");
        $result = $STM2->fetchAll();
         foreach ($result as $output)
                {
                    
                   if($output['STATUS']=='0'){

                       return 0;
                    }
                     else {
                        return 1;
                     }
                }
    }
    // bill paid by student
    public function billPaid($year,$term,$level,$student){
         $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT SUM(paid) AS PAID FROM feepayrecord WHERE stuId='$student' and year='$year'and term='$term' and level='$level'");
        $result = $STM2->fetchAll();
         foreach ($result as $output)
                {
                    
                    return $output["PAID"];
                }
    }
    
    // bill to be paid by student
    /**
     * 
     * @param type $year
     * @param type $term
     * @param type $level
     *  
     * @param type $student
     * @return type double
     */
    public function bill($year,$term,$level, $student=""){
         $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT distinct debit,oldbalance   FROM feepayrecord WHERE stuId='$student' and year='$year'and term='$term' and level='$level'");
        $result = $STM2->fetchAll();
         foreach ($result as $output)
                {
                    
                    return $output["debit"] + $output["oldbalance"];
                }
    }
    public function getyear()
    {
                 $query= $this->connect->Prepare("SELECT * FROM tpoly_year ORDER BY ID DESC");
            $output= $this->connect->Execute($query);
	 $a=$output->FetchNextObject();
     
         
    }
     public function getSemesterYear(){
            $con=  Core::getInstance();
         $query=$con->dbh->query("SELECT * FROM year");
         $output= $query->fetchAll();
         foreach ($output as $values){
             return $values;  
          }
            
        }
    public function canRegister($student,$level){
         $con=  Core::getInstance();
        $config=  $this->getSemesterYear();
        // total bill paid
       echo $total_paid=  $this->billPaid($config[year], $config[term], $level, $student);
        // total bill to be paid
      echo  $bill=  $this->bill($config[year], $config[term], $level, $student);
        
        // level of admission (loa)> 100 means top up 
        $STM2 = $con->dbh->query("SELECT loa,issues,level,register,outstanding,programme,nationality,feepayingstatus from students WHERE indexno='$student' AND level='$level'");
         $result = $STM2->fetchAll();
         foreach ($result as $output)
                {
                 if( ($output['issues']==0) && ($output['register']==1 || ((($total_paid==(75/100 * $bill))) && ($output['nationality']=="Ghanaian") && ($output['loa']==100)) )){
                        return 1;
                    }
                   elseif( ($output['nationality']=="Ghanaian" || $output['nationality']=="Ghana" || $output['nationality']=="") && ($output['level']==100 && $output['feepayingstatus']=="yes" && $output['programme']=="MBChB" && $output['issues']==0) && ($output['outstanding']<=2193.625 || $output['register']==1)){
                     return 1;
                    }
                     
                    else{
                        return 0;
                    }
                     
                }
      }
      
      public function canSeeResult($student){
         $con=  Core::getInstance();
        $STM2 = $con->dbh->query("SELECT result from students WHERE indexno='$student' ");
        $result = $STM2->fetchAll();
         foreach ($result as $output)
                {
                    
                   if($output['result']=='0'){

                                                            die( "<div class='alert alert-warning'>
                                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                                    <strong>Warning!</strong> RESULT HAS BEEN BLOCKED.PLEASE CONTACT REGISTRAR'S OFFICE
                                                             </div>");
                       
                    }
                }
      }
         //messaging function eg successful insertion,deletion,,,
     public function Message(){
         
         if(isset($_GET['success'])){
             echo "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Notification!</strong>   Action completed successfully.
         </div>";}
         elseif(isset($_GET['action'])=='opened'){
             echo "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Notification!</strong>   Semester openned successfully.
         </div>";}
         elseif(isset($_GET['no_internet'])){
             echo "<div class='alert alert-warning'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Notification!</strong>   Please check your internet connection.
         </div>";}
        else if(isset($_GET['action'])=='closed'){
             echo "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Notification!</strong>   Semester closed successfully.
         </div>";}
         
        else if(isset($_GET['error'])){
             echo "<div class='alert alert-warning'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Warning!</strong> Action failed.  Action couldn't complete well try again .
         </div>";}
    
         
         elseif(isset($_GET['notify'])){
             echo "<div class='alert alert-info'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Warning!</strong> Authentication failed <a href='#' class='alert-link'>No courses has been registered</a>.
         </div>";}
    }
}
