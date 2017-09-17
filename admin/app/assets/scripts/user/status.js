$(document).ready(function () {
  //$('.table td').css('cursor', 'pointer');

  $('.seat').click(function(event) {
    if(confirm(($(this).parent().index()+1) + " " + ($(this).index()))==true)
    // console.log("Seat: "+$(this).parent().index() +", "+$(this).parent().index()); 
  });
});
