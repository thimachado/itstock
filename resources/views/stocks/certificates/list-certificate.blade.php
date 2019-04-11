{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Histórico de Certificados')
@section('content_header')
<h1>HB Estoque Histórico de Certificados</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Último Certificado Registrado</h3>
   </div>
<div class="box-body">
          <!-- /.box-header -->
   <div class="box-body table-responsive">
   <table class="table table-hover">
         <thead>
            <th>ID</th>
            <th>Emissor</th>
            <th>Responsável</th>
            <th>Tipo</th>
            <th>Valor Pago</th>
            <th>Utilizado em</th>
            <th>Expira em</th>
            <th>Status</th>
            <th>Ações</th>
         </thead>
         <tbody>
            <tr>
               <td>{{$lastcertificate->id}}</td>
               <td>{{$lastcertificate->certificate_emitter}}</td>
               <td>{{$lastcertificate->certificate_owner}}</td>
               <td>{{$lastcertificate->certificate_type}}</td>
               <td>{{$lastcertificate->certificate_value}}</td>
               <td>{{$lastcertificate->certificate_use}}</td>
               <td>{{$lastcertificate->certificate_expirationdate}}</td>
               <td>{{$lastcertificate->certificate_status}}</td>
               <td><a href="editcertificate/{{$lastcertificate->id}}">EDITAR</a></td>
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
<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
            <div class="box-footer">
</div>
         </div>
      </div>
<div class="box">
   <div class="box-header">
      <h3 class="box-title"> Histórico de Certificados</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
    
   <table class="table table-hover" id="certificatesdt" >
         <thead>
         <th>ID</th>
            <th>Emissor</th>
            <th>Responsável</th>
            <th>Tipo</th>
            <th>Valor Pago</th>
            <th>Utilizado em</th>
            <th>Expira em</th>
            <th>Status</th>
            <th>Ações</th>
         </thead>
         <tbody>
         @foreach($data as $details)
            <tr>
            <td>{{$details->id}}</td>
               <td>{{$details->certificate_emitter}}</td>
               <td>{{$details->certificate_owner}}</td>
               <td>{{$details->certificate_type}}</td>
               <td>{{$details->certificate_value}}</td>
               <td>{{$details->certificate_use}}</td>
               <td>{{$details->certificate_expirationdate}}</td>
               <td>{{$details->certificate_status}}</td>
               <td><a href="editcertificate/{{$details->id}}">EDITAR</a></td>
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
    $('#certificatesdt').DataTable( {  
        dom: '<lf<t>ip> B',
        buttons: ['pdf', 'excel' ]
    } );
 
   } );
</script>
@stop