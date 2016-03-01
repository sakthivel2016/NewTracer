brfore_load()// Initial load only


function brfore_load(){
    var container = '#container_content';

    
    jQuery(container).prepend('<div class="overly_wrap"></div>');
    jQuery(container).find('.overly_wrap').append('<div class="ajaxloaderoverlay"><div class="ajaxloader"></div></div>');
    jQuery(container).find('.overly_wrap').css({'background':'#ffffff','height': '600px','position': 'absolute','width': '100%','z-index': '100000000'});
    jQuery(container).find('.overly_wrap').animate({opacity: ".8"});

    var overlay  = jQuery(container).find('.ajaxloaderoverlay'); 
    var loader  = jQuery(container).find('.ajaxloader');  

    overlay.css({ "position":'absolute',"top":'250px',"left":'550px'});
    loader.css({"margin":0,"padding":0,"position":'absolute'});
}// End before load fun

function remove_loader(){
    jQuery('#container_content').find('.overly_wrap').animate({'opacity':1});
    jQuery('#container_content').find('.overly_wrap').remove();
}
            
$(document).ready(function () {
    remove_loader()//Initial load only
}); // End document