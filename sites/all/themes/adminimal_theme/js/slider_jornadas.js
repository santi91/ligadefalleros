(function($) {
  Drupal.behaviors.sliderJornadas = {
    attach: function (context) {
      var slides = document.querySelectorAll('.slideshow-container-grupo-1 .mySlides-grupo-1');
      var currentSlide = 0;
      var slideInterval = setInterval(nextSlide, 10000);

      var slides2 = document.querySelectorAll('.slideshow-container-grupo-2 .mySlides-grupo-2');
      var currentSlide2 = 0;
      var slideInterval2 = setInterval(nextSlide2, 10000);

      function nextSlide() {
        slides[currentSlide].className = 'mySlides-grupo-1';
        currentSlide = (currentSlide+1)%slides.length;
        slides[currentSlide].className = 'mySlides-grupo-1 showing';
      }

      function nextSlide2() {
        slides2[currentSlide2].className = 'mySlides-grupo-2';
        currentSlide2 = (currentSlide2+1)%slides2.length;
        slides2[currentSlide2].className = 'mySlides-grupo-2 showing';
      }
    }
  }
})(jQuery);
