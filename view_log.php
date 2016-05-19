<?php
require '_ini_.php';
require 'vendor/autoload.php';
require '_library_/_includes_/config.php';
require '_library_/_includes_/app_config.inc';
include('parsecsv.lib.php');
$crypt = new _classes_\cryptCls();
$member = new _classes_\Members();
$help = new _classes_\helpers();
$notify = new _classes_\Notifications();
$config_file = $help->getConfig();
$ledger = new _classes_\Ledger();
$login = new _classes_\Login();
if($_GET[user]){
        $_SESSION[user]=$_GET[user];
        }
        if($_POST[end]){
        $_SESSION[end]=   date('Y-m-d', strtotime($_POST[end])) ;
        }
        if($_POST[start]){
        $_SESSION[start]=  date('Y-m-d', strtotime($_POST[start])) ;
        }
 
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
                        <div class="table-responsive" id="">
                        <table  width=" " border="0">
                                                            <tr>


                                                                <td width="20%">

                                                                    <select class='form-control select2_sample1'     style="margin-left:0%;" onchange="document.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?user='+escape(this.value);" >
                                                                        <option value=''>Filter by Users</option>
                                                                        <option value='All Users'>All Users</option>
                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_auth ");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option <?php if ($_SESSION['user'] == $row['ID']) {
                                                                            echo 'selected="selected"';
                                                                        } ?> value="<?php echo $row['ID']; ?>"        ><?php echo $row['USERNAME']; ?></option>

                                                                        <?php } ?>
                                                                    </select>

                                                                </td>


                                                                <td>&nbsp;</td>
                                                                 
                                                                
                                            
                                                
                                                    <td>&nbsp;</td>
                                                            <form action="" method="POST">
                                           <td width="25%">
                                             <div class="input-group date" id="datepickerDemo" style="margin-left: 12px">
                                                 <input type="text" class="form-control" required="" name="start" value="<?php echo $_POST[start]  ?>" placeholder="date from"    />
                                                 <span class="input-group-addon">
                                                     <i class=" fa fa-calendar"></i>
                                                 </span>
                                             </div>
                                           </td> 
                                                     <td>&nbsp;</td>
                                          
                                           <td width="25%">
                                               <div class="input-group date" id="datepickerDemo1" style="margin-left: 4px">
                                                   <input type="text" class="form-control" value="<?php echo $_POST[end]  ?>"   placeholder="date to" name="end"  />
                                                <span class="input-group-addon">
                                                    <i class=" fa fa-calendar"></i>
                                                </span>
                                            </div>

                                           </td>
                                           <td>&nbsp;</td>
                                           <td>
                                               <button type="submit" name="save" class="btn btn-success">search <i class="fa fa-search"></i></button>
                                                   
                                           </td>
                                          </form>
                                                            <td><img onclick="javascript:printDiv('print')" src="assets/images/printer.png"/></td>
                                        </tr>
                        </table></div>

                        <div><?php $notify->Message(); ?></div>
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12"  style="width:1200px;margin-left: -95px">
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <?php
                                                            $start=$_SESSION[start];
                                                             $end=$_SESSION[end];
                                                            $user=$_SESSION[user];
                                                             
                                                             

                                                            if($user=="All Users" or $user==""){ $user=""; }else {$user_=" and  USERNAME = '$user' "  ;}
                                                            if($end=="" or $end==""){ $end=""; }else {$end_=" and  DATE(INPUTEDDATE) = '$end' "  ;}
                                                            if($start=="" or $start==""){ $start=""; }else {$start_=" and  DATE(INPUTEDDATE) = '$start' "  ;}
                                            
                                    
                                    
                                    
                                            if(empty($end)){
                                            $query = $sql->Prepare("SELECT * FROM perez_system_log  WHERE 1 $user_ $start_ $end_ ORDER BY INPUTEDDATE DESC");
                                            }
                                            else{
                                                 $query = $sql->Prepare("SELECT * FROM perez_system_log  WHERE 1 $user_ AND DATE(INPUTEDDATE) BETWEEN ('$start') AND   ('$end') ORDER BY INPUTEDDATE DESC");
                                          
                                            }
                                            //print_r($query);
                                            $rs = $sql->PageExecute($query, RECORDS_BY_PAGE, CURRENT_PAGE);
                                            $recordsFound = $rs->_maxRecordCount;    // total record found
                                            if (!$rs->EOF) {


                                    ?>
               <center><caption><?php echo $recordsFound;?> Record(s)</caption></center>
                          
                    <div class="table-responsive" id="print">
                        <table id="data-table-command" class="table table-striped table-vmiddle table-hover"  >
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
                            <tbody>
                                <?php
                                   $count=0;
                                    while($rtmt=$rs->FetchRow()){
                                                            $count++;
                                                             						
                                       ?>
                                    <tr>
                                    
                                     <td><?php echo $count ?></td>
                                     <td style="text-align:left"><?php  $rtmt[USERNAME]; ?></td>
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
                          </table>
                    
                        <br/>
                     <center><?php
                     
                         $GenericEasyPagination->setTotalRecords($recordsFound);
	  
                        echo $GenericEasyPagination->getNavigation();
                        echo "<br>";
                        echo $GenericEasyPagination->getCurrentPages();
                      ?></center>
                    </div>
                            
                                    <?php }else{
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                 No record to display!                             </div>";
             }?>
                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

    </div>
</body>

 <?php include('./asset/js.php');?>            

            </body>

            </html>