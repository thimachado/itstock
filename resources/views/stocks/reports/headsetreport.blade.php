{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Relatório de Headsets em Estoque')
@section('content_header')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<h1>HB Estoque Relatório de Headsets em Estoque</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Relatório de Headsets em Estoque</h3>
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
   <!-- /.box-footer -->
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
@stop