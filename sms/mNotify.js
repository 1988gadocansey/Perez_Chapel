$(document).ready(function() {

    $('#sender_id').change(function() {
        var length = $('#sender_id').val().length;
        if (length >= 12) {
            $('#sender_id_error').removeClass("no-display");
            $('#sender_id_error').html("Please select another sender id");
            $('#add_message').attr("disabled", true);
            $('#sender_id_error').css("color", "#ff0000");
        } else {
            $('#sender_id_error').addClass("no-display");
            $('#add_message').attr("disabled", false);
        }
    });

    $("#select_all").change(function() {
        if ($(this).is(":checked")) {
            $('.check').prop('checked', true);
        } else {
            $('.check').prop('checked', false);
        }
    });

    $("#user_views").click(function() {
        $("#sms_ajax").overlay().load();
    });
    $("#scheduler").click(function() {
        if ($("#scheduler").is(":checked")) {
            $("#date").removeClass("no-display");
        } else {
            $("#date").addClass("no-display");
        }
    });

    $("#fname_insert").click(function() {
        var mess = $("#body_mes").val();
        $("#body_mes").val(mess + "[fname]");
    });
    $("#fullname_insert").click(function() {
        var mess = $("#body_mes").val();
        $("#body_mes").val(mess + "[fullname]");
    });
    $("#lname_insert").click(function() {
        var mess = $("#body_mes").val();
        $("#body_mes").val(mess + "[lname]");
    });

    $("#fname_insert_2").click(function() {
        var mess = $("#body_mes_2").val();
        $("#body_mes_2").val(mess + "[fname]");
    });
    $("#fullname_insert_2").click(function() {
        var mess = $("#body_mes_2").val();
        $("#body_mes_2").val(mess + "[fullname]");
    });
    $("#lname_insert_2").click(function() {
        var mess = $("#body_mes_2").val();
        $("#body_mes_2").val(mess + "[lname]");
    });





    $('#schedule_message').hide();
    $('#schedule_box').change(function() {
        if ($(this).is(':checked')) {

            //hide send message button and show shedule message stuff
            $('#add_message').hide();
            $('#schedule_message').show();//dont_schedule
        } else {
            // hide the shedule message and show send message
            $('#add_message').show();
            $('#schedule_message').hide();
        }
    });
    var intit;
    var num_sms;
    $("#body_mes").keyup(function() {//count anytime the keyboard is pressed
        intit = $("#body_mes").val().length;

        if (intit <= 160) {
            num_sms = 1;
            $("#total_messages").html(num_sms);
        }
        if (intit > 160 & intit < 320) {
            num_sms = 2;
            $("#total_messages").html(num_sms);
        }
        if (intit >= 320 & intit <= 479) {
            num_sms = 3;
            $("#total_messages").html(num_sms);
        }
        if (intit > 479) {
            num_sms = 3;
            $("#total_messages").html("<strong>Please Reduce The Number Of Characters</strong>");
        }

        $("#total_text").html(intit);
    });

    $("#body_mes_2").keyup(function() {//count anytime the keyboard is pressed
        intit = $("#body_mes_2").val().length;

        if (intit <= 160) {
            num_sms = 1;
            $("#total_messages_2").html(num_sms);
        }
        if (intit > 160 & intit < 320) {
            num_sms = 2;
            $("#total_messages_2").html(num_sms);
        }
        if (intit >= 320 & intit <= 479) {
            num_sms = 3;
            $("#total_messages_2").html(num_sms);
        }
        if (intit > 479) {
            num_sms = 3;
            $("#total_messages_2").html("<strong>Please Reduce The Number Of Characters</strong>");
        }

        $("#total_text_2").html(intit);
    });

    $("#new_sender_id").click(function() {
        $("#sender_id").val("");
        $("#new_id").removeClass('no-display');
    });
    $("#message_selected").click(function() {
        $("#send_message").removeClass('no-display');
    });
    $("#message_selected").click(function() {
        $("#send_message").removeClass('no-display');
    });
    $("#billing_cat").change(function() {
        $("#history_cat").submit();
    });
    $("#seach_field").keyup(function() {
        var search_key, url;
        search_key = $("#seach_field").val();
        url = '<?php echo base_url(); ?>admin/ajax_member_search/' + search_key;
        $("#search_result").load(url);
    });
    $("#add_to_quick").click(function() {
        var sThisVal, sList = "";
        var existing_numbers = $("#numbers").val();
        $('input[type=checkbox]').each(function() {
            sThisVal = (this.checked ? $(this).val() : "");
            if (sThisVal != "") {
                sList += (sList == "" ? sThisVal : "," + sThisVal);
            }
        });
        existing_numbers == "" ? $("#numbers").val(existing_numbers + sList) : $("#numbers").val(existing_numbers + "," + sList);

    });
    $('#schedule_date_time').datetimepicker({
        timeFormat: "HH:mm",
        dateFormat: "yy-mm-dd",
     beforeShow: function (input, inst) {
         var offset = $(input).offset();
         var height = $(input).height();
         window.setTimeout(function () {
             inst.dpDiv.css({ top: (offset.top + height)-368 + 'px', left: offset.left + 'px' })
         }, 1);
     }
    });
    $('#schedule_date_time_2').datetimepicker({
        timeFormat: "HH:mm",
        dateFormat: "yy-mm-dd"
    });
//$("#schedule_date_time").datetimepicker();
    $(".date").dateinput({
        yearRange: [-100, 1],
        format: ' yyyy-mm-dd', // the format displayed for the user
        selectors: true, // whether month/year dropdowns are shown
        min: -36500, // min selectable day (100 days backwards)
        max: 36500, // max selectable day (100 days onwards)
        offset: [10, 20], // tweak the position of the calendar
        speed: 'fast', // calendar reveal speed
        firstDay: 1                  	// which day starts a week. 0 = sunday, 1 = monday etc..
    });
    $("#open_now").click(function() {
        $("#sms_ajax").overlay().load();
    });


// select the overlay element - and "make it an overlay"
    $("#sms_ajax").overlay({
        // some mask tweaks suitable for facebox-looking dialogs
        mask: {
            // you might also consider a "transparent" color for the mask
            color: '#000',
            // load mask a little faster
            loadSpeed: 200,
            // very transparent
            opacity: 0.8
        },
        // disable this for modal dialog-type of overlays
        closeOnClick: false,
        // load it immediately after the construction
        load: false

    });

    $(document).ready(function() {
        $('#schedule_message').hide();
        $('#schedule_box').change(function() {
            if ($(this).is(':checked')) {

                //hide send message button and show shedule message stuff
                $('#add_message').hide();
                $('#schedule_message').show();//dont_schedule
            } else {
                // hide the shedule message and show send message
                $('#add_message').show();
                $('#schedule_message').hide();
            }
        });
    });

    $(document).ready(function() {
        $('#billing_tables').dataTable({"bPaginate": true});
    })

    $(document).ready(function() {
        $("#billing_table > tbody > tr:odd").addClass("odd");
        $("#billing_table > tbody > tr:not(.odd)").addClass("even");
    });

    $('#new_line').click(function()
    {
        var txt = $('#body_mes').val();

        $('#body_mes').val(txt + ":NL");

    });
    $('#enable_search').click(function() {
        if ($('#enable_search').is(':checked')) {
            $('#search_date').removeClass("no-display");
        } else {
            $('#search_date').addClass("no-display");
        }
    });

    $('#filter').change(function() {
        $('#res').html("Loading");
        var value = $(this).val();
        var date_1 = $('#schedule_date_time').val();
        var date_2 = $('#schedule_date_time_2').val();
        $.ajax({
            url: 'users/get_sales_stats',
            data: {value: value, date_1: date_1, date_2: date_2},
            type: 'POST'
        }).done(function(result) {
            $('#res').html(result);
        });
    });

    $('#check_all').click(function() {
        if ($(this).attr('checked')) {
            $('input:checkbox').attr('checked', true);
        }
        else {
            $('input:checkbox').attr('checked', false);
        }
    });

    $('#delete_selected').click(function() {
        var ans = confirm("Are you sure you want to delete the following items");
        if (ans == true) {
            $.ajax({
                url: 'users/delete_user_account',
                data: $('form').serialize(),
                type: 'POST'
            }).done(function(result) {
                if (result === '1') {
                    window.location.href = "";
                }
            });
        }
    });

   

    /**
     * Google Analytics
     */
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-28717731-2']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();



});
