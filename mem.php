<?php
        require '_ini_.php';
        require 'vendor/autoload.php'; 
        require '_library_/_includes_/config.php';
        require '_library_/_includes_/app_config.inc';
        include('parsecsv.lib.php');
        
        $member=new _classes_\Members();
        $help=new _classes_\helpers();
        $notify=new _classes_\Notifications();
        $destination = "uploads"; // destination for uploads
?>  
        <?php include("./_library_/_includes_/header.inc"); ?>
<script src= "assets/ajax.googleapis.com_ajax_libs_angularjs_1.3.14_angular.min.js"></script>
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
                    <link rel="stylesheet" href="assets/styles/plugins/select2.css">
                    <link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
                    <link rel="stylesheet" href="assets/styles/plugins/bootstrap-datepicker.css">
		</aside>
		<!-- #end main-navigation -->

		<!-- content-here -->
		<div class="content-container" id="content">
                        
			<div class="page page-ui-tables">
				<ol class="breadcrumb breadcrumb-small">
					<li>System Setups</li>
					<li class="active"><a href="#">Setup</a></li>
				</ol>
                            <div><?php $notify->Message(); ?></div>
                            <?php
                                
                                     
                                    $query = $sql->Prepare("SELECT * FROM perez_config  ");

                                    $stmt = $sql->Execute($query);
                                    $rows = $stmt->FetchNextObject();
                                 
                                ?>
                            <div class="page-wrap">
                                <div class="note note-success note-bordered">
					<!-- row -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-info">
                                                    <button type="button" class="close" data-dismiss="alert">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <div><strong>System Setup Procedures:</strong>
                                                        <br/>
                                                        
                                                        

                                                        To navigate through the guide, use the buttons in the bottom right-hand corner. Each step will take you to a different area of the system and give a quick explanation of its functions and features. We'll always remember what step you're up to, so feel free to have a look around before moving forward! You can always come back if you need to clarify.

                                                        If you'd like more information on any of the areas mentioned, you can always visit our 'Getting Started Page' for more information. We also have a How-To area, where you can find full setup instructions for each of the Elvanto features. If there's anything we miss in this guide, or if you have any further questions, be sure to contact our support team for assistance..


                                                    </div>
                                                </div>
                                            </div>	 


                                        </div>
                                <div class="row">
                                    <!-- Basic Table -->
                                    <!-- inline form -->
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default panel-hovered panel-stacked mb30">
								<div class="panel-heading">Inline Form</div>
								<div class="panel-body">
                                                                    <form action="/admin/people/person/?category=7bdee820-4d3f-11e5-95ba-068b656294b7" method="post" class="person-form form-horizontal form-horizontal-custom" autocomplete="off" role="form">
                                                                        <input type="hidden" name="save" value="1">
                                                                        <input type="text" name="fakeusernameremembered" class="hidden">
                                                                        <input type="password" name="fakepasswordremembered" class="hidden">
                                                                        <input type="hidden" name="category_id" value="7bdee820-4d3f-11e5-95ba-068b656294b7">

                                                                        <div class="form-btn">
                                                                            <div class="form-btn-floating">
                                                                                <button type="submit" class="btn btn-save"><i class="fa fa-check"></i>Save</button>
                                                                            </div>
                                                                        </div>



                                                                        <h4 class="form-header">Personal Information</h4>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">First Name <span class="text-danger">*</span></label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="check-duplicates-popover-parent">
                                                                                        <input type="text" name="member_firstname" id="member_firstname" class="form-control check-duplicates" value="" autocomplete="off">
                                                                                        <input type="hidden" name="member_firstname_old" class="form-control" value="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Last Name <span class="text-danger">*</span></label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_lastname" id="member_lastname" class="form-control check-duplicates" value="" autocomplete="off">
                                                                                        <input type="hidden" name="member_lastname_old" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Email Address</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="email" name="member_email" id="member_email" class="form-control check-duplicates" value="" autocomplete="off">
                                                                                        <div class="item checkbox ui-checkbox ui-checkbox-primary">
                                                                                            <label>
                                                                                                <input type="checkbox" id="member_email_general" name="member_email_unsubscribes" value="y"  checked> Receive general emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from general emails sent from Elvanto. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="item checkbox ui-checkbox ui-checkbox-info">
                                                                                            <label><input type="checkbox" id="member_email_scheduling" name="member_email_unsubscribes[scheduling]" value="y"  checked> Receive scheduling emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from service scheduling emails sent from Elvanto. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Phone Number</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_phone" class="form-control" value="" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Mobile Number</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_mobile" class="form-control check-duplicates" value="" autocomplete="off">
                                                                                        <div class="checkbox-group">
                                                                                        <div class="checkbox ui-checkbox ui-checkbox-info">
                                                                                            <label><input type="checkbox" id="member_mobile_sms_general" name="member_mobile_sms" value="y"> <span>Receive general messages</span> <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from general SMS messages sent from Elvanto. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i>
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="checkbox ui-checkbox ui-checkbox-pink">
                                                                                            <label>
                                                                                                <input type="checkbox" id="member_mobile_sms_scheduling" name="member_mobile_sms" value="y"><span> Receive scheduling messages</span> <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from service scheduling SMS messages sent from Elvanto. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i>
                                                                                            </label> 
                                                                                        </div>
                                                                                       </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group"><label class="col-lg-4 control-label">Gender</label>
                                                                                    <div class="col-lg-8">
                                                                                        <select name="member_gender" class="form-control">
                                                                                            <option value=""></option>
                                                                                            <option value="Male">Male</option>
                                                                                            <option value="Female">Female</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Date of Birth</label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="input-group date" id="datepickerDemo">
                                                                                            <input type="text" class="form-control" required="" name="member_dob"/>
											<span class="input-group-addon">
												<i class=" ion ion-calendar"></i>
											</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group date-picker-member_birthday-age">
                                                                                    <label class="col-lg-4 control-label">Age</label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="form-control-static age">
                                                                                            
                                                                                        </div>
                                                                                            
                                                                                    </div>
                                                                                        
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="input-field">
                                                                                    <label class="col-lg-4 control-label">Sunday School Grade</label>
                                                                                    <div class="col-lg-8">
                                                                                        <select name="member_school_grade" class="form-control" id="personSelect">
                                                                                            <option value="">-- None --</option>
                                                                                            <option value="Nursery/Pre-school">Nursery/Pre-school</option>
                                                                                            <option value="Kindergarten">Kindergarten</option>
                                                                                            <option value="Primary">Primary</option>
                                                                                            <option value="Junior">Junior</option>
                                                                                            <option value="Senior">Senior</option>
                                                                                            <option value="Adult">Adult</option>
                                                                                            </select>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Marital Status</label>
                                                                                    <div class="col-lg-8">
                                                                                        <select name="member_marital_status" class="form-control" id="marital">
                                                                                            <option value=""></option>
                                                                                            <option value="single">Single</option>
                                                                                            <option value="engaged">Engaged</option>
                                                                                            <option value="married">Married</option>
                                                                                            <option value="defacto">Partner</option>
                                                                                            <option value="widowed">Widowed</option>
                                                                                            <option value="divorced">Divorced</option>
                                                                                            <option value="separated">Separated</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Anniversary</label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="input-group date" id="datepickerDemo1">
                                                                                            <input type="text" class="form-control" name="member_anniversary"/>
											<span class="input-group-addon">
												<i class=" ion ion-calendar"></i>
											</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group date-picker-member_anniversary-age">
                                                                                    <label class="col-lg-4 control-label">Years</label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="form-control-static age">
                                                                                            
                                                                                        </div>
                                                                                            
                                                                                    </div>
                                                                                        
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Receipt Name <i class="fa fa-question-circle fa-fw" title="The name this person requires on their tax receipt." data-toggle="tooltip"></i></label><div class="col-lg-8"><input type="text" name="member_receipt_name" class="form-control" value="" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Giving Number <i class="fa fa-question-circle fa-fw" title="A unique privacy number for tax deductible giving." data-toggle="tooltip"></i></label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_giving_number" class="form-control" value="" autocomplete="off">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Access Permissions <i class="fa fa-question-circle fa-fw" title="This determines what access this person has." data-toggle="tooltip"></i></label>
                                                                                    <div class="col-lg-8"><div data-multi-select="access[]">
                                                                                            <div class="checkbox-group">
                                                                                                <div  class="item checkbox ui-checkbox ui-checkbox-primary">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" name="access[]" value="Admins"><span>Admins</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="item checkbox ui-checkbox ui-checkbox-pink">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" name="access[]" value="Leaders"><span>Leaders</span></label>
                                                                                                </div>
                                                                                                <div class="item checkbox ui-checkbox ui-checkbox-info">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" checked="" name="access[]" value="Members"><span>Members</span></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <input type="hidden" name="has_access" value="1">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <h4 class="form-header">Contact Information</h4>
                                                                            </div>
                                                                            <div class="col-sm-6"><h4 class="form-header">Home Address</h4></div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Address</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_mailing_address" id="member_mailing_address" class="form-control" value="">
                                                                                        <button type="button" class="btn btn-sm btn-action" data-copy-address="mailing" style="display: none">
                                                                                            <i class="fa fa-files-o fa-fw"></i> Copy to Home Address
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                   <label class="col-lg-4 control-label">Address Line 2</label>
                                                                                   <div class="col-lg-8">
                                                                                       <input type="text" name="member_mailing_address2" id="member_mailing_address2" class="form-control" value="">
                                                                                   </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">City</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_mailing_city" id="member_mailing_city" class="form-control" value="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Region</label>
                                                                                    <div class="col-lg-8">
                                                                                      <select id="region" name="region" required=""   data-placeholder="Select a region" class="form-control">
													 
                                                                                                            <option value=''>Choose region</option>

                                                                                                            <?php
                                                                                                            global $sql;

                                                                                                            $query2 = $sql->Prepare("SELECT * FROM perez_regions");


                                                                                                            $query = $sql->Execute($query2);


                                                                                                            while ($row = $query->FetchRow()) {
                                                                                                                ?>
                                                                                                                <option value="<?php echo $row['NAME']; ?>" <?php
                                                                                                                if ($rows->REGION == $row['NAME']) {
                                                                                                                    echo "selected='selected'";
                                                                                                                }
                                                                                                                ?>        ><?php echo $row['NAME']; ?></option>

                                                                                                        <?php } ?>

                                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                 
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Country</label>
                                                                                 <div class="col-lg-8">
                                                                                     <select name="member_mailing_country" required="" id="country" class="form-control">
                                                                                         <option value="">-- None --</option>
                                                                                         <option value="GH" selected="select">Ghana</option>
                                                                                         <option value="AU">Australia</option><option value="US">United States</option><option value="NZ">New Zealand</option><option value="GB">United Kingdom</option>><option value="" disabled="true">------</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, Democratic Republic</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d'Ivoire</option><option value="HR">Croatia</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TL">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People's Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="CS">Serbia and Montenegro</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and The South Sandwich Islands</option><option value="KR">South Korea</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SH">St. Helena</option><option value="PM">St. Pierre and Miquelon</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen Islands</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VG">Virgin Islands (British</option><option value="VI">Virgin Islands (U.S.</option><option value="WF">Wallis and Futuna Islands</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select></div></div></div><div class="col-sm-6"><div class="form-group"><label class="col-lg-4 control-label">Address</label><div class="col-lg-8"><input type="text" name="member_home_address" id="member_home_address" class="form-control" value=""><button type="button" class="btn btn-sm btn-action" data-copy-address="home" style="display: none"><i class="fa fa-files-o fa-fw"></i> Copy to Mailing Address</button></div></div><div class="form-group"><label class="col-lg-4 control-label">Address Line 2</label><div class="col-lg-8"><input type="text" name="member_home_address2" id="member_home_address2" class="form-control" value=""></div></div><div class="form-group"><label class="col-lg-4 control-label">City</label><div class="col-lg-8"><input type="text" name="member_home_city" id="member_home_city" class="form-control" value=""></div></div><div class="form-group"><label class="col-lg-4 control-label">State</label><div class="col-lg-8"><input type="text" name="member_home_state" id="member_home_state" class="form-control" value=""></div></div><div class="form-group"><label class="col-lg-4 control-label">Zip Code</label><div class="col-lg-8"><input type="text" name="member_home_postcode" id="member_home_postcode" class="form-control" value=""></div></div><div class="form-group"><label class="col-lg-4 control-label">Country</label><div class="col-lg-8"><select name="member_home_country" id="member_home_country" class="form-control"><option value="">-- None --</option><option value="GH">Ghana</option><option value="AU">Australia</option><option value="US">United States</option><option value="NZ">New Zealand</option><option value="GB">United Kingdom</option>><option value="" disabled="true">------</option><option value="AF">Afghanistan</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, Democratic Republic</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d'Ivoire</option><option value="HR">Croatia</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="TL">East Timor</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People's Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macau</option><option value="MK">Macedonia</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="CS">Serbia and Montenegro</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and The South Sandwich Islands</option><option value="KR">South Korea</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SH">St. Helena</option><option value="PM">St. Pierre and Miquelon</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen Islands</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="VG">Virgin Islands (British</option><option value="VI">Virgin Islands (U.S.</option><option value="WF">Wallis and Futuna Islands</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </div>
                                                                        </div><div class="row">
                                                                            <div class="col-sm-6">
                                                                                <h4 class="form-header">Locations</h4>
                                                                                <p class="form-description">Choose the locations this person is assigned to.</p>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Locations <i class="fa fa-question-circle fa-fw" title="The locations this person attends" data-toggle="tooltip"></i></label>
                                                                                    <div class="col-lg-8">
                                                                                        <select   data-tags="true"  required="" name="member_location"  id="branch"   data-placeholder="This person is in which location" class="form-control">
													 
                                                                                                            <option value=''>Choose Location</option>

                                                                                                            <?php
                                                                                                            global $sql;

                                                                                                            $query2 = $sql->Prepare("SELECT * FROM perez_branches");


                                                                                                            $query = $sql->Execute($query2);


                                                                                                            while ($row = $query->FetchRow()) {
                                                                                                                ?>
                                                                                                                <option value="<?php echo $row['ID']; ?>" <?php
                                                                                                                if ($rows->LOCATION == $row['ID']) {
                                                                                                                    echo "selected='selected'";
                                                                                                                }
                                                                                                                ?>        ><?php echo $row['NAME']." ".$row['LOCATION']." - ".$row['REGION']; ?></option>

                                                                                                        <?php } ?>

                                                                                                        </select>
                                       
                                                                                    </div>
                                                                                        
                                                                                </div>
                                                                                    
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <h4 class="form-header">Demographics</h4><p class="form-description">Choose the demographics of this person.</p>
                                                                                <div class="form-group"><label class="col-lg-4 control-label">Demographics <i class="fa fa-question-circle fa-fw" title="The demographics of this person." data-toggle="tooltip"></i></label><div class="col-lg-8"><div data-multi-select="demographic[]"><div class="checkbox-group">
                                                                                                <div class="item checkbox  ui-checkbox ui-checkbox-primary">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" name="demographic[]" value="7c08ef22-4d3f-11e5-95ba-068b656294b7"><span>Adults</span></label>
                                                                                                </div>
                                                                                                <div class="item checkbox ui-checkbox ui-checkbox-info">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" name="demographic[]" value="7c09ce57-4d3f-11e5-95ba-068b656294b7"><span>Families</span></label>
                                                                                                </div>
                                                                                                <div class="item checkbox ui-checkbox ui-checkbox-warning">
                                                                                                   <label class="">
                                                                                                       <input type="checkbox" name="demographic[]" value="7c0abdf3-4d3f-11e5-95ba-068b656294b7"><span>Youth</span></label>
                                                                                                </div>
                                                                                                <div class="item checkbox ui-checkbox ui-checkbox-danger">
                                                                                                    <label class="">
                                                                                                        <input type="checkbox" name="demographic[]" value="7c0b8579-4d3f-11e5-95ba-068b656294b7"><span>Children</span></label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <input type="hidden" name="has_demographics" value="1">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <h4 class="form-header">Volunteer</h4>
                                                                        <p class="form-description">These are the main personal details for this person.</p>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Volunteer <i class="fa fa-question-circle fa-fw" title="Check this box if this person is a volunteer." data-toggle="tooltip"></i>
                                                                                    </label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="checkbox  ui-checkbox ui-checkbox-primary"><label>
                                                                                                <input type="checkbox" name="volunteer" value="yes"> <span>Yes</span>
                                                                                     </label>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Username</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="text" name="member_username" id="member_username" class="form-control" value="" autocomplete="off" autocapitalize="none" autocapitalize="off" autocorrect="off" maxlength="30">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Password</label>
                                                                                    <div class="col-lg-8">
                                                                                        <input type="password" name="member_password1" class="form-control" autocomplete="off">
                                                                                        <input type="password" name="member_password2" class="form-control" autocomplete="off">
                                                                                        <p class="help-block">Leave blank to automatically generate a password</p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Send Login?</label>
                                                                                    <div class="col-lg-8">
                                                                                        <div class="checkbox ui-checkbox ui-checkbox-pink">
                                                                                            <label>
                                                                                                <input type="checkbox" name="member_send_login" value="yes" checked=""><span> Send these login details to the new user by email</span></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Reports To</label>
                                                                                    <div class="col-lg-8">
                                                                                     <select id="multiSelect" data-tags="true" multiple="multiple" name="member_report_to"     data-placeholder="This person reports to who??" class="form-control">
													 
                                                                                                            <option value=''>Choose member</option>

                                                                                                            <?php
                                                                                                            global $sql;

                                                                                                            $query2 = $sql->Prepare("SELECT ID,MEMBER_CODE,TITLE,FIRSTNAME,LASTNAME,OTHERNAMES FROM perez_members");


                                                                                                            $query = $sql->Execute($query2);


                                                                                                            while ($row = $query->FetchRow()) {
                                                                                                                ?>
                                                                                                                <option value="<?php echo $row['ID']; ?>" <?php
                                                                                                                if ($rows->REPORT == $row['ID']) {
                                                                                                                    echo "selected='selected'";
                                                                                                                }
                                                                                                                ?>        ><?php echo $row['TITLE']." ".$row['SURNAME']." ".$row['FIRSTNAME']." ".$row['OTHERNAMES']; ?></option>

                                                                                                        <?php } ?>

                                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label class="col-lg-4 control-label">Departments <i class="fa fa-question-circle fa-fw" title="Departments are the different areas of serving in the church. Choose what departments this person serves within." data-toggle="tooltip"></i>
                                                                                    </label>
                                                                                    <div class="col-lg-8">		  
                                                                                        <div class="form-btn form-btn-left">
                                                                                            <button type="button" class="btn btn-action btn-sm add-departments"><i class="fa fa-plus"></i>Add</button>
                                                                                        </div>
                                                                                         
                                                                                        <input type="hidden" name="has_departments" value="1">
                                                                                    </div>
                                                                                 </div>
                                                                            </div>
                                                                         </div>
                                                                                  <div class="row">
                                                                                                    
                                                                                      <div class="col-sm-6">
                                                                                          <h4 class="form-header">Add to Group</h4>
                                                                                          <p><a href="#" data-target="/admin/people/person_group/?new_person=1" data-modal="add-person-group" class="btn btn-action">Add to Groups</a></p>
                                                                                          <ul class="person-groups-inline"></ul>
                                                                                      </div>
                                                                                      <div class="col-sm-6">
                                                                                          <h4 class="form-header">Add to People Flow</h4>
                                                                                          <p><a href="#" data-target="/admin/people/person_flow/?new_person=1" data-modal="add-person-group" class="btn btn-action">Add to People Flows</a></p>
                                                                                          <ul class="person-flows-inline"></ul>
                                                                                      </div>
                                                                                  </div>
                                                                        <p>&nbsp;</p>
                                                                        <center>
                                                                                <div class="form-btn form-btn-bottom">
                                                                                    <button type="submit" name="save" class="btn btn-primary">
                                                                                        <i class="fa fa-save"></i>Save</button>
                                                                                </div></center>
                                                                    
                                                                    
                                                                    </form>

                                </div>
									 
								</div> <!-- #end panel body -->
							</div> <!-- #end panel -->
						</div>

					</div>
			</div>
			

		</div>

	</div> <!-- #end main-container -->

	<?php include("./_library_/_includes_/theme.inc"); ?>
        
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
        <script type="text/javascript" src="assets/scripts/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
        <?php include("_library_/_includes_/export.php"); ?>
         
          
         
</body>

</html>