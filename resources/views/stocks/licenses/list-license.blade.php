{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Histórico de Licenças')
@section('content_header')
<h1>HB Estoque Histórico  de Licenças</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Última Licença Registrada</h3>
   </div>
<div class="box-body">
          <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="lastlicensesdt" >
         <thead>
            <th>Nome</th>
            <th>Fabricante</th>
            <th>Finalidade</th>
            <th>Versão</th>
            <th>Área</th>
            <th>Usuário Chave</th>
            <th>Contato Suporte</th>
            <th>Valor Total em R$</th>
            <th>Quantidade</th>

            <th>Ações</th>
         </thead>
         <tbody>
         <tr>
               <td>{{$lastlicense->license_name}}</td>
               <td>{{$lastlicense->brand_name}}</td>
               <td>{{$lastlicense->license_usage}}</td>
               <td>{{$lastlicense->license_version}}</td>
               <td>{{$lastlicense->area_name}}</td>
               <td>{{$lastlicense->license_keyuser}}</td>
               <td>{{$lastlicense->license_supportcontact}}</td>
               <td>{{$lastlicense->license_totalvalue}}</td>
               <td>{{$lastlicense->license_qty}}</td>
               <td>
               <a href="showlicense/{{$lastlicense->id}}" data-toggle="modal" data-target="#modal-default">VER</a>
              ||<a href="editlicense/{{$lastlicense->id}}">EDITAR</a></td>
            </tr>
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
                <h4 class="modal-title">Licença</h4>
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
      <h3 class="box-title"> Histórico de Licenças</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="licensesdt" >
         <thead>
           <th>Nome</th>
           <th>Fabricante</th>
           <th>Finalidade</th>
           <th>Versão</th>
           <th>Área</th>
           <th>Usuário Chave</th>
           <th>Contato Suporte</th>
           <th>Valor Total em R$</th>
           <th>Quantidade</th>
           <th>Ações</th>
         </thead>
         <tbody>
         @foreach($data as $details)
         <tr>
           <td>{{$details->license_name}}</td>
           <td>{{$details->brand_name}}</td>
           <td>{{$details->license_usage}}</td>
           <td>{{$details->license_version}}</td>
           <td>{{$details->area_name}}</td>
           <td>{{$details->license_keyuser}}</td>
           <td>{{$details->license_supportcontact}}</td>
            <td>{{$lastlicense->license_totalvalue}}</td>
           <td>{{$details->license_qty}}</td>
           <td>
           <a href="showlicense/{{$details->id}}" data-toggle="modal" data-target="#modal-default">VER</a>
          ||<a href="editlicense/{{$details->id}}">EDITAR</a></td>
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
    $('#licensesdt').DataTable( {
        dom: '<lf<t>ip> B',
        buttons: [
        {
            extend: 'pdf',
            footer: true,
            exportOptions: {
                 columns: [0,1,2,3,4,5,6,7,8]
             }
        },
        {
            extend: 'excel',
            footer: true
        }
     ]
    } );

   } );
</script>
$('#modal-default').on('hidden.bs.modal', function () {
 location.reload();
})
</script>
@stop
