@extends('adminlte::page')

@section('title', 'Detalhes')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Detalhes Sac
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{url('/sacs')}}">Exibir Sacs</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detalhe Sac</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="row">

    @if($sac->status != 'fechado')
    <div class="col-2 " >

    <h5><a class="btn btn-dark" title="Editar Sac" href="{{ url("/updatesac/{$sac->id}") }}">
      <i class="fas fa-edit  " style="color: white;"></i> Editar Sac</a></h5>
    </div>
      @endif
    <div class="col-2 " >
    <h5><a class="btn btn-dark" title="Relatório do Sac" href="{{ url("/relatoriodetalhado/{$sac->id}") }}">
      <i class="fas fa-book " style="color: white;"></i> Formulário</a></h5>
    </div>

</div>



<div class="row">
  <div class="col-12 " align="center">
    <h4>STATUS-{{$sac->status}}</h4>
  </div>
</div>
<hr>
<h4>Consumidor:</h4>

<div class="row">
  <div class="col-4 " >
    <h5>Nome: {{$sac->consumidor}}</h5>
  </div>
  <div class="col-4 " >
    <h5>Email: {{$sac->email_cons}}</h5>
  </div>
  <div class="col-4 " >
    <h5>Telefone: {{$sac->telefone_cons}}</h5>
  </div>
</div>
<h5>Endereço: {{$sac->endereco_cons}} , {{$sac->cidade_cons}} - {{$sac->estado_cons}}</h5>

<hr>
<h4>Produto:</h4>

<div class="row">
  <div class="col-3 " >
    <h5>Produto: {{$produto->nome}}</h5>
  </div>
  <div class="col-2 " >
    <h5>Marca: {{$produto->marca}}</h5>
  </div>
  <div class="col-3 " >
    <h5>Fornecedor: {{$fornecedor->nome}}</h5>
  </div>
  <div class="col-2 " >
    <h5>Lote: {{$sac->lote_prod}}</h5>
  </div>
  <div class="col-2 " >
    <h5>Validade: {{$sac->validade_prod}}</h5>
  </div>
</div>
<hr>
<h5>Cliente Anchieta:   {{$sac->cliente_anch}}<h5>

  <hr>
  <h5>Ocorrido:{{$categoria->nome}}</h5>
  <h5>Reclamação:{{$sac->reclamacao}}</h5>
  <hr>
  <h4>Data Inserção/Fechamento:</h4>

  <div class="row">
    <div class="col-4 " >
      <h5>Data de Inserção: {{date('d/m/Y', strtotime($sac->data_insercao))}}</h5>
    </div>
    <div class="col-4 " >
      <h5>Data Envio:
          @if($sac->data_envio)
          {{date('d/m/Y', strtotime($sac->data_envio))}}
          @endif
      </h5>
    </div>
    <div class="col-4 " >
      <h5>Data Fechamento:
        @if($sac->data_fechamento)
          {{date('d/m/Y', strtotime($sac->data_fechamento))}}
          @endif

      </h5>

    </div>

  </div>




<hr>

<div class="row">

      @if($sac->status == 'novo')
      <div class="col " >
      <form  action="{{ url("/andamento/{$sac->id}") }}"  enctype="multipart/form-data" >
      <label >Justificativa</label>
      <textarea rows="5" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1' type="text" class="form-control" name="justificativa"
      placeholder="Justificativa" required maxlength="1000"></textarea>
      <button class="btn btn-warning" type="submit"><i class="fas fa-cogs"></i> Processar SAC</button>
      </form>
        </div>
            @endif
        @if($sac->status == 'andamento')
          <div class="col " >
        <form  action="{{ url("/fechado/{$sac->id}") }}"  enctype="multipart/form-data" >
        <label >Justificativa</label>
        <textarea rows="5" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1' type="text" class="form-control" name="justificativa"
        placeholder="Justificativa" required maxlength="1000"></textarea>
        <button class="btn btn-success" type="submit"><i class="far fa-calendar-check"></i> Fechar SAC</button>
        </form>
        </div>
        </div>

          @endif






      @stop
