@extends('adminlte::page')

@section('title', 'Exibir')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Categorias
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Exibir Categoria</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

@if(session('mensagem'))
<div class="alert alert-success">
  <p>{{session('mensagem')}}</p>
</div>
@endif
@if(session('erro'))
<div class="alert alert-danger">
  <p>{{session('erro')}}</p>
</div>
@endif
@if(session('atencao'))
    <div class="alert alert-warning">
        <p>{{session('atencao')}}</p>
    </div>
@endif



<table class="table">
  <thead>
    <tr>
      <th scope="col">Categoria</th>
      <th scope="col">Alterar</th>
      <th scope="col">Excluir</th>

    </tr>
  </thead>
  <tbody>

    @foreach($categorias as $categoria)
    <tr>
      <td scope="row">{{$categoria->nome}}</td>
      <td><a class="nav-link js-scroll-trigger" href="{{ url("/updatecategoria/{$categoria->id}") }}">
        <i class="fas fa-edit  fa-2x " style="color: blue;"></i></a></td>
        <td><a class="nav-link js-scroll-trigger"  href="{{ url("/deletecategoria/{$categoria->id}") }}" onclick="return confirm('Deseja mesmo excluir?')">
          <i class="fas fa-trash-alt fa-2x " style="color: red;"></i></a></td>
          </tr>
          @endforeach

        </tbody>
      </table>




      {{ $categorias->links() }}

      @stop
