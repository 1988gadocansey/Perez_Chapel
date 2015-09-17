<?php
  global $sql;
    $sql = ADONewConnection($config->dbtype); 
    $sql->debug = $config->debug;
	$sql->autoRollback = $config->autoRollback;
       // $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
    $sql->Connect($config->server, $config->user, $config->password, $config->database); 

     
  
?>