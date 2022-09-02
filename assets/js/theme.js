jQuery(function($){ 
    var queryData = {
        'action': 'loadmore',
        'page' : 2
    };

	$('.id-loadmore').click(function(){
 
		var button = $(this),
            postWrap = $('#latest-post');
 
		$.ajax({ 
			url : id.ajaxurl, 
			data : queryData,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Load More' );
                    postWrap.append(data.posts); 
					queryData.page++;
 
					if ( queryData.page == data.max_page ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
	});

    var target = $('.site-navbar');
    var position = target.position();
    window.addEventListener('scroll', function () {
        var height = $(window).scrollTop();
        if (height > position.top) {
            target.addClass('affix');
        } else {
            target.removeClass('affix');
        }
    });

    $('.btn-menu-toggle').on('click', function() {
        if ($('.site-navbar').is(':hidden')) {
            $('.site-navbar').slideDown();
            $(this).html('<span class="dashicons dashicons-no-alt"></span>');
        } else {
            $('.site-navbar').slideUp();
            $(this).html('<span class="dashicons dashicons-menu"></span>');
        }
    });

    $(window).on('resize orientationchange', function(){
        if ($(window).width() < 1024) {
            $('.site-navbar').css('display', 'none');
        } else {
            $('.site-navbar').css('display', 'block');
        }
    });
});