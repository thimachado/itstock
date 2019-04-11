{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Domínios')
@section('content_header')
<style>
 #password + .glyphicon {
   cursor: pointer;
   pointer-events: all;
 }

/* Styles for CodePen Demo Only */
#wrapper {
  max-width: 500px;
  margin: auto;
  padding-top: 25vh;
}

</style>
<h1>HB Estoque Domínios</h1>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Domínios</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <form class="form-horizontal" method="POST" action="{{ url('/savedomainregister') }}">
      {{ csrf_field() }}
   <form class="form-horizontal">
      <div class="box-body">
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Domínio</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_name') ? 'has-error' : '' }}">
                  <input type="text" name="domain_name" class="form-control" value="{{ old('domain_name') }}" required autofocus>
                  @if ($errors->has('domain_name'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_name') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Titular</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_holder') ? 'has-error' : '' }}">
                  <input type="text" name="domain_holder" class="form-control" value="{{ old('domain_holder') }}" required autofocus>
                  @if ($errors->has('domain_holder'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_holder') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Gerenciado Por</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_owner') ? 'has-error' : '' }}">
                  <input type="text" name="domain_owner" class="form-control" value="{{ old('domain_owner') }}" required autofocus>
                  @if ($errors->has('domain_owner'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_owner') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Usuário de acesso</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_userlogin') ? 'has-error' : '' }}">
                  <input type="text" name="domain_userlogin" class="form-control" value="{{ old('domain_userlogin') }}" required autofocus>
                  @if ($errors->has('domain_userlogin'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_userlogin') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email de acesso</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_emaillogin') ? 'has-error' : '' }}">
                  <input type="text" name="domain_emaillogin" class="form-control" value="{{ old('domain_emaillogin') }}" required autofocus>
                  @if ($errors->has('domain_emaillogin'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_emaillogin') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Senha de acesso</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_password') ? 'has-error' : '' }}">
                  <input type="password" id="password" name="domain_password" class="form-control" value="{{ old('domain_password') }}" required autofocus>
                  <i class="glyphicon glyphicon-eye-open form-control-feedback" onclick="showpassword()"></i>
                  @if ($errors->has('domain_password'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_password') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
         <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Criado em</label>
               <div class="col-sm-8">
                  <div class="form-group has-feedback {{ $errors->has('domain_createdat') ? 'has-error' : '' }}">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepickercreatedat" name="domain_createdat">
                        @if ($errors->has('domain_createdat'))
                        <span class="help-block">
                        <strong>{{ $errors->first('domain_createdat') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Expira em</label>
               <div class="col-sm-8">
                  <div class="form-group has-feedback {{ $errors->has('domain_expireat') ? 'has-error' : '' }}">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepickerexpireat" name="domain_expireat">
                        @if ($errors->has('domain_expireat'))
                        <span class="help-block">
                        <strong>{{ $errors->first('domain_expireat') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Renovado em</label>
               <div class="col-sm-8">
                  <div class="form-group has-feedback {{ $errors->has('domain_updatedat') ? 'has-error' : '' }}">
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepickerupdatedat" name="domain_updatedat">
                        @if ($errors->has('domain_updatedat'))
                        <span class="help-block">
                        <strong>{{ $errors->first('domain_updatedat') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
            <div class="col-sm-8">
               <div class="form-group has-feedback {{ $errors->has('domain_observation') ? 'has-error' : '' }}">
               <textarea name= "domain_observation" class="form-control" rows="3" placeholder="Você pode deixar em branco..."></textarea>
                  @if ($errors->has('domain_observation'))
                  <span class="help-block">
                  <strong>{{ $errors->first('domain_observation') }}</strong>
                  </span>
                  @endif
               </div>
            </div>
         </div>
        <div class="form-group">
         <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
         <div class="col-sm-8">
            <div class="form-group has-feedback {{ $errors->has('domain_status') ? 'has-error' : '' }}">
               <select name="domain_status" id="domain_status" class="form-control" required autofocus> 
                  <option value=""> </option>
                  <option value="Publicado">Publicado</option>
                  <option value="Desativado">Desativado</option>
               </select>
               @if ($errors->has('domain_status'))
               <span class="help-block">
               <strong>{{ $errors->first('domain_status') }}</strong>
               </span>
               @endif
            </div>
         </div>
      </div>
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
            </div>
         </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
         <button type="submit" class="btn btn-info pull-right">Registrar</button>
   </form>
   </div>
   <!-- /.box-footer -->
</div>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script>
   $(function () {
     $('#datepickercreatedat').datepicker({ format: 'dd-mm-yyyy' });
   });
</script>
<script>
   $(function () {
     $('#datepickerexpireat').datepicker({ format: 'dd-mm-yyyy' });
   });
</script>
<script>
   $(function () {
     $('#datepickerupdatedat').datepicker({ format: 'dd-mm-yyyy' });
   });
</script>
<script>
function showpassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
        $(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open'); // toggle our classes for the eye icon
    } else {
        x.type = "password";
    }
}
$('#password + .glyphicon').on('click', function() {
  $(this).toggleClass('glyphicon-eye-close').toggleClass('glyphicon-eye-open'); // toggle our classes for the eye icon
});
</script>
@stop