<?php
session_start();
$newip=$_SERVER['REMOTE_ADDR']; // check if ip has changed .. let him login again
if(!isset($_SESSION[USERNAME]) || $newip!=$_SESSION["IP"]){
    header("location:index.php?salt=empty&&auth=null");
}
