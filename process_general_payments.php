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
                        <div class="col-md-12" style="width:1090px;margin-left: -15px">
                                 
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div class="block-header">

                                         
                                        <div align="center">
                                            <h5 class="text-success">Personal Records of <?php  echo  $row1->TITLE . ' ' . $row1->FIRSTNAME . ' ' . $row1->LASTNAME . ' ' . $row1->OTHERNAMES; ?> </h5>
                                        </div>


                                    </div>
                                    <div class="block-header alert-success">


                                        <table   border="0" align="left" class="table   table-condensed"  >
                                            <tr>
                                                <td width="210" class="uppercase" align="right"><strong>Church N<u>O</u></strong></td>
                                                <td width="408" class="capitalize"><?php echo $row1->MEMBER_CODE ?></td>
                                                <td width="260" rowspan="5" > <img   <?php $pic = $help->pictureid($row1->MEMBER_CODE);
                                    echo $help->picture("photos/members/$pic.jpg", 190) ?>   src="<?php echo file_exists("photos/members/$pic.jpg") ? "photos/members/$pic.jpg" : "photos/members/user.jpg"; ?>" alt=" Picture of Member Here"  style="margin-top:-5px;margin-left: -70px"   /></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Branch:</strong></td>
                                                <td class="capitalize"><?php echo $member1->getBranch($row1->BRANCH); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Full Name:</strong></td>

                                                <td class="capitalize"><?php echo $row1->TITLE . ' ' . $row1->FIRSTNAME . ' ' . $row1->LASTNAME . ' ' . $row1->OTHERNAMES; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Birth Day:</strong></td>
                                                <td class="capitalize"><?php echo date('d/m/Y', $row1->DOB) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Member Since:</strong></td>
                                                <td class="capitalize"><?php echo date('d/m/Y', $row1->DATE_JOINED) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Giving Number</strong>:</td>
                                                <td class="capitalize"><?php echo $row1->GIVING_NUMBER ?></td>
                                            </tr>
                                             
                                            <tr>
                                                <td class="uppercase" align="right"><strong>Ministry</strong>:</td>
                                                <td class="capitalize"><?php echo $member1->getMinistry($row1->MINISTRY) ?></td>
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

          <form method="post" name="" action="new_payment_individual_action.php" id="process_general_payments" class="form-horizontal">
              <input type="hidden" name="giving_number" value="<?php echo $row1->GIVING_NUMBER;?>"/>
          <input type="hidden" name="m_id" id="m_id" value="<?php  echo $row1->ID ?>">
          <input type="hidden" name="name" id="name" value="<?php  echo $row1->TITLE . ' ' . $row1->FIRSTNAME . ' ' . $row1->LASTNAME . ' ' . $row1->OTHERNAMES ?>">
             
  <table id="paymentTable" class="table"border="0" style="font-weight:bold" style="cellpadding:0;">
	  <tr id="paymentRow" payment_row="payment_row"><td valign="top"><strong>Payment Type</strong></td>
	  <td >
	  <select name="paymentType[]" style="width:auto;" class="pay_type form-control" >
	  <option selected="selected" value="not_selected">Please Select</option>
                                                           
                      <?php 
                      global $sql;

                      $query2=$sql->Prepare("SELECT * FROM `perez_church_payment_type_info` ");


                        $query=$sql->Execute( $query2);


                     while( $row = $query->FetchRow())
                       {

                       ?>
                       <option value="<?php echo $row['payment_type_id']; ?>"   <?php  ?>      ><?php echo $row['payment_type_name']; ?></option>

                    <?php }?>
                        
	  </select>
	  </td>
	  <td valign="top">Amount (Ghc) &nbsp;<input type="text"  id="amt_1" sclass="input-small"  name="amt[]" style="width:auto;"></td>

     
	 
	  <td valign="top" id="insertPaymentCell"><button  type="button" id="insertPaymentRow" class="btn btn-success btn-small" ><i class=" fa fa-plus-circle"></i>  Add Another</button></td></tr>
	  </tr></table>
      </table>
      <table align="center">
        <tr><td >
        	<div class="input-prepend alert">
  <span class="add-on" style="font-size:17px;color:black;font-weight:bold;">Total ( GHc )</span>
  <span class="add-on" style="font-size:17px;color:black; font-weight:bold;" id="totalSum">0.00</span>
