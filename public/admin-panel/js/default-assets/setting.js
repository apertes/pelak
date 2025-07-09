(function($) {
  'use strict';
  $(function() {
    $(".nav-settings").on("click", function() {
      $("#right-sidebar").toggleClass("open");
    });
    $(".settings-close").on("click", function() {
      $("#right-sidebar,#theme-settings").removeClass("open");
    });

    $("#settings-trigger").on("click" , function(){
      $("#theme-settings").toggleClass("open");
    });

    //background constants
    var sidebar_classes = "sidebar-light sidebar-dark sidebar-color";
    var $body = $("body");

    // Load saved theme from localStorage
    var savedTheme = localStorage.getItem('selectedTheme');
    if (savedTheme) {
      $body.removeClass(sidebar_classes);
      $body.addClass(savedTheme);
      $('.sidebar-bg-options').removeClass('selected');
      $('#' + savedTheme + '-theme').addClass('selected');
    }

    //sidebar backgrounds
    $("#sidebar-light-theme").on("click" , function(){
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-light");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('selectedTheme', 'sidebar-light');
    });
    
    $("#sidebar-dark-theme").on("click" , function(){
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-dark");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('selectedTheme', 'sidebar-dark');
    });
    
    $("#sidebar-color-theme").on("click" , function(){
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-color");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
      localStorage.setItem('selectedTheme', 'sidebar-color');
    });
  });
})(jQuery);