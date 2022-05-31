(function() {
    'use strict';
  
    function trackScroll() {
      var scrolled = window.pageYOffset;
  
      if (scrolled > 300) {
        goTopBtn.classList.add('back_to_top-show');
      }
      if (scrolled < 300) {
        goTopBtn.classList.remove('back_to_top-show');
      }
    }
  
    function backToTop() {
      if (window.pageYOffset > 0) {
        window.scrollBy(0, -45);
        setTimeout(backToTop, 0);
      }
    }
  
    var goTopBtn = document.querySelector('.back_to_top');
  
    window.addEventListener('scroll', trackScroll);
    goTopBtn.addEventListener('click', backToTop);
  })();