</div>
</td></tr>
        <tr><td><input type="submit" value="Save" class="btn btn-success btn-large">
      <input type="reset" value="Cancel" class="btn btn-danger btn-large">
    </td></tr></table>
      </form>



</div>
                                    </div>
                                    
                                   
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

         
	 
          <script>
function checkFormElements(){
var checked=true;
       $('#paymentTable .pay_type  :selected').parent().each(function(){
      if($(this).prop('selectedIndex') <= 0){
       // $('#process_general_payments :submit').prop('disabled','disabled');
    $('#alertInfo').css('display','block').html("There are errors in the form! Please correct and submit again!");
        checked=false;
      }
    }) ;

    $("table#paymentTable tr[payment_row] :text").each(function(){
          var inputNumber=$(this).val();
      if(isNaN(inputNumber) || inputNumber==null || inputNumber==""  || inputNumber==0 ) {
              //$('#process_general_payments :submit').prop('disabled','disabled');
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
$('#totalSum').html('0.00');
/*
      jQuery.validator.addMethod("checkSelect", function(value, element, params) {
return this.optional(element) || value == params[0] + params[1];
//console.log("value"+value+"element"+element+"params"+params);
}, jQuery.format("Please enter the correct value for {0} + {1}"));*/
$('#process_general_payments :submit').prop('disabled','');
//$('#alertInfo').css('display','block').html("Amount cant be zero and must be a valid number!\nPayment Type must be selected!");


$('#paymentTable .pay_type :selected').parent().each(function(){
  $(this).live('change blur',function(){
    if($(this).prop('selectedIndex') <= 0){
  //  $('#process_general_payments :submit').prop('disabled','disabled');
  }

  });
});


$('#paymentTable .pay_type  :selected').parent().each(function(){

    if($(this).prop('selectedIndex') <= 0){
    //$('#process_general_payments :submit').prop('disabled','disabled');
  }
});

$('#amt_1').bind('change blur keyup',function(){
  var checkAmount=$(this).val();
  if(checkAmount==null || checkAmount==""  || checkAmount==0 || isNaN(checkAmount)){
//     $('#process_general_payments :submit').prop('disabled','disabled');
     $('#alertInfo').css('display','block').html("Amount cant be zero and must be a valid number!");
     $(this).focus();
   }
   var count=0;
   $("table#paymentTable tr[payment_row] :text").each(function(){
          var inputNumber=$(this).val();
          if(isNaN(inputNumber) || inputNumber==null || inputNumber==""  || inputNumber==0 ) {
            $('#totalSum').html(count.toFixed(2));
          }
          else{
           count=count+parseFloat(inputNumber);
           $('#totalSum').html(count.toFixed(2));
          }

   });
});


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
          var inputNumber=$(this).val();
          if(isNaN(inputNumber) || inputNumber==null || inputNumber==""  || inputNumber==0 ) {
            $('#totalSum').html(count.toFixed(2));
          }
          else{
           count=count+parseFloat(inputNumber);
           $('#totalSum').html(count.toFixed(2));
          }

   });

  });

  // $('#amt_'+numOrgs).bind('focus',function(){
  //   console.log('hello from here');
  // });

//});


  $('#paymentTable .pay_type  :selected').parent().each(function(){
    if($(this).prop('selectedIndex') <= 0){
      //$('#process_general_payments :submit').prop('disabled','disabled');
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
        if (confirm("Do you want to make new payment?")) {
           $('#alertInfo').css('display','none').html("");
          return true;
         }
      else {
          return false;
      }
       }
             },
          url : 'ajaxProcessGeneralPayment.php',
          data : {
            requestType : "ajax"
          },
          success : function(msg) {
              alert('Payment successful')
            
          },
          failure : function() {
            alert('Sorry...failure occurred');
          }
        };

        $('#process_general_payments').ajaxForm(options, function(event) {

        });

});
</script>
  
       
 </body>
 </html>