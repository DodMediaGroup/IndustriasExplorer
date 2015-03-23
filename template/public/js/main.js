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
});