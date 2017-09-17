$(document).ready(function () {

  var cnt = 0;
  $('#add').click(function(event) {
    var val = $('#time').val();   
    $('#menu').append('<li class="item" id="'+(cnt++)+'"><a>'+val+'</a></li>');
    event.preventDefault();
    //$('input[type="hidden"]').each (function() { this.type = 'text'; });
    $(".time_label").show();

    $("#time_hidden_div").append($("<input type='hidden' name='time[]' value='"+val+"' />"));
  });

  $(document).on("click", "li.item" , function() {
    $(this).remove();
  });

  $('#submit_register').click(function(event) {
    alert("공연이 등록되었습니다.");
  });

  $('#cancel_register').click(function(event) {
    alert("등록이 취소되었습니다.");
  });
});
