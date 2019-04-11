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
   @foreach($data as $details)
<form class="form-horizontal" method="POST" action="{{ url('/savereselleredit') }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{$details->id}}" id="id" name="id">
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Fornecedor</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('reseller_name') ? 'has-error' : '' }}">
                  <input type="text" name="reseller_name" class="form-control" value="{{ $details->reseller_name }}" required autofocus>
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
                  <input type="text" name="reseller_site" class="form-control" value="{{ $details->reseller_site }}" required autofocus>
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
                  <input type="text" name="reseller_email" class="form-control" value="{{ $details->reseller_email }}" required autofocus>
                  @if ($errors->has('reseller_email'))
                  <span class="help-block">
                  <strong>{{ $errors->first('reseller_email') }}</strong>
                  </span>
                  @endif
                  @endforeach
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
   </div>
   <!-- /.box-footer -->
</div>
@stop
