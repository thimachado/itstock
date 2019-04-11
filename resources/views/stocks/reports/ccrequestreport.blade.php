{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Relatório de Saída')
@section('content_header')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<h1>HB Estoque Relatório de Saída</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Relatório de Saída</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/ccrequestreport') }}">
      {{ csrf_field() }}
      <div class="col-sm-0">
         <div class="col-sm-3">
            <select id="costcenter_id" name="costcenter_id" class="form-control">
               <option value=" ">--Centro de Custo--</option>
               @foreach($cc as $details)
               <option value="{{$details->id}}">{{$details->costcenter_description}}</option>
               @endforeach
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
      <h3 class="box-title">Saídas para o Centro de Custo  {{$data[0]->costcenter_description}} nos últimos 30 dias</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="reportsdt" >
         <thead>
            <th>Tipo de Movimento</th>
            <th>Centro de Custo</th>
            <th>Categoria</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Quantidade</th>
            <th>Preço Médio</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
                <td>{{$details->invoice_typemov}}</td>
               <td>{{$details->costcenter_description}}</td>
               <td>{{$details->category_name}}</td>
               <td>{{$details->brand_name}}</td>
               <td>{{$details->product_model}}</td>
               <td>{{$details->quantity}}</td>
               <td>{{number_format((float)$details->avgprice, 2, '.', '')}}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <!-- /.box-body -->
</div>
@stop
@section('js')
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