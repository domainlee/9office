jQuery(document).ready(function(){

    if (jQuery('#your-profile').length > 0) {
        var table_list = jQuery('.form-table');
        jQuery('#your-profile').find('h3').remove();
        var profile = jQuery('#your-profile').find('h2').remove();
        var profile = jQuery('#your-profile').find('.yoast-settings').remove();
        var c = 0;

        table_list.each(function () {
            c++;
            var table = jQuery(this);
            if (c != 5) {
                table.css({'display': 'none'});
            }
        });
    }
});