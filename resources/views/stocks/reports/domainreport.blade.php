{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Relatório de Domínios Expirantes')
@section('content_header')
<h1>HB Estoque Relatório de Domínios Expirantes</h1>
@stop
@section('content') 
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Relatório de Domínios Expirantes</h3>
   </div>
<div class="box-body">
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
<div class="box-footer">
</div>
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