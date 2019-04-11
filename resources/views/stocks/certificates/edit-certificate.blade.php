{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Certificados')
@section('content_header')
<h1>HB Estoque Certificados</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Certificados</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/savecertificateedit') }}">
      {{ csrf_field() }}
      @foreach($data as $details)
    <input type="hidden" value="{{$details->id}}" id="id" name="id">
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Emissor</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('certificate_emitter') ? 'has-error' : '' }}">
                  <input type="text" name="certificate_emitter" class="form-control" value="{{$details->certificate_emitter}}" required autofocus>
                  @if ($errors->has('certificate_emitter'))
                  <span class="help-block">
                  <strong>{{ $errors->first('certificate_emitter') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Responsável</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('certificate_owner') ? 'has-error' : '' }}">
                  <input type="text" name="certificate_owner" class="form-control" value="{{$details->certificate_owner}}" required autofocus>
                  @if ($errors->has('certificate_owner'))
                  <span class="help-block">
                  <strong>{{ $errors->first('certificate_owner') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('certificate_type') ? 'has-error' : '' }}">
               <select name="certificate_type" id="certificate_type" class="form-control" required autofocus> 
                  <option value="{{$details->certificate_type}}">{{$details->certificate_type}} </option>
                  <option value="A1">A1</option>
                  <option value="A3">A3</option>
                  <option value="A3">A4</option>
               </select>
               @if ($errors->has('certificate_type'))
               <span class="help-block">
               <strong>{{ $errors->first('certificate_type') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Valor Pago</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('certificate_value') ? 'has-error' : '' }}">
                  <input type="text" name="certificate_value" class="form-control" value="{{$details->certificate_value}}" required autofocus>
                  @if ($errors->has('certificate_value'))
                  <span class="help-block">
                  <strong>{{ $errors->first('certificate_value') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Utilizado em:</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('certificate_use') ? 'has-error' : '' }}">
                  <input type="text" name="certificate_use" class="form-control" value="{{$details->certificate_use}}" required autofocus placeholder="Informe o produto, projeto ou setor em que é o certificado é utilizado.">
                  @if ($errors->has('certificate_use'))
                  <span class="help-block">
                  <strong>{{ $errors->first('certificate_use') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
       
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Expira em</label>
               <div class="col-sm-8">
                  <div class="form-group has-feedback {{ $errors->has('certificate_expirationdate') ? 'has-error' : '' }}">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepickerexpireat" name="certificate_expirationdate" value="{{$details->certificate_expirationdate}}">
                        @if ($errors->has('certificate_expirationdate'))
                        <span class="help-block">
                        <strong>{{ $errors->first('certificate_expirationdate') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('certificate_status') ? 'has-error' : '' }}">
               <select name="certificate_status" id="certificate_status" class="form-control" required autofocus> 
                  <option value="{{$details->certificate_status}}">{{$details->certificate_status}} </option>
                  <option value="Publicado">Publicado</option>
                  <option value="Desativado">Desativado</option>
               </select>
               @if ($errors->has('certificate_status'))
               <span class="help-block">
               <strong>{{ $errors->first('certificate_status') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      @endforeach
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script>
   $(function () {
     $('#datepickerexpireat').datepicker({ format: 'dd-mm-yyyy' });
   });
</script>

@stop