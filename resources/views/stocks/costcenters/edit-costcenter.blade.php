{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Esstoque Centro de Custo')
@section('content_header')
<h1>HB Estoque Centro de Custo</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Centro de Custo</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
@foreach($data as $details)
<form class="form-horizontal" method="POST" action="{{ url('/savecostcenteredit') }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{$details->id}}" id="id" name="id">
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Cód.CC</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_cod') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_cod" name="costcenter_cod"  class="form-control" value="{{$details->costcenter_cod}}" required autofocus>
               @if ($errors->has('costcenter_cod'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_cod') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Descrição</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_description') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_description" name="costcenter_description"  class="form-control" value="{{$details->costcenter_description}}"  required autofocus>
               @if ($errors->has('costcenter_description'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_description') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Dono do CC</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_ccowner') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_ccowner" name="costcenter_ccowner"  class="form-control" value="{{$details->costcenter_ccowner}}"  required autofocus>
               @if ($errors->has('ccostcenter_ccowner'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_ccowner') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>

      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Négocio</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('brand_name') ? 'has-error' : '' }}">
               <select id="business_id" type="text" class="form-control" name="business_id" required>
               <option value="{{$details->business_id}}">{{$details->business_name}}</option>
               @endforeach
                  @foreach($databusiness as $details)
                  <option value="{{$details->id}}">{{$details->business_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('business_name'))
               <span class="help-block">
               <strong>{{ $errors->first('business_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      @foreach($data as $details)
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Dono do Négocio</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_businessowner') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_businessowner" name="costcenter_businessowner"  class="form-control" value="{{$details->costcenter_businessowner}}" required autofocus>
               @if ($errors->has('costcenter_businessowner'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_businessowner') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
    
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Vertical</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('vertical_name') ? 'has-error' : '' }}">
               <select id="vertical_id" type="text" class="form-control" name="vertical_id" required>
               <option value="{{$details->vertical_id}}">{{$details->vertical_name}}</option>
                  @endforeach
                  @foreach($datavertical as $details)
                  <option value="{{$details->id}}">{{$details->vertical_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('vertical_name'))
               <span class="help-block">
               <strong>{{ $errors->first('vertical_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Grupo de Cliente</label>
         <div class="col-sm-8">
         @foreach($data as $details)
            <div class="form-group has-feedback {{ $errors->has('clientgroup_name') ? 'has-error' : '' }}">
               <select id="clientgroup_id" type="text" class="form-control" name="clientgroup_id" required>
               <option value="{{$details->clientgroup_id}}">{{$details->clientgroup_name}}</option>
                  @endforeach
                  @foreach($dataclientgroup as $details)
                  <option value="{{$details->id}}">{{$details->clientgroup_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('clientgroup_name'))
               <span class="help-block">
               <strong>{{ $errors->first('clientgroup_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Centro de Resultado</label>
         <div class="col-sm-8">
         @foreach($data as $details)
            <div class="form-group has-feedback {{ $errors->has('resultcenter_name') ? 'has-error' : '' }}">
               <select id="resultcenter_id" type="text" class="form-control" name="resultcenter_id" required>
               <option value="{{$details->resultcenter_id}}">{{$details->resultcenter_name}}</option>
                  @endforeach
                  @foreach($dataresultcenter as $details)
                  <option value="{{$details->id}}">{{$details->resultcenter_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('resultcenter_name'))
               <span class="help-block">
               <strong>{{ $errors->first('resultcenter_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Área</label>
         <div class="col-sm-8">
         @foreach($data as $details)
            <div class="form-group has-feedback {{ $errors->has('area_name') ? 'has-error' : '' }}">
               <select id="resultcenter_id" type="text" class="form-control" name="area_id" required>
               <option value="{{$details->area_id}}">{{$details->area_name}}</option>
                  @endforeach
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
         <label for="inputEmail3" class="col-sm-2 control-label">Projeto</label>
         <div class="col-sm-8">
         @foreach($data as $details)
            <div class="form-group has-feedback {{ $errors->has('project_name') ? 'has-error' : '' }}">
               <select id="project_id" type="text" class="form-control" name="project_id" required>
               <option value="{{$details->project_id}}">{{$details->project_cod}} - {{$details->project_name}}</option>
                  @endforeach
                  @foreach($dataproject as $details)
                  <option value="{{$details->id}}">{{$details->project_cod}} - {{$details->project_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('project_name'))
               <span class="help-block">
               <strong>{{ $errors->first('project_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="form-group">
         <div class="col-sm-offset-2 col-sm-10">
         </div>
      </div>
<div class="box-footer">
<button type="submit" class="btn btn-info pull-right">Registrar</button>
</form>
</div>
<!-- /.box-footer -->
@stop
