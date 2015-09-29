
var home_window_width_old;
jQuery(document).ready(function(){

    alert('script alert');

    home_window_width_old = jQuery('.container').width();
    if( home_window_width_old < 750  ){
        jQuery('#our_services_wrap').parallaxonegridpinterest({columns: 1,selector: '.service-box'});
        jQuery('#happy_customers_wrap').parallaxonegridpinterest({columns: 1,selector: '.testimonials-box'});
    } else {
        jQuery('#our_services_wrap').parallaxonegridpinterest({columns: 2,selector: '.service-box'});
        jQuery('#happy_customers_wrap').parallaxonegridpinterest({columns: 2,selector: '.testimonials-box'});
    } 
});

jQuery(window).resize(function() {
    if( home_window_width_old != jQuery('.container').outerWidth() ){
        home_window_width_old = jQuery('.container').outerWidth();
        if( home_window_width_old < 750  ){
            jQuery('#our_services_wrap').parallaxonegridpinterest({columns: 1,selector: '.service-box'});
            jQuery('#happy_customers_wrap').parallaxonegridpinterest({columns: 1,selector: '.testimonials-box'});
        } else {
            jQuery('#our_services_wrap').parallaxonegridpinterest({columns: 2,selector: '.service-box'});
            jQuery('#happy_customers_wrap').parallaxonegridpinterest({columns: 2,selector: '.testimonials-box'});
        } 
    }
});


