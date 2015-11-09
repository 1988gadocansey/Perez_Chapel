<?php
require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
         
        include('parsecsv.lib.php');
         
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
      
        $sms=new _classes_\smsgetway();
        $sms->sendSMS1("0505284060", "perez is meeting today");
?>