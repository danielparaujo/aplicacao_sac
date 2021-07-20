@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Finalizar Sac
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="/exibirsacfsac">Sacs Pendentes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Finalizar Sac</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<form  action='storesacfsac' method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}
<h3>Informações do Sac</h3>
<hr>
@foreach($sacs as $s)
@if($s->id == $id)
<input type="hidden"  name="sac_id" value="{{$s->id}}">
<div class="row">
  <div class="col">
    @foreach($produtos as $p)
    @if($p->id ==$s->produto_id)
      <h5>Produto:</h5> <p>{{$p->nome}}</p>
      @endif
      @endforeach
     </div>
<div class="col">
     <h5>Lote do produto:</h5> <p>{{$s->lote_prod}}</p>
</div>
</div>

<div class="row">
<div class="col">
  <label for="estado">Fornecedor</label>
  <select name="fornecedor_id" class="form-control" required>
  @foreach($fornecedores as $f)
  @if($f->id ==$s->fornecedor_id)
    <option value="{{$f->id}}" selected >{{$f->nome}}</option>
  @else
    <option value="{{$f->id}}">{{$f->nome}}</option>
  @endif
    @endforeach
    </select>
   </div>
   <div class="col">
     <label for="fabricação">Tipo de fabricação</label>
     <select name="fabricacao" class="form-control" required>
     <option value="marca propria" selected >Marca Própria </option>
       <option value="distribuido">Distribuído</option>
     <option value="terceirizado">Terceirizado</option>
      </select>
   </div>


</div>
@endif
@endforeach
<hr>
<div class="row">


  <div class="col">
    <label for="fabricação">Enc. Análise: </label>
    <input type=radio name="enc_analise" value="sim" checked required>Sim
    <input type=radio name="enc_analise" value="não" >Não


    <!--
    <select name="enc_analise" class="form-control" required>
    <option value="sim" selected >Sim </option>
      <option value="nao">Não</option>
     </select>
   -->
   </div>

   <div class="col">
     <label for="fabricação">Enc. Fabricante</label>
     <input type=radio name="enc_fabricante" value="sim" checked required>Sim
     <input type=radio name="enc_fabricante" value="não" >Não
  </div>

  <div class="col">
    <label for="fabricação">Reposicao prod.</label>
    <input type=radio name="reposicao_prod" value="sim" checked required>Sim
    <input type=radio name="reposicao_prod" value="não" >Não
   </div>

   <div class="col">
     <label for="fabricação">Recolhimento prod.</label>
     <input type=radio name="recolhe_prod" value="sim" checked required>Sim
     <input type=radio name="recolhe_prod" value="não" >Não
  </div>
</div>
<div class="row">
<div class="col">
<label >Laboratório</label>
<input type="text" class="form-control" maxlength="20" name="laboratorio"
placeholder="Laboratório" >
</div>
</div>



<div class="row">
<div class="col-12" align="center">
    <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
  </div>
  </div>
  </form>

@stop
