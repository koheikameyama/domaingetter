  $('#new_todo_form').on('submit', function(){
    // idを取得
    var title = $('#new_todo').val();
    //ajax処理
    $.post('_ajax.php',{
      title: title,
      mode: 'create',
      token: $('#token').val()
    },function(res){
    /*3の処理*/
    });
  });