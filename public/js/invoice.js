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
   

   $(document).ready(function(){
       $(".btn-info").click(function(){
           var category_text =  $("#category_id option:selected").text();
           var category_id = $("#category_id").val();
           var brand_id= $("#brand_id").val();
           var brand_text =  $("#brand_id option:selected").text();
           var product_id = $("#product_id").val();
           var product_text =  $("#product_id option:selected").text();
           var valueitem= $("#invoice_itemvalue").val();
           var quantity= $("#invoice_itemquantity").val();
           var markup =	 "<tr><td>"+"<input type="+"hidden"+" name=category_id[] value= " + category_id + "" +" " +"/>"+ category_text+"</td><td>"+"<input type="+"hidden"+" name=brand_id[] value= " + brand_id + "" +" " +"/>"+ brand_text+"</td><td>"+"<input type="+"hidden"+" name=product_id[] value= " + product_id + "" +" " +"/>"+ product_text+"</td><td>"+"<input type="+"hidden"+" name=itemvalue[] value= " + valueitem + "" +" " +"/>"+ valueitem+"</td><td>"+"<input type="+"hidden"+" name=quantity[] value= " + quantity+ "" +" " +"/>"+ quantity+"</td><td><input type='checkbox' name='record'></td></tr>";
           $("table tbody").append(markup);
           var total=0;
           var inps = document.getElementsByName('itemvalue[]');
           var qtds = document.getElementsByName('quantity[]');
                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    var qtd = qtds[i];
                    total += parseFloat(inp.value) * (qtd.value);
          document.getElementById("total").innerHTML = total.toFixed(2);
                }
       });
       
       // Find and remove selected table rows
       $(".btn-warning").click(function(){
           $("table tbody").find('input[name="record"]').each(function(){
               if($(this).is(":checked")){
                   $(this).parents("tr").remove();
                   var total=0;
                   var inps = document.getElementsByName('itemvalue[]');
                   var qtd = document.getElementsByName('quantity[]');
                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    var qtd = qtds[i];
                    total += parseFloat(inp.value) * (qtd.value);
          document.getElementById("total").innerHTML = total.toFixed(2);
                }
               }
           });
       });
   });  
   

   $(function () {
     $('#datepickerbill').datepicker({ format: 'dd-mm-yyyy' });
   });

   $(function () {
     $('#datepickerdue').datepicker({ format: 'dd-mm-yyyy' });
   });

   $(document).ready(function() {
   var type;
     $('#invoice_typemov').on('change.invoice_number', function() {
      type = $(this).val();
       if(type == 'Legado'){
       var random  = Math.floor(Math.random() * 1000000) + 1; 
       document.getElementById("invoice_number").value = "SN-" + random;
       }else{
           document.getElementById("invoice_number").value = " "; 
       }
     }).trigger('change.invoice_number');
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
   
   var costcenterID;
     $(document).ready(function() {
     $('select[name="costcenter_id"]').on('change', function(){
        costcenterID = $(this).val();
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
   
    var total= 0;
    var inps = document.getElementsByName('itemvalue[]');
    var qtds = document.getElementsByName('quantity[]');
          for (var i = 0; i <inps.length; i++) {
              var inp=inps[i];
              var qtd = qtds[i];
              total += parseFloat(inp.value) * qtd.value;
    document.getElementById("total").innerHTML = total.toFixed(2);
          }

