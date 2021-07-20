@extends('adminlte::page')

@section('title', 'Exibir')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Fornecedores
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Exibir Fornecedores</li>
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
          <th scope="col">Fornecedor</th>
          <th scope="col">CNPJ</th>
          <th scope="col">Email</th>
          <th scope="col">Telefone</th>
          <th scope="col">Complemento telefone</th>
          <th scope="col">Alterar</th>
          <th scope="col">Excluir</th>
          </tr>
      </thead>
      <tbody>

        @foreach($fornecedores as $f)
        <tr>
        <td scope="row">{{$f->nome}}</td>
        <td scope="row">{{$f->cnpj}}</td>
        <td scope="row">{{$f->email}}</td>
        <td scope="row">{{$f->telefone}}</td>
        <td scope="row">{{$f->telefone_complemento}}</td>


          <td><a class="nav-link js-scroll-trigger" href="{{ url("/updatefornecedor/{$f->id}") }}">
          <i class="fas fa-edit  fa-2x " style="color: blue;"></a></td>
          <td><a class="nav-link js-scroll-trigger"  href="{{ url("/deletefornecedor/{$f->id}") }}" onclick="return confirm('Deseja mesmo excluir?')">
            <i class="fas fa-trash-alt fa-2x " style="color: red;"></i></a></td>
            </tr>
            @endforeach

      </tbody>
    </table>




{{ $fornecedores->links() }}

@stop
