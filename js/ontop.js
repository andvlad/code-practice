jQuery(document).ready(function($){
        var
        //скорость прокрутки к началу страницы
        speed = 500,
        //html-разметка кнопки
        $scrollTop = $('<a href="#" title="Быстро вернуться наверх" class="scrollTop"><i class="fa fa-angle-double-up"></i></a>').appendTo('body');        
        $scrollTop.click(function(e){
            e.preventDefault();
            $( 'html:not(:animated),body:not(:animated)' ).animate({ scrollTop: 0}, speed );
        });
        //настройка режима появления кнопки
        function show_scrollTop(){
            ( $(window).scrollTop() > 300 ) ? $scrollTop.fadeIn(600) : $scrollTop.fadeOut(600);
        }
        $(window).scroll( function(){ show_scrollTop(); } );
        show_scrollTop();
        });