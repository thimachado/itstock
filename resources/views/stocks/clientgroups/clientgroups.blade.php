{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Grupo de Clientes')
@section('content_header')
<h1>HB Estoque Grupo de Clientes</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">NGrupo de Clientes</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/saveclientgroupregister') }}">
      {{ csrf_field() }}
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Grupo de Cliente</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('clientgroup_name') ? 'has-error' : '' }}">
                  <input type="text" name="clientgroup_name" class="form-control" value="{{ old('clientgroup_name') }}" required autofocus>
                  @if ($errors->has('clientgroup_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('clientgroup_name') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
         <button type="submit" class="btn btn-info pull-right">Registrar</button>
   </form>
   </div>
   <!-- /.box-footer -->
</div>
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Grupo de Clientes</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="clientgroupdt" >
         <thead>
            <th>ID</th>
            <th>Grupo de Cliente</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->clientgroup_name}}</td>
               <td><a href="editclientgroup/{{$details->id}}">EDITAR</a></td>
            </tr>
            @endforeach
         </tbody>
      </table>
      
   </div>
   <!-- /.box-body -->
</div>
@stop
@section('js')
<script> console.log('Hi!'); </script>
<script>
   $(document).ready(function() {
       $('#clientgroupdt').DataTable();
   } );
</script>
@stop