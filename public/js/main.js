var url = "http://proyecto-laravel.com.devel";

window.addEventListener("load", function(){
	$('.btn-like').css('cursor','pointer');
	$('.btn-dislike').css('cursor','pointer');

	$(document).on("click", ".btn-like", function(e){
		$(this).addClass('btn-dislike').removeClass('btn-like');
		$(this).attr('src', url+'/img/heart-red.png');

        $.ajax({
            url: url+'/like/'+$(this).data('id'),
            type: 'GET',
            success: function(response){
                if(response.like){
                    console.log('Has dado like a la publicación');
                }else{
                    console.log('Error al dar like');
                }
            }
        });

	});

	$(document).on("click", ".btn-dislike", function(e){
		$(this).addClass('btn-like').removeClass('btn-dislike');
		$(this).attr('src', url+'/img/heart-black.png');

        $.ajax({
            url: url+'/dislike/'+$(this).data('id'),
            type: 'GET',
            success: function(response){
                if(response.like){
                    console.log('Has dado dislike a la publicación');
                }else{
                    console.log('Error al dar dislike');
                }
            }
        });

	});
});
