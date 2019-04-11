{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Requisição de Saída')
@section('content_header')
<h1>HB Estoque Requisição de Saída</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Requisição de Saída</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
<form class="form-horizontal" method="POST" action="{{ url('/saveoutgoingregister') }}">
<input type="hidden"  id="invoice_typemov" name="invoice_typemov" class="form-control">
   <div class="row">
   <div class="col-sm-6">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Movimento</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('') ? 'has-error' : '' }}">
               <select name="invoice_type" id="invoice_type" class="form-control">
                  <option value="S">Saída</option>
                  <option value="E">Empréstimo</option>
               </select>
               @if ($errors->has('invoice_type'))
               <span class="help-block">
               <strong>{{ $errors->first('invoice_type') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Req Nr.</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('request_number') ? 'has-error' : '' }}">
               <input type="text"  id="request_number" name="request_number"  class="form-control" value="{{old('request_number')}}" required autofocus>
               @if ($errors->has('request_number'))
               <span class="help-block">
               <strong>{{ $errors->first('request_number') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Requisitante</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('request_owner') ? 'has-error' : '' }}">
               <input type="text"  id="request_owner" name="request_owner"  class="form-control" value="{{old('request_owner')}}" required autofocus>
               @if ($errors->has('request_owner'))
               <span class="help-block">
               <strong>{{ $errors->first('request_owner') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Líder</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_ccowner') ? 'has-error' : '' }}">
               <select id="costcenter_ccowner" type="text" class="form-control" name="costcenter_ccowner" required>
                  <option value=""> </option>
                  @foreach($datacostcenter as $details)
                  <option value="{{$details->costcenter_ccowner}}">{{$details->costcenter_ccowner}}</option>
                  @endforeach
               </select>
               @if ($errors->has('costcenter_ccowner'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_ccowner') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Vertical</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('vertical_id') ? 'has-error' : '' }}">
               <select id="vertical_id" type="text" class="form-control" name="vertical_id" required>
                  <option value=""> </option>
               </select>
               @if ($errors->has('vertical_id'))
               <span class="help-block">
               <strong>{{ $errors->first('vertical_id') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Centro de Custo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('costcenter_description') ? 'has-error' : '' }}">
               <select id="costcenter_id" type="text" class="form-control" name="costcenter_id" required>
                  <option value=""> </option>
               </select>
               @if ($errors->has('costcenter_description'))
               <span class="help-block">
               <strong>{{ $errors->first('costcenter_description') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Área</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('area_name') ? 'has-error' : '' }}">
               <select id="area_id" type="text" class="form-control" name="area_id" required>
                  <option value=""> </option>
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
               </select>
               @if ($errors->has('project_name'))
               <span class="help-block">
               <strong>{{ $errors->first('project_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">CTA. Fin</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('invoice_ctafin') ? 'has-error' : '' }}">
               <input type="text"  id="invoice_ctafin" name="invoice_ctafin"  class="form-control" value="{{old('invoice_ctafin')}}" required autofocus>
               @if ($errors->has('invoice_ctafin'))
               <span class="help-block">
               <strong>{{ $errors->first('invoice_ctafin') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">CTA. Con</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('invoice_ctacon') ? 'has-error' : '' }}">
               <input type="text"  id="invoice_ctacon" name="invoice_ctacon"  class="form-control" value="{{old('invoice_ctacon')}}" required autofocus>
               @if ($errors->has('invoice_ctacon'))
               <span class="help-block">
               <strong>{{ $errors->first('invoice_ctacon') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('request_observation') ? 'has-error' : '' }}">
               <textarea name= "request_observation" class="form-control" rows="3" placeholder="Você pode deixar em branco..."></textarea>
               @if ($errors->has('request_observation'))
               <span class="help-block">
               <strong>{{ $errors->first('request_observation') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Data de Movimento</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('request_datemov') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerdatemov" name="request_datemov" >
               </div>
            </div>
         </div>
      </div>
      <div class="form-group" id="return">
         <label for="inputEmail3" class="col-sm-2 control-label">Data de Devolução</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('request_returndate') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerreturndate" name="request_returndate" >
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6">
   <div class="box-footer">
     <div class="form-group" id="status">
        <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-8">
           <div class="form-group has-feedback {{ $errors->has('') ? 'has-error' : '' }}">
              <select name="invoice_loanstatus" id="invoice_loanstatus" class="form-control">
                 <option value="Devolvido">Devolvido</option>
                 <option value="Emprestado">Emprestado</option>
              </select>
              @if ($errors->has('invoice_type'))
              <span class="help-block">
              <strong>{{ $errors->first('invoice_type') }}</strong>
              </span>
              @endif
           </div>
        </div>
     </div>

      <div class="box-header with-border">
         <h2 class="box-title">Item</h2>
         <button type="button" id="additem" class="btn btn-info pull-right">Adicionar Item</button>
      </div>
   </div>
   <div class="form-group">
   <div class="row">
      <div class="col-sm-0">
         <div class="col-sm-3">
            <select id="category_id" name="category_id" class="form-control">
               <option value=" ">--Categoria--</option>
               @foreach($datacategory as $details)
               <option value="{{$details->id}}">{{$details->category_name}}</option>
               @endforeach
            </select>
         </div>
         <div class="col-sm-2">
            <select id="brand_id" name="brand_id" class="form-control">
               <option value="">--Marca--</option>
            </select>
         </div>
         <div class="col-sm-2">
            <select id="product_id" name="product_model" class="form-control">
               <option value="">--Produto--</option>
            </select>
         </div>
         <div class="col-sm-2">
            <select id="invoice_itemvalue" name="invoice_itemvalue" class="form-control">
               <option value=""></option>
            </select>
         </div>
         <div class="col-sm-2">
            <input type="text"  id="invoice_itemquantity" name="invoice_itemquantity"  class="form-control" placeholder="Qtd">
            <input type="hidden"  id="stock" name="stock"  class="form-control" value="">
            <input type="hidden"  id="control" name="control"  class="form-control" value="0">
         </div>
      </div>
      </br>
      </br>
      </br>
      <div class="col-sm-2">
         <label for="estoque">Em estoque:</label>
         <span id="estoque">0</span>
      </div>
      <div class="row-sm-7">
         <span>
         <strong class="danger-block" id="msg"> </strong>
         </span>
      </div>
      </br>
      </br>
      <div class="col-sm-11">
         <div class="box box-info">
            <div class="box-header">
               <h3 class="box-title">Itens da Nota</h3>
               <div class="box-tools">
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
               <table class="table table-hover" >
                  <thead>
                     <th>Categoria</th>
                     <th>Marca</th>
                     <th>Produto</th>
                     <th>Preço Médio</th>
                     <th>Qtd</th>
                     <th>Selecionar</td>
                  </thead>
                  <tbody>
                     <tr>
                     </tr>
                  </tbody>
               </table>
            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-success pull-right">Registrar</button>
</form>
<button type="button" class="btn btn-warning pull-left">Deletar Item</button>
</div>
<!-- /.box-body -->
</div>
</div>
</div>
<div>
   <label for="total">Valor Total R$:</label>
   <span id="total">0</span>
</div>
<div class="form-group has-feedback {{ $errors->has('request_datemov') ? 'has-error' : '' }}">
@if ($errors->has('request_datemov'))
<span class="help-block">
<strong>{{ $errors->first('request_datemov') }}</strong>
</span>
@endif
</div>
<div class="form-group has-feedback {{ $errors->has('request_returndate') ? 'has-error' : '' }}">
@if ($errors->has('request_returndate'))
<span class="help-block">
<strong>{{ $errors->first('request_returndate') }}</strong>
</span>
</div>
<div class="form-group has-feedback {{ $errors->has('category_id.*') ? 'has-error' : '' }}">
@if ($errors->has('category_id.*'))
<span class="help-block">
<strong>Informe uma categoria para o item</strong>
</span>
@endif
</div>
<div class="form-group has-feedback {{ $errors->has('brand_id.*') ? 'has-error' : '' }}">
@if ($errors->has('brand_id.*'))
<span class="help-block">
<strong>Informe uma marca para o item</strong>
</span>
@endif
</div>
<div class="form-group has-feedback {{ $errors->has('product_id.*') ? 'has-error' : '' }}">
@if ($errors->has('product_id.*'))
<span class="help-block">
<strong>Informe um produto para o item.</strong>
</span>
@endif
</div>
<div class="form-group has-feedback {{ $errors->has('itemvalue.*') ? 'has-error' : '' }}">
@if ($errors->has('itemvalue.*'))
<span class="help-block">
<strong>{{ $errors->first('itemvalue.*') }}</strong>
</span>
@endif
</div>
<div class="form-group has-feedback {{ $errors->has('quantity.*') ? 'has-error' : '' }}">
@if ($errors->has('quantity.*'))
<span class="help-block">
<strong>{{ $errors->first('quantity.*') }}</strong>
</span>
@endif
</div>
@endif
@stop
@section('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="{{ URL::asset('js/request.js') }}"></script>

@stop
