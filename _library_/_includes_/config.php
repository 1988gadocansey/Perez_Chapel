<?php
namespace classes;
global $sql,$session,$config;
 
define( '_PHYLIO','INDEX');
define("JPATH_ROOT",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define( 'JPATH_CONFIGURATION', 	JPATH_ROOT );
 
 
define('START_YEAR','2015');

class JConfig {
	public $dbtype = 'mysqli';
	public $server = 'localhost';
	public $user = 'root';
	public $database = 'db_perez_chapel';
	public $password = "PRINT45dull";
	public $secret='perez_chapel';
	public $debug = false;
	public $autoRollback= true;
	public $ADODB_COUNTRECS = false;
	private static $_instance;
	 
	public function __construct(){
            session_start();
	}
	
	private function __clone(){}
	
	public static function getInstance(){
	if(!self::$_instance instanceof self){
	     self::$_instance = new self();
	 }
	    return self::$_instance;
	}

}


$config = JConfig::getInstance();

//included classes
 
include "Adodb/adodb.inc.php";
include "sql.php";
  
include_once('Adodb/adodb-pager.inc.php');
?>
