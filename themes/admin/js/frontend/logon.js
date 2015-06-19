$(function(){
    if(!!document.getElementById('logon')) {
        $('#logon').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '/user/auth',
                type: 'POST',
                data: 'login='+$('#email').val()+'&password='+$('#password').val(),
                success: function(data) {
                    if(data.success) {
                        document.location.href = data.url;
                    } else {
                        $('#error').html(data.error);
                    }
                }
            });
        });
    }
});