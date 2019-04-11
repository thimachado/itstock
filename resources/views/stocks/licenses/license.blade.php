{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Licenças')
@section('content_header')
<h1>HB Estoque Licenças</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Licença</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
<form class="form-horizontal" method="POST" action="{{ url('/savelicenseregister') }}" enctype="multipart/form-data">
   <div class="row">
   <div class="col-sm-6">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_name') ? 'has-error' : '' }}">
               <input type="text" name="license_name" class="form-control" value="{{ old('license_name') }}" required autofocus>
               @if ($errors->has('license_name'))
               <span class="help-block">
               <strong>{{ $errors->first('license_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Fabricante</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('brand_id') ? 'has-error' : '' }}">
               <select id="brand_id" type="text" class="form-control" name="brand_id" required>
                  <option value=""> </option>
                  @foreach($databrand as $details)
                  <option value="{{$details->id}}">{{$details->brand_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('brand_name'))
               <span class="help-block">
               <strong>{{ $errors->first('brand_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Finalidade</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_type') ? 'has-error' : '' }}">
               <select id="license_usage" type="text" class="form-control" name="license_usage" required>
                  <option value="Gestão Empresarial">Gestão Empresarial</option>
                  <option value="Gestão Financeira">Gestão Financeira</option>
                  <option value="Gestão Comercial">Gestão Comercial</option>
                  <option value="Gestão de Controladoria">Gestão Controladoria</option>
                  <option value="Gestão de DHO">Gestão de DHO</option>
                  <option value="Gestão de Controladoria">Gestão de Marketing</option>
                  <option value="Gestão de Controladoria">Gestão de TI</option>
                  <option value="Gestão de Orçamento">Gestão de Orçamento</option>
                  <option value="Gestão de Aplicativos">Gestão de Aplicativos</option>
                  <option value="Banco de Dados">Gestão de Infraestrutura</option>
               </select>
               @if ($errors->has('license_usage'))
               <span class="help-block">
               <strong>{{ $errors->first('license_usage') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Versão</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_version') ? 'has-error' : '' }}">
               <input type="text" name="license_version" class="form-control" value="{{ old('license_version') }}" required autofocus>
               @if ($errors->has('license_version'))
               <span class="help-block">
               <strong>{{ $errors->first('license_version') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Área</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('area_id') ? 'has-error' : '' }}">
               <select id="area_id" type="text" class="form-control" name="area_id" required>
                  <option value=""> </option>
                  @foreach($dataarea as $details)
                  <option value="{{$details->id}}">{{$details->area_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('area_name'))
               <span class="help-block">
               <strong>{{ $errors->first('area_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Usuário Chave</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_keyuser') ? 'has-error' : '' }}">
               <input type="text" name="license_keyuser" class="form-control" value="{{ old('license_keyuser') }}" required autofocus>
               @if ($errors->has('license_keyuser'))
               <span class="help-block">
               <strong>{{ $errors->first('license_keyuser') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Mantenedor</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_maintainer') ? 'has-error' : '' }}">
               <input type="text" name="license_maintainer" class="form-control" value="{{ old('license_maintainer') }}" required autofocus>
               @if ($errors->has('license_maintainer'))
               <span class="help-block">
               <strong>{{ $errors->first('license_maintainer') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_type') ? 'has-error' : '' }}">
               <select id="license_type" type="text" class="form-control" name="license_type" required>
                  <option value="Software as a Service">Software as a Service</option>
                  <option value="Platform as a Service">Platform as a Service</option>
                  <option value="Infrastructure as a Service">Infrastructure as a Service</option>
                  <option value="On Premisses">On Premisses</option>
                  <option value="OEM">OEM</option>
               </select>
               @if ($errors->has('license_type'))
               <span class="help-block">
               <strong>{{ $errors->first('license_type') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Integrações</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_integration') ? 'has-error' : '' }}">
               <input type="text" name="license_integration" class="form-control" value="{{ old('license_integration') }}" placeholder="Se não houver, deixar em branco">
               @if ($errors->has('license_integration'))
               <span class="help-block">
               <strong>{{ $errors->first('license_integration') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Acesso ao Banco</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_dbaccess') ? 'has-error' : '' }}">
               <input type="text" name="license_dbaccess" class="form-control" value="{{ old('license_dbaccess') }}" placeholder="Se não houver, deixar em branco">
               @if ($errors->has('license_dbaccess'))
               <span class="help-block">
               <strong>{{ $errors->first('license_dbaccess') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Servidor</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_server') ? 'has-error' : '' }}">
               <input type="text" name="license_server" class="form-control" value="{{ old('license_server') }}" placeholder="Se não houver, deixar em branco">
               @if ($errors->has('license_server'))
               <span class="help-block">
               <strong>{{ $errors->first('license_server') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Quantidade de Licenças</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('license_qty') ? 'has-error' : '' }}">
               <input type="text" name="license_qty" class="form-control" value="{{ old('license_qty') }}" required autofocus >
               @if ($errors->has('license_qty'))
               <span class="help-block">
               <strong>{{ $errors->first('license_qty') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
    </div>
 <div class="box-body">
 <div class="col-sm-6">
 <div class="box-footer"></div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Valor Total</label>
    <div class="col-sm-8">
       <div class="form-group has-feedback {{ $errors->has('license_totalvalue') ? 'has-error' : '' }}">
          <input type="text" name="license_totalvalue" class="form-control" value="{{ old('license_totalvalue') }}" required autofocus placeholder="Ex: R$ 4200.00">
          @if ($errors->has('license_totalvalue'))
          <span class="help-block">
          <strong>{{ $errors->first('license_totalvalue') }}</strong>
          </span>
          @endif
       </div>
    </div>
 </div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Contato para Suporte</label>
    <div class="col-sm-8">
       <div class="form-group has-feedback {{ $errors->has('license_supportcontact') ? 'has-error' : '' }}">
          <input type="text" name="license_supportcontact" class="form-control" value="{{ old('license_supportcontact') }}" required autofocus >
          @if ($errors->has('license_supportcontact'))
          <span class="help-block">
          <strong>{{ $errors->first('license_supportcontact') }}</strong>
          </span>
          @endif
       </div>
    </div>
 </div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
    <div class="col-sm-8">
       <div class="form-group has-feedback {{ $errors->has('license_observation') ? 'has-error' : '' }}">
          <textarea name= "license_observation" class="form-control" rows="3" placeholder= "Pode deixar em branco."></textarea>
          @if ($errors->has('license_observation'))
          <span class="help-block">
          <strong>{{ $errors->first('license_observation') }}</strong>
          </span>
          @endif
       </div>
    </div>
 </div>
 <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Anexos:</label>
    <div class="col-sm-8">
       <div class="form-group has-feedback {{ $errors->has('attachments[]') ? 'has-error' : '' }}">
          <input type="file" id="files" name="attachments[]"  multiple>
          @if ($errors->has('attachments[]'))
          <span class="help-block">
          <strong>{{ $errors->first('attachments[]') }}</strong>
          </span>
          @endif
       </div>
       <div id="selectedFiles"> </div>
       <div id="alert" > </div>
    </div>
 </div>
 <!-- /.box-body -->
 <div class="box-footer">
    <button type="submit" class="btn btn-info pull-right">Registrar</button>
</form>
</div>
<!-- /.box-footer -->
@stop
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="{{ URL::asset('js/license.js') }}"></script>
@stop
