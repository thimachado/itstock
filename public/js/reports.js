var categoryId;
var brandId;
  $(document).ready(function() {
  $('select[name="category_id"]').on('change', function(){
    categoryId = $(this).val();
    if(categoryId) {
        $.ajax({
            url: '/selectbrand/get/'+ categoryId,
            type:"GET",
            dataType:"json",
            beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },
  
            success:function(data) {
  
                $('select[name="brand_id"]').empty();
                $('select[name="brand_id"]').prepend('<option value="'+ " " +'">' + "--Marca-- "+ '</option>');
                $.each(data, function(key, value){
                 $('select[name="brand_id"]').append('<option value="'+ key +'">' + value + '</option>').last(1);
  
                });
            },
            complete: function(){
                $('#loader').css("visibility", "hidden");
            }
        });
    } else {
        $('select[name="brand_id"]').empty();
    }
  });

});

