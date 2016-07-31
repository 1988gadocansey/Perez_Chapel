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
         $groups=new _classes_\Group();
        $sms=new _classes_\smsgetway();
         if($_GET[type]){
        $_SESSION[type]=$_GET[type];
          $_SESSION[start]="";
            $_SESSION[end]="";
        }
         
         
         
        if(isset($_GET[end])){
        $_SESSION[end]=  date('Y-m-d',  strtotime($_GET[end]));
        }
        if(isset($_GET[start])){
        $_SESSION[start]=  date('Y-m-d',strtotime($_GET[start]));
        }
         
         
        if($_POST[go]){
        $_SESSION[search]=$_POST[search];
        
        }
         
        if(isset($_GET[delete])){
            $query=$sql->Prepare("UPDATE perez_church_payments SET payment_status='disabled' WHERE id='$_GET[delete]'");
            if($sql->Execute($query)){
                header("location:viewChurchPayments?success=1");
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
       
        <!-- #end main-navigation -->

        <!-- content-here -->
        <div class="content-container" id="content">

                                    
                 
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>Fund Management</li>
					<li class="active"><a href="#">General Payments Reports</a></li>
				</ol>
                            
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
						 
                                                 <div style="margin-top:31px;float:right">
                                                      
                                                             <button   class="btn btn-primary  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="$('#gad').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                                                             <button   class="btn btn-success  waves-effect waves-button dropdown-toggle" style="margin-top: -59px" onClick ="javascript:printDiv('print')" title="click to print"><i class="fa fa-print"></i>Print</button>
                                                      </div>
                             <div><?php $notify->Message(); ?></div>
					</div>
                                <div class="row">
                                    <!-- Basic Table -->
                                     <div class="col-md-12" style="width:1200px;margin-left: -95px">
                                        <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">
                                            <div class="panel-heading panel-info">
                                                <a href="create_church_payment.php"  style="margin-top: -17px;margin-left: -25px"  title="create a new group"  class="btn btn-pink waves-effect btn-sm">Make General Payment<i class="fa fa-plus-circle"></i></a>
                                                 
                                               
                                                <div class="btn-group btn-group-sm right">
                                                    <button type="button" class="btn btn-default btable-bordered" data-table-class="table-bordered">Table View</button>
                                                    <button type="button" class="btn btn-default btable-striped" data-table-class="table-stiped">List View</button>
                                                    <button type="button" class="btn btn-default btable-condensed" data-table-class="table-condensed">Condensed</button>
                                                    <button type="button" class="btn btn-default btable-hover" data-table-class="table-hover">Hover</button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                 <div class="table-responsive">
                                                        <table  width=" " border="0">
                                                            <tr>


                                                                <td width="20%">

                                                                    <select class='form-control select2_sample1'     style="margin-left:0%; width:190px " onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?type='+escape(this.value);" >
                                                                        <option value=''>Filter by payment types</option>
                                                                        <option value='All type'>All Payment types</option>
                                                                        <?php
                                                                        global $sql;

                                                                        $query2=$sql->Prepare("SELECT * FROM `perez_church_payment_type_info` ");


                                                                            $query=$sql->Execute( $query2);


                                                                         while( $row = $query->FetchRow())
                                                                           {?>
                                                                        <option <?php if ($_SESSION[type] == $row['payment_type_id']) {
                                                                            echo 'selected="selected"';
                                                                        } ?> value="<?php echo $row['payment_type_id']; ?>"        ><?php echo $row['payment_type_name']; ?></option>

                                                                        <?php } ?>
                                                                    </select>

                                                                </td>

 
                                                             
                                           <td width="25%">
                                             <div class="input-group date" id="datepickerDemo" style="margin-left: 10px;width:266px">
                                                 <input type="text" class="form-control"      placeholder="payments date from" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?start='+escape(this.value);"   />
                                                 <span class="input-group-addon">
                                                     <i class=" fa fa-calendar"></i>
                                                 </span>
                                             </div>
                                           </td> 
                                                     
                                          
                                           <td width="25%">
                                               <div class="input-group date" id="datepickerDemo1" style="margin-left:10px;width:266px">
                                                   <input type="text" class="form-control"   onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?end='+escape(this.value);" placeholder="payment date to"   />
                                                <span class="input-group-addon">
                                                    <i class=" fa fa-calendar"></i>
                                                </span>
                                            </div>

                                           </td>
                                           <td>&nbsp;</td>
                                           
                                           
                                         
                                          <form action=" " method="post" >
                                              <td width="25%">


                                                  <input type="text" name ="search" placeholder="search by giving number.."required="" style="  width: 195px;" class="form-control" id=" "  >

                                              </td>
                                             

                                              <td width="25%">
                                                  <button type="submit" style="margin-left: -69px" name="go" style="" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                              </td>
                                         </form> 
                                             </tr>  

                                        

                                               
                                       </table>
                                       
                                </div>
                                               
                                                <!-- end filters   -->
                                                 
                                                 <hr>
                                                <div class="table-responsive" id="print">
                                                    <?php
                                                             $config_file=$help->getConfig() ;                                  
                                                            $type=$_SESSION[type];
                                                             
                                                            $start=$_SESSION[start];
                                                             $end=$_SESSION[end];
                                                            
                                                             if(!empty($start) && !empty($end)){
                                                                 $date_="AND date BETWEEN '$start' AND '$end'";
                                                             }
                                                             elseif(!empty ($start)){
                                                                 $date_="AND date = '$start'";
                                                                  $_SESSION[end]="";
                                                             }
                                                             elseif(!empty ($end)){
                                                                 $date_="AND date <= '$end'";
                                                                  $_SESSION[start]="";
                                                             }
                                                            $search=$_POST[search];
                                                            

                                                            if($type=="All type" or $type==""){ $type=""; }else {$type_=" and  payment_name = '$type' "  ;}
                                                             
                                                            
                                                            
                                                            if($search=="" ){ $search=""; }else {$search_="AND giving_number = '$search' "  ;}

                                                            $query="SELECT * FROM `perez_church_payments` WHERE 1 AND payment_status='enabled' $type_     $search_  $date_   " ;
                                                          //  print_r( $_SESSION[last_query]=$query); 

                                                            $rs = $sql->PageExecute($query,RECORDS_BY_PAGE,CURRENT_PAGE);
                                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                                           if (!$rs->EOF) 

                                                           {
                                               
                                                    ?>
                                                <table id="gad" class="table   display" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Giving N<u>o</u></th>
                                                             <th>Photo</th>
                                                              <th>Member</th>
                                                                
                                                                <th>Payment Type</th>
                                                               
                                                                <th>Amount</th>
                                                                <th>Date</th>
                                                                 
                                                             
                                                            <th colspan=""  >Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <p align="center"style="color:red">  <?php echo $recordsFound ?> Records </p>
                                                    <tbody>
                                                        <?php

                                                          $count=0;
                                                           while($rtmt=$rs->FetchRow()){
                                                               $member=$help->getMemberDetail($rtmt[member] );
                                                                
                                                                                   $count++;
                                                                                   $totalAmount[]=$rtmt[amount] ;

                                                              ?>
                                                           <tr>
                                                               <td><?php echo $count ?></td>
                                                               <td style="text-align:"><?php echo $member->GIVING_NUMBER ?></td>
                                                                <td><img  <?php   $pic=  $help->pictureid($member->MEMBER_CODE );  echo$help->picture("photos/members/$pic.JPG",'90')  ?>   src="<?php echo file_exists("photos/members/$pic.JPG") ? "photos/members/$pic.JPG":"photos/members/user.jpg";?>" alt=" Picture of member Here"    /></td>
                                                                <td style="text-align:"><?php echo $member->TITLE." ". $member->FIRSTNAME." ". $member->LASTNAME; ?></td>
                                                                
                                                                <td style="text-align:"><?php echo $help->getGeneralPaymentName($rtmt[payment_name]) ?></td>
                                                                
                                                                <td style="text-align:">GHc<?php echo $help->formatMoney($rtmt[amount]) ?></td>
                                                                <td style="text-align:"><?php echo date("d/m/Y", $rtmt[date]); ?></td>
                                                        
                                                             <td>  
                                                             
                                                                 <a onclick="return confirm('Are you sure you want to disable this payment??')" href="viewChurchPayments?delete=<?php echo  $rtmt[id] ?>"><i class="fa fa-trash-o" title="click to delete"></i> </a>
                                                             </td>
                                                            
                                                        </tr>
                                                        
                                                         <?php }?>
                                                        </tbody>
                                                </table>
                                                    <div style=" margin-left: 633px"> <tr><td colspan=" ">Total Amount <b>GHc<?php echo $help->formatMoney(array_sum($totalAmount)); ?></b></td></tr></div>
                                                     <center><table>
                                                             <tr>
                                                         
                                                                 <td>
                                                                      <table>
                                                             <tr>
                                                                 <td><img src="uploads/pastor.jpg" style="width:30px;height: auto"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                 <b><?php echo $config_file->CHURCH_HEAD_PASTOR  ?></b><br/>
                                                                (Head Pastor)
                                                            </td>
                                                        </tr>
                                                         </table>
                                                                 </td>
                                                                 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                 <td>
                                                                      <table>
                                                             <tr>
                                                            <td><img src="uploads/finance.jpg" style="width:30px;height: auto"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <b><?php echo $config_file->CHURCH_FINANCE_DIRECTOR  ?></b><br/>
                                                                (Finance Director)
                                                            </td>
                                                        </tr>
                                                         </table>
                                                                 </td>
                                                             </tr>
                                                        
                                                        
                                                         </table>
                                                     
                                                        
                                                     
                                                     </center>
                                                     
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

	<?php include("./_library_/_includes_/js.php"); ?>
      
<script src="assets/scripts/vendors.js"></script>
<script src="assets/scripts/plugins/screenfull.js"></script>
	<script src="assets/scripts/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/scripts/plugins/waves.min.js"></script>
	<script src="assets/scripts/plugins/select2.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-colorpicker.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-slider.min.js"></script>
	<script src="assets/scripts/plugins/summernote.min.js"></script>
	<script src="assets/scripts/plugins/bootstrap-datepicker.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/form-elements.init.js"></script>
        <script src="assets/scripts/plugins/jquery.dataTables.min.js"></script>
	<script src="assets/scripts/app.js"></script>
	<script src="assets/scripts/tables.init.js"></script>
 <?php include("_library_/_includes_/export.php");  ?>
        <script>
            $(document).ready(function() {
                $('#gad').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'colvis'
                    ]
                } );
            } );
        </script>
        <script src="assets/scripts/select2.min.js"></script>
       
        <script>
                 $(document).ready(function(){
                    $('select').select2({ width: "resolve" });


                  });
        </script>
</body>

</html>