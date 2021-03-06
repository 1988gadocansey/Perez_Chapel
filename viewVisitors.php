<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        $crypt=new _classes_\cryptCls();
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $sms=new _classes_\smsgetway();
         $config_file=$help->getConfig() ;
         if($_GET[branch]){
        $_SESSION[branch]=$_GET[branch];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
        }
        if($_GET['languages']){
         $_SESSION['languages']=$_GET['languages'];
        }
        if($_GET[ministry]){
        $_SESSION[ministry]=$_GET[ministry];
        }
        if($_GET[deceased]){
        $_SESSION[deceased]=$_GET[deceased];
        }
        if($_GET[category]){
        $_SESSION[category]=$_GET[category];
        }
        if($_GET[team]){
        $_SESSION[team]=$_GET[team];
        }
        if($_GET[department]){
        $_SESSION[department]=$_GET[department];
        }
        if($_GET[demo]){
        $_SESSION[demo]=$_GET[demo];
        }
        if($_GET[ethnic]){
        $_SESSION[ethnic]=$_GET[ethnic];
        }
         if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_members WHERE MEMBER_CODE='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:members?success=1");
            }
        }
  /////////////////////////////////////////////////////////////////////////////
        // upload csv
        if(isset($_POST[go])){
     
              	//check if file path is empty
            $extension= end(explode(".", basename($_FILES['file']['name'])));
             if($extension== 'csv'){

            
                    if (!$_FILES["file"]["name"]) {
                        echo " <font color='red' style='text-decoration:blink'>Please choose a file to upload</font>";
                        $error = 1;
                    }

                    elseif (($_FILES["file"]["size"] ) > 25000000) {
                        echo "Only pictures of size less than 250 kb accepted";
                        $error = 3;
                    }

                    $name = $_FILES["file"]["name"];
                    //$var= $name.$_SESSION[area];

                    if ($error > 0) {

                    } else {

                        $destination = "uploads/$name";
                        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
                        if (move_uploaded_file) {

                            # create new parseCSV object.
                            $csv = new parseCSV();
                          # Parse '_books.csv' using automatic delimiter detection...
                            $csv->auto($destination);


                            //print_r($csv->data);

                            foreach ($csv->data as $key => $row) { 

                               // print_r( $row);


                                    $query=$sql->Prepare("INSERT INTO  `perez_members` SET   `MEMBER_CODE`='$row[MEMBER_CODE]', `BARCODE`='$row[BARCODE]', `DATE_JOINED`='$row[DATE_JOINED]', `DATE_BAPTISTED`='$row[DATE_BAPTISTED]', `TITLE`='$row[TITLE]', `FIRSTNAME`='$row[FIRSTNAME]', `LASTNAME`='$row[LASTNAME]', `OTHERNAMES`='$row[OTHERNAMES]', `ARCHIVED`='$row[ARCHIVED]', `CONTACT`='$row[CONTACT]', `DECEASED`='$row[DECEASED]', `GENDER`='$row[GENDER]', `DOB`='$row[DOB]', `AGE`='$row[AGE]', `MARITAL_STATUS`='$row[MARITAL_STATUS]', `ANNIVERSARY`='$row[ANNIVERSARY]', `EMAIL`='$row[EMAIL]', `PHONE`='$row[PHONE]', `TELEPHONE`='$row[TELEPHONE]', `VOLUNTEER`='$row[VOLUNTEER]', `RESIDENTIAL_ADDRESS`='$row[RESIDENTIAL_ADDRESS]', `CONTACT_ADDRESS`='$row[CONTACT_ADDRESS]', `HOMETOWN`='$row[HOMETOWN]', `REGION`='$row[RELIGION]', `COUNTRY`='$row[COUNTRY]', `SECURITY_CODE`='$row[SECURITY_CODE]', `RECEIPT`='$row[RECEIPT]', `GIVING_NUMBER`='$row[GIVING_NUMBER]', `FAMILY_RELATIONSHIP`='$row[FAMILY_RELATIONSHIP]', `MUSIC_TEAM`='$row[MUSIC_TEAM]', `DEMOGRAPHICS`='$row[DEMOGRAPHICS]', `SERVICE_TYPE`='$row[SERVICE_TYPE]', `LOCATION`='$row[LOCATION]', `BRANCH`='$row[BRANCH]', `OCCUPATION`='$row[OCCUPATION]', `PLACE_OF_WORK`='$row[PLACE_OF_WORK]', `NAME_OF_SPOUSE`='$row[NAME_OF_SPOUSE]', `OCUPATION_OF_SPOUSE`='$row[OCUPATION_OF_SPOUSE]', `SPOUSE_PHONE`='$row[SPOUSE_PHONE]', `SSNIT`='$row[SSNIT]', `NEXT_OF_KIN`='$row[NEXT_OF_KIN]', `NEXT_OF_KIN_ADDRESS`='$row[NEXT_OF_KIN_ADDRESS]', `NEXT_OF_KIN_PHONE`='$row[NEXT_OF_KIN_PHONE]', `FATHERS_NAME`='$row[FATHERS_NAME]', `FATHERS_DOB`='$row[FATHERS_DOB]', `MOTHERS_NAME`='$row[MOTHERS_NAME]', `MOTHERS_DOB`='$row[MOTHERS_DOB]', `PHONE2`='$row[PHONE2]', `PEOPLE_CATEGORY`='$row[PEOPLE_CATEGORY]', `MINISTRY`='$row[MINISTRY]' ");
                                    if($sql->Execute($query)){
                                        header("location:dashboard?success=1");
                                    }

                                }


                }


            }
          }
        }
          if(isset($_POST[sms])){
              $q = $_SESSION[last_query];
                $query2 = $sql->Prepare($q);
                $rt = $sql->Execute($query2);

                While ($stmt = $rt->FetchRow()) {
                    $arrayphone = $stmt[PHONE];

                    if ($a = $sms->sendSMS1($arrayphone, $_POST[message])) {
                        $_SESSION[last_query] = "";

                        header("location:members?success=1");
                    }
                }
             }
 if (isset($_POST[mail])) {
    if ($help->ping("www.google.com", 80, 20)) {
        $message = $_POST['message'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


        $q = $_SESSION[last_query];
        $query2 = $sql->Prepare($q);
        $rt = $sql->Execute($query2);

        While ($stmt = $rt->FetchRow()) {
            $email = $stmt[email];


            if (@mail($email, "$config_file->CHURCH_NAME - Ghana", $message, $headers)) {
                $_SESSION[last_query] = "";
                header("location:members?success=1");
            }
        }
    } else {
        header("location:members?no_internet=1");
    }
}
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
     <script src="assets/scripts/vendors.js"></script>
       
	<!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
	<!-- #end header -->
        
	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- main-navigation -->
		 
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                    <div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Send SMS</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="members?sms=1" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">Message</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                 <textarea required="" class="form-control" name="message" rows="9" ></textarea>                                    
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="sms" class="btn btn-success">Send <i class="fa fa-sm"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
                    <div class="modal fade" id="mail" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Send Email</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="members?mail=1" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">Message</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                 <textarea required="" class="form-control" name="message" rows="9" ></textarea>                                    
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="mail" class="btn btn-success">Send Email <i class="fa fa-forward"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
                        <div class="modal fade" id="mount" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Import Bulk Members</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form action="members.php" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                     <div class="form-group">
                                                         <label for="inputPassworsd3" class="col-sm-2 control-label">select csv file</label>
                                                         <div class="col-sm-10">

                                                             <div class="fg-line">
                                                                  
                                                                          <input type="file" required="" class="form-control" name="file"  >                                     
                                                             </div>
                                                         </div>
                                                     </div>
                                                <div class="modal-footer">
                                                      
                                                        <button type="submit" name="go" class="btn btn-success">Save</button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                  </div>
                                </div>
                        </div>
			<div class="page page-ui-tables">
				  <ol class="breadcrumb breadcrumb-small">
					<li><?php echo $config_file->CHURCH_NAME;  ?></li>
					<li class="active"><a href="#">Vistors</a></li>
				</ol>
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:31px;float:right">
                                                     
                                                     <button  style="margin-top: -59px" name="mail"  class="btn btn-success waves-effect" data-target="#mail"  data-toggle="modal">Mail<i class="fa fa-mail-forward"></i></button>
                                                        <button  style="margin-top: -59px"  data-target="#mount" data-toggle="modal"  class="btn btn-success waves-effect">Import csv<i class="fa fa-upload"></i></button>
                                                          <button  style="margin-top: -59px"   class="btn btn-pink waves-effect" data-target="#sms"  data-toggle="modal">Send SMS<i class="fa fa-phone"></i></button>
                                                        <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" data-toggle="dropdown" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});"><i class="fa fa-save"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="width:1300px;margin-left: -95px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="addMember.php?new=1"  style="margin-top: -19px;margin-left: -25px"  title="Add new member"  class="btn btn-success waves-effect">Add Member<i class="fa fa-plus-circle"></i></a> 
                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Bordered</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">Striped</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                        <table  width=" " border="0">
                                        <tr>


                                     <td width="20%">

                                    <select class='form-control select2_sample1'  id="title"   style="margin-left:-3px; width:165px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?branch='+escape(this.value);" >
                                <option value=''>Filter by branch</option>
                                        <option value='All branch'>All Branches</option>
                                    <?php 
                                      global $sql;

                                          $query2=$sql->Prepare("SELECT * FROM perez_branches");


                                          $query=$sql->Execute( $query2);


                                       while( $row = $query->FetchRow())
                                         {

                                         ?>
                                         <option <?php if($_SESSION[branch]==$row['CODE']){echo 'selected="selected"'; }?> value="<?php echo $row['CODE']; ?>"        ><?php echo $row['NAME']; ?></option>

                                  <?php }?>
                                      </select>

                            </td>
                             
				 
                               <td>&nbsp;</td>
                                <td width="25%">
                                    <select class='form-control'       style="margin-left:12px;  width:133px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='Male'<?php if($_SESSION[gender]=='Male'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='Female'<?php if($_SESSION[gender]=='Female'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                                </td>
                              <td width="25%">
                                   <select class='form-control' style="margin-left:-53px;  width:auto" id="ministry" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?ministry='+escape(this.value);"     >
                                       <option value=''>Filter by Ministries</option>
                                        <option value='All ministry'>All Ministries</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_ministries");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[ministry]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                         <td width="25%">
                                   <select class='form-control' style=" width:auto " id="category" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?category='+escape(this.value);"     >
                                       <option value=''>Filter by member category</option>
                                        <option value='All category'>All Categories</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_member_category");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[category]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['CATEGORY']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                             <td width="25%">
                                            <select class='form-control' style="  width:auto " id="department" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?department='+escape(this.value);"     >
                                            <option value=''>Filter by departments</option>
                                            <option value='All departments'>All departments</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_departments");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[department]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>   
                                        </tr>
                                       </table>
                                                    <p>&nbsp;</p>
                                
                                        </div>
                                            <div>
                                                    <table>
                                                        <tr>

                                         <td>&nbsp;</td>
                                          
                                          <td width="25%">
                                            <select class='form-control'  id="familsy" style=" margin-left: -3px; width:182px"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?demo='+escape(this.value);"     >
                                            <option value=''>by demographics</option>
                                            <option value='All demographics'>All Demographics</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_demographics");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[demographics]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>  
                                                
                                                 <td width="25%">
                                            <select class='form-control'   style=" margin-left: -3px; width:182px"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?languages='+escape(this.value);"     >
                                            <option value=''>by languages</option>
                                            <option value='All languages'>All Languages</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM `perez_languages`  ");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['NAME']; ?>"   <?php if($_SESSION[languages]==$row['NAME']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>  
                                                
                                                    <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control gad' id="marital"  style="margin-left:  px;  width:149px"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?team='+escape(this.value);"     >
                                            <option value=''>filter by group</option>
                                            <option value='All team'>All Groups</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM `perez_group` ");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[team]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left: 2px;   width:149px " id="ethnic"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?ethnic='+escape(this.value);"     >
                                            <option value=''>filter by ethnic</option>
                                            <option value='All ethnic'>All ethnic groups</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_ethnic");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['NAME']; ?>"   <?php if($_SESSION[ethnic]==$row['NAME']){echo "selected='selected'";} ?>      ><?php echo $row['Name']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>
                                                        <form action="members.php" method="post">
                                                <td>
                                                      
                                                    <input style="margin-left: -47px;width:131px" type="search" placeholder="Search here" name="search" id="member_" class="form-control check-duplicates" >

                                                        
                                                </td>
                                                        <td>
                                                             <select class='form-control'  name='content' id="family" required="" style=" margin-left: 10px;width:114px"  >
                                                                    <option value=''>search by</option>

                                                                   <option value='LASTNAME'<?php if($_SESSION[contents]=='SURNAME'){echo 'selected="selected"'; }?>>Surname</option>
                                                                   <option value='FIRSTNAME'<?php if($_SESSION[statuss]=='OTHERNAMES'){echo 'selected="selected"'; }?>>First Name</option>
                                                                   <option value='MEMBER_CODE'<?php if($_SESSION[statuss]=='INDEXNO'){echo 'selected="selected"'; }?>>Member code</option>

                                                               </select>
                                                        </td>
                                                        <td width="25%">
                            <button type="submit" name="go" style="margin-left: 22px;width:   " class="btn btn-primary   btn-search">Search</button>
                                                        </td> 
                                                       
                                                        </tr>
                                                    </table>
                                                 </form>
                                                </div>
                                                <!-- end filters   -->
                                                <div class="row">
<!--                                                    <div class="panel panel-collapse">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    <center>Click to Send SMS</center>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                <form id="form2" name="form2" method="post" action="dashboard?send=1">
                                                                    <label></label>
                                                                    <table width="640" border="0" align="center">
                                                                        <tr>
                                                                            <td colspan="2" bgcolor="#91B7D9">Select members to send sms</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2" bgcolor="#2D5982">
                                                                                autocomplete goes here
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td bgcolor="#91B7D9"><div align="center"><strong>Text Message</strong></div></td>
                                                                            <td valign="top" bgcolor="#91B7D9"><div align="center"><strong>Fields Available</strong></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="419" height="110" bgcolor="#2D5983"><div align="center">
                                                                                    <textarea name="sms" id="sms" cols="45" rows="5" required=""></textarea>
                                                                                </div></td>
                                                                            <td width="211" valign="top" bgcolor="#2D5983"><div align="center">
                                                                                    <script>
                                                                                                        function inse(inco){
                                                                                                        var curr=document.getElementById('sms');
                                                                                                        curr.value=curr.value+"["+inco+"]"
                                                                                                        }
                                                                                    </script>
                                                                                    <select name="select"  ondblclick="inse(this.value)" size="6" id="select" required="">
                                                                                        <option value="MEMBER_CODE"> Student ID</option>
                                                                                        <option value="SURNAME">Surname</option>
                                                                                        <option value="OTHERNAMES">Other Names</option>
                                                                                        <option value="CLASS">Class</option>
                                                                                        <option value="BILLS">Total Bills</option>
                                                                                        <option value="PTA_OWING">PTA</option>
                                                                                        <option value="BILLS_PAID">Bills paid</option>
                                                                                        <option value="ACADEMIC_OWING">Academic Owing</option>
                                                                                        <option value="OTHERS_OWING">Other Bills</option>

                                                                                    </select>
                                                                                </div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="" style="text-align: center"> 
                                                                                <div align="center" style="margin-left: 32%">
                                                                                    <p></p>
                                                                                        <center>   <button type="submit" class="btn btn-success waves-effect" name="send"   />Send SMS <i class="md md-sms"></i></button></center>
                                                                                    </div>
                                                                                 </td>
                                                                        </tr>
                                                                    </table>
                                                                    <label> </label>
                                                                    <label></label>
                                                                </form>


                                                            </div>
                                                        </div>

                                                    </div>-->
                                                </div>
                                                 <hr>
                                                <div class="table-responsive">
                                                    <?php
                                                            $language=$_SESSION['languages'];                                  
                                                            $branch=$_SESSION[branch];
                                                            $gender=$_SESSION[gender];
                                                            $ministry=$_SESSION[ministry];
                                                            $status=$_SESSION[deceased];
                                                            $ethnic=$_SESSION[ethnic];
                                                            $team=$_SESSION[team];
                                                            $demo=$_SESSION[demo];
                                                            $department=$_SESSION[department];
                                                            $category=$_SESSION[category];
                                                            $search=$_POST[search];
                                                            $content=$_POST[content];
                                                            
                                                            if($language=="All languages" or $language==""){ $language=""; }else {$language_=" and  LANGUAGES LIKE  '%$language%' "  ;}
                                                           

                                                            if($branch=="All branch" or $branch==""){ $branch=""; }else {$branch_=" and  BRANCH = '$branch' "  ;}
                                                            if($ministry=="All ministry" or $ministry==""){ $ministry=""; }else {$ministry_="and MINISTRY = '$ministry' "  ;}
                                                            if($gender=="All gender" or $gender=="" ){ $gender=""; }else {$gender_=" and GENDER = '$gender' "  ;}
                                                            if($status=="All status" or $status=="" ){ $status=""; }else {$status_=" and DECEASED = '$status' "  ;}
                                                            if($ethnic=="All ethnic" or $ethnic=="" ){ $ethnic=""; }else {$ethnic_=" and ETHNIC = '$ethnic' "  ;}
                                                             if($team=="All team" or $team=="" ){ $team=""; }else {$team_=" and GROUPS = '$team' "  ;}
                                                           if($demo=="All demographics" or $demo=="" ){ $demo=""; }else {$demo_=" and DEMOGRAPHICS = '$demo' "  ;}
                                                           if($department=="All departments" or $department=="" ){ $department=""; }else {$department_=" and DEPARTMENT = '$department' "  ;}
                                                            if($category=="All category" or $category=="" ){ $category=""; }else {$category_=" and PEOPLE_CATEGORY = '$category' "  ;}
                                                            if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '%$search%' "  ;}

                                                           $query="SELECT  * FROM  perez_members  where 1 and PEOPLE_CATEGORY='2' $branch_  $ministry_  $search_ $gender_ $nation_ $status_ $team_ $category_ $demo_ $service_" ;
                                                              $_SESSION[last_query]=$query; 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="gad" class="table   display" >
                                                    
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                             <th>Member Code</th>
                                                             <th>Photo</th>
                                                            
                                                            <th>Name</th>
                                                            <th>Gender</th>
                                                            <th>Date Joined</th>
                                                            <th>Date Baptised</th>
                                                             
                                                            <th>Phone</th>
                                                            <th>Branch</th>
                                                            <th>Ministry</th>
                                                            <th>Demographic</th>
                                                            <th>Occupation</th>
                                                            <th>Category</th>
                                                            <th colspan="" style="text-align: center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                                                    <tbody>
                                                        <?php

                                                          $count=0;
                                                           while($rtmt=$rs->FetchRow()){
                                                                                   $count++;


                                                              ?>
                                                           <tr>
                                                               <td><?php echo $count ?></td>
                                                                
                                                              <td style="text-align:"><?php echo $rtmt[MEMBER_CODE] ?></td>
                                                              <td><a href="addMember.php?member=<?php echo  $rtmt[MEMBER_CODE] ?>&&update"><img  <?php   $pic=  $help->pictureid($rtmt[MEMBER_CODE]);  echo$help->picture("photos/members/$pic.JPG",'90')  ?>   src="<?php echo file_exists("photos/members/$pic.JPG") ? "photos/members/$pic.JPG":"photos/members/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                                            
                                                             <td style="text-align:"><?php echo $rtmt[TITLE]." ". $rtmt[LASTNAME]." ,".$rtmt[FIRSTNAME]." ".$rtmt[OTHERNAMES] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[GENDER] ?></td>
                                                             <td style="text-align:"><?php echo date("d/m/Y",$rtmt[DATE_JOINED]); ?></td>
                                                             <td style="text-align:"><?php echo date("d/m/Y",$rtmt[DATE_BAPTISTED]); ?></td>
                                                              
                                                             <td style="text-align:"><?php echo $rtmt[PHONE] ?></td>
                                                             <td style="text-align:"><?php echo $help->getLocation($rtmt[LOCATION]) ?></td>
                                                             <td style="text-align:"><?php echo $member->getMinistry($rtmt[MINISTRY]) ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[DEMOGRAPHICS] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[OCCUPATION] ?></td>
                                                             <td style="text-align:"><?php echo $help->getCategory($rtmt[PEOPLE_CATEGORY] )?></td>
                                                             <td><a href="addMember?member=<?php echo  $rtmt[MEMBER_CODE] ?>&&update"><i class="fa fa-edit" title="click to edit info"></i></a> 
                                                             
                                                                 <a href=""><i class="fa fa-print" title="click to print"></i></a>  
                                                              <a onclick="return confirm('Are you sure you want to delete this person??')" href="members?delete=<?php echo  $rtmt[MEMBER_CODE] ?>"><i class="fa fa-trash" title="click to delete"></i> </a></td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                <center><?php
//                                                    $GenericEasyPagination->setTotalRecords($recordsFound);
//
//                                                   echo $GenericEasyPagination->getNavigation();
//                                                   echo "<br>";
//                                                   echo $GenericEasyPagination->getCurrentPages();
//                                                 ?></center>
                                         <?php }else{
                                                            echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                                                  Oh snap! Something went wrong. No record to display 
                                                              </div>";
                                               }?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>


                                     

                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	</div> <!-- #end main-container -->

	 

   <script src="assets/scripts/jquery-2.1.1.min.js"></script>
       
	<script src="assets/scripts/jquery.dataTables.min.js"></script>
        <script src="assets/scripts/dataTables.bootstrap.min.js"></script>
          
        <script src="assets/scripts/dataTables.keyTable.min.js"></script>
        
     
       <script>
            $(document).ready(function() {
                $('#gad').DataTable( {
                    
                } );
            } );
        </script>
          
        
<script src="assets/scripts/select2.min.js"></script>
       
        <script>
                 $(document).ready(function(){
                    $('select').select2({ width: "resolve" });


                  });
        </script>       
         <?php include("_library_/_includes_/export.php"); ?> 
         
</body>

</html>