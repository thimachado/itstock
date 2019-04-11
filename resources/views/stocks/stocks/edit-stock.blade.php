{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB  Estoque')
@section('content_header')
<h1>HB Estoque</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Estoque</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
   @foreach($stock as $details)
   <form class="form-horizontal" method="POST" action="{{ url('/savestockedit') }}">
      {{ csrf_field() }}
      <input type="hidden" value="{{$details->id}}" id="id" name="id">
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('category_name') ? 'has-error' : '' }}">
               <select name="category_id" class="form-control">
                  <option value ="{{$details->category_id}}">{{$details->category_name}}</option>
               </select>
               @if ($errors->has('category_name'))
               <span class="help-block">
               <strong>{{ $errors->first('category_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Marca</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('brand_name') ? 'has-error' : '' }}">
               <select name="brand_id" class="form-control">
                  <option value ="{{$details->brand_id}}">{{$details->brand_name}}</option>
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
         <label for="inputEmail3" class="col-sm-2 control-label">Modelo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('product_model') ? 'has-error' : '' }}">
               <select name="product_model" class="form-control">
                  <option value = "{{$details->product_id}}">{{$details->product_model}}</option>
               </select>
               @if ($errors->has('product_model'))
               <span class="help-block">
               <strong>{{ $errors->first('product_model') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Quantidade</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('stock_quantity') ? 'has-error' : '' }}">
               <input type="text"  id="stock_quantity" name="stock_quantity"  class="form-control" value="{{$details->stock_quantity}}" required autofocus>
               @if ($errors->has('stock_quantity'))
               <span class="help-block">
               <strong>{{ $errors->first('stock_quantity') }}</strong>
               </span>
               @endif
               @endforeach
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
<button type="submit" class="btn btn-info pull-right">Salvar</button>
</form>
</div>
<!-- /.box-footer -->
@stop