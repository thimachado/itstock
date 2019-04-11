{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Centro de Custo')
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
<div class="box-body">
   <form class="form-horizontal" method="POST" action="{{ url('/savecostcenterregister') }}">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Cód.CC</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_cod') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_cod" name="costcenter_cod"  class="form-control" value="{{old('costcenter_cod')}}" required autofocus>
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
               <input type="text"  id="costcenter_description" name="costcenter_description"  class="form-control" value="{{old('costcenter_description')}}" required autofocus>
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
               <input type="text"  id="costcenter_ccowner" name="costcenter_ccowner"  class="form-control" value="{{old('costcenter_ccowner')}}" required autofocus>
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
                  <option value=""> </option>
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
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Dono do Négocio</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_businessowner') ? 'has-error' : '' }}">
               <input type="text"  id="costcenter_businessowner" name="costcenter_businessowner"  class="form-control" value="{{old('costcenter_businessowner')}}" required autofocus>
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
                  <option value=""> </option>
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
            <div class="form-group has-feedback {{ $errors->has('clientgroup_name') ? 'has-error' : '' }}">
               <select id="clientgroup_id" type="text" class="form-control" name="clientgroup_id" required>
                  <option value=""> </option>
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
            <div class="form-group has-feedback {{ $errors->has('resultcenter_name') ? 'has-error' : '' }}">
               <select id="resultcenter_id" type="text" class="form-control" name="resultcenter_id" required>
                  <option value=""> </option>
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
            <div class="form-group has-feedback {{ $errors->has('area_name') ? 'has-error' : '' }}">
               <select id="resultcenter_id" type="text" class="form-control" name="area_id" required>
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
         <label for="inputEmail3" class="col-sm-2 control-label">Projeto</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('project_name') ? 'has-error' : '' }}">
               <select id="project_id" type="text" class="form-control" name="project_id" required>
                  <option value=""> </option>
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
</div>
<div class="box-footer">
<button type="submit" class="btn btn-info pull-right">Registrar</button>
</form>
</div>
<!-- /.box-footer -->
<div class="box">
   <div class="box-header">
      <h3 class="box-title">Centros de Custo</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="costcenterdt" >
         <thead>
            <th>Cód.CC</th>
            <th>Descrição</th>
            <th>Dono do CC</th>
            <th>Negócio</th>
            <th>Dono do Negócio</th>
            <th>Cliente</th>
            <th>Centro de Resultado</th>
            <th>Área</th>
            <th>Cód. Projeto</th>
            <th>Projeto</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->costcenter_cod}}</td>
               <td>{{$details->costcenter_description}}</td>
               <td>{{$details->costcenter_ccowner}}</td>
               <td>{{$details->business_name}}</td>
               <td>{{$details->costcenter_businessowner}}</td>
               <td>{{$details->clientgroup_name}}</td>
               <td>{{$details->resultcenter_name}}</td>
               <td>{{$details->area_name}}</td>
               <td>{{$details->project_cod}}</td>
               <td>{{$details->project_name}}</td>
               <td><a href="editcostcenter/{{$details->id}}">EDITAR </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
   <!-- /.box-body -->
</div>
@stop
@section('js')
<script>
   $(document).ready(function() {
       $('#costcenterdt').DataTable();
   } );
</script>
@stop