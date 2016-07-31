<?php

namespace _classes_;
class smsgetway{
	private $config;
         private $connect;
	private $url;
	
	function __construct(){
		/*global $config;
		$this->config=$config;
		$this->url =$this->config->smsurl."?username=".$this->config->smsusername."&password=".$this->config->smspassword;*/
	
            global $sql,$season;
           $this->connect=$sql;
          
        }
	
	/**
	 * 
	 * @param string $phone
	 * @param string $msg
	 */
	public function sendSms($phone,$msg){
		$url = $this->url."&msg=". urlencode($msg)."&to=". $phone ;
		
		// create curl resource
		$ch = curl_init();
		// set url
		curl_setopt($ch, CURLOPT_URL, $url);
		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string
		$output = curl_exec($ch);
		// close curl resource to free up system resources
		curl_close($ch);
		$output = substr($output, 3);
		return $output;
	}
	
	/**
	 * sends same message in bulk
	 * @param array $arrayphone
	 * @param string $msg
	 */
	public function sendBulkSms($arrayphone,$msg){
		$returns =array();
		if(is_array($arrayphone)){
			foreach ($arrayphone as $phone){
				$returns[] =$this->sendSms($phone, $msg);
			}
		}else{
			$returns[] =$this->sendSms($phone, $msg);	
		}
		
		return $returns;
		
	}//end
        
        // tpoly sms
        public function sendSMS1($phone,$message){
            $phone="+233".\substr($phone,1,9);
            $phone = str_replace(' ', '', $phone);
                 $phone = str_replace('-', '', $phone);
                 if (!empty($message) && !empty($phone)) {
            $key = "83f76e13c92d33e27895"; //your unique API key;
            //$message=urlencode($message); //encode url;
        $sender_id="PerezChapel";

        $url = "https://apps.mnotify.net/smsapi?key=$key&to=$phone&msg=$message&sender_id=$sender_id";
        //print_r($url);
        $result = file_get_contents($url); //call url and store result;

        if ($result = 1000) {


            $result = "Message  sent. ";
        } else {
            $result = "Message not sent";
        }
        if($result=1000){ 
                   $info="Message was successfully sent"; 
                   $date=time();
                    $insertor=$this->connect->Prepare("insert into perez_sms_sent set number='$phone',type='$type',name='$_SESSION[ID]',message='$message',dates='$date',status='Delivered'");
                    $this->connect->Execute($insertor) ;
	
                  return $info;
                    }else{ 
                        $date=time();
                        $insertor=$this->connect->Prepare("insert into perez_sms_sent set number='$phone',type='$type',name='$_SESSION[ID]',message='$message',dates='$date',status='Not Delivered'");
                        $this->connect->Execute($insertor) ;

                    $info="Message failed to send. Error: " . $data->error; 
                    return $info;
                    } 
                     
                 }
                  
                 }
                 
                 // bulk sms form tpoly
                 public function sendBulkSMS1($arrayphone,$msg){
		$returns =array();
		if(is_array($arrayphone)){
			foreach ($arrayphone as $phone){
				$returns[] =$this->sendSMS1($phone, $msg);
			}
		}else{
			$returns[] =$this->sendSMS1($phone, $msg);	
		}
		
		return $returns;
		
	}
}
?>