<?php
    /**
     *@desc this class handles all the client end log in details and methods
     *@author Gad Ocansey
     */
	 
namespace _classes_;
 
	class Login{
		private $session;
		private $redirect;
		private $hashkey;
		private $md5;
		private $remoteip;
		private $useragent;
		private $sessionid;
		private $result;
		private $connect;
		private $crypt;
                private $jconfig;
	        private $mac_addr;
                private $homepage;
                private $algorithm;
                private $key;
                private $config;
                private $mode;
                private $stream;
		public $sql;
                 

                public function __construct( ){
			global $sql ;
                         $a=new Session() ;
			$this->redirect ="index?login=error";
                        $this->homepage ="members?welcome=1";
			$this->hashkey	=$_SERVER['HTTP_HOST'];
			$this->md5=true;
			$this->remoteip = $_SERVER['REMOTE_ADDR'];
			$this->useragent = $_SERVER['HTTP_USER_AGENT'];
			$this->session	=$session;
			$this->connect = $sql;
			$this->mac_addr =  $this->getMac();
			 $this->sql = $sql;
                        $this->sessionid = $a->getSessionID();
			 $this->session	=$a;
                        $this->algorithm = MCRYPT_RIJNDAEL_256;	
                        $this->mode = MCRYPT_MODE_ECB;
                        $this->Mhash();
                        $this->stream = mcrypt_create_iv(mcrypt_get_iv_size($this->algorithm, $this->mode), MCRYPT_RAND);
                        $_SESSION[IP]=$_SERVER['REMOTE_ADDR'];
                       // echo $this->remoteip;
		}
                public function encodeString($url){
                        return(mcrypt_encrypt($this->algorithm, $this->key, $url, $this->mode, $this->stream));	
                }//End Function

                public function decodeString($url){
                        return (rtrim(mcrypt_decrypt($this->algorithm, $this->key, $url, $this->mode, $this->stream),"\0"));
                }//End Function

                public function Mhash(){
                        $this->key = sha1("RAC-1".$this->config->secret,TRUE);
                }//End Function

		 
		public function signin($USER_LOGIN_VAR,$USER_PASSW_VAR){
			
			  
			 $data->PIN;
			
			if($USER_LOGIN_VAR=="" || $USER_PASSW_VAR == ""){
				
				$this->logout("empty");			
			}
                        $_SESSION["name"]=$USER_LOGIN_VAR;
			$this->user=$_SESSION["name"];
			if($this->md5){
				$passwrd = md5($USER_PASSW_VAR);
				}else{
				$passwrd = $USER_PASSW_VAR;
			}
						
			$query = "SELECT * FROM perez_auth  WHERE USERNAME =".$this->sql->Param('a')." AND PASSWORD=".$this->sql->Param('b')." AND ACTIVE='1'";
			$stmt = $this->connect->Prepare($query);
			 $stmt = $this->connect->Execute($stmt,array($USER_LOGIN_VAR,$passwrd));
			  $this->connect->ErrorMsg();
			
			if($stmt){		

				if($stmt->RecordCount() > 0){
					
				 // check if if its the server that the app is runnin
                                   
                                
                                
				$userid=$stmt->FetchNextObject();
				$this->storeAuth($userid->ID, $userid->USERNAME);
                                $_SESSION['USERNAME']=$userid->USERNAME;
                                $_SESSION['level']=$userid->USER_TYPE;
                                 $_SESSION['ID']=$userid->ID;
                                 
                           if($this->remoteip=='127.0.0.1' || $userid->NET_ADD=='Any'){
				$this->setLog("Login",$this->session->get("USERNAME") ." has login into the system  ");
                                $this->session->set("USERNAME", $userid->USERNAME);
                                $date=  strtotime(NOW);
                                $stmt=$this->connect->Prepare("UPDATE perez_auth SET LAST_LOGIN='$date' WHERE ID='$_SESSION[ID]'");
                                $this->connect->Execute($stmt);
                                
                                if($_SESSION['level']=="administrator"){
				header('Location: main.php');
                                echo '<script>Window.location.href="' .'../main.php " </script>';
                                exit;
				
                                }
                                else{
                                   header('Location: main.php');
                                echo '<script>Window.location.href="' . '../main.php " </script>';
                                exit;
                                }
                                }	
				
                                elseif ($this->remoteip!=$userid->NET_ADD) {
                                    header( 'refresh: 2000; url=index?unauthorize_domain' );
                                }
				
			       }else{ 
			 
                                    	$this->logout("wrong");
					
				 
                                }
			}
			
		}//end
		
		 
		
	public function storeAuth($userid,$login)
	  {
		$this->session->set('pyuserid',$userid);
		$this->session->set('h20',$login);
		
		$this->session->set('random_seed_pay',md5(uniqid(microtime())));

		$hashkey = md5($this->hashkey . $login .$this->remoteip.$this->sessionid.$this->useragent);
		$this->session->set('login_hash_pay',$hashkey);
		$this->session->set("LAST_REQUEST_TIME",time());
	  }//end
	
		public function logout($msg="out")
                {
                    $this->setLog("Logout", $this->session->get("USERNAME") ." has logout   from the system  " );
				
                         
                        $this->session->del('ID');
                        $this->session->del('USERNAME');
                         
                        $_SESSION = array();
                        session_destroy();
                        $this->direct($msg);
                }//end
	
	 public function direct($direction=''){
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: no-store, no-cache, must-validate');
			header('Cache-Control: post-check=0, pre-check=0',FALSE);
			header('Pragma: no-cache');
			
			if($direction == 'empty'){
			header('Location: ' . $this->redirect.'&attempt_in=0');	
			}else if($direction == 'wrong'){
                            
			header('Location:index?login=error ' );	
			}else if($direction=="out"){
			header("Location:index?logout=1");	
			}else if ( $direction =='captchax'){
					header('Location: ' .$this->redirect.'&attempt_in=11');
					}else{
						header('Location: ' .$this->redirect);
						}
			exit;
			
		}
                public function confirmAuth(){
		
		  $login = $this->session->get("h20");
		  $hashkey = $this->session->get('login_hash_pay');

                    if(md5($this->hashkey . $login .$this->remoteip.$this->sessionid.$this->useragent) != $hashkey)
                    {
                            $this->logout();
                    }
		
                }//end
	public function getMac(){
		  $mac          = "";
		  $cmd_info     = "";
		  $mac_address  = "";

		  
		  ob_start();
		  system("ipconfig /all");
		  $cmd_info=ob_get_contents();
		  ob_clean();
		  $mac          = strpos($cmd_info, 'Physical');
		  $mac_address  = substr($cmd_info,($mac+36),17);//MAC Address
		  return $mac_address;

      }

	
      public function setLog($event,$activity){
                 $userid=$this->session->get("pyuserid");
                $stmt = $this->connect->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$userid."', '$event','$activity', '".$this->hashkey."','".$this->remoteip."','".$this->useragent."','".$this->mac_addr."','".$this->session->getSessionID()."')");
                $this->connect->Execute($stmt); 

       }
        public function pageVisted($user,$page=array()){
                    $page=basename($_SERVER[REQUEST_URL]); 
                    // this will be sent to db system log as pages visited
                  return  $this->session->set("page", $page);

       }
       public function displayMessage(){
         
         if(isset($_GET[login])=='error'){
              ?>

               <div class='alert-warning' style='margin-top:0%;font-weight:bolder;font-size:15px;color:red'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Warning!</strong> Invalid Username or Password
         </div>  
              <?php
             
         }
         elseif(isset($_GET[unauthorize_domain]) ){
              ?>
              <center><div class='alert alert-warning' style='color:red;margin-top:0%;font-weight:bolder;font-size:15px'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>Warning!</strong> You are not authorized on this device
         </div></center>
              
              <?php
             
         }
    }
		
    
    public function doLogin($username,$salt){
        /*
     * Password generator: class PASSWORD\Generator();
     * You can have a setted pass, and export the encoded value:
     * $a="MyPassword";
     * $password=new PASSWORD\Generator();
     * $encode_pass=$password->generateEncode($a); //this is the field to INSERT in tbl_users.user_password field
     *
     * OR
     *
     * $password=new PASSWORD\Generator();
     * $password->NewPassword(8); //number inside method is the length of password (default 8);
     * echo $password->Plain; is the user password
     * echo $password->DB_Encode; is the password to insert in tbl_users.user_password
     *
     * IMPORTANT!!!!!
     * If you change the dbase location, or the position of class.password.php, THE OLD PASSWORD doesn't work!
     * For security they use a phisical position of the file.
     *
     * In table tbl_ipblocked you have the IP that try wrong connection. After 10 try it's blocked.
     *
      * */
        //Verify IP from list.
         $stmt=$this->connect->Prepare('SELECT ip FROM tbl_ipblocked WHERE ip="'.$_SERVER['REMOTE_ADDR'].'" AND tryConnection >=10;');
         $stmt=$this->connect->Execute($stmt);
        if ($stmt->RecordCount()==1){
            //Ip blocked for many connection
            header('HTTP/1.0 403 Not Found');
            echo "<h1>Forbidden</h1>";
            echo "You don't have permission to access / on this server.";
            echo "<hr>";
            echo $_SERVER['REMOTE_ADDR'];
            exit;
        }
        
        /***************************/

      
        //we have a post setted for try login
        $tempDate=new \DateTime();

        $password=new PASSWORD\Generator();

        //generate encoded password with prevent injection
        $encode_pass=$password->generateEncode($salt);

        $stmt='SELECT id_user
                FROM tbl_users
                WHERE user_email="'.$username.'"
                AND SHA2(concat(user_password,DATE_FORMAT(NOW(),"%Y-%m-%d"),5),512)="'.hash('sha512',$encode_pass.date('Y-m-d').'5').'";';

        $mysql->Execute($Sql);
        if ($mysql->Rows==1){
            //set user verified!
            $userActive->loginVerifiedUser();
            $Sql='UPDATE tbl_ipblocked SET tryConnection=1 WHERE ip="'.$_SERVER['REMOTE_ADDR'].'";';
            $mysql->Execute($Sql);
        } else {
            //a new session
            $userActive->unSetUser();

            //block IP counter
            $Sql='SELECT tryConnection FROM tbl_ipblocked WHERE ip="'.$_SERVER['REMOTE_ADDR'].'";';
            $mysql->Execute($Sql);
            if ($mysql->Rows==1){
                $increment=$mysql->Result[0]['tryConnection'];
                $increment++;
                $Sql='UPDATE tbl_ipblocked SET tryConnection='.$increment.' WHERE ip="'.$_SERVER['REMOTE_ADDR'].'";';
                $mysql->Execute($Sql);
            } else {
                $Sql='INSERT tbl_ipblocked (ip) VALUES ("'.$_SERVER['REMOTE_ADDR'].'");';
                $mysql->Execute($Sql);
            }

        }
     


    if ($userActive->userIdentified()==1) {
        //USER NOT AUTORIZED TO SEE ADMIN PAGE
        header('location: index.php');//redirect
        exit;
    }

        
        
   
    }
       
      
        
        
        
        
    }

