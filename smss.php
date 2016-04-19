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
					<li class="active"><a href="#">User Accounts</a></li>
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
                              <div class="row main_content">
            <div class="col s12 m12">


                <h3><i class="left fa fa-ellipsis-v fa-lg"></i>Send a Quick SMS</h3>
                <div class="card white darken-1">
                    <div class="card-content black-text">
                                                    <form class="col s12" method="POST" action="https://apps.mnotify.net/message/bulk_sms">
        <div class="row">
            <div class="input-field col s6">
                <input type="button" class="btn modal-trigger" data-target="modal1" name="add_contacts" value=" Add existing contacts to Message " />
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <textarea id="body_mes" name="message" class="materialize-textarea">

                </textarea>
                <label for="body_mes">Message</label>
            </div>

            <div class="input-field col s6 rgt">
                <textarea id="numbers" name="numbers" class="materialize-textarea">

                </textarea>
                <label for="numbers">Mobile phone numbers separated by ", " e.g 0247878234,+233269621128</label>
            </div>            
        </div>
        <div class="row">
            <div class="col s6">
                Total characters entered: <span id="total_text">0</span>Number of Messages Per Recipient: <span id="total_messages">0</span>  <br/>160/SMS<br/>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label>Select Sender ID*</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <select name="sender_id" class="browser-default">
                    <option value="">-- Select --</option>
                    <option value="Rioment">Rioment</option>                </select>
            </div>
            <div class="col s1">
                <p class="or_sender_id">OR </p>
            </div>
            <div class="col s5">
                <div class="input-field col s6">
                    <input type="button" name="new_sender_id" id="new_sender_id" value="Use Different Sender Name" class="btn" />
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col s6">
                <label class="no-display" id="sender_id_error"></label>
                <div class="no-display" id="new_id"><br/><label for="n_sender_id">NB: Sender Id will be saved for later use</label><input value="" type="text" name="n_sender_id" id="n_sender_id" maxlength="11" /></div><br/>

            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <input type="checkbox" name="schedule_radio" id="schedule_box" /><label for="schedule_box"><span class="schedule">Schedule this message to be sent at a later date and time</span></label>
                <input type="hidden" name="action" value="bulk_sms">
                <br/><br/>
                <a  class="btn btn-info modal-trigger" id="add_message" href="#messageModal">Send Message</a>
                <div id="schedule_message">
                    <label for="group_name">Send message on:</label><input type="text" name="schedule_date_time" id="schedule_date_time" value="" />
                    <a href="#scheduleModal" id="schedule"  class="btn btn-default modal-trigger">Schedule Message</a>
                </div>
            </div>
        </div>
        <div id="messageModal" class="modal">
            <div class="modal-content">
                <h4>Confirmation Message</h4>
                <br/>
                <div id="message-box"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="add_message" class="waves-effect waves-green btn">Send Message</button>
                <a href="#" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div id="scheduleModal" class="modal">
            <div class="modal-content">
                <h4>Confirmation Message</h4>
                <br/>
                <div id="message-box2"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="waves-effect waves-green btn">Submit</button>
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div> 

        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4>Add Selected Contacts</h4>
                <form>
                    <input type="text" id="seach_field" name="seach_field" placeholder="Enter a name to start searching" />
                </form>
                <form name="search_result">
                    <table class="bordered striped">
                        <thead>
                            <tr class="even">
                                <th></th>
                                <th>Name</th>
                                <th>Mobile Number</th>
                            </tr></thead><tbody id="search_result">
                        </tbody>
                    </table>
                    <br/>
                </form>
                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="waves-effect waves-green btn-flat" name="add_message" value="  Add selected contacts to Quick SMS  " id="add_to_quick">
            </div>
        </div>
    </form>

    <script src="sms/jquery.js"></script>
        <script src="sms/materialize.min.js"></script>
        <script src="sms/init.js"></script>

       <!-- <link rel="stylesheet" href="https://apps.mnotify.net/assets/themes/mnotify/css/app.css" /> -->
        <script src="sms/jquery-1.8.2.min.js"></script><script src="https://apps.mnotify.net/assets/system/js/jquery.ui.timepicker.js?v=0.3.1"></script><script src="https://apps.mnotify.net/assets/system/js/cdn.min.js"></script><script src="https://apps.mnotify.net/assets/system/bootstrap/js/bootstrap.js" type="text/javascript"></script> <script src="https://apps.mnotify.net/assets/system/js/jquery.dataTables.min.js"></script><script type="text/javascript" src="https://apps.mnotify.net/assets/js/materialize.js"></script><script src="sms/jquery-ui.js"></script><script src="https://apps.mnotify.net/assets/system/js/jquery-ui-timepicker-addon.js"></script><script src="https://apps.mnotify.net/assets/js/highcharts_2.js"></script><script src="https://apps.mnotify.net/assets/js/sweetalert.min.js"></script><script src="https://apps.mnotify.net/assets/system/js/jquery.jgrowl.js"></script><script src="//cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js"></script><script src="//cdn.jquerytools.org/1.2.7/form/jquery.tools.min.js"></script><script src="sms/mNotify.js"></script>

