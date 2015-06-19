/**
 * Created by coolfire on 08.05.15.
 */
function reload(){
    location.reload();
}
function add_part(orderid){
    $.post('/project/zakazParts/apiCreate', JSON.stringify({
        'orderId': orderid,
        'name': 'Новая Часть'
    }), function (response) {
        if (response.data) {
            reload();
        }
    }, 'json');
}
function delete_part(orderid) {
    $.post('/project/zakazParts/apiDelete', JSON.stringify({
        'id': orderid
    }), function (response) {
        if (response.data) {
            reload();
        }
    }, 'json');
}
function change_title(new_title,part_id){
    $.post('/project/zakazParts/apiEditPart', JSON.stringify({
        'id': part_id,
        'title': new_title
    }), function (response) {
        if (response.data.result) {
            $('#part_title_'.part_id).html(new_title);
        }
    }, 'json');
}
function change_comment(new_comment,part_id){
    $.post('/project/zakazParts/apiEditPart', JSON.stringify({
        'id': part_id,
        'comment': new_comment
    }), function (response) {}, 'json');
}
function send(url) {
    var formData = new FormData($("#up_file")[0]);
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        datatype: 'json',
        success: function (data,textStatus,errorThrown) {
            jQuery("#list_files").load(url.replace('add','list'));
            console.log(data);
            if (data.error) alert(data.error.ProjectChanges_file);
        },
        error: function (data,textStatus,errorThrown) {
            alert(data);
        },
        processData: false,
        contentType: false,
        cache: false
    });

    return false;
}
function approve(obj){
    var data=$(obj).data();
    $.post('/project/zakazParts/apiApprove', JSON.stringify({
        'data': data
    }), function (response) {
        if (response.data) {
            console.log(response);
        }
    }, 'json');
}
/*$( document ).ready( function() {
    $('#partEdit').on('click',function(event){
        console.log(event);
    });
});*/