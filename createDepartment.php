<?php
require '_ini_.php';
require 'vendor/autoload.php';
require '_library_/_includes_/config.php';
require '_library_/_includes_/app_config.inc';
include('parsecsv.lib.php');
//$crypt = new _classes_\cryptCls();
$member = new _classes_\Members();
$help = new _classes_\helpers();
$notify = new _classes_\Notifications();
$config_file = $help->getConfig();
$ledger = new _classes_\Ledger();
$login = new _classes_\Login();

if (isset($_POST[submit])) {

    $name = strip_tags($_POST['name']);
    $id = strip_tags($_POST['id']);
    //
    $parent = strip_tags($_POST['parent']);
     if(empty($id)){
    $query=$sql->Prepare("INSERT INTO perez_departments (NAME,PARENT) VALUES('$name','$parent')");
    //print_r($query);    
    if($sql->Execute($query)){
             //loggingdie($id);
                    $dpat=$help->getDepartmentName($name);
                    $event="Creation";
                    $activity="$_SESSION[USERNAME] has added $name department";
                    $hashkey = $_SERVER['HTTP_HOST'];
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $mac = $login->getMac();
                    $sessionId = session_id();
                    $stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                    $sql->Execute($stmt);

           header('location:viewDepartments.php?success=1');
        }
        else{
           // header('location:createDepartment.php?error=1');
        }
     }
     else{
          $query=$sql->Prepare("UPDATE perez_departments SET NAME='$name',PARENT='$parent' WHERE ID='$id'");
        if($sql->Execute($query)){
             //logging
                    $dpat=$help->getDepartmentName($department);
                    $event="Creation";
                    $activity="$_SESSION[USERNAME] has updated $name department";
                    $hashkey = $_SERVER['HTTP_HOST'];
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $mac = $login->getMac();
                    $sessionId = session_id();
                    $stmt = $sql->Prepare("INSERT INTO `perez_system_log` ( `USERNAME`, `EVENT_TYPE`, `ACTIVITIES`, `HOSTNAME`, `IP`, `BROWSER_VERSION`,MAC_ADDRESS,SESSION_ID) VALUES ('".$_SESSION[ID]."', '$event','$activity', '".$hashkey."','".$remoteip."','".$useragent."','".$mac."','".$sessionId."')");
                    $sql->Execute($stmt);

            header('location:viewDepartments.php');
        }
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


            <h5>Adding Department</h5>


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
                                        <?php
                                        
                                            if(isset($_GET[id])){
                                                $department=$_GET[id];
                                                
                                                $query=$sql->Prepare("SELECT * FROM perez_departments WHERE ID ='$department'");
                                                $query_=$sql->Execute($query);
                                                $rows=$query_->FetchNextObject();
                                                //print_r($row);
                                            }
                                        
                                        
                                        ?>
                                        <form action="" method="post" class="form-horizontal row-border"   id="form" novalidate="" name="applicationForm"  v-form>

                                            <div class="form-group">
                                                <span id="item">
                                                    <label class="col-sm-3 control-label">Department Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" required="required" name="name" value="<?php echo $rows->NAME;?>" v-model="name"  v-form-ctrl>
                                                    <p  class=" text-danger text-small  "   v-if="applicationForm.name.$error.required">Name  is required</p>  
                                               
                                                    </div>
                                                    <input type="hidden" class="form-control" required="required" name="id" value="<?php echo $rows->ID;?>" >
                                                 
                                                </span>
                                            </div>
                                            
                                            <div class="form-group">
                                                 
                                                    <label for="fieldname" class="col-md-3 control-label">Parent Department</label>
                                                    <div class="col-md-6">
                                                        <select style="width:230px" name='parent'  v-model="parent" v-form-ctrl=""  v-select="parent"  >
                                                            <option value=''>select parent department </option>
                                                            <?php
                                                            $STM = $sql->Prepare("SELECT *  FROM perez_departments");
                                                            $rowa = $sql->Execute($STM);

                                                            $num = 0;
                                                            while ($row = $rowa->FetchRow()) {
                                                                extract($row);
                                                                ?>
                                                                
                                                           
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                     
                                                            on <?php if($rows->PARENTtc5==$ID){echo "selected='selected'";}  ?> value="<?php echo $ID; ?>"><?php echo $NAME; ?></option>

                                                            <?php } ?>
                                                                                                                
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
   parent:"<?php echo $row->PARENT ?>",
   
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