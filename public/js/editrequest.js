
   var owner;
   var verticalId;
     $(document).ready(function() {
     $('select[name="costcenter_ccowner"]').on('change', function(){
    owner = $(this).val();
       if(owner) {
           $.ajax({
               url: '/selectvertical/get/'+ owner,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               success:function(data) {

                   $('select[name="vertical_id"]').empty();
                   $('select[name="vertical_id"]').prepend('<option value="'+ " " +'">' + "--Vertical-- "+ '</option>');
                   $.each(data, function(key, value){
                    $('select[name="vertical_id"]').append('<option value="'+ key +'">' + value + '</option>').last(1);

                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="vertical_id"]').empty();
       }
     });

      $('select[name="vertical_id"]').on('change', function(){
       verticalId = $(this).val();
       if(verticalId) {
      console.log(verticalId);
      console.log(owner);
           $.ajax({
               url: '/selectcostcenter/get/'+ owner + '/'+ verticalId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },

               success:function(data) {

                   $('select[name="costcenter_id"]').empty();
                   $('select[name="costcenter_id"]').prepend('<option value="'+ " " +'">' + "--CC-- "+ '</option>');
                   $.each(data, function(key, value){

                       $('select[name="costcenter_id"]').append('<option value="'+ key +'">' + value + '</option>').last(1);

                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="costcenter_id"]').empty();
       }
     });
    });
    var costcenterID;
     $(document).ready(function() {
     $('select[name="costcenter_id"]').on('change', function(){
        costcenterID = $(this).val();
        console.log(costcenterID);
       if(costcenterID) {
           $.ajax({
               url: '/selectarea/get/'+ costcenterID,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },
               success:function(data) {
                   $('select[name="area_id"]').empty();
                   $.each(data, function(key, value){
                    $('select[name="area_id"]').append('<option value="'+ key +'">' + value + '</option>').last(1);
                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="area_id"]').empty();
       }
     });
    });


   $(function () {
     $('#datepickerdatemov').datepicker({ format: 'dd-mm-yyyy' });
   });
   $(function () {
    $('#datepickerreturndate').datepicker({ format: 'dd-mm-yyyy' });
  });
   var categoryId;
   var brandId;
   var productId;
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
   $('select[name="brand_id"]').on('change', function(){
       brandId = $(this).val();
       if(brandId) {
           $.ajax({
               url: '/selectproduct/get/'+ categoryId + '/'+ brandId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },

               success:function(data) {
                   $('select[name="product_model"]').empty();
                   $('select[name="product_model"]').prepend('<option value="'+ " " +'">' + "--Produto-- "+ '</option>');
                   $.each(data, function(key, value){
                       $('select[name="product_model"]').append('<option value="'+ key +'">' + value + '</option>').last(1);
                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="product_model"]').empty();
       }
     });
    });

    $('select[name="product_model').on('change', function(){
     productId = $(this).val();
       if(productId) {
           $.ajax({
               url: '/showavgprice/get/'+ productId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },

               success:function(data) {

                   $('select[name="invoice_itemvalue"]').empty();

                   $.each(data, function(key, value){

                       $('select[name="invoice_itemvalue"]').append('<option value="'+ value +'">'+"R$ " + value + '</option>').last(1);

                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="invoice_itemvalue"]').empty();
       }
     });

   $('select[name="product_model').on('change', function(){
     productId = $(this).val();
       if(productId) {
           $.ajax({
               url: '/showproductquantity/get/'+ productId,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },

               success:function(data) {

                document.getElementById("estoque").innerHTML = 0

                   $.each(data, function(key, value){
                    var total =  parseInt(value);
                    console.log(total);
                    document.getElementById("estoque").innerHTML = total;
                    document.getElementById("stock").value=total;
                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
        document.getElementById("estoque").innerHTML = 0;
        document.getElementById("stock").value=0;
       }
    });


 $(document).ready(function(){
   document.getElementById("additem").addEventListener("click", function(event){
       var mov= document.getElementById("invoice_itemquantity").value;
       var stock= document.getElementById("stock").value;
       var control= document.getElementsByName('control');
       mov =  parseInt(mov);
       stock =  parseInt(stock);

   if(mov > stock){
    var product_text =  $("#product_id option:selected").text();
      document.getElementById("msg").innerHTML = "Não temos quantidade solicitada do produto " + product_text + " disponível em estoque."
        event.preventDefault()
   }else{
    if(control[0].value == "0"){
          var category_text =  $("#category_id option:selected").text();
          var category_id = $("#category_id").val();
          var brand_id= $("#brand_id").val();
          var brand_text =  $("#brand_id option:selected").text();
          var product_id = $("#product_id").val();
          var product_text =  $("#product_id option:selected").text();
          var valueitem= $("#invoice_itemvalue").val();
          var quantity= $("#invoice_itemquantity").val();
          var stock= $("#inventory_qty").val();
          var markup =	 "<tr><td>"+"<input type="+"hidden"+" name=category_id[] value= " + category_id + "" +" " +"/>"+ category_text+"</td><td>"+"<input type="+"hidden"+" name=brand_id[] value= " + brand_id + "" +" " +"/>"+ brand_text+"</td><td>"+"<input type="+"hidden"+" name=product_id[] value= " + product_id + "" +" " +"/>"+ product_text+"</td><td>"+"<input type="+"hidden"+" name=itemvalue[] value= " + valueitem + "" +" " +"/>"+ valueitem+"</td><td>"+"<input type="+"hidden"+" name=quantity[] value= " + quantity+ "" +" " +"/>"+ quantity +"" +"</td><td><input type='checkbox' name='record'></td></tr>";
          $("table tbody").append(markup);
           document.getElementById("msg").innerHTML = ""
          var total=0;
          var inps = document.getElementsByName('itemvalue[]');
          var qtds = document.getElementsByName('quantity[]');
               for (var i = 0; i <inps.length; i++) {
                   var inp=inps[i];
                   var qtd = qtds[i];
                   total += parseFloat(inp.value) * qtd.value;
                   document.getElementById("total").innerHTML = total.toFixed(2);
                   document.getElementById("control").value=1;
        }

    }else{
    if(control[0].value == "1"){
        var qtd=0;
        var product = document.getElementById("product_id").value;
        var products= document.getElementsByName('product_id[]');
        var quantity= document.getElementsByName('quantity[]');
        var product_text =  $("#product_id option:selected").text();
        var qty= $("#invoice_itemquantity").val();
        var stockcontrol= document.getElementById("stock").value;
         for (var i = 0; i < products.length; i++) {
            if(products[i].value == product){
                 qtd += parseInt(quantity[i].value);

}
}
 qtd += parseInt(qty);
console.log("A quantidade é " + qtd + " o dispnivel em estoque é  " + stockcontrol)
         if(qtd > stockcontrol){
                document.getElementById("msg").innerHTML = "Não temos quantidade solicitada do produto " + product_text + " disponível em estoque."
                event.preventDefault()
                }else{
                    var category_text =  $("#category_id option:selected").text();
                    var category_id = $("#category_id").val();
                    var brand_id= $("#brand_id").val();
                    var brand_text =  $("#brand_id option:selected").text();
                    var product_id = $("#product_id").val();
                    var product_text =  $("#product_id option:selected").text();
                    var valueitem= $("#invoice_itemvalue").val();
                    var quantity= $("#invoice_itemquantity").val();
                    var stock= $("#inventory_qty").val();
                    var markup =	 "<tr><td>"+"<input type="+"hidden"+" name=category_id[] value= " + category_id + "" +" " +"/>"+ category_text+"</td><td>"+"<input type="+"hidden"+" name=brand_id[] value= " + brand_id + "" +" " +"/>"+ brand_text+"</td><td>"+"<input type="+"hidden"+" name=product_id[] value= " + product_id + "" +" " +"/>"+ product_text+"</td><td>"+"<input type="+"hidden"+" name=itemvalue[] value= " + valueitem + "" +" " +"/>"+ valueitem+"</td><td>"+"<input type="+"hidden"+" name=quantity[] value= " + quantity+ "" +" " +"/>"+ quantity +"" +"</td><td><input type='checkbox' name='record'></td></tr>";
                    $("table tbody").append(markup);
                    document.getElementById("msg").innerHTML = ""
                    var total=0;
                    var inps = document.getElementsByName('itemvalue[]');
                    var qtds = document.getElementsByName('quantity[]');
               for (var i = 0; i <inps.length; i++) {
                        var inp=inps[i];
                        var qtd = qtds[i];
                   total += parseFloat(inp.value) * qtd.value;
                   document.getElementById("total").innerHTML = total.toFixed(2);
                 }
                }
             }
          }
   }
});
$(".btn-warning").click(function(){
           $("table tbody").find('input[name="record"]').each(function(){
               if($(this).is(":checked")){
                   $(this).parents("tr").remove();
                   var total=0;
                     var total=0;
                     var inps = document.getElementsByName('itemvalue[]');
                    var qtds = document.getElementsByName('quantity[]');

               for (var i = 0; i <inps.length; i++) {
                   var inp=inps[i];
                   var qtd = qtds[i];
                   total += parseFloat(inp.value) * qtd.value;
                   document.getElementById("total").innerHTML = total.toFixed(2);
                    }
               }
           });
       });
    });

   var costcenterID;
     $(document).ready(function() {
     $('select[name="costcenter_id"]').on('change', function(){
        costcenterID = $(this).val();
       if(costcenterID) {
           $.ajax({
               url: '/selectproject/get/'+ costcenterID,
               type:"GET",
               dataType:"json",
               beforeSend: function(){
                   $('#loader').css("visibility", "visible");
               },

               success:function(data) {

                   $('select[name="project_id"]').empty();
                   $.each(data, function(key, value){
                    $('select[name="project_id"]').append('<option value="'+ key +'">' + value + '</option>').last(1);
                   });
               },
               complete: function(){
                   $('#loader').css("visibility", "hidden");
               }
           });
       } else {
           $('select[name="project_id"]').empty();
       }
     });

    });
    var total= 0;
    var inps = document.getElementsByName('itemvalue[]');
    var qtds = document.getElementsByName('quantity[]');
          for (var i = 0; i <inps.length; i++) {
              var inp=inps[i];
              var qtd = qtds[i];
              total += parseFloat(inp.value) * qtd.value;
    document.getElementById("total").innerHTML = total.toFixed(2);
          }

          $(document).ready(function() {
              var type;
                $('#invoice_type').on('change.invoice_loanstatus', function() {
                 type = $(this).val();
                 console.log(type);
                  if(type == 'E'){
                    $('#status').hide();

                  }else{
                      $('#status').show();
                  }
                }).trigger('change.invoice_loanstatus');
              });
