@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Cadastrar Fornecedor
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar Fornecedor</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<form  action='storefornecedor' method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}

     <label for="nome">Fornecedor</label>
     <input type="text" class="form-control" maxlength="50" name="nome" placeholder="Fornecedor" required>

      <label for="cnpj">Cnpj</label>
      <input type="text" class="form-control" maxlength="14" name="cnpj" placeholder="Cnpj somente números" required>

      <label for="email">Email</label>
      <input type="email" class="form-control" maxlength="50" name="email" placeholder="Email" required>

       <label for="telefone">Telefone</label>
       <input type="text" class="form-control" maxlength="20" name="telefone" placeholder="Telefone" required>

       <label for="telefone_complemento">Telefone Complemento</label>
       <input type="text" class="form-control" maxlength="20" name="telefone_complemento" placeholder="Telefone Complemento" >


       <div class="row">
       <div class="col-12" align="center">
           <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
         </div>
         </div>
    </form>
@stop
