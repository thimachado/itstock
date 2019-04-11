{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Projetos')
@section('content_header')
<h1>HB Estoque Projetos</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Projetos</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   @foreach($data as $details)
<form class="form-horizontal" method="POST" action="{{ url('/saveprojectedit') }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{$details->id}}" id="id" name="id">
   <form class="form-horizontal">
      <div class="box-body">
      <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Cód. Projeto</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('project_cod') ? 'has-error' : '' }}">
                  <input type="text" name="project_cod" class="form-control" value="{{ $details->project_cod}}" required autofocus>
                  @if ($errors->has('project_cod'))
                  <span class="help-block">
                  <strong>{{ $errors->first('project_cod') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Projetos</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('project_name') ? 'has-error' : '' }}">
                  <input type="text" name="project_name" class="form-control" value="{{ $details->project_name}}" required autofocus>
                  @endforeach
                  @if ($errors->has('project_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('project_name') }}</strong>
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
