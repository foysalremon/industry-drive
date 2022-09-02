jQuery(function($){ 
	$('.id-loadmore').click(function(){
 
		var button = $(this),
            postWrap = $('#latest-post'),
		    data = {
                'action': 'loadmore',
                'query': id.posts, 
                'page' : id.current_page
            };
 
		$.ajax({ 
			url : id.ajaxurl, 
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Load More' );
                    postWrap.append(data); 
					id.current_page++;
 
					if ( id.current_page == id.max_page ) 
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
    })
});