{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Minhas Requisições de Saída')
@section('content_header')
<h1>HB Estoque Histórico de Saída</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Minha Última Requisição de Saída Registrada</h3>
   </div>
<div class="box-body">
          <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="lastinvoicedt" >
        <thead>
           <th>Req. Nr.</th>
           <th>Movimento</th>
           <th>Fornecedor</th>
           <th>Área</th>
           <th>Centro de Custo</th>
           <th>Dono</th>
           <th>Entrega</th>
           <th>Atendente</th>
           <th>Ações</th>
        </thead>
         <tbody>
         <tr>
            <td><a href="editrequest/{{$lastinvoice->invoice_number}}">{{$lastinvoice->invoice_number}}</a></td>
            <td>{{$lastinvoice->invoice_typemov}}</td>
            <td>{{$lastinvoice->reseller_name}}</td>
            <td>{{$lastinvoice->area_name}}</td>
            <td>{{$lastinvoice->costcenter_description}}</td>
            <td>{{$lastinvoice->invoice_owner}}</td>
            <td>{{$lastinvoice->invoice_billingdate}}</td>
            <td>{{$lastinvoice->request_user}}</td>
            <td>
            <a href="showrequest/{{$lastinvoice->invoice_number}}" data-toggle="modal" data-target="#modal-default">VER</a>
           ||<a href="editrequest/{{$lastinvoice->invoice_number}}">EDITAR</a></td>
            </tr>
        </tbody>
      </table>
   </div>
   <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">


            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   <!-- /.box-body -->
</div>
</div>
<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
            <div class="box-footer">
</div>
         </div>
      </div>
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Histórico das Minhas Requisições de Saída</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="invoicesdt" >
        <thead>
           <th>Req. Nr.</th>
           <th>Movimento</th>
           <th>Fornecedor</th>
           <th>Área</th>
           <th>Centro de Custo</th>
           <th>Dono</th>
           <th>Entrega</th>
           <th>Atendente</th>
           <th>Ações</th>
        </thead>
         <tbody>
         @foreach($data as $details)
            <tr>
              <td><a href="editrequest/{{$details->invoice_number}}">{{$details->invoice_number}}</a></td>
              <td>{{$details->invoice_typemov}}</td>
              <td>{{$details->reseller_name}}</td>
              <td>{{$details->area_name}}</td>
              <td>{{$details->costcenter_description}}</td>
              <td>{{$details->invoice_owner}}</td>
              <td>{{$details->invoice_billingdate}}</td>
              <td>{{$details->request_user}}</td>
              <td><a href="showrequest/{{$details->invoice_number}}" data-toggle="modal" data-target="#modal-default">VER</a>
             || <a href="editrequest/{{$details->invoice_number}}">EDITAR</a></td>
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
       $('#lastinvoicesdt').DataTable();
   } );
</script>
<script>
 $(document).ready(function() {
    $('#invoicesdt').DataTable( {
        "order": [[ 6, "desc" ]]
    } );
} );
</script>
<script>
$('#modal-default').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@stop
