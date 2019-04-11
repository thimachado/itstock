@section('title', 'HB Estoque Requisição')
@section('content_header')
<h1>HB Estoque Requisição</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Requisição de Saída</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
@foreach($data as $details)
<div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Req Nr.:</label>
   <p>{{$details->invoice_number}}</p>
</div>
<div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Dono:</label>
   <p class="margin">{{$details->invoice_owner}}</p>
</div>
<div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Atendente:</label>
   <p class="margin">{{$details->request_user}}</p>
</div>
<div class="form-group">
   <label for="inputEmail3" class="col-sm-2 control-label">Obs:</label>
   <p class="margin">{{$details->request_observation}}</p>
</div>
<div class="box-body no-padding">
<table class="table table-bordered table-striped dataTable" >
   <tr>
            <th style="width: 40px" >CC: </th>
            <td style="width: 400px" >{{$details->costcenter_description}}</td>
            <th style="width: 40px" >Projeto: </th>
            <td style="width: 60px"> {{$details->project_cod}} - {{$details->project_name}}</td>
         </tr>
   </table>
   <table class="table table-bordered table-striped dataTable" >
      <tbody>
         <tr>
            <th style="width: 40px" >Faturamento:</th>
            <th style="width: 60px" >{{$details->invoice_billingdate}}</th>
            <th style="width: 40px" ></th>
            <th style="width: 50px" ></th>
            <th style="width: 40px" >Vencimento:</th>
            <th style="width: 40px" >{{$details->invoice_duedate}}</th>
         </tr>
         <tr>
            <th style="width: 40px" >Movimento:</th>
            <td style="width: 40px" >Saída</td>
            <th style="width: 40px" >Tipo: </th>
            <td style="width: 40px">{{$details->invoice_typemov}}</td>
            <th style="width: 40px" >Fornecedor: </th>
            <td style="width: 40px" >{{$details->reseller_name}}</td>
         </tr>
         <tr>
            <th style="width: 40px" >Area:</th>
            <td style="width: 40px" >{{$details->area_name}}</td>
            <th style="width: 40px" >Depósito:</th>
            <td style="width: 40px">{{$details->deposit_name}}</td>
         </tr>
         <tr>
            <th style="width: 40px">CTA. Fin: </th>
            <td style="width: 40px">{{$details->invoice_ctafin}}</td>
            <th style="width: 40px">CTA. Con:</th>
            <td style="width: 40px">{{$details->invoice_ctacon}}</td>
            <th style="width: 40px">Valor Total R$:</th>
            <td style="width: 40px"><span id="total">0</span></td>
         </tr>
      </tbody>
   </table>
</div>
@endforeach     
<div class="col-sm-13">
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
            <th>Valor Unitário</th>
            <th>Qtd</th>
         </thead>
         <tbody>
            <tr>
               @foreach($itens as $details)
            <tr>
               <td><input type=hidden name=category_id[] value="{{$details->category_id}}">{{$details->category_name}} </td>
               <td><input type=hidden name=brand_id[] value="{{$details->brand_id}}">{{$details->brand_name}} </td>
               <td><input type=hidden name=product_id[] value="{{$details->product_id}}">{{$details->product_model}} </td>
               <td><input type=hidden name=itemvalue[] value="{{$details->inventory_itemvalue}}">{{number_format((float)$details->inventory_itemvalue, 2, '.', '')}}</td>
               <td><input type=hidden name=quantity[] value="{{$details->inventory_itemquantity}}">{{$details->inventory_itemquantity}} </td>
               @endforeach
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Fechar</button>
</div>
<script>
   $(document).ready(function(){
   var total= 0;
          var inps = document.getElementsByName('itemvalue[]');
          var qtds = document.getElementsByName('quantity[]');
                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    var qtd = qtds[i];
                    total += parseFloat(inp.value) * qtd.value;
          document.getElementById("total").innerHTML = total.toFixed(2);
   }
   }); 
</script>