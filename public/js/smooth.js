// slide
$(document).ready(function(){
    $(".thumbnail-button").click(function() {
      var target = $(this).attr("href");
      $("html, body").animate({
        scrollTop: $(target).offset().top
      }, 1000); // Change the duration to 1000 milliseconds (1 second)
    });
  });
  