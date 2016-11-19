<?php
require '_ini_.php';
require 'vendor/autoload.php';
require '_library_/_includes_/config.php';
require '_library_/_includes_/app_config.inc';
include('parsecsv.lib.php');
$crypt = new _classes_\cryptCls();
$member1 = new _classes_\Members();
$help = new _classes_\helpers();
$notify = new _classes_\Notifications();
$config_file = $help->getConfig();
$ledger = new _classes_\Ledger();
$login = new _classes_\Login();
$session=new _classes_\Session();
$member=$session->set('member', $_GET[member]);
$member=$session->get('member');
$query=$sql->Prepare("SELECT * FROM perez_members WHERE ID ='$member'");
$query=$sql->Execute($query);
$row1=$query->FetchNextObject();
 
if (isset($_GET[id])) {

    $payment = strip_tags($_GET['id']);
    // check if member exist ...//
    $query = $sql->Prepare("UPDATE perez_member_payments SET payment_status='disabled' WHERE ID='$payment'");
    $query = $sql->Execute($query);
     
    if ($query) {
        header("location:addMemberPayment.php?member=$member");
    } else {
        header("location:addMemberPayment.php?error=1");
    }
}
?>
<?php include("./_library_/_includes_/header.inc"); ?>
 
<script src="assets/scripts/vendors.js"></script>
	<script src="assets/scripts/plugins/screenfull.js"></script>
        <script src="assets/scripts/jquery.js"> </script>
<script src="assets/scripts/jquery.validate.min.js"></script>
        <script src="assets/scripts/jquery.form.js"></script>
          
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

                                <div class="panel-body">

                                    <div class="block-header">

                                         
                                        <div align="center">
                                            <h5 class="text-success">Adding Children (Child) of <?php  echo  $row1->TITLE . ' ' . $row1->FIRSTNAME . ' ' . $row1->LASTNAME . ' ' . $row1->OTHERNAMES; ?> </h5>
                                        </div>


                                    </div>
                                    <div class="block-header alert-success">


                                        <table   border="0" align="left" class="table   table-condensed"  >
                                            <tr>
                                                <td width="210" class="uppercase" align="right"><strong>Church N<u>O</u></strong></td>
                                                <td width="408" class="capitalize"><?php echo $row1->MEMBER_CODE ?></td>
                                                <td width="260" rowspan="5" > <img   <?php $pic = $help->pictureid($row1->MEMBER_CODE);
                                    echo $help->picture("photos/members/$pic.jpg", 110) ?>   src="<?php echo file_exists("photos/members/$pic.jpg") ? "photos/members/$pic.jpg" : "photos/members/user.jpg"; ?>" alt=" Picture of Member Here"  style="margin-top:-5px;margin-left: -70px"   /></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Branch:</strong></td>
                                                <td class="capitalize"><?php echo $member1->getBranch($row1->BRANCH); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Full Name:</strong></td>

                                                <td class="capitalize"><?php echo $row1->TITLE . ' ' . $row1->FIRSTNAME . ' ' . $row1->LASTNAME . ' ' . $row1->OTHERNAMES; ?></td>
                                            </tr>
                                             
                                        </table>
                                    </div>

                                    <p>&nbsp;</p>
                                    <div class="block-header">
                                        <center><div class="alert-dismissable alert-success alert"><?php print_r( $_SESSION['message']); ?></div></center>
                                         <?php
                                         
            if (isset($_SESSION['reg_error_msg']) && !empty($_SESSION['reg_error_msg'])) {
              echo '<center><div class="alert" id="alertInfo" style=" font-weight: bold;"></center>';
              echo $_SESSION['reg_error_msg'];
              echo '  </div>';

              $_SESSION['reg_error_msg'] = '';
            } else {
              echo '<center><div class="text-danger alert" id="alertInfo" style=" font-weight: bold;display:none;"> </div></center>';
            };
            ?>
          <!-- </div> -->

