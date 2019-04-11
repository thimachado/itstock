{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Relatório Equipamentos em Estoque')
@section('content_header')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<h1>HB Estoque Relatório Equipamentos em Estoque</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Relatório de Equipamentos em Estoque</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/selectinventory') }}">
      {{ csrf_field() }}
      <div class="col-sm-0">
         <div class="col-sm-3">
            <select id="category_id" name="category_id" class="form-control">
               <option value=" ">--Categoria--</option>
               @foreach($datacategory as $details)
               <option value="{{$details->id}}">{{$details->category_name}}</option>
               @endforeach
            </select>
         </div>
         <div class="col-sm-3">
            <select id="brand_id" name="brand_id" class="form-control">
               <option value="">--Marca--</option>
            </select>
         </div>
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
         <button type="submit" class="btn btn-info pull-right">Pesquisar</button>
   </form>
   </div>
   <!-- /.box-footer -->
</div>
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Equipamentos em Estoque</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="reportsdt" >
         <thead>
            <th>ID</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Quantidade</th>
            <th>Preço Médio</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->category_name}}</td>
               <td>{{$details->brand_name}}</td>
               <td>{{$details->product_model}}</td>
               <td>{{$details->stock_quantity}}</td>
               <td>{{$details->stock_avgprice}}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <!-- /.box-body -->
</div>
@stop
@section('js')
<script src="{{ URL::asset('js/reports.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
$(document).ready(function() {
    $('#reportsdt').DataTable( {  
        dom: '<lf<t>ip> B',
        buttons: ['pdf', 'excel' ]
    } );
 
} );
</script>

<script>
   $('select[name="product_id').on('load', function(){
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
</script>
@stop