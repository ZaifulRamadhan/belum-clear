$(document).ready(function(){
    $('.increment-btn').click(function(e){
      e.preventDefault();
      var $input = $(this).closest('.product_data').find('.input-qty');
      var value = parseInt($input.val(), 10);
      value = isNaN(value) ? 0 : value;
      if(value < 10) {
        value++;
        $input.val(value);
      }
    });
  
    $('.decrement-btn').click(function(e){
      e.preventDefault();
      var $input = $(this).closest('.product_data').find('.input-qty');
      var value = parseInt($input.val(), 10);
      value = isNaN(value) ? 0 : value;
      if(value > 1) {
        value--;
        $input.val(value);
      }
    });
  });