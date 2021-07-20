@extends('adminlte::page')

@section('title', 'Exibir')

@section('content_header')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Sacs
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Exibir Sacs</li>
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

<form class="needs-validation" action='exibirsac' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}
  <div class="row">
    <div class="col ">
  <label>Status</label>
  <select name="status" class="form-control" onchange="this.form.submit()">
    @if($request->status and $request->status != "%%")
    @if($request->status == "andamento")
      <option  value="{{$request->status}}" selected>Em andamento</option>
      <option  value="%%">Todos</option>
       <option  value="novo">Novo</option>
          <option  value="fechado">Fechado</option>
      @elseif($request->status == "novo")
        <option  value="{{$request->status}}" selected>Novo</option>
        <option  value="%%">Todos</option>

        <option  value="andamento">Em andamento</option>
        <option  value="fechado">Fechado</option>
          @elseif($request->status == "fechado")
        <option  value="{{$request->status}}" selected>Fechado</option>
        <option  value="%%">Todos</option>
         <option  value="novo">Novo</option>
        <option  value="andamento">Em andamento</option>

      @endif
    @else
    <option  value="%%">Todos</option>
     <option  value="novo">Novo</option>
    <option  value="andamento">Em andamento</option>
    <option  value="fechado">Fechado</option>
    @endif
  </select>
</div>
  <div class="col ">

@php
foreach($produtos as $p){
  if($p->id == $request->produto){
  $produto=$p->nome;
}
}

foreach($fornecedores as $f){
  if($f->id == $request->fornecedor){
  $fornecedor=$f->nome;
}
}
foreach($categorias as $c){
  if($c->id == $request->categoria){
  $categoria=$c->nome;
}
}
@endphp

  <label>Produto:</label>
  <select name="produto" class="form-control" onchange="this.form.submit()" >
    @if($request->produto and $request->produto !="%%")
      <option  value="{{$request->produto}}" >{{$produto}}</option>
    @endif
    <option  value="%%" >Todos produtos</option>

    @for ($i = 0; $i < count($produtos); $i++)
    <option  value="{{$produtos[$i]->id}}">{{$produtos[$i]->nome}}</option>
    @endfor
  </select>
</div>
  <div class="col">
  <label>Categoria:</label>

  <select name="categoria" class="form-control" onchange="this.form.submit()" >


    @if($request->categoria and $request->categoria !="%%")
      <option  value="{{$request->categoria}}" >{{$categoria}}</option>
    @endif
    <option  value="%%">Todas Categorias</option>
    @for ($i = 0; $i < count($categorias); $i++)
      <option  value="{{$categorias[$i]->id}}">{{$categorias[$i]->nome}}</option>
    @endfor


  </select>
</div>
  <div class="col">
  <label>Fornecedor:</label>

  <select name="fornecedor" class="form-control" onchange="this.form.submit()" >


    @if($request->fornecedor and $request->fornecedor !="%%")
      <option  value="{{$request->fornecedor}}" >{{$fornecedor}}</option>
    @endif
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
  @if($request->data_inicio)
  <input name="data_inicio" class="form-control" type="date" value="{{$request->data_inicio}}" onchange="this.form.submit()">
  @else
  <input name="data_inicio" class="form-control" type="date" value="2020-01-01" onchange="this.form.submit()">
  @endif
</div>
  <div class="col-3">
  <label >Data Final:</label>
  @if($request->data_fim)
  <input name="data_fim" class="form-control" type="date" value="{{$request->data_fim}}" onchange="this.form.submit()">
  @else
  <input name="data_fim" class="form-control" type="date" value="{{date('Y-m-d')}}" onchange="this.form.submit()">
  @endif
</div>
</div>
<!--
<div class="row">
<div class="col ">
  <h1 align="center"><button class="btn btn-info btn-lg " align="center" type="submit"><i class="fas fa-filter"></i> Filtrar</button></h1>
</div>
</div>
-->
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Consumidor</th>
      <th scope="col">Produto</th>
      <th scope="col">Cidade</th>
      </tr>
  </thead>
  <tbody>
    @foreach($sacs as $sac)
    <tr>
      @if($sac->status == 'novo')
        <th scope="row">
        <button title="Novo" class="btn btn-outline-danger  ">
          <i class="fas fa-exclamation-triangle" ></i>
        </button>
        </th>
        @endif
        @if($sac->status == 'andamento')
          <th scope="row">
            <button title="Em andamento" class="btn btn-outline-warning  ">
            <i class="fas fa-cog"></i>
            </button>
          </th>
          @endif
          @if($sac->status == 'fechado')
            <th scope="row">
              <button title="Fechado" class="btn btn-outline-success  ">
            <i class="fas fa-check-circle"></i>
            </button>
            </th>
            @endif


      <td>{{$sac->consumidor}}</td>
      @foreach($produtos as $produto)
      @if($sac->produto_id ==$produto->id)
      <td>{{$produto->nome}}</td>
      @endif
      @endforeach
      <td>{{$sac->cidade_cons}}</td>




    </tr>
    @endforeach
  </tbody>
</table>

<form class="needs-validation" action='exibirsac' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  @for ($i = 0; $i < count($todos_sacs); $i++)
  <input name="imprimir[]" type="hidden" value="{{$todos_sacs[$i]->id}}">
  @endfor

  <div class="row">
<div class="col ">
  <h1 align="center"><button class="btn btn-success btn-lg " align="center" type="submit"><i class="fas fa-print"></i> Imprimir</button></h1>
</div>
</div>
</form>

<!--
{{$sacs->appends(['status'=>isset($status) ? $status : '%%'])
->appends(['produto'=>isset($produto) ? $produto : '%%' ])
->appends(['categoria'=>isset($categoria)? $categoria : '%%'])
->appends(['fornecedor'=>isset($fornecedor) ? $fornecedor : '%%'] )->links()}}
-->

{{$sacs->appends(['status'=>isset($request->status) ? $request->status : "%%"])
->appends(['produto'=>isset($request->produto) ? $request->produto : '%%' ])
->appends(['categoria'=>isset($request->categoria) ? $request->categoria : '%%'])
->appends(['fornecedor'=>isset($request->fornecedor) ? $request->fornecedor : '%%'])
->appends(['data_inicio'=>isset($request->data_inicio) ? $request->data_inicio : '2020-01-01'])
->appends(['data_fim'=>isset($request->data_fim)? $request->data_fim : date('Y-m-d') ])->links()}}


@stop
