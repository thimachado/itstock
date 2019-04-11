{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')
@section('title', 'HB Estoque Visão Geral Estoque')
@section('content_header')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<h1>HB Estoque Visão Geral Estoque </h1>
<style>
 .container {
    position: relative;
     width: 100%;
     height: 0;
     padding-bottom: 56.25%;
 }
 .video {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
 }

</style>
@stop
@section('content')
<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">Visão Geral Estoque</h3>
   </div>

   <div class="container">
   <iframe  align="center"
    src="https://app.powerbi.com/view?r=eyJrIjoiNmU2ZWVlNWMtYzlmMS00MmI5LTkwOTYtZGQ0MDMwN2YxN2JjIiwidCI6ImViNzZkODQ0LTlmMDYtNDFkMS1iMGFmLTAzNzRlNTgxNWM1NyIsImMiOjR9"
    frameborder="0" class=video allowFullScreen="true"></iframe>
 </div>
</div>
@stop
@section('js')
@stop
