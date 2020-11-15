// Background-image responsive
this.imgResponsive();

$(window).resize(function() {
    $('.user-img').each(function() {
        let width = $(this).width();
        $(this).css({
            height: width,
        });
    });
});

function imgResponsive() {
    let width = $('.user-img').width();
    $('.user-img').css({
        height: width,
    });
}