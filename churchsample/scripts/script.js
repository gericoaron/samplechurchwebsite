$(document).ready(function(){
    $('a[href^="#]').on('click', function (e) {e.preventDefault();
        var target = this.hash;
        var $target = $(target);
    $('html','body').stop().animate({
        'scrollTop': $target.offset().top-100
    }, 1000, 'swing', function () {
            window.location.hash = target-100;
    });
});
});
    $(document).ready(function(){
    $(window).scroll(function(){
    if(this.scrollY > 30){
        $('nav ul').addClass("sticky");
    }else {
        $('nav ul').removeClass("sticky");
    }


});
});

$('.menu-btn').click(function(){
$('nav ul').toggleClass("active");
$('nav ul .menu-btn i').toggleClass("active");

});
