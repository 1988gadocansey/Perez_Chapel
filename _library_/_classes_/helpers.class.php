<?php
/**
 * Description of helpers
 * 
 * @author Administrator
 */
namespace _classes_;
 
class helpers {
	private $connect;
     public function __construct() {
           global $sql,$season;
           $this->connect=$sql;
		   
          
     }
     public function getMemo(){
    $query=$this->connect->Prepare("SELECT NO FROM perez_trans_code");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return $data->NO;
}
public function UpdateMemo(){
    $query=$this->connect->Prepare("UPDATE perez_trans_code SET NO=NO + 1");
     return $this->connect->Execute($query);
    
}
   public  function nextyear($currenyear){
        $pp=explode("/",$currenyear);
        //echo $pp[0];

        return $pp[1]."/".($pp[1]+1);
        }
      public function buildall($data){
	 
	
	$all=explode(',',$data);
          foreach($all as $dd){
                  $dd=trim($dd);


          }
	  
          return $dd;
	}
	public function getLocation($location){

            $query= $this->connect->Prepare("SELECT * FROM perez_branches WHERE ID='$location'");
            $output= $this->connect->Execute($query);
                 $a=$output->FetchNextObject();
            return $a->NAME." / ".$a->LOCATION;
      
        }
        public function getNotes($person){

            $query= $this->connect->Prepare("SELECT * FROM perez_notes WHERE PERSON='$person'");
            $output= $this->connect->Execute($query);
                 $a=$output->FetchNextObject();
            return $a;
      
        }
        public function getCategory($category_id){

            $query= $this->connect->Prepare("SELECT * FROM perez_member_category WHERE ID='$category_id'");
            $output= $this->connect->Execute($query);
                 $a=$output->FetchNextObject();
            return $a->CATEGORY;
      
        }
	   
    public function age($birthdate, $pattern = 'eu')
        {
            $patterns = array(
                'eu'    => 'd/m/Y',
                'mysql' => 'Y-m-d',
                'us'    => 'm/d/Y',
                'gh'    => 'd-m-Y',
            );

            $now      = new \DateTime();
            $in       = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
            $interval = $now->diff($in);
            return $interval->y;
        }
       public function picture($path,$target){
                if(file_exists($path)){
                        $mypic = getimagesize($path);

                 $width=$mypic[0];
                        $height=$mypic[1];

                if ($width > $height) {
                $percentage = ($target / $width);
                } else {
                $percentage = ($target / $height);
                }

                //gets the new value and applies the percentage, then rounds the value
                 $width = round($width * $percentage);
                $height = round($height * $percentage);

               return "width=\"$width\" height=\"$height\"";



            }else{}
        
       
        }
        
        
	public function pictureid($stuid){
	 
	 return str_replace('/','',$stuid);
	 }
 
public function yearsDifference($endDate, $beginDate)
{
   $date_parts1=explode("-", $beginDate);
   $date_parts2=explode("-", $endDate);
   return $date_parts2[0] - $date_parts1[0];
}

// send sms
public  function sendtxt($message,$phone,$type,$name) 
{ 

global $sql;
set_time_limit  (500);
if(is_numeric($phone) and $message){

if($_SESSION['connected']>=0 and $_SESSION['connected']!='down') 
{ 
$themassage=urlencode($message);
$url="http://powertxtgh.com/access.php?company=ALOT&ccode=ALT101&sender=Gad&message=$themassage&recipient=$phone";

$f=@fopen($url,"r"); 

$date=time();
	 $insertor=$this->connect->Prepare("insert into sent set number='$phone',type='$type',name='$name',message='$message',dates='$date',status='Delivered'");
	 $insertor->Execute($insertor) ;
	
fclose($f); 
return true; 
} else{
		$date=time();

	 $insertor=$this->connect->Prepare("insert into sent set number='$phone',type='$type',name='$name',message='$message',dates='$date',status='Not Delivered'");
	 $insertor->Execute($insertor) ;
	
return false; }
}} 

public function ping($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = @fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return "down"; } 
  $tA = microtime(true); 
  return round((($tA - $tB) * 1000), 0)." ms"; 
}


public function getSession($preference){
    $query=  $this->connect->Prepare("SELECT * FROM tbl_session WHERE ID='$preference'");
    $output= $this->connect->Execute($query);
   $output->FetchNextObject();
    return $a->name;
}
public function getName($student){
    $query=  $this->connect->Prepare("SELECT NAME FROM tpoly_students WHERE INDEXNO='$student'");
    $output= $this->connect->Execute($query);
    $a=$output->FetchNextObject();
    return $a->NAME;
}
// get config file
public function getConfig(){
    $query=$this->connect->Prepare("SELECT * FROM perez_config");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return  $data;
}
public function getindexno(){
    $query=$this->connect->Prepare("SELECT no FROM perez_code_gen");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return $data->NO;
}

public function UpdateIndexno(){
    $query=$this->connect->Prepare("UPDATE perez_code_gen SET no=no + 1");
     return $this->connect->Execute($query);
    
}
public function getGroupCode(){
    $query=$this->connect->Prepare("SELECT GROUPS FROM perez_codes");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return $data->GROUPS;
}
public function UpdateGroupCode(){
    $query=$this->connect->Prepare("UPDATE perez_codes SET GROUPS=GROUPS + 1");
     return $this->connect->Execute($query);
    
}
public function getServiceType(){
    $query=$this->connect->Prepare("SELECT SERVICETYPE FROM perez_codes");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return $data->SERVICETYPE;
}
public function UpdateServiceType(){
    $query=$this->connect->Prepare("UPDATE perez_codes SET SERVICETYPE=SERVICETYPE + 1");
     return $this->connect->Execute($query);
    
}
public function UpdateServiceCode(){
    $query=$this->connect->Prepare("UPDATE perez_codes SET SERVICE=SERVICE + 1");
     return $this->connect->Execute($query);
    
}
public function UpdateCode($item){
    $query=$this->connect->Prepare("UPDATE perez_codes SET $item=$item + 1");
     return $this->connect->Execute($query);
    
}
public function getCode($item){
    $query=$this->connect->Prepare("SELECT    $item FROM perez_codes");
    $query2=$this->connect->Execute($query);
    $data=$query2->FetchNextObject();
    return $data->$item;
    
}
 
 public function password() {
        $alphabet = "ABCDEFGHJKMNPQRSTUWXYZ23456789";
        
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
     
         
     
     /**
      * @param sync $name CURL libray
      * @access public
      */
     public function sync_to_online($url,$data){
                $ch = \curl_init();
               \curl_setopt($ch, CURLOPT_URL,$url);
               \curl_setopt($ch, CURLOPT_POST,1);
               \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $result=\curl_exec($ch);
 
		\curl_close ($ch);
                return $result;
 
     }
     public function autopassword($len = 8){
    	return substr(md5(rand().rand()), 0, $len);
    }//end

/**
** required when the applicant finish working on form
** send sms and email to applicant upon receiving his or her form
*/
     
public function finalize($applicant){
	
	
	}
public function copyright(){
    return "&copy ".date("Y")." | Takoradi Polytechnic - All rights reserved";
}

}

