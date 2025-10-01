$(window).scroll(function(){
  // The total height of the jumbotron
  var scrollTop = $('#banner').outerHeight(true);
  var barHeight=$('.navbar').outerHeight(true);
  // If the user scrolls down
  if($(window).scrollTop() >= scrollTop) {
    // Fix to top
    $( "#navbar" ).addClass( "navbar-fixed-top" );
    // And padding-top to the body so the content does not jump up (50px is the height of the now fixed to top navbar)
    $("body").css("padding-top",barHeight);
  }
  // If the user scrolls back up
  if($(window).scrollTop() < scrollTop){
    // Undo
    $( "#navbar" ).removeClass( "navbar-fixed-top" );
    $("body").css("padding-top","0px");
  }
})

