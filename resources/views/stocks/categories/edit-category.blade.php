{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Categorias')
@section('content_header')
<h1>HB Estoque Categorias</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Categorias</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   @foreach($data as $details)
<form class="form-horizontal" method="POST" action="{{ url('/savecategoryedit') }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{$details->id}}" id="id" name="id">
      <form class="form-horizontal">
       <div class="box-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('category_name') ? 'has-error' : '' }}">
                  <input type="text" name="category_name" class="form-control" value="{{ $details->category_name}}" required autofocus>
                  @endforeach
                  @if ($errors->has('category_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('category_name') }}</strong>
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
@stop
