<?php
/*
* Filename.......: vcard.php
* Author.........: Troy Wolf [troy@troywolf.com]
* Last Modified..: 2005/07/14 13:30:00
* Description....: Generate a vCard from form data.
*/

require_once('../class_vcard/class_vcard.php');

$vc = new vcard();

/*
The secret here is to name your form fields exactly the same as the vCard
data key names in the class.
*/
foreach ($_POST as $key=>$val) {
  $vc->data[$key] = $val;
}

$vc->download();

//export content from form to vcard directly
// or use bellow
 
/*
* Filename.......: vcard_example.php
* Author.........: Troy Wolf [troy@troywolf.com]
* Last Modified..: 2005/07/14 13:30:00
* Description....: An example of using Troy Wolf's class_vcard.
*/

/*
Modify the path according to your system.
*/
require_once('../class_vcard/class_vcard.php');

/*
Instantiate a new vcard object.
*/
$vc = new vcard();

/*
filename is the name of the .vcf file that will be sent to the user if you
call the download() method. If you leave this blank, the class will 
automatically build a filename using the contact's data.
*/
#$vc->filename = "";

/*
If you leave this blank, the current timestamp will be used.
*/
#$vc->revision_date = "";

/*
Possible values are PUBLIC, PRIVATE, and CONFIDENTIAL. If you leave class
blank, it will default to PUBLIC.
*/
#$vc->class = "PUBLIC";

/*
 * export database to vcard directly
Contact's name data.
If you leave display_name blank, it will be built using the first and last name.
*/
#$vc->data['display_name'] = "";
$vc->data['first_name'] = "Troy";
$vc->data['last_name'] = "Wolf";
#$vc->data['additional_name'] = ""; //Middle name
#$vc->data['name_prefix'] = "";  //Mr. Mrs. Dr.
#$vc->data['name_su
?>