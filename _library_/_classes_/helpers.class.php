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
        public function getAssetLocation($location){

            $query= $this->connect->Prepare("SELECT * FROM `perez_departments`  WHERE ID='$location'");
            $output= $this->connect->Execute($query);
            $a=$output->FetchNextObject();
            return $a->NAME;
      
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
        public function getCircuitName($circuit){

            $query= $this->connect->Prepare("SELECT * FROM perez_circuits WHERE ID='$circuit'");
            $output= $this->connect->Execute($query);
                 $a=$output->FetchNextObject();
            return $a->NAME;
      
        }
        public function getDepartmentName($depart_id){

            $query= $this->connect->Prepare("SELECT NAME FROM perez_departments WHERE ID='$depart_id'");
            $output= $this->connect->Execute($query);
            if($output->RecordCount()>0){
                 $a=$output->FetchNextObject();
            return $a->NAME;
            
            }else{
                return "No parent department";
            }
      
        }
        // check if todelete has data if not delete else restrain from
        // deleting
         public function confirmDelete($table,$column,$data,$operator){
             if($operator!='='){
                  $query= $this->connect->Prepare("SELECT * FROM $table WHERE $column LIKE '%$data%'");
           
             }
             else{
            $query= $this->connect->Prepare("SELECT * FROM $table WHERE $column $operator '$data'");
             }
            $output= $this->connect->Execute($query);
                 
            return $output->RecordCount();
      
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

////////BACKUP RESTORE/////////
    function create_backup() {
        if (!isset($RootPath)){
		$RootPath = dirname(htmlspecialchars($_SERVER['PHP_SELF']));
		if ($RootPath == '/' OR $RootPath == "\\") {
			$RootPath = '';
		}
	}
        $db="db_perez_chapel";
        $folder="backup";
        $DBPassword="";
        $DBUser="root";
        $host="localhost";
        $BackupFile =   $folder.'/' . $db  .'/' . _('Backup') . '_' . Date('Y-m-d-H-i-s') . '.sql.gz';
	$Command = 'mysqldump --opt -h' . $host . ' -u' . $DBUser . ' -p' . $DBPassword  . '  ' . $db . '| gzip > ' .
	$_SERVER['DOCUMENT_ROOT'] . $BackupFile;


	$CommandOutput = array();
	exec($Command,$CommandOutput, $ReturnValue);

	if ($ReturnValue ==0) {
		print_r('The backup file has now been created. You must now download this to your computer because in case the web-server has a disk failure the backup would then not on the same machine. Use the link below'. '<br /><br /><a href="' . $BackupFile  . '">' .'Download the backup file to your locale machine' . '</a>','success');
		print_r('Once you have downloaded the database backup file to your local machine you should use the link below to delete it - backup files can consume a lot of space on your hosting account and will accumulate if not deleted - they also contain sensitive information which would otherwise be available for others to download!,info');
		echo '<br />
			<br />
			<a href="'. htmlspecialchars($_SERVER['PHP_SELF'],ENT_QUOTES,'UTF-8') . '?BackupFile=' .$BackupFile  .'">' .'Delete the backup file off the server' . '</a>';
	} else {
		print_r('There was some problem producing a backup using mysqldump. Normally this relates to a permissions issue - the web-server user must have permission to write to the companies directory error');
	}
  }
    

    

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

