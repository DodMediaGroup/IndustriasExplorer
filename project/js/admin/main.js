jQuery(document).ready(function($) {
	/***** LOGIN ****/
	$("#LoginForm_username").on('focus', function(){
		$("#login-form input").removeClass('has-error');
	});
	$("#LoginForm_username").on('keypress', function(e){
		$("#login-form input").removeClass('has-error');
		if(e.which == 13)
            if($.trim($(this).val()) != "")
                $("#LoginForm_password").focus();
	});
	$("#LoginForm_password").on('focus', function(){
		$("#login-form input").removeClass('has-error');
		if($.trim($("#LoginForm_username").val()) == "")
                $("#LoginForm_username").focus();
	});
	$("#LoginForm_password").on('keypress', function(e){
		$("#login-form input").removeClass('has-error');
		if(e.which == 13)
            if($.trim($(this).val()) != "")
                $("#login-form").submit();
	});

	$("#login-form").on('submit', function(event){
		event.preventDefault();

		var error = false;

		if($.trim($("#LoginForm_username").val()) == ""){
			error = true;
			$("#LoginForm_username").addClass('has-error');
		}
		if($.trim($("#LoginForm_password").val()) == ""){
			error = true;
			$("#LoginForm_password").addClass('has-error');
		}
		if(!error && !requestAjax){
			requestAjax = true;
			$.loading();

			$.ajax( $('#login-form').attr('action'), {
	            data: $('#login-form').serialize(),
	            dataType: 'json',
	            type: 'post',
	            success: function(data){
	            	var errors = "";

	            	$.loadingClose();

	            	if (data != null){
                        $.each(data, function(key, value){
                            errors += '<p>'+value+'</p>';
                        });
                        $.loadMessage('Error', errors);
                        requestAjax = false;
                    }else{
                        window.location.reload();
                    }
	            },
	            error: function(xhr, textStatus, error){
	            	$.loadingClose();
	                $.loadMessage('Error', 'Error contactando con el servidor, intenta nuevamente.');
	                requestAjax = false;
	            }
	        });
		}
	});
	/***** END LOGIN ****/

	/**** CARGAR DATATABLE EN TABLAS ****/
	$(".js-data-table").each(function(){
		$(this).dataTable();
	});
	/**** END DATATABLE *****/

	/***** ACTIVAR CKEDITOR EN TEXTAREA ***/
    $(".js-ckeditor").each(function(){
    	$(this).ckeditor({
            toolbarGroups: [
                { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
                { name: 'links' },
                { name: 'insert' },
                '/',
                { name: 'styles' },
                { name: 'colors' },
                { name: 'tools' },
                { name: 'others' }
            ]
    	});
    });
    /***** END CKEDITOR ****/

    // MOSTRAR MODAL PARA CUALQUIER LINK QUE NECESITE CONFIRMACIÓN
    $(".js-confirm").on('click', function(event){
        event.preventDefault();
        $.loadMessage('Confirmar', $(this).attr('data-msj'), true, $(this).attr('href'));
    });
    /**** END MODAL CONFIRM ****/

    /**** CREAR WIZARD *****/
    $(".js-myWizard").each(function(){
        $(this).easyWizard({
            buttonsClass: 'btn btn-default',
			submitButtonClass: 'btn btn-primary',
			showButtons: true,
        });
    });
    /**** END WIZARD ****/

    /**** LISTAS ARRASTRABLES ****/
    $.updateOutput = function(){
    	$('#nestable-output').val(window.JSON.stringify($('.nestable.nestable_out').nestable('serialize')));
    }
    if($('.nestable').length){
	    $('.nestable').nestable({
	        group: $(this).attr('data-group'),
	        maxDepth: 2
	    })
	    .on('change', $.updateOutput);
	    $.updateOutput();

	    $('.js-add-item-list').on('click', function(event) {
	    	event.preventDefault();
	    	if($.trim($('#add_item_menu').val()) != ""){
	    		$('.nestable_in .dd-list').append($('<li>',{
		    		class: 'dd-item'
		    	}).attr('data-id', $('#add_item_menu').val()).append($('<div>',{
		    		class: 'dd-handle',
		    		text: $('#add_item_menu').val(),
		    	})));
	    	}
	    });
    }
    /**** END LISTAS ARRASTRABLES ****/

    /**** ACTIVAR SELECTOR DE FECHAS ****/
    $(".js-my-datepicker").each(function(){
        if(typeof $(this).find('input').attr('data-timePicker') != 'undefined')
            timePicker = ($(this).find('input').attr('data-timePicker') == 'false')?false:true;
        $(this).datetimepicker({
            language: 'es',
            pickTime: timePicker
        });
    });
    /**** SELECTOR FECHAS ****/

    /*** MOSTRAR IMAGEN ANTES DE SER CARGADA ****/
    $('.js-show-before').on('change', function(){
    	$.readBeforeFile(this);
    });
    /**** END PREIMAGE ****/

    /**** VALIDAR CAMPOS SOLO NUMERICOS ****/
    $(document).on('keypress', '.js-input-number', function(event){
        if(!((event.which <= 57 && event.which >= 48) || event.which == 8))
            event.preventDefault();
    });
    /***** END SOLO NUMEROS ****/
});

$.loading = function(){
	$("#md-active-loading").click();
}
$.loadingClose = function(){
	$("#modal-ajax-loading .md-close").click();
}
$.loadMessage = function(title, content, close, redirect){
	var close = close || true;
	var redirect = redirect || "";
	var modal = $("#modal-message");

	modal.find("h3").text(title);
	modal.find(".message-content").html('');
	modal.find(".message-content").prepend(content);

	if(!close)
		modal.find(".md-close").addClass('v-none');
	if(redirect != "")
		modal.find(".md-redirect").attr('href', redirect);
	else
		modal.find(".md-redirect").addClass('v-none');

	$("#md-active-message").click();
}

$.readBeforeFile = function(input){
	var content = input.getAttribute('data-before');

	if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
        	$(content).html('');
            $(content).append($('<div>', {
            	class:"img"
            }).css('background-image', 'url('+e.target.result+')'));
        }

        reader.readAsDataURL(input.files[0]);
    }
}