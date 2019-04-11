{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque')
@section('content_header')
<h1>HB Estoque</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Estoque</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
   <form class="form-horizontal" method="POST" action="{{ url('/savestockregister') }}">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('category_name') ? 'has-error' : '' }}">
               <select id="category_id" type="text" class="form-control" name="category_id" required>
                  <option value=""> </option>
                  @foreach($datacategory as $details)
                  <option value="{{$details->id}}">{{$details->category_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('category_name'))
               <span class="help-block">
               <strong>{{ $errors->first('category_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Marca</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('brand_name') ? 'has-error' : '' }}">
               <select id="brand_id" type="text" class="form-control" name="brand_id" required>
                  <option value=""> </option>
                  @foreach($databrand as $details)
                  <option value="{{$details->id}}">{{$details->brand_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('brand_name'))
               <span class="help-block">
               <strong>{{ $errors->first('brand_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Modelo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('product_model') ? 'has-error' : '' }}">
               <select name="product_model" class="form-control">
                  <option>--Product Model--</option>
               </select>
               @if ($errors->has('product_model'))
               <span class="help-block">
               <strong>{{ $errors->first('product_model') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Quantidade</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('stock_quantity') ? 'has-error' : '' }}">
               <input type="text"  id="stock_quantity" name="stock_quantity"  class="form-control" value="{{old('stock_quantity')}}" required autofocus>
               @if ($errors->has('stock_quantity'))
               <span class="help-block">
               <strong>{{ $errors->first('stock_quantity') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="form-group">
         <div class="col-sm-offset-2 col-sm-10">
         </div>
      </div>
</div>
<div class="box-footer">
<button type="submit" class="btn btn-info pull-right">Registrar</button>
</form>
</div>
<!-- /.box-footer -->
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Produtos</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="stocksdt" >
         <thead>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Quantidade em Estoque</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($stock as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->product_model}}</td>
               <td>{{$details->brand_name}}</td>
               <td>{{$details->category_name}}</td>
               <td>{{$details->stock_quantity}}</td>
               <td><a href="editstock/{{$details->id}}">EDITAR <a href="deletestock/{{$details->id}}" onclick="return dele()"> | DELETAR </a></td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <!-- /.box-body -->
</div>
@stop
@section('js')
<script>
   $(document).ready(function() {
       $('#stocksdt').DataTable();
   } );
</script>
<script>
   var categoryId;
   var brandId;
   
   $(document).ready(function() {
   
   $('select[name="category_id"]').on('change', function(){
     categoryId = $(this).val();
   })
   
   $('select[name="brand_id"]').on('change', function(){
   
     brandId = $(this).val();
     console.log(categoryId);
     console.log(brandId);
     
     if(brandId) {
         $.ajax({
             url: '/select/get/'+categoryId + '/'+ brandId,
             type:"GET",
             dataType:"json",
             beforeSend: function(){
                 $('#loader').css("visibility", "visible");
             },
   
             success:function(data) {
   
                 $('select[name="product_model"]').empty();
   
                 $.each(data, function(key, value){
   
                     $('select[name="product_model"]').append('<option value="'+ key +'">' + value + '</option>');
   
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
</script>
<script>
   function dele() {
       var dele = prompt("Digite: Sim. ");
       if (dele  == null || dele  != "Sim") {
          
           event.stopPropagation();
           alert("A frase digita está incorreta.");
           return false;
       
       } else {
           alert("A item foi deletado com sucesso.");
           return true;
       }
   }
</script>
@stop