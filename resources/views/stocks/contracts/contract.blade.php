{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Contratos')
@section('content_header')
<h1>HB Estoque Contratos</h1>
@stop
@section('content')
<div class="box box-info">
<div class="box-header with-border">
   <h3 class="box-title">Contrato</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<div class="box-body">
<form class="form-horizontal" method="POST" action="{{ url('/savecontractregister') }}" enctype="multipart/form-data">
   <div class="row">
   <div class="col-sm-6">
      {{ csrf_field() }}
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Fornecedor</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('reseller_name') ? 'has-error' : '' }}">
               <select id="reseller_id" type="text" class="form-control" name="reseller_id" required>
                  <option value=""> </option>
                  @foreach($datareseller as $details)
                  <option value="{{$details->id}}">{{$details->reseller_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('reseller_name'))
               <span class="help-block">
               <strong>{{ $errors->first('reseller_name') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Nr. Contrato</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_number') ? 'has-error' : '' }}">
               <input type="text" name="contract_number" class="form-control" value="{{ old('contract_number') }}" required autofocus>
               @if ($errors->has('contract_number'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_number') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
        <input type="hidden" name="contract_internal" class="form-control" value="Não Aplicável" required autofocus>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Título</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_title') ? 'has-error' : '' }}">
               <input type="text" name="contract_title" class="form-control" value="{{ old('contract_title') }}" required autofocus>
               @if ($errors->has('contract_title'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_title') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Categoria</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contractcategory_id') ? 'has-error' : '' }}">
               <select name="contractcategory_id" id="contractcategory_id" class="form-control">
                  <option value=""> </option>
                  @foreach($datacategory as $details)
                  <option value="{{$details->id}}">{{$details->category_name}}</option>
                  @endforeach
               </select>
               @if ($errors->has('contractcategory_id'))
               <span class="help-block">
               <strong>{{ $errors->first('contractcategory_id') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Tipo</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_type') ? 'has-error' : '' }}">
               <select name="contract_type" id="contract_type" class="form-control">
                  <option value=""> </option>
                  <option value="Comodato">Serviço</option>
                  <option value="Parceiro">Parceiro</option>
                  <option value="Fornecedor">Fornecedor</option>
                  <option value="Cliente">Cliente</option>
                  <option value="Comodato">Comodato</option>
                  <option value="Empréstimo">Empréstimo</option>
               </select>
               @if ($errors->has('contract_type'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_type') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Data de Início</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_startdate') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerstart" name="contract_startdate">
                  @if ($errors->has('contract_startdate'))
                  <span class="help-block">
                  <strong>{{ $errors->first('contract_startdate') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Data de Expiração</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_expirationdate') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerexpiration" name="contract_expirationdate">
                  @if ($errors->has('contract_expirationdate'))
                  <span class="help-block">
                  <strong>{{ $errors->first('contract_expirationdate') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Data de Aviso Prévio</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_warningdate') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerwarning" name="contract_warningdate" placeholder="Se não houver, considere 30 dias antes do vencimento">
                  @if ($errors->has('contract_warningdate'))
                  <span class="help-block">
                  <strong>{{ $errors->first('contract_warningdate') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Forma de Pagamento</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_paytype') ? 'has-error' : '' }}">
               <select name="contract_paytype" id="contract_paytype" class="form-control">
                  <option value=""> </option>
                  <option value="Boleto">Boleto</option>
                  <option value="Depósito">Depósito</option>
                  <option value="Cartão de Crédito">Cartão de Crédito</option>
               </select>
               @if ($errors->has('contract_paytype'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_paytype') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Valor Total</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_totalvalue') ? 'has-error' : '' }}">
               <input type="text" name="contract_totalvalue" class="form-control" value="{{ old('contract_totalvalue') }}" placeholder="Ex: R$ 4200.00"  required autofocus>
               @if ($errors->has('contract_totalvalue'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_totalvalue') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Quantidade de Parcelas</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_qtdparcelas') ? 'has-error' : '' }}">
               <input type="text" name="contract_qtdparcelas" class="form-control" value="{{ old('contract_qtdparcelas') }}" required autofocus>
               @if ($errors->has('contract_qtdparcelas'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_qtdparcelas') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
      <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Venc. Última Parcela</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_ultimaparcela') ? 'has-error' : '' }}">
               <div class="input-group date">
                  <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepickerultimaparcela" name="contract_ultimaparcela">
                  @if ($errors->has('contract_ultimaparcela'))
                  <span class="help-block">
                  <strong>{{ $errors->first('contract_ultimaparcela') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="box-body">
   <div class="col-sm-6">
   <div class="box-footer"></div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Area Beneficiada</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('contract_area') ? 'has-error' : '' }}">
            <select id="contract_area" type="text" class="form-control" name="contract_area" required>
               <option value=""> </option>
               <option value="Não aplicável">Não aplicável</option>
               @foreach($dataarea as $details)
               <option value="{{$details->area_name}}">{{$details->area_name}}</option>
               @endforeach
            </select>
            @if ($errors->has('contract_area'))
            <span class="help-block">
            <strong>{{ $errors->first('contract_area') }}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Índice de Reajuste</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('index_id') ? 'has-error' : '' }}">
            <select id="contract_area" type="text" class="form-control" name="index_id" required>
               <option value=""> </option>
               @foreach($dataindex as $details)
               <option value="{{$details->id}}">{{$details->index_name}}</option>
               @endforeach
            </select>
            @if ($errors->has('index_id'))
            <span class="help-block">
            <strong>{{ $errors->first('index_id')}}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Índice %</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('contract_indexpercentage') ? 'has-error' : '' }}">
            <input type="text" name="contract_indexpercentage" class="form-control" value="{{ old('contract_indexpercentage') }}" placeholder="Ex: 12" required autofocus>
            @if ($errors->has('contract_indexpercentage'))
            <span class="help-block">
            <strong>{{ $errors->first('contract_indexpercentage') }}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Mês de Reajuste</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('contract_anualreadjust') ? 'has-error' : '' }}">
            <input type="text" name="contract_anualreadjust" class="form-control" value="{{ old('contract_anualreadjust') }}" placeholder="Ex: Agosto" required autofocus>
            @if ($errors->has('contract_anualreadjust'))
            <span class="help-block">
            <strong>{{ $errors->first('contract_anualreadjust') }}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Descrição do Objeto do Contrato</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('contract_objectdescription') ? 'has-error' : '' }}">
            <textarea name= "contract_objectdescription" class="form-control" rows="3" placeholder= "Insira o parágrafo de objeto de contrato"></textarea>
            @if ($errors->has('contract_objectdescription'))
            <span class="help-block">
            <strong>{{ $errors->first('contract_objectdescription') }}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Descrição de Distrato</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('contract_releasedescription') ? 'has-error' : '' }}">
            <textarea name= "contract_releasedescription" class="form-control" rows="3" placeholder="Insira o parágrafo de distrato do contrato"></textarea>
            @if ($errors->has('contract_releasedescription'))
            <span class="help-block">
            <strong>{{ $errors->first('contract_releasedescription') }}</strong>
            </span>
            @endif
         </div>
      </div>
   </div>
   <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('contract_status') ? 'has-error' : '' }}">
               <select name="contract_status" id="contract_status" class="form-control" required autofocus> 
                  <option value="Em vigor">Em vigor</option>
                  <option value="Encerrado">Encerrado</option>
               </select>
               @if ($errors->has('contract_status'))
               <span class="help-block">
               <strong>{{ $errors->first('contract_status') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
   <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Anexos:</label>
      <div class="col-sm-8">
         <div class="form-group has-feedback {{ $errors->has('attachments[]') ? 'has-error' : '' }}">
            <input type="file" id="files" name="attachments[]"  multiple required autofocus>
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
<script src="{{ URL::asset('js/contract.js') }}"></script>
@stop