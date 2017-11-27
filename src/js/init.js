import 'jquery';

$('.header-hamburger').click(function (event) {
    event.preventDefault();

    $(this).toggleClass('is-active');
    $('.site').toggleClass('site-sidebar');
    $('.sidebar').toggleClass('sidebar-hide');

    // Toggle container widths
    $('.site-main').toggleClass('container-sidebar');
    $('.intro-container').toggleClass('container-sidebar');
    $('.custom-header').toggleClass('container-sidebar');
    $('.site-footer .container').toggleClass('container-sidebar');
});