<script>
    $(document).ready(function () {
        $('.modal-trigger').leanModal();
    });
</script>
<script>
    $('#numbers').html("");
    $('#body_mes').html("");
    $("#seach_field").keyup(function () {
        var search_key, url;
        search_key = $("#seach_field").val();
        url = 'https://apps.mnotify.net/message/ajax_member_search/' + search_key;
        $("#search_result").load(url);
    });
    $('#add_message').click(function () {
        var a = $('#body_mes').val();
        var numbers = $('#numbers').val().split(",");
        var length = a.length;
        var cost = Math.ceil(a.length / 160);
        var html = "<table class='striped bordered'><thead><tr><th>Cost</th><th>Length</th><th>Recipients</th><th>Message</th></tr></thead><tbody><tr><td>" + (cost * numbers.length) + "</td><td>" + length + "</td><td>" + numbers.length + "</td><td>" + a + "</td></tr></tbody></table>";
        $('#message-box').html(html);
    });

    $('#schedule').click(function () {
        var a = $('#body_mes').val();
        var numbers = $('#numbers').val().split(",");
        var length = a.length;
        var cost = Math.ceil(a.length / 160);
        var html = "<table class='striped bordered'><thead><tr><th>Cost</th><th>Length</th><th>Recipients</th><th>Message</th></tr></thead><tbody><tr><td>" + (cost * numbers.length) + "</td><td>" + length + "</td><td>" + numbers.length + "</td><td>" + a + "</td></tr></tbody></table>";
        $('#message-box2').html(html);
    });
</script>                    </div>
                    
                </div>
            </div>
        </div>
<footer id="footer">
        <p> © mNotify 2016 </p>
    </footer>                
            <div class="notification_modal" id="promptj">
                <button type="button" class="close" id="close_notification">&times;</button>
                <h2>Check out our new cool features</h2>

                <div id="notification_photo" style="float:left;">
                </div>
                <div id="notification_description" style="float:right;width:340px;height:200px;">
                </div>
                <!-- input form. you can press enter too -->
                <div class="bottom" style="width:500px;height:20px;background:none;float:right;border:none;">
                    <button id="next"  style="float:right;" type="button" class="btn btn-primary"> Next notification &raquo; </button>
                </div>

                </form>
                <br />

            </div>

