{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Fornecedores')
@section('content_header')
<h1>HB Estoque Fornecedores</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Fornecedores</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/saveresellerregister') }}">
      {{ csrf_field() }}
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Fornecedor</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('reseller_name') ? 'has-error' : '' }}">
                  <input type="text" name="reseller_name" class="form-control" value="{{ old('reseller_name') }}" required autofocus>
                  @if ($errors->has('reseller_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('reseller_name') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Site</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('reseller_site') ? 'has-error' : '' }}">
                  <input type="text" name="reseller_site" class="form-control" value="{{ old('reseller_site') }}" required autofocus>
                  @if ($errors->has('reseller_site'))
                  <span class="help-block">
                  <strong>{{ $errors->first('reseller_site') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
            </div>
            <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('reseller_email') ? 'has-error' : '' }}">
                  <input type="text" name="reseller_email" class="form-control" value="{{ old('reseller_email') }}" required autofocus>
                  @if ($errors->has('reseller_email'))
                  <span class="help-block">
                  <strong>{{ $errors->first('reseller_email') }}</strong>
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
      <h3 class="box-title">Fornecedores</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="resellerdt" >
         <thead>
            <th>ID</th>
            <th>Fornecedor</th>
            <th>Site</th>
            <th>Email</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->reseller_name}}</td>
               <td>{{$details->reseller_site}}</td>
               <td>{{$details->reseller_email}}</td>
               <td><a href="editreseller/{{$details->id}}">EDITAR</a></td>
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
       $('#resellerdt').DataTable();
   } );
</script>
@stop