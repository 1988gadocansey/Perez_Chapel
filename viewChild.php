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
         if($_GET[person]){
        $_SESSION[person]=$_GET[person];
        }
        if($_GET[gender]){
        $_SESSION[gender]=$_GET[gender];
        }
         
         
         if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_children WHERE ID='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:viewChild?success=1");
            }
        }
  /////////////////////////////////////////////////////////////////////////////
        
          
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<body id="app" class="app off-canvas">
     
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
                 
                     
			<div class="page page-ui-tables">
				 
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                              
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12" style="width:1200px;margin-left: -95px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="addChild.php?new=1"  style="margin-top: -19px;margin-left: -25px"  title="Add new member"  class="btn btn-success waves-effect btn-sm">Add a Child<i class="fa fa-plus-circle"></i></a> 
                                                
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


                                  
				 
                               <td>&nbsp;</td>
                                            
                                          
                                        
                                               
                                        </tr>
                                       </table>
                                                    <p>&nbsp;</p>
                                
                                        </div>
                                            <div>
                                                    <table>
                                                        <tr>
                                                            
                                         <td>&nbsp;</td>
                                           
                                        <form action="viewChild.php" method="post">
<!--                                                <td>
                                                      
                                                    <input style="width:131px" type="search" placeholder="Search here" name="search" id="member_" class="form-control check-duplicates" >

                                                        
                                                </td>
                                                        <td>
                                                             <select class='form-control'  name='content' id="family" required="" style=" margin-left: 10px;width:114px"  >
                                                                    <option value=''>search by</option>

                                                                   <option value='NAME'<?php if($_SESSION[contents]=='SURNAME'){echo 'selected="selected"'; }?>>Name</option>
                                                                   <option value='CODE'<?php if($_SESSION[statuss]=='OTHERNAMES'){echo 'selected="selected"'; }?>>Child code</option>
                                                                    
                                                               </select>
                                                        </td>
                                                        <td width="25%">
                            <button type="submit" name="go" style="margin-left: 22px;width:   " class="btn btn-primary   btn-search">Search</button>
                                                        </td> -->
                                                          <td width="20%">

                                    <select class='form-control select2_sample1'  id="title"   style=" width:215px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?person='+escape(this.value);" >
                                 
                                                        <option value='All Members'>select member</option>
                                                        <?php
                                                        $num = 0;
                                                        $query2 = $sql->Prepare("SELECT *  FROM perez_members");


                                                        $query = $sql->Execute($query2);
                                                        while ($row = $query->FetchRow()) {
                                                            ?>
                                                            <option <?php if($_SESSION[person]==$row['ID']){echo "selected='selected'";} ?>   value="<?php echo $row[ID]; ?>"><?php echo $row[MEMBER_CODE] . ' - ' . $row[TITLE] . ' ' . $row[FIRSTNAME] . ' ' . $row[LASTNAME] . ' ' . $row[OTHERNAMES]; ?></option>

                                                        <?php } ?>
                                                    </select>

                            </td>
                            
                                <td width="25%">
                                    <select class='form-control'       style="margin-left:12px;   " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?gender='+escape(this.value);" >
                                         <option value=''>by gender</option>
                                        <option value='All gender'>All gender</option>
                                        <option value='Male'<?php if($_SESSION[gender]=='Male'){echo 'selected="selected"'; }?>>Male</option>
                                        <option value='Female'<?php if($_SESSION[gender]=='Female'){echo 'selected="selected"'; }?>>Female</option>
                                         
                                    </select>

                                </td>
                             
                                                        </tr>
                                                    </table>
                                                 </form>
                                                </div>
                                                <!-- end filters   -->
                                            
                                                 <hr>
                                                <div class="table-responsive">
                                                    <?php
                                                                                               
                                                            $person=$_SESSION[person];
                                                            
                                                            $search=$_POST[search];
                                                            $content=$_POST[content];
                                            

                                                            if($person=="All Members" or $person==""){ $person=""; }else {$person_=" and  PARENT_ID = '$person' "  ;}
                                                           //if($category=="All category" or $category=="" ){ $category=""; }else {$category_=" and PEOPLE_CATEGORY = '$category' "  ;}
                                                            if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '$search' "  ;}

                                                            $query="SELECT  * FROM  perez_children  where 1 $person_ $search_" ;
                                                            $_SESSION[last_query]=$query; 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table   class="table table-condensed  display"  >
                                                    <caption>Children </caption>
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                             <th>Photo</th>
                                                            <th>Child Code</th>
                                                            <th>Name</th>
                                                            <th>Age</th>
                                                            
                                                            <th colspan=" " style="text-align: center">Actions</th>
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
                                                               
                                                             <td><a href="updateChild.php?child=<?php echo  $rtmt[ID] ?>&&update"><img  <?php   $pic=  $help->pictureid($rtmt[CODE]); echo $help->picture("photos/children/$pic.jpg",90)  ?>   src="<?php echo 'photos/children/'.$pic.jpg ? "photos/children/$pic.jpg":"photos/members/user.jpg";?>" alt=" Picture of child Here"    /></a></td>
                                                             <td style="text-align:"><?php echo $rtmt[CODE] ?></td>
                                                             <td style="text-align:"><?php echo $rtmt[NAME] ?></td>
                                                          
                                                             <td style="text-align:"><?php echo $help->age($rtmt[DOB],'eu' )?>yrs</td>
                                                               
                                                             <td style="text-align: center"><a onclick="return confirm('Are you sure you want to delete this person??')" href="viewChild?delete=<?php echo  $rtmt[ID] ?>"Delete<i class="fa fa-trash" title="click to delete"></i> </a></td>
                                                            
                                                        </tr>
                                                         <?php }?>
                                                    </tbody>
                                                </table>
                                                    <br/>
                                                <center><?php
                                                    
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