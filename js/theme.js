
jQuery( document ).ready(function() {
    jQuery("#main_footer .links ul a").append("<i class='fas fa-arrow-right'></i>");

    // nav code
    jQuery("#main_header .bar-button").click(function(){
        jQuery("#main_header .navigation").toggleClass("show_nav");
    })
});