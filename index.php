<?php
/**
 * SRMS - Student Records Management System
 *
 * @package  public
 * @author   TPconnet group - Takoradi Polytechnic
 * @link http://www.tpconnect.com developers
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/
    
    require 'vendor/autoload.php';
    require '_ini_.php';
    require '_library_/_includes_/config.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let's turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight these users.
|
*/

$app = new _classes_\Boot();
$_fire_=new \_classes_\Login();
//$_realm_=new \_classes_\CI_Security();       
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can simply call the run method,
| which will execute the request and send the response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have whipped up for them.
|
*/
//$_realm_->csrf_verify();
$_fire_->displayMessage();
$app->run();
