{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Relatório de Contratos Expirantes')
@section('content_header')
<h1>HB Estoque Relatório de Contratos Expirantes</h1>
@stop
@section('content') 
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Relatório de Contratos Expirantes</h3>
   </div>
<div class="box-body">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
      <table class="table table-hover" id="contractsdt" >
         <thead>
         <th>Título</th>
            <th>Nr. Contrato</th>
            <th>Nr. Interno</th>
            <th>Fornecedor</th>
            <th>Tipo</th>
            <th>Início</th>
            <th>Término</th>
            <th>Aviso Prévio</th>
            <th>Ações</th>
         </thead>
         <tbody>
         @foreach($data as $details)
         <tr>
               <td>{{$details->contract_title}}</td>
               <td>{{$details->contract_number}}</td>
               <td>{{$details->contract_internal}}</td>
               <td>{{$details->reseller_name}}</td>
               <td>{{$details->contract_type}}</td>
               <td>{{$details->contract_startdate}}</td>
               <td>{{$details->contract_expirationdate}}</td>
               <td>{{$details->contract_warningdate}}</td>
               <td>
               <a href="showcontract/{{$details->id}}" data-toggle="modal" data-target="#modal-default">VER</a>
              ||<a href="editcontract/{{$details->id}}">EDITAR</a></td>
    </tr>
        @endforeach  
        </tbody>
      </table>
         
   </div>
   <div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span></button>
                <h4 class="modal-title">Contrato</h4>
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
<div class="box-footer">
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
   $('#contractsdt').DataTable( {  
        dom: '<lf<t>ip> B',
        buttons: ['pdf', 'excel' ]
    } );
  } );  
</script>
<script>
$('#modal-default').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@stop