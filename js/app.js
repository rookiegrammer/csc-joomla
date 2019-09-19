(function($) {
    var defaults={
        sm : 540,
        md : 720,
        lg : 960,
        xl : 1140,
        navbar_expand: 'lg'
    };
    $.fn.bootnavbar = function() {

        if (matchMedia('(pointer:fine)').matches) {
          $(this).find('.dropdown').hover(function() {
              $(this).addClass('show');
              $(this).find('.dropdown-menu').first().addClass('show').addClass('animated fadeIn').one('animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd', function () {
                  $(this).removeClass('animated fadeIn');
              });
          }, function() {
              $(this).removeClass('show');
              $(this).find('.dropdown-menu').first().removeClass('show');
          });
        }

        $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
          if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
          }
          $(this).toggleClass('toggled');
          var $subMenu = $(this).next(".dropdown-menu");
          $subMenu.toggleClass('show');

          $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
          });

          return false;
        });
    };
})(jQuery);

$(function ($) {
    $('.easynavbar').bootnavbar();
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
    $(document).on("click", 'a[href^="#"]', function(event) {
      event.preventDefault();
      var jump = $(this).attr('href');
      $.scrollTo(jump, 300);
    });
})
