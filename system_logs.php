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
        $ledger=new _classes_\Ledger();                           
        $login=new _classes_\Login();
          $user=new _classes_\Users();
          
        
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
		<aside class="nav-wrap" id="site-nav" data-perfect-scrollbar>
			
                    <?php include("./_library_/_includes_/menu.inc"); ?>
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                    
                                            
                                           
                         
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Systems</li>
					<li class="active"><a href="#">Access Logs</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						        
                                                <div style="margin-top:-2.5%;float:right">
                                                       <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#assesment').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
                                                        
                                              </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <div class="col-md-12">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                             
                                            <div class="panel-body">
                             
                                         <table  width=" " border="0">
                                         <tr>

                                         <form action="system_logs" method="post" class="form-horizontal row-border"   id="form">

                                          <td width="25%">
                                              
                                              

                                              <input placeholder="date from" id="datepickerDemo" name="start" type="text" class="form-control"  style="margin-left: 6px"   required=""/>
 
                                             
                                          </td> 
                                           <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                             

                                               <input placeholder="date to" style="margin-left:10%" id="datepickerDemo1" name="end" type="text" class="form-control"     required=""/>

                                            
                                            
                                           </td>
                                           <td>&nbsp;</td>
                                           <td>
                                                <select class="form-control" name='type'id='source' style="margin-left:20%"    >
                                                    <option value=''>Select Transaction types</option>
                                                  
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT DISTINCT EVENT_TYPE  FROM perez_system_log");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                       
                                                                    ?>
                                                                    <option value="<?php echo $EVENT_TYPE; ?>"><?php echo $EVENT_TYPE; ?></option>
                                                              <?php }?>

                                                        </select>
                                                   </td>
                                                    <td>
                                                <select class="form-control" name='username'id='source' style="margin-left:28%"    >
                                                    <option value=''>Select user account</option>
                                                  
                                                              <?php
                                                                   $STM = $sql->prepare("SELECT  DISTINCT ID, USERNAME  FROM perez_auth");
                                                                   $stmt=$sql->Execute($STM);
                                                                  
                                                                    $num=0;
                                                                    while($row = $stmt->FetchRow())
                                                                    {
                                                                        extract($row);
                                                                       
                                                                    ?>
                                                                    <option value="<?php echo $ID; ?>"><?php echo $USERNAME; ?></option>
                                                              <?php }?>

                                                                    </select>
                                                               </td>
                                                       <td>&nbsp;</td>

                                                       <td>
                                                           <button style="margin-left: 64%" type="submit" name="submit"class="btn-primary btn btn-success">search</button>
                                                       </td>
                                                    </tr>
                                                   </table>
                                                </form>
      
                           <div>
                            <p>&nbsp;</p>
                            <!-- end filters   -->
        <div class="table-responsive">
               <a onclick="javascript:printDiv('print')" title="Click to print report"><i class="fa fa-print"></i></a>                                                           
              <div id="print">
                <?php
                if(isset($_POST['submit'])){
                     
                            $end_date=date("Y-m-d",  strtotime($_POST[end]));
                            $start_date=date("Y-m-d",  strtotime($_POST[start]));
                          $username=$_POST[username];
                             $type=$_POST[type];
                            if(!empty($type)){
                                $l="AND EVENT_TYPE='$type'";
                            }
                            
                            if(!empty($username)){
                                $u="AND USERNAME='$username'";
                            }
                            $end=" WHERE  DATE(INPUTEDDATE)  BETWEEN '$start_date' AND '$end_date'  $l $p $u  ";
                    }
                


                    $query= $sql->Prepare( "SELECT * FROM perez_system_log $end ORDER BY INPUTEDDATE DESC");
                    print_r($query);
                    $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                   $recordsFound =$rs->_maxRecordCount;    // total record found
                  if (!$rs->EOF) 

                    {
                    ?>
                   <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                   <table  class='table  table-hover' id='assesment'>      
                    <thead>
                                <tr>
                                    
                                     <th>NO</th>
                                     <th data-column-id="Student" data-type=" " data-toggle="tooltip">USERNAME</th>
                                     <th data-column-id="Subject" data-type=" " data-toggle="tooltip">EVENT TYPE</th>
                                    <th style="text-align:center" data-type="string" data-column-id="Class" style="">ACTIVITIES</th>
                                   
                                    <th data-column-id="Academic Year" data-order="asc" style="text-align:center">HOSTNAME</th>
                                    <th data-column-id="Term" style="text-align:center">IP ADDRESS</th>
                                     <th data-column-id="Class Score">BROWSER USED</th>
                                    <th data-column-id="Exam Score" data-order="asc" style="text-align:center">MAC ADDRESS</th>
                                     <th data-column-id="Total" data-order="asc" style="text-align:center">DATE TIME</th>
                                      
                                </tr>
                            </thead>
             <?php
                $count=0;
               
                
                            while($rtmt=$rs->FetchRow()){
                                        $count++;
                                        $person=$user->user($rtmt[USERNAME]);             						
                               ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td style="text-align:left"><?php  echo $person->USERNAME; ?></td>
                                    <td><?php echo $rtmt[EVENT_TYPE] ?></td>
                                    <td><?php echo $rtmt[ACTIVITIES] ?></td>
                                    <td><?php echo $rtmt[HOSTNAME] ?></td>
                                    <td><?php echo $rtmt[IP] ?></td>
                                    <td><?php echo $rtmt[BROWSER_VERSION] ?></td>
                                    <td><?php echo $rtmt[MAC_ADDRESS] ?></td>
                                    <td><?php echo date("F j, Y, g:i a",  strtotime($rtmt[INPUTEDDATE])) ?></td>
                                    </tr>
                                    <?php }?>
                            </tbody>
                          </table><?php
            echo "</table> 
            <br/>
                                                <center>";
                                                    $GenericEasyPagination->setTotalRecords($recordsFound);

                                                   echo $GenericEasyPagination->getNavigation();
                                                   echo "<br>";
                                                   echo $GenericEasyPagination->getCurrentPages();
                                                  echo"</center>";
           } else{
                        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                              Oh snap!. No record to display 
      </div>";
         }
?>
 
     
    
            <small>  Generated on <?php echo gmdate("D, d M Y H:i:s") . " GMT";?></small>
 
        </div>
        </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

                    <script src="asset/vendors.js"></script>
	<script src="asset/screenfull.js"></script>
	<script src="asset/perfect-scrollbar.min.js"></script>
	<script src="asset/waves.min.js"></script>
	<script src="asset/select2.min.js"></script>
	<script src="asset/bootstrap-colorpicker.min.js"></script>
	<script src="asset/bootstrap-slider.min.js"></script>
	<script src="asset/summernote.min.js"></script>
	<script src="asset/bootstrap-datepicker.min.js"></script>
        <script src="asset/app.js"></script>
        <script src="asset/form-elements.init.js"></script>
         
</body>

</html>