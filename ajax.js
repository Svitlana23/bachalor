

/*$(function(){
  $('#my_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
        fData = $that.serialize(); // сериализируем данные
        // ИЛИ
        // fData = $that.serializeArray();
    $.ajax({
      url: $that.attr('action'), // путь к обработчику берем из атрибута action
      type: $that.attr('method'), // метод передачи - берем из атрибута method
      data: {form_data: fData},
      dataType: 'json',
      success: function(json){
        // В случае успешного завершения запроса...
        if(json){
          $that.replaceWith(json); // заменим форму данными, полученными в ответе.
        }
      }
    });
  });
});*/