{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Histórico de Domínios')
@section('content_header')
<h1>HB Estoque Histórico de Domínios</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Último Domínio Registrado</h3>
   </div>
<div class="box-body">
          <!-- /.box-header -->
   <div class="box-body table-responsive">
   <table class="table table-hover">
         <thead>
            <th>ID</th>
            <th>Domínio</th>
            <th>Titular</th>
            <th>Gerenciado Por</th>
            <th>Usuário de acesso</th>
            <th>Email de acesso</th>
            <th>Data de Expiração</th>
            <th>Status</th>
            <th>Ações</th>
         </thead>
         <tbody>
            <tr>
               <td>{{$lastdomain->id}}</td>
               <td>{{$lastdomain->domain_name}}</td>
               <td>{{$lastdomain->domain_holder}}</td>
               <td>{{$lastdomain->domain_owner}}</td>
               <td>{{$lastdomain->domain_userlogin}}</td>
               <td>{{$lastdomain->domain_emaillogin}}</td>
               <td>{{$lastdomain->domain_expireat}}</td>
               <td>{{$lastdomain->domain_status}}</td>
               <td><a href="editdomain/{{$lastdomain->id}}">EDITAR</a></td>
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
                <h4 class="modal-title">Domínio</h4>
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
      <h3 class="box-title"> Histórico de Domínios</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
    
   <table class="table table-hover" id="domainsdt" >
         <thead>
         <th>ID</th>
            <th>Domínio</th>
            <th>Titular</th>
            <th>Gerenciado Por</th>
            <th>Usuário de acesso</th>
            <th>Email de acesso</th>
            <th>Data de Expiração</th>
            <th>Status</th>
            <th>Ações</th>
         </thead>
         <tbody>
         @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->domain_name}}</td>
               <td>{{$details->domain_holder}}</td>
               <td>{{$details->domain_owner}}</td>
               <td>{{$details->domain_userlogin}}</td>
               <td>{{$details->domain_emaillogin}}</td>
               <td>{{$details->domain_expireat}}</td>
               <td>{{$details->domain_status}}</td>
               <td><a href="editdomain/{{$details->id}}">EDITAR</a></td>
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
    $('#domainsdt').DataTable( {  
        dom: '<lf<t>ip> B',
        buttons: ['pdf', 'excel' ]
    } );
 
   } );
</script>
@stop