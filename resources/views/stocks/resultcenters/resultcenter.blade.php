
{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Centro de Resultados')
@section('content_header')
<h1>HB Estoque Centro de Resultados</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Centro de Resultados</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/saveresultcenterregister') }}">
      {{ csrf_field() }}
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Centro de Resultado</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('resultcenter_name') ? 'has-error' : '' }}">
                  <input type="text" name="resultcenter_name" class="form-control" value="{{ old('resultcenter_name') }}" required autofocus>
                  @if ($errors->has('resultcenter_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('resultcenter_name') }}</strong>
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
      <h3 class="box-title">Centro de Resultados</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="resultcenterdt" >
         <thead>
            <th>ID</th>
            <th>Centro de Resultados</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->resultcenter_name}}</td>
               <td><a href="editresultcenter/{{$details->id}}">EDITAR</a></td>
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
       $('#resultcenterdt').DataTable();
   } );
</script>
@stop