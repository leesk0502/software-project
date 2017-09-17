$(document).ready(function(){
  $( ".options" ).change(function() {
    var idx=$(this).data("idx");
    var state=$(this).val();
    $.ajax({
      'url': '/user/ajax/change_state.json',
      'type': 'post',
      'dataType': 'json',
      'data': {
        'idx': idx,
        'state': state
      },
      'success': function(result){
        alert(result.test);
      }
    });
    if($(this).val()=='2') {
      alert( "Completed." );
    }  
  });
});
