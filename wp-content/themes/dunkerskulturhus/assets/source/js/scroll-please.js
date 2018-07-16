DunkersKultur = DunkersKultur || {};
DunkersKultur.ScrollPlease = DunkersKultur.ScrollPlease || {};

DunkersKultur.ScrollPlease.ScrollPlease = (function ($) {

    function ScrollPlease() {
        // $(window).on('scroll', function (e) {
        //     var scrollPos = $(e.target).scrollTop();

        //     if (scrollPos > 100) {
        //         $('.scroll-down-please').fadeOut();
        //     } else {
        //         $('.scroll-down-please').fadeIn();
        //     }
        // });

        // $('.scroll-down-please').on('click', function (e) {
        //     var target = $(e.target).closest('a').attr('href');
        //     var scrollTo = $(target).offset().top - $('.navbar-mainmenu').height();

        //     $('html, body').animate({
        //         scrollTop: scrollTo
        //     }, 500);

        //     return false;
        // });
    }

    return new ScrollPlease();

})(jQuery);
