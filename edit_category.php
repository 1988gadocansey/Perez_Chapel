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
          
?>
<?php include("./_library_/_includes_/header.inc"); ?>
<p>&nbsp;</p>
<?php
    if(isset($_GET[item])){
    $qt = $sql->Prepare("SELECT * FROM `perez_group_category`  WHERE  ID ='$_GET[item]'  ");

    $stmt = $sql->Execute($qt);
    $rtmt = $stmt->FetchNextObject();
}

?>

                                            <form action="group_category?1" method="post" class="form-horizontal row-border"   id="form" data-validate="parsley" >
                                               <div class="form-group">
                                                    <input type="hidden" value="<?php echo $rtmt->ID ?>" name="check"/>

                                                <label class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" required="required" name="name" value="<?php echo $rtmt->NAME?>">

                                                </div>

                                            </div>
                                               <div class="form-group">
                                                <label class="col-sm-3 control-label">Notify Leader</label>
                                                <div class="col-sm-6">
                                                                    <div class="item checkbox ui-checkbox ui-checkbox-success">
                                             <label class="">
                                                 <input type="checkbox" name="notify" value="1" <?php if($rtmt->NOTIFY_LEADER=="1"){ echo "checked='checked'";} ?>><span>Receive scheduling messages  <i class="fa fa-question-circle fa-fw" title="Uncheck this box to not to send sms to the leader on being choosen as leader" data-toggle="tooltip"></i></span></label>
                                         </div>  </div>
                                            </div>
                                                
                                         <div class="form-group">
                                                <label class="col-sm-3 control-label">Positions</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="positions[]"   rows="2" data-trigger="hover" data-toggle="popover"><?php echo $rtmt->POSITION ?></textarea>
                                                </div>
                                            </div>
                                            
                                             
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Details about category</label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control fullscreen wysihtml5-toolbar popovers" name="details"   rows="10" data-trigger="hover" data-toggle="popover"  ><?php echo $rtmt->DETAILS ?></textarea>
                                                </div>
                                            </div>
                                            



                                            <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="btn-toolbar">
                                                        <button type="submit" name="create" class="btn-primary btn btn-success">Save</button>
                                                           </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
        <?php include("./_library_/_includes_/theme.inc"); ?>
        <?php include("./_library_/_includes_/js.php"); ?>
        