$('#log-in').click(function(e){
    e.preventDefault();
    $.ajax({
        url: 'check_user.php',
        type: 'POST',
        data: $('#login-form').serialize(),
        success: function(msg){
            if(msg == 'success'){
                window.location.replace('/admin');
            }
            else{
                $('#log-in-fail-descr').html(msg);
                $('#password').val('');
                $('#password').parent().addClass('has-error').addClass('has-feedback')
                $('.glyphicon').removeClass('hidden');
            }
        }
    })
});