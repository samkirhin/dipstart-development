$(function(){
    $('select[name="category_id"]').change(function(){
        $('input[type="checkbox"]').removeAttr('checked');
        var checked = $(this).find(':selected').attr('data').split('|');
        for(var i = 0; i < checked.length; i++) {
            $('.privilege_'+checked[i]).prop('checked', true);
        }
    });
    $('.select_all').click(function(e){
        e.preventDefault();
        $('input[type="checkbox"]').prop('checked', true);
    });
    $('.deselect_all').click(function(e){
        e.preventDefault();
        $('input[type="checkbox"]').removeAttr('checked');
    });
    $('label.prnt').click(function(e){
        e.preventDefault();
        var cbox = $(this).find('input[type="checkbox"]');
        if(cbox.prop('checked')) {
            cbox.prop('checked', false);
            $('label.child[data-parent="'+$(this).attr('data-num')+'"]').find('input[type="checkbox"]').prop('checked', false);
        } else {
            cbox.prop('checked', true);
            $('label.child[data-parent="'+$(this).attr('data-num')+'"]').find('input[type="checkbox"]').prop('checked', true);
        }
    });
});