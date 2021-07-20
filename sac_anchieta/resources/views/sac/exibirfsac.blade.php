@extends('adminlte::page')

@section('title', 'Exibir')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Sacs Finalizados
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Sacs Finalizados</li>
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


<form  action='exibirfsac' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <input name="pesquisa" type="hidden" value="">
  <div class="row">


  <div class="col">
  <label >Data Inicial:</label>
  @if($request->data_inicio)
  <input name="data_inicio" type="date" class="form-control" value="{{$request->data_inicio}}" onchange="this.form.submit()">
  @else
<input name="data_inicio" type="date" class="form-control" value="2020-01-01" onchange="this.form.submit()">
  @endif
</div>
  <div class="col">
  <label >Data Final:</label>
  @if($request->data_inicio)
  <input name="data_fim" type="date" class="form-control" value="{{$request->data_fim}}" onchange="this.form.submit()">
  @else
  <input name="data_fim" type="date" class="form-control" value="{{date('Y-m-d')}}" onchange="this.form.submit()">
  @endif
</div>
<div class="col ">

<label >Pesquisar ID:</label>
<input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Pesquisa" value="{{$pesquisa}}" >
</div>
<div class="col ">
<hr >
<button class="btn btn-info" align="center" type="submit"><i class="fas fa-search"></i> Pesquisar</button>
</div>
</div>

</form>



<table class="table">
  <thead>
    <tr>
      <th scope="col">ID Sac</th>

      <th scope="col">Consumidor</th>
      <th scope="col">Produto</th>
      <th scope="col">Lote</th>
      <th scope="col">Categoria</th>
      <th scope="col">Relatório</th>

      </tr>
  </thead>
  <tbody>
    @foreach($fsacs as $fsac)
    <tr>
    <th>{{$fsac->sac_id}}</th>


      @foreach($sacs as $sac)
      @if($sac->id == $fsac->sac_id)
      <td>{{$sac->consumidor}}</td>
      @foreach($produtos as $produto)
      @if($sac->produto_id ==$produto->id)
      <td>{{$produto->nome}}</td>
      @endif
      @endforeach
      <td>{{$sac->lote_prod}}</td>
      @foreach($categorias as $cat)
      @if($sac->categoria_id ==$cat->id)
      <td>{{$cat->nome}}</td>
      @endif
      @endforeach
      @endif
      @endforeach

      <td><a class="nav-link js-scroll-trigger" title="Detalhes" href="{{ url("/relatoriofsac/{$fsac->id}") }}">
      <i class="far fa-fw fa-file-alt fa-2x " style="color: #2B5DE8;"></i></a></td>


    </tr>
    @endforeach
  </tbody>
</table>




@stop
