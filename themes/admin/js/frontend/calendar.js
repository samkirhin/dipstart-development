$(function(){
    if($('.date_field').length) {
        $('.date_field').datepicker({
            dateFormat: 'yy-mm-dd',
            monthsToShow: 3,
            monthsOffset: 1
        });
    }
    if($('.date_field_small').length) {
        $('.date_field_small').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
});