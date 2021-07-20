@extends('adminlte::page')

@section('title', 'Update')

@section('content_header')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Atualizar Categoria
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/exibircategoria')}}">Exibir Categoria</a></li>
          <li class="breadcrumb-item active" aria-current="page">Atualizar Categoria</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')





<form class="was-validated" action='upcategoria' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <input  class="form-control" type="hidden" name="id"  value="{{$categoria->id}}" >

    <label >Categoria</label>
    <input type="text" class="form-control" maxlength="100" name="categoria" placeholder="categoria" value="{{$categoria->nome}}"required >



<button class="btn btn-primary" type="submit">Enviar</button>

</form>

@stop
