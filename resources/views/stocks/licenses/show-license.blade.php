@section('title', 'HB Estoque Requisição')
@section('content_header')
<h1>HB Estoque Contrato</h1>
@stop
@section('content')
@foreach($data as $details)
<div class="box-body">
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Licença - {{$details->license_name}} - {{$details->license_type}} - {{$details->brand_name}} </h3>
    </br>
    </br>
   <p>Contato Suporte:  {{$details->license_supportcontact}} </p>
</div>
<table class="table table-striped">
<tr>
            <th style="width: 40px" >Nome: </th>
            <td style="width: 40px"> {{$details->license_name}}</td>
            <th style="width: 40px" >Finalidade: </th>
            <td style="width: 40px"> {{$details->license_usage}}</td>
            <th style="width: 40px" >Versão: </th>
            <td style="width: 40px"> {{$details->license_version}}</td>
            <th style="width: 40px" >Quantidade: </th>
            <td style="width: 40px"> {{$details->license_qty}}</td>
</tr>
  @endforeach
</table>
<div class="box-header no-border">
 <h4 class="box-title">Informações</h4>
</div>
@foreach($data as $details)
<table class="table table-striped">
<tr>
            <th style="width: 40px" >Área: </th>
            <td style="width: 40px"> {{$details->area_name}}</td>
            <th style="width: 40px" >Usuário Chave: </th>
            <td style="width: 40px"> {{$details->license_keyuser}}</td>
            <th style="width: 40px" >Mantenedor: </th>
            <td style="width: 40px"> {{$details->license_maintainer}}</td>
            <th style="width: 40px" >Valor Total em R$: </th>
            <td style="width: 40px"> {{$details->license_totalvalue}}</td>
</tr>
<tr>
            <th style="width: 40px" >Integração: </th>
            <td style="width: 40px"> {{$details->license_integration}}</td>
            <th style="width: 40px" >Acesso Banco: </th>
            <td style="width: 40px"> {{$details->license_dbaccess}}</td>
            <th style="width: 40px" >Servidor: </th>
            <td style="width: 40px"> {{$details->license_server}}</td>

</tr>
</table>
<div class="box-header no-border">
   <h4 class="box-title">Observação</h4>
</div>
<table class="table table-striped">
<tr>
            <td style="width: 100px">{{$details->license_observation}}</td>
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
