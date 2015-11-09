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
         if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        $_SESSION[content]=$_POST[content];
        }

         
        if(isset($_GET[delete])){
            $query=$sql->Prepare("DELETE FROM perez_group_category WHERE ID='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:group_category?success=1");
            }
        }
         if(isset($_POST[create])){
             $position = implode(",",$_POST["positions"]);
             $details=  trim($_POST[details]);
             $name=  trim($_POST[name]);
             $notify=  trim($_POST[notify]);
             $check=trim($_POST[check]);
             if($check==""){
            $query=$sql->Prepare("INSERT INTO perez_group_category SET NAME='$name',POSITION='$position',DETAILS='$name',NOTIFY_LEADER='$notify'");
             }
             else{
                 $query = $sql->Prepare("UPDATE perez_group_category SET NAME='$name',POSITION='$position',DETAILS='$name',NOTIFY_LEADER='$notify' WHERE ID='$check'");
                }
            if($sql->Execute($query)){
                header("location:group_category?success=1");
            }
            else{
                header("location:group_category?error=1");
            }
        }
        
        
           
?>
<?php include("./_library_/_includes_/header.inc"); ?>
 <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
<body id="app" class="app off-canvas">
     
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
		<div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Group Category</h4>
                                        </div>
                                        <div class="modal-body">
                                    
                                            <form action="group_category?1" method="post" class="form-horizontal row-border"   id="form" data-validate="parsley" >
                                               <div class="form-group">
                                                    
                                                <label class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" required="required" name="name">

                                                </div>

                                            </div>
                                               <div class="form-group">
                                                <label class="col-sm-3 control-label">Notify Leader</label>
                                                <div class="col-sm-6">
                                                                    <div class="item checkbox ui-checkbox ui-checkbox-success">
                                             <label class="">
                                                 <input type="checkbox" name="notify" value="1" <?php if($rtmt->NOTIFY_LEADER=="1"){ echo "checked='checked'";} ?>><span>Send sms to leader  <i class="fa fa-question-circle fa-fw" title="Uncheck this box to not to send sms to the leader on being choosen as leader" data-toggle="tooltip"></i></span></label>
                                         </div>  </div>
                                            </div>                    
                                         <div class="form-group">
                                                <label class="col-sm-3 control-label">Positions</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="positions[]"   rows="2" data-trigger="hover" data-toggle="popover" data-content="click on the rectangular box at the extreme right to get fullscreen notepad" data-original-title="Notepad"></textarea>
                                                </div>
                                            </div>
                                            
                                             
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Details about category</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="details"   rows="2" data-trigger="hover" data-toggle="popover" data-content="click on the rectangular box at the extreme right to get fullscreen notepad" data-original-title="Notepad"></textarea>
                                                </div>
                                            </div>
                                            



                                            <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="btn-toolbar">
                                                        <button type="submit" name="create" class="btn-primary btn btn-success">Save</button>
                                                        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                  </div>
                                </div>
                        </div>
                </div>
		<!-- content-here -->
		<div class="content-container" id="content">
                     
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Group Management</li>
					<li class="active"><a href="#">Group Categories</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                <div style="margin-top:-2.5%;float:right">
                                                     
                                                        <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" data-toggle="dropdown"><i class="md md-save"></i> Export Data</button>
                                                        <ul class="dropdown-menu">
                                            
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'csv',escape:'false'});"><img src='assets/icons/csv.png' width="24"/> CSV</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'txt',escape:'false'});"><img src='assets/icons/txt.png' width="24"/> TXT</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});"><img src='assets/icons/xls.png' width="24"/> XLS</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'doc',escape:'false'});"><img src='assets/icons/word.png' width="24"/> Word</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'powerpoint',escape:'false'});"><img src='assets/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'png',escape:'false'});"><img src='assets/icons/png.png' width="24"/> PNG</a></li>
                                                            <li><a href="#" onClick ="$('#gad').tableExport({type:'pdf',escape:'false'});"><img src='assets/icons/pdf.png' width="24"/> PDF</a></li>
                                                         </ul>
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a data-target="#sms" data-toggle="modal"  style="margin-top: -17px;margin-left: -25px"  title="create a new group"  class="btn btn-pink waves-effect btn-sm">Create Group Category<i class="fa fa-plus-circle"></i></a>
                                                 
                                               
                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Table View</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">List View</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <form action="group_category?" method="post" >
                                                        <table  width=" " border="0">
                                                            <tr>


                                                                <td width="25%">
                          
                                                         
                                                        <input type="text" name ="search" placeholder="search here"required="" style="margin-left:13%;  width:151% " class="form-control" id=" "  >

                                                    </td>
                                                    <td>&nbsp;</td>
                                                     <td width="25%">
                                                         <select class='form-control'  name='content' required="" style="margin-left:55%;  width:91% "  >
                                                                       <option value=''>search by</option>

                                                                      <option value='NAME'<?php if($_SESSION[content]=='SURNAME'){echo 'selected="selected"'; }?>>By Name</option>
                                                                      <option value='POSITION'<?php if($_SESSION[status]=='FIRSTNAME'){echo 'selected="selected"'; }?>>By Position</option>

                                                                  </select>

                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td width="25%">
                                                          <button type="submit" name="go" style="margin-left:5%;width: 65px " class="btn btn-primary">Go</button>
                                                    </td>
                                                  </tr>  

                                              </form>

                                       </table>
                                               
                                                <!-- end filters   -->
                                                 
                                                 
                                                <div class="table-responsive">
                                                    <?php
                                                                                               
                                                             
                                                            $search=$_POST[search];
                                                            $content=$_POST[content];
                                            
                                                            if($search=="" ){ $search=""; }else {$search_="AND $content LIKE '$search' "  ;}

                                                            $query="SELECT  * FROM  perez_group_category  where 1      $search_ " ;
                                                           print_r( $_SESSION[last_query]=$query); 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="assesment" class="table   display" >
                                                    <thead>
                                                        <tr>
                                                             <th>#</th>
                                                             <th></th>
                                                               
                                                            <th>Name</th>
                                                            <th>Details</th>
                                                            <th>Notify Leader</th>
                                                            <th>Positions</th>
                                                             
                                                             
                                                            <th colspan="5"  >Actions</th>
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
                                                                           <label><input type="checkbox" name="box[]"><span></span>
                                                                               </label>
                                                                       </div>
                                                                </td>
                                                                  <td style="text-align:"><?php echo $rtmt[NAME] ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[DETAILS] ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[NOTIFY_LEADER] ?></td>
                                                                        <td style="text-align:"><?php echo $rtmt[POSITION] ?></td>
                                                                         
                                                            
                                                               
                                                                        <td><a style="cursor: pointer" title="click to edit" onclick="return MM_openBrWindow('edit_category.php?item=<?php echo $rtmt[ID] ?>','','menubar=yes,width=700,height=450')"  >Edit <i class="md md-edit" title="click to edit info"></i></a> 
                                                                  
                                                             
                                                             <a onclick="return confirm('Are you sure you want to delete this group category??')" href="group_category?delete=<?php echo  $rtmt[ID] ?>">Delete<i class="md md-delete" title="click to delete"></i> </a></td>
                                                            
                                                        </tr>
                                                         <?php } $_POST[search]="";
                                                            $_POST[content]="";?>
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
        
 
</body>

</html>