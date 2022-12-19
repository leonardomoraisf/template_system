$( function () {
    var open = true;
    var windowSize = $(window)[0].innerWidth;

    var targetSizeMenu = (windowSize <= 400) ? 200 : 300;

    if(windowSize <= 768){
        $('.sidebar').css('width','0').css('padding','0');
        open = false;

    }

    $('.top-menu-btn').click( function() {
        if(open){
            // Menu está abero, precisa fechar
            $('.sidebar').animate({'width':'0','padding':'0'}, function () {
                open = false;
            });
            $('.content,header').css({'width':'100%'});
            $('.content,header').animate({'left':'0'},function () {
                open = false;
            });
        }else{
            // Menu está fechado, precisa abrir
            $('.sidebar').css('display','block')
            $('.sidebar').animate({'width':targetSizeMenu+'px','padding':'30px'}, function () {
                open = true;
            });
            $('.content,header').css({'width':'calc(100% - 300px'});
            $('.content,header').animate({'left':targetSizeMenu+'px'},function () {
                open = true;
            });
        }
    })

    $(window).resize( function(){
        windowSize = $(window)[0].innerWidth;
        if(windowSize <= 768){
            $('.menu').css('width','0').css('padding','0');
            $('.context,header').css('width','100%').css('left','0');
            open = false;
        }else{
            open = true;
            $('.context,header').css('width','calc(100% - 300px').css('left','300px');
            $('.menu').css('width','300px').css('padding','30px');
        }
    })

})