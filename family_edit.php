<?php
echo  $ID= $_REQUEST['id'];

?>
  
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add a Family</h4>
                                        </div>
                                        <div class="modal-body">
                                            sss
                                            <form action="addFamily?sms=1" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                                                 <div class="card-body card-padding">
                                                      
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <form action="addFamily?" method="post" class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                                                                <input type="hidden" value="<?php echo $rtmt->ID ?>" name="check"/>

                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Family Code <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                        <input type="text" name="code" readonly=""  class="form-control check-duplicates" value="<?php echo $_SESSION[family_] ?>" autocomplete="off">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Last Name <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" name="lastname" id="member_lastname" class="form-control check-duplicates" value="<?php echo $rtmt->LASTNAME ?>" autocomplete="off">

                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Email Address</label>
                                                                <div class="col-lg-8">
                                                                    <input type="email" name="email" value="<?php echo $rtmt->EMAIL; ?>" class="form-control check-duplicates"   autocomplete="off">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Telephone Number<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="phone" class="form-control" value="<?php echo  $rtmt->PHONE; ?>" autocomplete="off">
                                                                </div>
                                                            </div>
                                                             <div class="form-group">
                                                                <label class="col-lg-4 control-label">City<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="city" class="form-control" value="<?php echo  $rtmt->CITY; ?>" autocomplete="off">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-sm-6">


                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Address<span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" required="" name="address" class="form-control" value="<?php echo  $rtmt->ADDRESS; ?>" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>
                                                            <div class="form-group">
                                                                <label class="col-lg-4 control-label">Region <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                       <select id="regions" name="region" required=""   data-placeholder="Select a region" class="form-control">

                                                                        <option value=''>Choose region</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['NAME']; ?>" <?php
                                                                            if ($rtmt->REGION == $row['NAME']) {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>        ><?php echo $row['NAME']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>
                                                             <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Country <span class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="check-duplicates-popover-parent">
                                                                        <select id="countryd" name="country" required=""   data-placeholder="Select nationality" class="form-control">

                                                                        <option value=''> Countries</option>

                                                                        <?php
                                                                        global $sql;

                                                                        $query2 = $sql->Prepare("SELECT * FROM perez_country");


                                                                        $query = $sql->Execute($query2);


                                                                        while ($row = $query->FetchRow()) {
                                                                            ?>
                                                                            <option value="<?php echo $row['Name']; ?>" <?php
                                                                            if ($rtmt->COUNTRY == $row['Name']) {
                                                                                echo "selected='selected'";
                                                                            }
                                                                            ?>        ><?php echo $row['Name']; ?></option>

                                                                        <?php } ?>

                                                                    </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p>&nbsp;</p>

                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                      
                                                    <button type="submit" name="save" class="btn btn-success">Send <i class="fa fa-save"></i></button>
                                                          <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                </div>
                                                  
                                                 </div>
                                             </div>  
                                            </form>
                                 