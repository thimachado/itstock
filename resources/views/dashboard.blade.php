@extends('adminlte::page')
@section('title', 'HB Estoque Dashboard')
@section('content_header')
<h1>Dashboard</h1>
@stop
@section('content')
<ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i> Dashboard </a></li>
   <li class="active">Alertas</li>
</ol>
<!-- /.row -->
<!-- =========================================================== -->
<div class="row">
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($keyboard > 21 )
         <a href="/keyboardreport"><span class="info-box-icon bg-aqua"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span></a>
         @endif
         @if ($keyboard <= 20 && $keyboard >= 5 )
         <a href="/keyboardreport"><span class="info-box-icon bg-yellow"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span></a>
         @endif
         @if ($keyboard < 5 )
         <a href="/keyboardreport"><span class="info-box-icon bg-red"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/keyboardreport">Teclados</a></span>
            <span class="info-box-number">{{$keyboard}}<small> teclados em estoque</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($notebook > 21  )
         <a href="/machinereport"><span class="info-box-icon bg-aqua"><i class="fa fa-laptop" aria-hidden="true"></i></span></a>
         @endif
         @if ($notebook <= 20 && $notebook >= 5 )
         <a href="/machinereport"><span class="info-box-icon bg-yellow"><i class="fa fa-laptop" aria-hidden="true"></i></span></a>
         @endif
         @if ($notebook < 5 )
         <a href="/machinereport"><span class="info-box-icon bg-red"><i class="fa fa-laptop" aria-hidden="true"></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/machinereport">Máquinas</a></span>
            <span class="info-box-number">{{$notebook}}<small> máquinas em estoque</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <!-- fix for small devices only -->
   <div class="clearfix visible-sm-block"></div>
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($mouse > 21 )
         <a href="/mousereport"><span class="info-box-icon bg-aqua"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span></a>
         @endif
         @if ($mouse <= 20 && $mouse >= 5 )
         <a href="/mousereport"><span class="info-box-icon bg-yellow"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span></a>
         @endif
         @if ($mouse < 5 )
         <a href="/mousereport"><span class="info-box-icon bg-red"><i class="fa fa-mouse-pointer" aria-hidden="true"></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/mousereport">Mouses</a></span>
            <span class="info-box-number">{{$mouse}}<small> mouses em estoque</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <!-- /.col -->
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($headset > 21 )
         <a href="/headsetreport"><span class="info-box-icon bg-aqua"><i class="fa fa-headphones" aria-hidden="true"></i></i></span></a>
         @endif
         @if ($headset <= 20 && $headset >= 5 )
         <a href="/headsetreport"><span class="info-box-icon bg-yellow"><i class="fa fa-headphones" aria-hidden="true"></i></i></span></a>
         @endif
         @if ($headset < 5 )
         <a href="/headsetreport"><span class="info-box-icon bg-red"><i class="fa fa-headphones" aria-hidden="true"></i></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/headsetreport">Headsets</a></span>
            <span class="info-box-number">{{$headset}}<small> headsets em estoque</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($monitor > 21 )
         <a href="/monitorreport"><span class="info-box-icon bg-aqua"><i class="fa fa-television" aria-hidden="true"></i></span></a>
         @endif
         @if ($monitor <= 20 && $monitor >= 5 )
         <a href="/monitorreport"><span class="info-box-icon bg-yellow"><i class="fa fa-television" aria-hidden="true"></i></span></a>
         @endif
         @if ($monitor < 5 )
         <a href="/monitorreport"><span class="info-box-icon bg-red"><i class="fa fa-television" aria-hidden="true"></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/monitorreport">Monitores</a></span>
            <span class="info-box-number">{{$monitor}}<small> monitores em estoque</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
   </div>
   <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
         @if ($line > 21 )
         <a href="/#"><span class="info-box-icon bg-aqua"><i class="fa fa-tablet" aria-hidden="true"></i></span></a>
         @endif
         @if ($line <= 20 && $line >= 5 )
         <a href="/#"><span class="info-box-icon bg-yellow"><i class="fa fa-tablet" aria-hidden="true"></i></span></a>
         @endif
         @if ($line < 5 )
         <a href="/#"><span class="info-box-icon bg-red"><i class="fa fa-tablet" aria-hidden="true"></i></span></a>
         @endif
         <div class="info-box-content">
            <span class="info-box-text"><a href="/#">Linhas-Vivo</a></span>
            <span class="info-box-number">{{$line}}<small> linhas disponíveis</small></span>
         </div>
         <!-- /.info-box-content -->
      </div>
   </div>
