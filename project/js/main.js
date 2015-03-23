jQuery(document).ready(function($) {
	/***** PRINCIPAL SLIDE ******/
    $('.camera_wrap').each(function(index, el) {
        $(this).camera({
            fx: 'simpleFade',
            hover: false,
            height: '380px',
            loader: 'none',
            pagination: true,
            pauseOnClick: false,
            playPause: false
        });
    });

    /***** FANCYBOX *****/
    $(".fancybox").each(function(index, el) {
    	$(this).fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});
    });

    $('.js-form-customer').on('submit', function(event) {
        event.preventDefault();
        $user = $.trim($('#login-user').val());
        $pass = $.trim($('#login-pass').val());

        if($user == '')
            $('#login-user').blur();
        else if($pass == '')
            $('#login-pass').blur();
        else{
            $loading = $.addLoading();

            $.ajax( $(this).attr('action'), {
                data: $(this).serialize(),
                dataType: 'json',
                type: 'post',
                success: function(data){
                    if (data.status == false){
                        $loading.remove();
                        $.showMessage('error', data.message);
                    }else{
                        window.location.reload();
                    }
                },
                error: function(xhr, textStatus, error){
                    $loading.remove();
                    $.showMessage('error', 'Error contactando con el servidor, intenta nuevamente.');
                }
            });
        }
    });

    $('.js-form-contact').on('submit', function(event) {
        event.preventDefault();

        $loading = $.addLoading();
        $.ajax( $(this).attr('action'), {
            data: $(this).serialize(),
            dataType: 'json',
            type: 'post',
            success: function(data){
                if(data.status == true){
                    $(this).find('input, textarea').val('').html('');
                }
                $loading.remove();
                $.showMessage(data.status, data.message);
            },
            error: function(xhr, textStatus, error){
                $loading.remove();
                $.showMessage('error', 'Error contactando con el servidor, intenta nuevamente.');
            }
        });
    });
});

$.addLoading = function(){
    $loading = $('<div>',{
        class:"ajax-load"
    });
    $('body').append($loading);

    return $loading;
}
$.showMessage = function(type, message){
    var alert = $('<div>', {
        class: type+' my-message',
        text: message
    });

    $('body .container').append(alert);

    setTimeout(function() {
        alert.remove();
    }, 5000);
}