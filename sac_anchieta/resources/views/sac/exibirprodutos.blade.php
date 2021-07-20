

@extends('adminlte::page')

@section('title', 'Exibir')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Produtos
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Exibir Produtos</li>
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



<form class="needs-validation" action='exibirprodutos' method="GET" >
  <div class="row">
    <div class="col-5 ">
  <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Pesquisa" value="" >
</div>
<div class="col-2 ">
  <button class="btn btn-info  " align="center" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
</div>
</div>
</form>


    <table class="table">
      <thead>
        <tr>
          <th scope="col">Produto</th>
          <th scope="col">Marca</th>
          <th scope="col">Fornecedor</th>
          <th scope="col">Situação</th>
          <th scope="col">Alterar</th>
          <th scope="col">Excluir</th>
          </tr>
      </thead>
      <tbody>

        @foreach($produtos as $produto)
        <tr>
        <td scope="row">{{$produto->nome}}</td>
        <td scope="row">{{$produto->marca}}</td>


        @foreach($fornecedores as $f)
        @if($f->id == $produto->fornecedor_id)
                <td scope="row">{{$f->nome}}</td>
                @endif
        @endforeach
        @if($produto->situacao == 'ativo')
        <td><a class="nav-link js-scroll-trigger" title="Ativo" href="{{ url("/inativarproduto/{$produto->id}") }}">
          <i class="fas fa-check-square fa-2x " style="color: green;"></i></a></td>
          @else
          <td><a class="nav-link js-scroll-trigger" title="Inativo"href="{{ url("/ativarproduto/{$produto->id}") }}">
            <i class="fas fa-minus-square fa-2x " style="color: red;"></i></a></td>

        @endif


        <td><a class="nav-link js-scroll-trigger" title="Editar Produto" href="{{ url("/updateproduto/{$produto->id}") }}">
          <i class="fas fa-edit  fa-2x " style="color: blue;"></i></a></td>

          <td><a class="nav-link js-scroll-trigger" title="Excluir Produto" href="{{ url("/deleteproduto/{$produto->id}") }}" onclick="return confirm('Deseja mesmo excluir?')">
            <i class="fas fa-trash-alt fa-2x " style="color: red;"></i></a></td>
            </tr>
            @endforeach

      </tbody>
    </table>




{{ $produtos->appends(['pesquisa' => isset($pesquisa) ? $pesquisa : ''])->links() }}

@stop
