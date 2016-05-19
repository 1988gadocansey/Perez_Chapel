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

    $member = strip_tags($_POST['member']);
     
        header("location:add_children.php?member=$member");
     
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


                        <div><?php $notify->Message(); ?></div>
                    </div>
                    <div class="row">
                        <!-- Basic Table -->
                        <div class="col-md-12">
                            <div class="panel panel-lined panel-hovered mb20 table-responsive basic-table">

                                <div class="panel-body">

                                    <div>

                                        <form action="" method="post" class="form-horizontal row-border"   id="form" novalidate="" name="applicationForm"  v-form>

                                            <div class="form-group">
                                                <span id="item">
                                                    <label class="col-sm-3 control-label">Asset Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" required="required" name="name" v-model="name"  v-form-ctrl>
                                                    <p  class=" text-danger text-small  "   v-if="applicationForm.name.$error.required">Name  is required</p>  
                                               
                                                    </div>
                                                     
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <span id="item">
                                                    <label class="col-sm-3 control-label">Asset Cost</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" required="required" name="cost" v-model="cost" v-form-ctrl>
                                                        <p  class=" text-danger text-small  "   v-if="applicationForm.cost.$error.required">Cost  is required</p>  
                                               
                                                    </div>
                                                </span>
                                            </div>




                                            <div class="form-group">
                                                <span id="item">
                                                    <label class="col-sm-3 control-label">Asset Category</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" required="required" name="category" v-model="category" v-form-ctrl="">
                                                        <p  class=" text-danger text-small  "   v-if="applicationForm.category.$error.required">Category  is required</p>  
                                               
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                 
                                                    <label for="fieldname" class="col-md-3 control-label">Asset Location</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name='location'id='type' v-model="location" v-form-ctrl=""  v-select="location" required="required">
                                                            <option value=''>select asset location </option>
                                                            <?php
                                                            $STM = $sql->Prepare("SELECT *  FROM perez_departments");
                                                            $rowa = $sql->Execute($STM);

                                                            $num = 0;
                                                            while ($row = $rowa->FetchRow()) {
                                                                extract($row);
                                                                ?>
                                                                <option value="<?php echo $ID; ?>"><?php echo $NAME; ?></option>

                                                            <?php } ?>
                                                        </select>
                                                        <p  class=" text-danger text-small  "   v-if="applicationForm.location.$error.required">Asset Location/Department  is required</p>  
                                               
                                                    </div>
                                                 
                                            </div>

                                            <div class="form-group">
                                                <span id="item">
                                                    <label class="col-sm-3 control-label">Asset Serial Number</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"   name="serial">

                                                    </div>
                                                </span>
                                            </div>


                                            <div class="form-group">

                                                <label class="col-sm-3 control-label">Date Purchased</label>
                                                <div class="col-sm-6">
                                                    <div class="input-group date" id="datepickerDemo" style="margin-left: 12px">
                                                        <input type="text" class="form-control" required="" name="date" placeholder="date purchased"    />
                                                        <span class="input-group-addon">
                                                            <i class=" fa fa-calendar"></i>
                                                        </span>
                                                    </div> 
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Asset Description</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="description"   rows="2" data-trigger="hover" data-toggle="popover" data-content="click on the rectangular box at the extreme right to get fullscreen notepad" data-original-title="Notepad"></textarea>
                                                </div>
                                            </div>




                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <div class="btn-toolbar">
                                                            <button type="submit" name="submit"class="btn-primary btn btn-success"   v-show="applicationForm.$valid" >Save</button>
                                                            <a href="#" onclick="return alert('Please fill in all required fields')"class="btn-primary btn btn-danger"  v-show="applicationForm.$invalid" >Save</a>
                                                                <button class="btn-default btn">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- #end row -->
                    </div> <!-- #end page-wrap -->
                </div>


            </div>
            

 <?php include('./asset/js.php');?>            
         
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

            </body>

            </html>