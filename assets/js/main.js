jQuery(document).ready(function($) {
    if (wopo_calculator.is_shortcode != 0){        
        $('#wopo_calculator').attr('src',wopo_calculator.app_url);
        $('#wopo_calculator_window').show('slow');
    }
    $('#wopo_calculator_window .btn-close').click(function(){        
        $('#wopo_calculator_window').hide('slow');
    });    
    $('#wopo_calculator_window .btn-minimize').click(function(){        
        $('#wopo_calculator_window').removeClass('maximize').toggleClass('minimize');
    });
    $('#wopo_calculator_window .btn-maximize').click(function(){
        $('#wopo_calculator_window').removeClass('minimize').toggleClass('maximize');
    });
});