<?php include("./_library_/_includes_/js.php"); ?>
       
            <script>
                $('body').prepend('<a target="_blank" href="https://apps.mnotify.net/home/sso_login" class="support btn"><i class="small left fa fa-question-circle"></i> Support</a>');
                $('#switch_theme').click(function () {
                    $.ajax({
                        url: 'https://apps.mnotify.net/admin_groups/switch_theme',
                        type: 'POST',
                        data: {theme: 'classic'}
                    }).done(function (result) {
                        if (result === '1') {
                            window.location.href = '';
                        }
                    });
                });
                $('.language_selection').change(function () {
                    $.ajax({
                        url: 'https://apps.mnotify.net/account_settings/change_language',
                        type: 'POST',
                        data: {language: $('#language_selection').val()}
                    }).done(function (result) {
                        window.location.href = "";
                    });
                });
            </script>
            <script>
                $.fn.learn_more = function (user_id, notification_id) {
                    $.ajax({
                        url: 'https://apps.mnotify.net/admin_groups/save_client_notification',
                        type: 'POST',
                        data: {notification_id: notification_id, userid: user_id}
                    }).done(function (result) {
                        $.ajax({
                            url: 'https://apps.mnotify.net/admin_groups/count_notification_status'
                        }).done(function (result) {
                            $('.badge').html(result);
                        });
                    });

                };
                $('.badge').click(function () {
                    if ($('.badge').html() < 1) {
                        $('.badge').attr('data-toggle', 'none');
                    } else {
                        $.ajax({
                            url: 'https://apps.mnotify.net/admin_groups/notify_client',
                            dataType: 'json'
                        }).done(function (result) {
                            var pics = new Array();
                            var desc = new Array();
                            var id = new Array();
                            i = 0;
                            j = 1;
                            $('#notification-icon').html('');
                            $.each(result, function (index, element) {
                                pics[i] = element.filename;
                                desc[i] = element.description;
                                id[i] = element.id;
                                url = 'https://apps.mnotify.net/uploads';
                                $('#notification-icon').append('<div class=text style="font-weight:100;font-size:11px;line-height:18px;color:#777;font-family:\"Open Sans\";min-height:80px;"><img style="border:3px solid #444; height:50px;width:90px;float:left;margin-bottom:5px;margin-right:5px;" src="' + url + '/' + pics[i] + '" />' + desc[i] + '<br/><br/><div style="height:20px;"><a href="http://' + element.url + '" class="learn_more" onclick="$(this).learn_more(\'0505284060\',\'' + id[i] + '\')"><b>[Learn More]</b></a></div></div>');
                                ++i;
                            });
                        });
                    }
                });
                $('#close_notification').click(function () {
                    $.ajax({
                        url: 'https://apps.mnotify.net/admin_groups/count_notification_status'
                    }).done(function (result) {
                        $('.badge').html(result);
                    });
                });
                var notify = 'checked';
                if (notify !== 'checked') {
                    $.ajax({
                        url: 'https://apps.mnotify.net/admin_groups/notify_client',
                        dataType: 'json'
                    }).done(function (result) {
                        var pics = new Array();
                        var desc = new Array();
                        var id = new Array();
                        i = 0;
                        j = 1;
                        $.each(result, function (index, element) {
                            pics[i] = element.filename;
                            desc[i] = element.description;
                            id[i] = element.id;
                            ++i;
                        });
                        if (pics.length > 0) {
                            $("#prompt").overlay({
                                top: 260,
                                mask: {
                                    color: '#aaa',
                                    loadSpeed: 200,
                                    opacity: 0.5
                                },
                                closeOnClick: false,
                                load: true
                            });
                            base_url = 'https://apps.mnotify.net/uploads';
                            $('#notification_photo').html('<center><img src=' + base_url + '/' + pics[0] + ' style="text-align:center;height:100px;width:200px" ></center>');
                            $('#notification_description').html(desc[0]);
                            $.ajax({
                                url: 'https://apps.mnotify.net/admin_groups/save_client_notification',
                                type: 'POST',
                                data: {notification_id: id[0], userid: '0505284060'}
                            }).done(function (result) {
                            });
                            if (pics.length === 1) {
                                $('#next').addClass('no-display');
                            }
                        }
                        $('#next').click(function () {
                            if (j === (pics.length - 1)) {
                                $('#next').addClass('no-display');
                            }
                            $('#notification_photo').html('<center><img src=' + base_url + '/' + pics[j] + ' style="text-align:center;height:100px;width:200px" ></center>');
                            $('#notification_description').html(desc[j]);
                            $.ajax({
                                url: 'https://apps.mnotify.net/admin_groups/save_client_notification',
                                type: 'POST',
                                data: {notification_id: id[j], userid: '0505284060'}
                            }).done(function (result) {
                            });
                            j++;
                        });
                    });
                }
            </script>
            <script>
                $("#btn_submit").click(function () {
                    var details = $("#details").val();
                    $.ajax({
                        type: "POST",
                        url: "https://apps.mnotify.net/message/user_views",
                        data: {details: details}
                    }).done(function (result) {
                        $("#msg").html(result);
                    });
                });
                $("#close").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "https://apps.mnotify.net/admin_groups/message_display",
                        data: {userdata:0505284060}
                    }).done(function (result) {

                    });
                });

                $('#close_help').click(function () {
                    $.ajax({
                        type: "POST",
                        url: "https://apps.mnotify.net/admin_groups/save_status",
                        data: {userdata:0505284060}
                    }).done(function (result) {

                    });

                });

                $.ajax({
                    url: 'https://apps.mnotify.net/admin_groups/count_notification_status'
                }).done(function (result) {
                    $('.badge').html(result);
                });

            </script>
                                        </div>
                                    </div>




                                </div>
                                <!-- #end row -->
                            </div> <!-- #end page-wrap -->
			</div>
			

		</div>

	 
         
</body>

</html>