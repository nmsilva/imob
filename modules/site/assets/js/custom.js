
$(document).ready(function() {
        
    $('.slide-imoveis li a').click(function(){
        
        $('.active').each(function(){
            $(this).removeClass('active');
        });
        
        $(this).parent().addClass('active');
        
        return false;
    });
    
    $('.fotos-imovel ul li span.pover').hide();
    $('.fotos-imovel ul li a').mouseover(function(){
        $(this).children('span.pover').fadeTo("fast", 0.5);
    });
    
    $('.fotos-imovel ul li a').mouseout(function(){
        $(this).children('span.pover').hide();
    });
    
    $("a[rel=photo_gallery]").fancybox({
            'transitionIn'		: 'elastic',
            'transitionOut'		: 'elastic',
            'titlePosition' 	: 'over',
            'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
    });
   
    $('.destaque-link').click(function(){
        var id=$(this).attr('rel');

        var url=site_url+"site/home/imovel/"+id;
        
        $('#imovel-destaque').html('');
        $('#imovel-destaque').addClass('loading');
        
        $('#imovel-destaque').load(url, function() {
                $('#imovel-destaque').removeClass('loading');
        });
    });
   
});
