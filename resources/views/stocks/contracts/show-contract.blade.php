@section('title', 'HB Estoque Requisição')
@section('content_header')
<h1>HB Estoque Contrato</h1>
@stop
@section('content')
@foreach($data as $details)
<div class="box-body">
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Contrato - {{$details->contract_title}}  - {{$details->contract_status}} </h3>
</div>
<table class="table table-striped">
<tr>
            <th style="width: 40px" >Fornecedor: </th>
            <td style="width: 40px" >{{$details->reseller_name}}</td>
            <th style="width: 40px" >Nr. Contrato: </th>
            <td style="width: 40px"> {{$details->contract_number}}</td>
            <th style="width: 40px" >Nr. Interno: </th>
            <td style="width: 40px"> {{$details->contract_internal}}</td>
</tr> 
<tr>
            <th style="width: 40px" >Categoria: </th>
            <td style="width: 40px" >{{$details->category_name}}</td>
            <th style="width: 40px" >Tipo: </th>
            <td style="width: 40px"> {{$details->contract_type}}</td>
</tr>                
</table>

  <div class="box-header no-border">
   <h4 class="box-title">Datas </h4>
</div>

<table class="table table-striped">
<tr>
            <th>Início: </th>
            <td >{{$details->contract_startdate}}</td>
            <th>Término: </th>
            <td>{{$details->contract_expirationdate}}</td>
            <th >Aviso Prévio: </th>
            <td>{{$details->contract_warningdate}}</td>
</tr>           
</table>
<div class="box-header no-border">
   <h4 class="box-title">Pagamento e Reajuste </h4>
</div>


<table class="table table-striped">
<tr>
            <th style="width: 20px">Pagamento: </th>
            <td style="width: 20px">{{$details->contract_paytype}}</td>
            <th style="width: 20px">Parcelas: </th>
            <td style="width: 20px">{{$details->contract_qtdparcelas}}</td>
            <th style="width: 20px">Vencimento Ult. Parcela </th>
            <td>{{$details->contract_ultimaparcela}}</td>
            <th style="width: 40px" >Valor Total:</th>
            <td style="width: 40px">R$ {{number_format((float)$details->contract_totalvalue, 2, '.', '')}}   </td>
</tr>  
<tr>
            <th style="width: 20px">Índice de Reajuste: </th>
            <td style="width: 20px">{{$details->index_name}}</td>
            <th style="width: 20px">Índice %: </th>
            <td style="width: 20px">{{$details->contract_indexpercentage}}%</td>
            <th style="width: 20px">Mês de Reajuste </th>
            <td>{{$details->contract_anualreadjust}}</td> 
</tr>            
</table>
<div class="box-header no-border">
   <h4 class="box-title">Área Beneficiada </h4>
</div>
<table class="table table-striped">
<tr>
            <th style="width: 10px">Área: </th>
            <td style="width: 100px">{{$details->contract_area}}</td>
            <th style="width: 100px"></th>
            <td style="width: 100px"></td>       
</tr>        
</table>
<div class="box-header no-border">
   <h4 class="box-title">Descrição do Objeto de Contrato</h4>
</div>
<table class="table table-striped">
<tr>
            <td style="width: 100px">{{$details->contract_objectdescription}}</td>    
</tr>        
</table>
<div class="box-header no-border">
   <h4 class="box-title">Descrição de Distrato</h4>
</div>
<table class="table table-striped">
<tr>
            <td style="width: 100px">{{$details->contract_releasedescription}}</td>    
</tr>        
</table>

@endforeach
<div class="box-header no-border">
   <h4 class="box-title">Anexos</h4>
</div>
<table class="table table-striped">
@foreach($attachments as $details)
<tr>
<td align="center">{{$details->id}}</td>
<td align="center">{{$details->attachment_name}}</td>
<td align="center"><a download href="/storage/contracts/{{$details->attachment_name}}">Download</a></td>
</tr>       
@endforeach
</table>
  </div>
  </div>  
  <div class="modal-footer">
   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Fechar</button>
</div>