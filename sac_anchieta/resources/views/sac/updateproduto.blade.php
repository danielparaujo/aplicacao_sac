@extends('adminlte::page')

@section('title', 'Update')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Atualizar Produto
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/exibirprodutos')}}">Exibir Produto</a></li>
          <li class="breadcrumb-item active" aria-current="page">Atualizar Produto</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')





<form class="was-validated" action='upproduto' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <input  class="form-control" type="hidden" name="id"  value="{{$produto->id}}" >

    <label >Produto</label>
    <input type="text" class="form-control" maxlength="50" name="produto" placeholder="produto" value="{{$produto->nome}}"required >
    <label >Marca</label>
    <select name="marca" class="form-control" >
      <option value="{{$produto->marca}}" selected>{{$produto->marca}}</option>
      <option value="Anchieta">Anchieta</option>
      <option value="BigJo">BigJo</option>

    </select>

    <label >Fornecedor</label>

    <select name="fornecedor_id" class="form-control">
      @foreach($fornecedores as $fornecedor)
      @if($produto->fornecedor_id == $fornecedor->id)
      <option value="{{$produto->fornecedor_id}}" selected>{{$fornecedor->nome}}</option>
      @else
      <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
      @endif
      @endforeach

    </select>


<button class="btn btn-primary" type="submit">Enviar</button>

</form>

@stop
