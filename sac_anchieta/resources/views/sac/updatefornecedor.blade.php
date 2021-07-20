@extends('adminlte::page')

@section('title', 'Update')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Atualizar Fornecedor
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/exibirfornecedor')}}">Exibir Fornecedor</a></li>
          <li class="breadcrumb-item active" aria-current="page">Atualizar Fornecedor</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')





<form class="was-validated" action='upfornecedor' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <input  class="form-control" type="hidden" name="id"   value="{{$fornecedor->id}}" >

  <label >Fornecedor</label>
  <input type="text" class="form-control" name="nome" maxlength="50" placeholder="nome" value="{{$fornecedor->nome}}"required >

  <label for="cnpj">Cnpj</label>
  <input type="text" class="form-control" name="cnpj" maxlength="14" placeholder="Cnpj" value="{{$fornecedor->cnpj}}" required>

  <label for="email">Email</label>
  <input type="text" class="form-control" name="email" maxlength="50" placeholder="Email" value="{{$fornecedor->email}}" required>

   <label for="telefone">Telefone</label>
   <input type="text" class="form-control" name="telefone" maxlength="20" placeholder="Telefone" value="{{$fornecedor->telefone}}" required>

   <label for="telefone_complemento">Telefone Complemento</label>
   <input type="text" class="form-control" name="telefone_complemento" maxlength="20" placeholder="Telefone Complemento" value="{{$fornecedor->telefone_complemento}}" >



<button class="btn btn-primary" type="submit">Enviar</button>

</form>

@stop