</div>
<!-- /.row -->
<!-- =========================================================== -->
<ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i> Informações </a></li>
   <li class="active">Vencimentos</li>
</ol>
<!-- /.row -->
<!-- =========================================================== -->
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
   <div class="info-box">
      @if ($contracts == 0 )
      <a href="/contractreport"><span class="info-box-icon bg-aqua"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      @if ($contracts > 0 )
      <a href="/contractreport"><span class="info-box-icon bg-red"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      <div class="info-box-content">
         <span class="info-box-text"><a href="/contractreport">Contratos</a></span>
         @if ($contracts == 0 )
         <span class="info-box-number"><small>Nenhum contrato expirará em menos de 15 dias.</small></span>
         @endif
         @if ($contracts > 0 )
         <span class="info-box-number">{{$contracts}}<small> contrato(s) expirarão em menos de 15 dias.</small></span>
         @endif
      </div>
      <!-- /.info-box-content -->
   </div>
   <!-- /.info-box -->
</div>
<!-- =========================================================== -->
<div class="col-md-4 col-sm-6 col-xs-12">
   <div class="info-box">
      @if ($domains == 0 )
      <a href="/domainreport"><span class="info-box-icon bg-aqua"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      @if ($domains > 0 )
      <a href="/domainreport"><span class="info-box-icon bg-red"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      <div class="info-box-content">
         <span class="info-box-text"><a href="/domainreport">Domínios</a></span>
         @if ($domains == 0 )
         <span class="info-box-number"><small>Nenhum domínio expirará em menos de 30 dias.</small></span>
         @endif
         @if ($domains > 0 )
         <span class="info-box-number">{{$domains}}<small> expirarão em menos de 30 dias.</small></span>
         @endif
      </div>
      <!-- /.info-box-content -->
   </div>
   <!-- /.info-box -->
</div>
<!-- =========================================================== -->
<div class="col-md-4 col-sm-6 col-xs-12">
   <div class="info-box">
      @if ($certificates == 0 )
      <a href="/#"><span class="info-box-icon bg-aqua"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      @if ($certificates > 0 )
      <a href="/#"><span class="info-box-icon bg-red"><i class="fa fa-handshake-o" aria-hidden="true"></i></span></a>
      @endif
      <div class="info-box-content">
         <span class="info-box-text"><a href="/certificatereport">Certificados</a></span>
         @if ($certificates == 0 )
         <span class="info-box-number"><small>Nenhum certificado expirará em menos de 15 dias.</small></span>
         @endif
         @if ($certificates > 0 )
         <span class="info-box-number">{{$certificates}}<small> expirarão em menos de 15 dias.</small></span>
         @endif
      </div>
      <!-- /.info-box-content -->
   </div>
   <!-- /.info-box -->
</div>
</div>
<!-- =========================================================== -->
<ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-windows" aria-hidden="true"></i> Licenças Microsoft </a></li>
   <li class="active">Disponíveis</li>
</ol>
<!-- /.row -->
<!-- =========================================================== -->
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
     <div class="info-box">
        @if ($e1 > 21 )
        <a href="/#"><span class="info-box-icon bg-aqua"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
        @endif
        @if ($e1 <= 20 && $e1 >= 5 )
        <a href="/#"><span class="info-box-icon bg-yellow"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
        @endif
        @if ($e1 < 5 )
        <a href="/#"><span class="info-box-icon bg-red"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
        @endif
        <div class="info-box-content">
           <span class="info-box-text"><a href="/#">Office 365 Enterprise E1</a></span>
           <span class="info-box-number">{{$e1}}<small> licenças do tipo E1 disponíveis.</small></span>
        </div>
        <!-- /.info-box-content -->
     </div>
     <!-- /.info-box -->
  </div>
