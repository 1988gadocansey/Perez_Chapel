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
        $config_file=$help->getConfig() ;
                                    
        $sms=new _classes_\smsgetway();
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
        if($_GET[branch]){
        $_SESSION[branch]=$_GET[branch];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
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
        if($_GET[group]){
        $_SESSION[group]=$_GET[group];
        }
        if($_GET[service]){
        $_SESSION[service]=$_GET[service];
        }
        if($_GET[demo]){
        $_SESSION[demo]=$_GET[demo];
        }
         if($_GET[volunteers]){
        $_SESSION[volunteers]=$_GET[volunteers];
        }
        if($_GET[country]){
        $_SESSION[nation]=$_GET[country];
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
 

                        $destination = "uploads/$name";
                       //Import uploaded file to Database
                        $handle = fopen($_FILES['file']['tmp_name'], "r");

                        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
                         if (move_uploaded_file) {
                        //Import uploaded file to Database
                         $handle = fopen($_FILES['file']['tmp_name'], "r");
 	 
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                         //print_r($data);
                                           $member_code=substr(strtoupper($config_file->CHURCH_NAME),0,3).date("Y").$help->getindexno();
                                           $code=$help->getCode("ACCOUNT");

                                            $query=$sql->Prepare("INSERT INTO perez_members  SET MEMBER_CODE='$member_code', FIRSTNAME='$data[0]', LASTNAME='$data[1]', OTHERNAMES='$data[2]',  TITLE='$data[3]', GENDER='$data[4]',  PHONE='$data[5]', EMAIL='$data[6]' ");
                                            $query2 =$sql->Prepare("INSERT INTO tbl_accounts(ACCOUNT_NAME,PARENT_ACCOUNT,ACCOUNT_DESCRIPTION,AFFECTS,ACCOUNT_BALANCE,ACCOUNT_CODE,BALANCE_TYPE,BUSINESS_PERSON,BANK_ACCOUNT_NUM)VALUES ('$member_code','2','created ledger account for member','Balance Sheet','0','$code','Debit','$business_person','$account_number')");

                            if($sql->Execute($query)&&$sql->Execute($query2)){

                                                 header("location:members?success=1");
                                               } 
                                        $help->UpdateIndexno();
                                        $help->UpdateCode("ACCOUNT");

                                }

                }

                fclose($handle);

                }
          }
        
          if(isset($_POST[sms])){
             if( $help->ping("www.google.com",80,20)){
              $q = $_SESSION[last_query];
                $query2 = $sql->Prepare($q);
                 
                $rt = $sql->Execute($query2);
                
                While ($stmt = $rt->FetchRow()) {
                            $phone=$stmt[PHONE];
                          
                    if ( $sms->sendSMS1($phone, $_POST['message'])) {
                        $_SESSION[last_query] = "";

                       header("location:members?success=1");
                    }
                }
                
              }
              else{
                  header("location:members?no_internet=1");
              }
             }
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
      <link rel="stylesheet" href="assets/styles/plugins/select2.css">
	<!-- header -->
	<header class="site-head" id="site-head">
		
            <?php include("./_library_/_includes_/top_bar.inc"); ?>
	</header>
	<!-- #end header -->

	<!-- main-container -->
	<div class="main-container clearfix">
		<!-- main-navigation -->
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
		</aside>
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
                                            <div class="table-responsive">
                                            <form action="members?sms=1" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                      
                                                     <textarea name="message" required="" row="9" class="form-control"></textarea>
						 
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="sms" class="btn btn-success">Send <i class="md md-sms"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                      
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
                                            
                                            <form action="members" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
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
					<li>Church Administration</li>
					<li class="active"><a href="#">Members</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:-2.5%;float:right">
                                                     
                                                     <button  style="margin-top: -59px" name="mail"  class="btn btn-success waves-effect">Mail<i class="md md-email"></i></button>
                                                        <button  style="margin-top: -59px"  data-target="#mount" data-toggle="modal"  class="btn btn-success waves-effect">Import csv<i class="md md-cloud-upload"></i></button>
                                                          <button  style="margin-top: -59px"   class="btn btn-pink waves-effect" data-target="#sms"  data-toggle="modal">Send SMS<i class="md md-sms"></i></button>
                                                          <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="addMember?new=1"  style="margin-top: -17px;margin-left: -25px"  title="Add new member"  class="btn btn-pink waves-effect btn-sm">Add Member<i class="fa fa-plus-circle"></i></a>
                                                 
                                                <a href="addFamily?new=1"  style="margin-top: -17px;margin-left: 10px"  title="Add new family"    class="btn btn-primary waves-effect btn-sm">Families<i class="fa fa-users"></i></a> 
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

                                    <select class='form-control' id="category" data-placeholder="filter by branch"    style="margin-left:-3%; width:120px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?branch='+escape(this.value);" >
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
                                     <select class='form-control'  id="gender"    style="margin-left:-14%;  width:110px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='Male'<?php if($_SESSION[gender]=='Male'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='Female'<?php if($_SESSION[gender]=='Female'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                                </td>
                              <td width="25%">
                                   <select class='form-control' style="margin-left:-60%;  width:150px " id="ministry" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?ministry='+escape(this.value);"     >
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
                                   <select class='form-control' style="margin-left:12px;  width:100px " id="title" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?category='+escape(this.value);"     >
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
                                            <select class='form-control' style="margin-left:;  width:150px " id="service"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?service='+escape(this.value);"     >
                                            <option value=''>Filter by Service category</option>
                                            <option value='All service'>All Service</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_service_type");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[service]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['SERVICE']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>     
                                         <td>&nbsp;</td>
                                          
                                          <td width="25%">
                                            <select class='form-control' style="margin-left:-39px;  width:175px " id="marital" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?demo='+escape(this.value);"     >
                                            <option value=''>by demographics</option>
                                            <option value='All demographics'>All Demographics</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_demographics");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['NAME'] ?>"   <?php if($_SESSION[demographics]==$row['NAME']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>   
                                                
                                                    <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left:-51%;  width:170px " id="country"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?group='+escape(this.value);"     >
                                            <option value=''>filter by group</option>
                                            <option value='All group'>All Groups</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_group");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['ID']; ?>"   <?php if($_SESSION[group]==$row['ID']){echo "selected='selected'";} ?>      ><?php echo $row['NAME']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                            <select class='form-control' style="margin-left:256%;  width:165px " id="region" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?country='+escape(this.value);"     >
                                            <option value=''>filter by country</option>
                                            <option value='All country'>All Countries</option>
                                                          
                                                      <?php 
                                                      global $sql;

                                                      $query2=$sql->Prepare("SELECT * FROM perez_country");


                                                        $query=$sql->Execute( $query2);


                                                     while( $row = $query->FetchRow())
                                                       {

                                                       ?>
                                                       <option value="<?php echo $row['Code']; ?>"   <?php if($_SESSION[nation]==$row['Code']){echo "selected='selected'";} ?>      ><?php echo $row['Name']; ?></option>

                                                    <?php }?>
                                                       
                                                   </select>

                                                </td>
                                                <td>&nbsp;</td>
                                <td width="25%">
                                     <select class='form-control'      style="margin-left:14%;  width:140px "id="ethnic"  onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?volunteers='+escape(this.value);" >
                                         <option value=''>by volunteers</option>
                                        <option value='All'>All members</option>
                                        <option value='yes'<?php if($_SESSION[volunteers]=='yes'){echo 'selected="selected"'; }?>>Volunteers</option>
                                        <option value='no'<?php if($_SESSION[volunteers]=='no'){echo 'selected="selected"'; }?>>Non Volunteers</option>
                                         
                                    </select>

                                </td>
                      
                                        </tr>
                                       </table>
                                    <br/>
                                       <table align="center">
                                           <tr>
                                           <form action="members?" method="post" >
                                            <td width="25%">


                                                <input type="text" name ="search" placeholder="type search item here..."required="" style="margin-left:50%; width:263px;" class="form-control" id=" "  >

                                            </td>
                                            <td>&nbsp;</td>
                                             <td width="25%">
                                            <select class='form-control'  name='content'id="family" required="" style="margin-left: 93; width: 200px;"  >
                                                <option value=''>search by</option>
                                                <option value='SURNAME'<?php if($_SESSION[conthhent]=='SURNAME'){echo 'selected="selected"'; }?>>Surname</option>
                                                <option value='FIRSTNAME'<?php if($_SESSION[status]=='FIRSTNAME'){echo 'selected="selected"'; }?>>First Name</option>
                                                <option value='OTHERNAMES'<?php if($_SESSION[status]=='INDEXNO'){echo 'selected="selected"'; }?>> Other names</option>
                                                <option value='MEMBER_CODE'<?php if($_SESSION[status]=='PROGRAMMECODE'){echo 'selected="selected"'; }?>>Member's Code</option>

                                           </select>

                                             </td>
                                        <td>&nbsp;</td>
                                        <td width="25%">
                                              <button type="submit" name="go" style="margin-left: 78%; width: 65px;" class="btn btn-primary">Go</button>
                                        </td>
                                            </tr>  

                                        </form>
                                            
                                               
                                       </table>
                                                   
                            </div>
                            <!-- end filters   -->

                                                 <hr>
                                                <div class="table-responsive">
                                                    <?php
                                                                                               
                                                            $branch=$_SESSION[branch];
                                                            $gender=$_SESSION[gender];
                                                            $ministry=$_SESSION[ministry];
                                                            $status=$_SESSION[deceased];
                                                            $nation=$_SESSION[nation];
                                                            $group=$_SESSION[group];
                                                            $demo=$_SESSION[demo];
                                                            $volunteer=$_SESSION[volunteers];
                                                            $service=$_SESSION[service];
                                                            $category=$_SESSION[category];
                                                            $search=$_POST[search];
                                                            $content=$_POST[content];
                                                            if($volunteer=="All" or $volunteer==""){ $volunteer=""; }else {$volunteer_=" and  VOLUNTEER = '$volunteer' "  ;}
                                                           

                                                            if($branch=="All branch" or $branch==""){ $branch=""; }else {$branch_=" and  BRANCH = '$branch' "  ;}
                                                            if($ministry=="All ministry" or $ministry==""){ $ministry=""; }else {$ministry_="and MINISTRY = '$ministry' "  ;}
                                                            if($gender=="All gender" or $gender=="" ){ $gender=""; }else {$gender_=" and GENDER = '$gender' "  ;}
                                                            if($status=="All status" or $status=="" ){ $status=""; }else {$status_=" and DECEASED = '$status' "  ;}
                                                            if($nation=="All country" or $nation=="" ){ $nation=""; }else {$nation_=" and COUNTRY = '$nation' "  ;}
                                                             if($group=="All group" or $group=="" ){ $group=""; }else {$group_=" and GROUPS LIKE '%$group%' "  ;}
                                                           if($demo=="All demographics" or $demo=="" ){ $demo=""; }else {$demo_=" and DEMOGRAPHICS LIKE '%$demo%' "  ;}
                                                           if($service=="All service" or $service=="" ){ $service=""; }else {$service_=" and SERVICE_TYPE = '$service' "  ;}
                                                            if($category=="All category" or $category=="" ){ $category=""; }else {$category_=" and PEOPLE_CATEGORY = '$category' "  ;}
                                                            if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '%$search%' "  ;}

                                                            $query="SELECT  * FROM  perez_members  where 1 $branch_  $ministry_  $search_ $gender_ $nation_ $status_ $group_ $category_ $demo_ $service_ $volunteer_" ;
                                                            $_SESSION[last_query]=$query; 
                                                            print_r($query);
                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="assesment" class="table table-striped " >
                                                    <thead style="background:rgb(225, 131, 72) none repeat scroll 0% 0%;color:#fff">
                                                        <tr>
                                                             <th>#</th>
                                                            <th class="col-lg-1"><button type="button"  onclick="return confirm('Are you sure you want to delete this members??')" class="btn btn-default btn-sm md md-delete"></th>
                                                            <th>Photo</th>
                                                            <th>Member Code</th>
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
                                                            <th colspan="5" style="text-align: center">Actions</th>
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
                                                               <td>
                                                                       <div class="ui-checkbox ui-checkbox-primary ml5">
                                                                               <label><input type="checkbox"><span></span>
                                                                               </label>
                                                                       </div>
                                                                </td>
                                                             <td><a href="addMember.php?member=<?php echo  $rtmt[MEMBER_CODE] ?>&&update"><img   <?php   $pic=  $help->pictureid($rtmt[MEMBER_CODE]); echo $help->picture("photos/members/$pic.jpg",90)  ?>   src="<?php echo file_exists("photos/members/$pic.jpg") ? "photos/members/$pic.jpg":"photos/members/user.jpg";?>" alt=" Picture of Student Here"    /></a></td>
                                                             <td style="text-align:"><?php echo $rtmt[MEMBER_CODE] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[TITLE]." ". $rtmt[LASTNAME]." ,".$rtmt[FIRSTNAME]." ".$rtmt[OTHERNAMES] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[GENDER] ?></td>
                                                             <td style="text-align:"><?php echo date("d/m/Y",$rtmt[DATE_JOINED]); ?></td>
                                                             <td style="text-align:"><?php echo date("d/m/Y",$rtmt[DATE_BAPTISTED]); ?></td>
                                                              
                                                             <td style="text-align:"><?php echo $rtmt[PHONE] ?></td>
                                                             <td style="text-align:"><?php echo $member->getBranch($rtmt[LOCATION]) ?></td>
                                                             <td style="text-align:"><?php echo $member->getMinistry($rtmt[MINISTRY]) ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[DEMOGRAPHICS] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[OCCUPATION] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[PEOPLE_CATEGORY] ?></td>
                                                             <td><a href="addMember?member=<?php echo  $rtmt[MEMBER_CODE] ?>&&update">Edit <i class="md md-edit" title="click to edit info"></i></a></td>
                                                             <!--<td>Mail<i class="md md-email" title="click to send email"></i> </td>-->
                                                             <td>SMS<i class="md md-sms" title="click to send  sms"></i> </td>
                                                             <td>vcard<i class="md md-contacts" title="click to view vcard"></i> </td>
                                                            <!-- <td><a style="cursor: pointer" title="click to edit" onclick="return MM_openBrWindow('member_profile?page=<?php //echo $rtmt[MEMBER_CODE] ?>','','menubar=yes,width=800,height=650')">Profile<i class="fa fa-user" title="click to view profile"></i> </a></td>-->
                                                             <td>Delete<a onclick="return confirm('Are you sure you want to delete this person??')" href="members?delete=<?php echo  $rtmt[MEMBER_CODE] ?>"Delete<i class="md md-delete" title="click to delete"></i> </a></td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                <center><?php
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                 ?></center>
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

	<?php include("./_library_/_includes_/theme.inc"); ?>
 
        
	<?php include("./_library_/_includes_/js.php"); ?>
        
        
        <script src="assets/scripts/plugins/jquery.dataTables.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/tables.init.js"></script>
 <?php include("_library_/_includes_/export.php");  ?>
        <script>
            $(document).ready(function() {
                $('#assesment').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis'
                    ]
                } );
            } );
        </script>
</body>

</html>