<div style=" " id="payment_div">

          <form method="post" name="childForm" action="" id="new_payment_individual_form" class="form-horizontal" enctype="multipart/form-data" >

          <input type="hidden" name="member" id="m_id" value="<?php  echo $_SESSION[member] ?>">
             
  <table id="paymentTable" class="table"border="0" style="font-weight:bold" style="cellpadding:0;">
	  <tr id="paymentRow" payment_row="payment_row"> 
	  <td >
              <div class="form-group">
                <label class="col-lg-4 control-label">Name <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" name="name[]" id="member_lastname" class="form-control check-duplicates"  autocomplete="off">
                     
                </div>
            </div>
	  </td>
	  <td valign="top">Date of Birth &nbsp;
               <div class="form-group">
                 <div class="col-lg-8">
             
                   <input type="text" class="form-control" id="datepickerDemo1" placeholder="2/12/1990" required="" name="dob[]"/>
                </div>
               </div>
                     
          </td>

 
	  <td valign="top">
            <div class="col-md-9" style="margin-left: 12%">
                                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                                 
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
                                                     
                                                    <input type="file" class="form-control input-sm" name="images[]" >
                                                    
                                                </div>
                                                     
                                            </div>

                                         
                                    </div>

	  </td>
	  
	  <td valign="top" id="insertPaymentCell"><button  type="button" id="insertPaymentRow" class="btn btn-success btn-small" ><i class=" fa fa-plus-circle"></i>  Add Another</button></td></tr>
	  </tr></table>
      </table>
      <table align="center">
         
        <tr><td><input type="submit" value="Save" class="btn btn-success btn-large">
      <input type="reset" value="Cancel" class="btn btn-danger btn-large">
    </td></tr></table>
      </form>



</div>
                                    </div>
                                    
                                  
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

         
	 
          <script>
function checkFormElements(){
var checked=true;
        

    $("table#paymentTable tr[payment_row] :text").each(function(){
          var inputNumber=$(this).val();
      if(inputNumber==null || inputNumber=="") {
              //$('#new_payment_individual_form :submit').prop('disabled','disabled');
      $('#alertInfo').css('display','block').html("There are errors in the form! Please correct and submit again!");
         checked=false;
          }
   });
      if(checked==false){
        alert("There are errors in the form! Please correct and submit again!");
      }
      return checked;


}

$(document).ready(function(){
 
/*
      jQuery.validator.addMethod("checkSelect", function(value, element, params) {
return this.optional(element) || value == params[0] + params[1];
//console.log("value"+value+"element"+element+"params"+params);
}, jQuery.format("Please enter the correct value for {0} + {1}"));*/
$('#new_payment_individual_form :submit').prop('disabled','');
//$('#alertInfo').css('display','block').html("Amount cant be zero and must be a valid number!\nPayment Type must be selected!");


 


 
 

$("#insertPaymentRow").bind('click',function(){

    var numOrgs=$(" table#paymentTable tr[payment_row]").length+1;
	  var newOrg=$("table#paymentTable tr:first ").clone(true);

   $(newOrg).children(' td#insertPaymentCell ').html('<button  type="button" id="removePaymentRow_'+numOrgs+'" class="btn btn-danger btn-small" ><i class="fa fa-minus"></i>  Remove</button>');

    var amountLine=$(newOrg).children('td')[2];
    $(amountLine).children(':last-child').prop('value','');

  var amountInput=$(amountLine).children(':last-child');

  $(amountInput).prop('id','amt_'+numOrgs);

    $(newOrg).attr('id','paymentRow_'+numOrgs);

    $(newOrg).insertAfter($("table#paymentTable tr:last"));

   $('#removePaymentRow_'+numOrgs).bind("click",function(){
   // $(amountInput).trigger('keyup');
    $('#paymentRow_'+numOrgs).remove();
    var count=0;
   $("table#paymentTable tr[payment_row] :text").each(function(){
          

   });

  });

  // $('#amt_'+numOrgs).bind('focus',function(){
  //   console.log('hello from here');
  // });

//});


  $('#paymentTable .pay_type  :selected').parent().each(function(){
    if($(this).prop('selectedIndex') <= 0){
      //$('#new_payment_individual_form :submit').prop('disabled','disabled');
    //  $('#alertInfo').css('display','block').html("Please select a payment type!");
     }
   });
//console.log($(this).prop('name')+"->"+$('#paymentTable .pay_type  :selected').parent().length);

});




var options = {
          beforeSubmit : function() {
        if(!checkFormElements()){
           $('#alertInfo').css('display','block').html("There are errors in the form! Please correct and submit again!");
          return false;
        }

      else {
        //
       }
             },
          url : 'processChild.php',
          data : {
            requestType : "ajax"
          },
          success : function(msg) {
             // window.href.location="viewChild.php";
            alert("Child added successfully");
                 },
          failure : function() {
            alert('Sorry...failure occurred');
          }
        };

        $('#new_payment_individual_form').ajaxForm(options, function(event) {

        });

});
</script>
  
       
 </body>
 </html>