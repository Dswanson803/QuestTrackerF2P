$(document).ready( function() {

//Changes the header size after scrolling 100 or more px.
 var shrinkHeader = 100;
 $(window).scroll(function() {
    var scroll = yPos();
      if ( scroll >= shrinkHeader ) {
          $('.header-nav').addClass('shrink');
          $('.logo').addClass('shrink');
        }
        else {
            $('.header-nav').removeClass('shrink');
            $('.logo').removeClass('shrink');
        }
  });

    //Returns the position of the y-axis. 
    //The multiple ||'s are for browser compatibility.
    function yPos() {
        return window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
    }
    
});