<!-- =========================================================== -->
<div class="col-md-4 col-sm-6 col-xs-12">
   <div class="info-box">
      @if ($e3 > 21 )
      <a href="/#"><span class="info-box-icon bg-aqua"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
      @endif
      @if ($e3 <= 20 && $e3 >= 5 )
      <a href="/#"><span class="info-box-icon bg-yellow"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
      @endif
      @if ($e3 < 5 )
      <a href="/#"><span class="info-box-icon bg-red"><i class="fa fa-windows" aria-hidden="true"></i></span></a>
      @endif
      <div class="info-box-content">
         <span class="info-box-text"><a href="/#">Office 365 Enterprise E3</a></span>
         <span class="info-box-number">{{$e3}}<small> licenças do tipo E3 disponíveis.</small></span>
      </div>
      <!-- /.info-box-content -->
   </div>
   <!-- /.info-box -->
</div>
<!-- =========================================================== -->

</div>
<ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i> Atividades
    </a></li> <li class="active"> Retornos e Comentários</li>
</ol>
<!-- =========================================================== -->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Comentários</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <ul class="timeline">
            <!-- timeline time label -->
            @foreach($comments as $details)
            <li class="time-label">
               <span class="bg-red">
               {{ $details->timeline_date}}
               </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
               <!-- timeline icon -->
               <i class="fa fa-envelope bg-blue"></i>
               <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i>{{$details->timeline_hour}}</span>
                  <span class="time"> <a href="removecomment/{{$details->id}}"> <i class="fa fa-trash" pull-right></i> Excluir </a> </span>
                  <h3 class="timeline-header"><a href="#">{{$details->timeline_user}}</a> ...</h3>
                  <div class="timeline-body">
                     {{$details->timeline_body}}
                  </div>
                  @endforeach
                  <div class="timeline-footer">
                  </div>
                  @if (session('status'))
                  <div class="alert alert-warning">
                     {{ session('status') }}
                  </div>
                  @endif
               </div>
            </li>
            <!-- END timeline item -->
         </ul>
         <button type="button" class="btn btn-box-tool"><i class="fa fa-plus" data-toggle="modal" data-target="#comment"> Adicionar Comentário</i></button>
         <!-- Modal -->
         <div class="modal fade" id="comment" role="dialog">
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Comentário</h4>
                  </div>
                  <form class="form-horizontal" method="POST" action="{{ url('/savecomment') }}">
                     {{ csrf_field() }}
                     <div class="modal-body">
                        <textarea class="form-control" id="timeline_body" name= "timeline_body" rows="3" placeholder="Faça um comentário com no máximo 140 caracteres." required></textarea>
                        <h6 class="pull-right" id="count_message"></h6>
                        </br>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-success pull-right">Registrar</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.box-body -->
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Empréstimos - Devolução Pendente</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="box-body table-responsive">
            <table class="table table-hover" id="reportsdt" >
               <thead>
                  <th>Requisição</th>
                  <th>Solicitante</th>
                  <th>Data de Entrega</th>
                  <th>Data de Retorno</th>
                  <th>Ver</th>
               </thead>
               <tbody>
                  @foreach($loans as $details)
                  <tr>
                     <td><a href="editrequest/{{$details->invoice_number}}">{{$details->invoice_number}}</a></td>
                      <td>{{$details->invoice_owner}}</td>
                     <td>{{$details->invoice_billingdate}}</td>
                     <td>{{$details->invoice_duedate}}</td>
                     <td><a href="showrequest/{{$details->invoice_number}}" data-toggle="modal" data-target="#modal-default2">VER</a></td>
                  </tr>
         @endforeach
               </tbody>
            </table>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="modal fade" id="modal-default2" style="display: none;">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span></button>
                   <h4 class="modal-title">Default Modal</h4>
                 </div>
                 <div class="modal-body">


               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
      <!-- /.box-body -->
   </div>
   </div>
   </div>
</div>
@stop
@section('js')
<script>
   $(document).ready(function() {
       $('#reportsdt').DataTable();

   } );
</script>
<script>
   $('#modal-default2').on('hidden.bs.modal', function () {
    location.reload();
   })
</script>
<script>
   $('#modal-default').on('hidden.bs.modal', function () {
    location.reload();
   })
</script>
<script>
   var text_max = 140;
   $('#count_message').html(text_max + ' restantes');
   $('#timeline_body').keyup(function() {
     var text_length = $('#timeline_body').val().length;
     var text_remaining = text_max - text_length;
     $('#count_message').html(text_remaining + ' restantes');
   });

</script>
@stop
