$("#adverts > div:gt(0)").hide();

setInterval(function() {
  $('#adverts > div:first')
    .fadeOut(500)
    .next()
    .fadeIn(500)
    .end()
    .appendTo('#newsletter');
},  10000);
