@extends('adminlte::page')

@section('title', 'Relatório')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Relatório
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Relatório</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop


@section('content')

        <form  action='gerarrelatorio' method="POST" enctype="multipart/form-data" >
          {{ csrf_field() }}


<div class="row">
  <div class="col-3 ">

          <label>Status do SAC:</label>
          <select name="status" class="form-control">
            <option  value="%%">Todos</option>
             <option  value="novo">Novo</option>
            <option  value="andamento">Em andamento</option>
            <option  value="fechado">Fechado</option>
          </select>
        </div>
        <div class="col-3 ">
          <label>Produtos com Sac:</label>
          <select name="produto" class="form-control">
            <option  value="%%">Todos produtos</option>
            @for ($i = 0; $i < count($produtos); $i++)
            <option  value="{{$produtos[$i]->id}}">{{$produtos[$i]->nome}}</option>
            @endfor
          </select>
        </div>
        <div class="col-3 ">
          <label>Categorias com Sac:</label>
          <select name="categoria" class="form-control">
          <option  value="%%">Todas Categorias</option>
            @for ($i = 0; $i < count($categorias); $i++)
              <option  value="{{$categorias[$i]->id}}">{{$categorias[$i]->nome}}</option>
            @endfor
          </select>
        </div>
        <div class="col-3 ">
          <label>Fornecedores com Sac:</label>
          <select name="fornecedor" class="form-control">
            <option  value="%%">Todos Fornecedores</option>
            @for ($i = 0; $i < count($fornecedores); $i++)
              <option  value="{{$fornecedores[$i]->id}}">{{$fornecedores[$i]->nome}}</option>
            @endfor
          </select>
        </div>
        </div>

        <div class="row">
          <div class="col-3">
          <label >Data Inicial:</label>
          <input name="data_inicio" type="date" value="2020-01-01">
          </div>
          <div class="col-3">
          <label >Data Final:</label>
          <input name="data_fim" type="date" value="{{date('Y-m-d')}}">
          </div>
          </div>


          <h1 align="center"><button class="btn btn-success" align="center" type="submit"><i class="far fa-fw fa-file-alt"></i>Gerar Relatório</button></h1>

        </form>



@endsection
