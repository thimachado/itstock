{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Produtos')
@section('content_header')
<h1>HB Estoque Produtos</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Produto</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
   <form class="form-horizontal" method="POST" action="{{ url('/saveproductregister') }}">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Modelo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('product_model') ? 'has-error' : '' }}">
               <input type="text"  id="product_model" name="product_model"  class="form-control" value="{{old('product_model')}}" required autofocus>
               @if ($errors->has('product_model'))
               <span class="help-block">
               <strong>{{ $errors->first('product_model') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Marca</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('brand_name') ? 'has-error' : '' }}">
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
         <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('category_name') ? 'has-error' : '' }}">
               <select id="brand_id" type="text" class="form-control" name="category_id" required>
                  <option value=""> </option>
                  @foreach($datacategory as $details)
                  <option value="{{$details->id}}">{{$details->category_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('category_name'))
               <span class="help-block">
               <strong>{{ $errors->first('category_name') }}</strong>
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
      <h3 class="box-title">Produtos</h3>
      <div class="box-tools">
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body table-responsive">
      <table class="table table-hover" id="productsdt" >
         <thead>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Categoria</th>
            <th>Data de Criação</th>
            <th>Última Modificação</th>
            <th>Ações</th>
         </thead>
         <tbody>
            @foreach($data as $details)
            <tr>
               <td>{{$details->id}}</td>
               <td>{{$details->product_model}}</td>
               <td>{{$details->brand_name}}</td>
               <td>{{$details->category_name}}</td>
               <td>{{$details->created_at}}</td>
               <td>{{$details->updated_at}}</td>
               <td><a href="editproduct/{{$details->id}}">EDITAR </td>
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
       $('#productsdt').DataTable();
   } );
</script>
@stop