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

if (isset($_POST[submit])) {

    $name = strip_tags($_POST['name']);
    // check if member exist ...//
    $query1 = $sql->Prepare("INSERT INTO perez_church_payment_type_info SET payment_type_name='$name',status='enabled'");
    $query = $sql->Execute($query1);
     
    if ($query) {
        header("location:view_church_payment_types.php?success=1");
    } else {
        header("location:create_church_payment.php?error=1");
    }
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
                 
                <p>Create Member Payment Types</p>
                <div class="page-wrap">
                    <div class="note note-success note-bordered">


                        <div><?php $notify->Message(); ?></div>
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12">
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div>

                                        <form  action="create_church_payment.php?submit=1" method="post"class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form" novalidate="" name="applicationForm"  v-form>
                                            <p>&nbsp;</p>

                                            <div class="form-group">

                                                <label for="fieldname" class="col-md-3 control-label">Payment Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="name"   class="form-control" required="required"  v-model="name"  v-form-ctrl autocomplete="off">
                 
                                                     <p  class=" text-danger text-small  "   v-if="applicationForm.name.$error.required">Name  is required</p>  
                                                </div>

                                            </div>



                                            <center>
                                                
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            
                                                                <button type="submit" name="submit"class="btn-primary btn btn-success"  v-show="applicationForm.$valid" >Save</button>
                                                                <a href="#" class="btn-primary btn btn-danger"  v-show="applicationForm.$invalid" >Save</a>
                                                               
                                                                <button type="reset" class="btn btn-default-light" > Cancel</button>
                                                            
                                                        </div>
                                                    </div>
                                                 </center>
                                        </form>


                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

          

<?php include("./_library_/_includes_/js.php"); ?>

              
<script>


//code for ensuring vuejs can work with select2 select boxes
Vue.directive('select', {
  twoWay: true,
  priority: 1000,
  params: [ 'options'],
  bind: function () {
    var self = this
    $(this.el)
      .select2({
        data: this.params.options,
         width: "resolve"
      })
      .on('change', function () {
        self.vm.$set(this.name,this.value)
        Vue.set(self.vm.$data,this.name,this.value)
      })
  },
  update: function (newValue,oldValue) {
    $(this.el).val(newValue).trigger('change')
  },
  unbind: function () {
    $(this.el).off().select2('destroy')
  }
})


var vm = new Vue({
  el: "body",
  ready : function() {
  },
 data : {
  
   
 options: [    ]  ,
    
  },
  methods : {
    go_to_payment_section : function (event){
    UIkit.modal.confirm(vm.$els.confirm_modal.innerHTML, function(){
      vm.$data.in_payment_section=true
})

    },
    submit_form : function(){
      return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Processing Transcript Order<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 50000) })();
    }
        ,    
    go_to_fill_form_section : function (event){    
      vm.$data.in_payment_section=false
    }
  }
})

</script>
            </body>

            </html>