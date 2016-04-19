
(function($){
    $(function(){
        $(".button-collapse").sideNav();
        $(".collapse_button").sideNav();
        //$('.collapsible').collapsible();
        $('.slider').slider({
            full_width: true,
            indicators: true,
            interval: 5000,
            height: 550
        });
        $('.materialboxed').materialbox();
        $(".dropdown-button").dropdown();
        $('.button-collapse').sideNav();
        $('.parallax').parallax();
        $('.modal-trigger').leanModal();
        $('select').material_select();
        $('input#input_text, textarea#textarea1').characterCounter();
        $('input#input_text, textarea#textarea2').characterCounter();

    }); // end of document ready
})(jQuery); // end of jQuery name space