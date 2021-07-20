@extends('adminlte::page')

@section('title', 'Update')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Atualizar Sac
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url("/detalhessac/{$sac->id}") }}">Detalhe Sac</a></li>
          <li class="breadcrumb-item active" aria-current="page">Atualizar Sac</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')





<form class="was-validated" action='upsac' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <input  class="form-control" name="id" type="hidden" value="{{$sac->id}}" >
  <h3>Dados do cliente</h3>
  <hr>
  <div class="row">
  <div class="col-md-4">
       <label >Consumidor</label>
       <input type="text" class="form-control" maxlength="50" name="consumidor" value="{{$sac->consumidor}}"
       placeholder="consumidor" required>
  </div>
  <div class="col-md-4">
       <label >Telefone</label>
       <input type="text" class="form-control" maxlength="50" name="telefone_cons" value="{{$sac->telefone_cons}}"
       placeholder="telefone consumidor" required>
     </div>
     <div class="col-md-4">
       <label>Email</label>
       <input type="text" class="form-control" maxlength="50" name="email_cons" value="{{$sac->email_cons}}"
       placeholder="email consumidor" required>
  </div>
  </div>

  <div class="row">

  <div class="col-md-4">
    <label>Endereço</label>
    <input type="text" class="form-control" name="endereco_cons" maxlength="100" value="{{$sac->endereco_cons}}"
    placeholder="endereço consumidor" required>
  </div>

  <div class="col-md-4">
    <label>Cidade</label>
    <input type="text" class="form-control" maxlength="50" name="cidade_cons" value="{{$sac->cidade_cons}}"
    placeholder="cidade consumidor" required>
  </div>

  <div class="col-md-4">
    <label for="estado">Estado</label>
    <select name="estado_cons" class="form-control" required>
    <option selected value="{{$sac->estado_cons}}">{{$sac->estado_cons}}</option>
    <option value="Acre">Acre</option>
    <option value="Alagoas">Alagoas</option>
    <option value="Amapá">Amapá</option>
    <option value="Amazonas">Amazonas</option>
    <option value="Bahia">Bahia</option>
    <option value="Ceará">Ceará</option>
    <option value="Distrito Federal">Distrito Federal</option>
    <option value="Espírito Santo">Espírito Santo</option>
    <option value="Goiás">Goiás</option>
    <option value="Maranhão">Maranhão</option>
    <option value="Mato Grosso">Mato Grosso</option>
    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
    <option value="Minas Gerais">Minas Gerais</option>
    <option value="Pará">Pará</option>
    <option value="Paraíba">Paraíba</option>
    <option value="Paraná">Paraná</option>
    <option value="Pernambuco">Pernambuco</option>
    <option value="Piauí">Piauí</option>
    <option value="Rio de Janeiro">Rio de Janeiro</option>
    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
    <option value="Rondônia">Rondônia</option>
    <option value="Roraima">Roraima</option>
    <option value="Santa Catarina">Santa Catarina</option>
    <option value="São Paulo">São Paulo</option>
    <option value="Sergipe">Sergipe</option>
    <option value="Tocantins">Tocantins</option>
     </select>
  </div>



  </div>
  <hr>
  <h3>Informações do produto</h3>
  <hr>
  <div class="row">
  <div class="col-md-3">
       <label for="marca">Produto</label>
       <select name="produto" class="form-control" required>
         <option selected value="{{$produto->id}}">{{$produto->nome}}</option>
         @foreach($produtos as $p)
         <option value="{{$p->id}}">{{$p->nome}}</option>
         @endforeach
       </select>
  </div>
  <div class="col-md-3">
       <label for="marca">Fornecedor</label>
       <select name="fornecedor" class="form-control" required>
         <option selected value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
         @foreach($fornecedores as $f)
         <option value="{{$f->id}}">{{$f->nome}}</option>
         @endforeach
       </select>
  </div>

  <div class="col-md-3">
  <label >Validade</label>
  <input type="text" class="form-control"  maxlength="20" name="validade" value="{{$sac->validade_prod}}"
  placeholder="validade" required>
  </div>
  <div class="col-md-3">
  <label >Lote</label>
  <input type="text" class="form-control" maxlength="20" name="lote" value="{{$sac->lote_prod}}"
  placeholder="lote" required>
  </div>
  </div>

  <label >Cliente</label>
  <input type="text" class="form-control" maxlength="50" name="cliente_anch" value="{{$sac->cliente_anch}}"
  placeholder="Cliente" required>

  <hr>
  <h3>Sac</h3>
  <div class="row">
    <div class="col">
    <label for="estado">Motivo Contato</label>
    <select name="motivo" class="form-control" required>
      <option selected value="{{$sac->motivo}}">{{$sac->motivo}}</option>
      <option  value="reclamação">Reclamação</option>
      <option value="informação" >Informação</option>
      <option value="elogio">Elogio</option>
     </select>
    </div>
  <div class="col">
  <label >Ocorrido</label>
  <select name="categoria" class="form-control" required>
    @foreach($categorias as $c)
    @if($c->id == $sac->categoria_id)
    <option value="{{$c->id}}">{{$c->nome}}</option>
    @endif
    @endforeach

    @foreach($categorias as $c)

    <option value="{{$c->id}}">{{$c->nome}}</option>
    @endforeach
  </select>
  </div>
  <div class="col">
  <label for="estado">Meio Contato</label>
  <select name="meio_contato" class="form-control" required>
    <option value="{{$sac->meio_contato}}" selected >{{$sac->meio_contato}}</option>
  <option value="telefone"  >Telefone</option>
    <option value="e-mail">E-mail</option>
    <option value="carta" >Carta</option>
    <option value="outro">Outro</option>
   </select>
  </div>

  </div>
  <div class="row">
  <div class="col">
  <label >Descrição</label>
  <textarea type="text" oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1' class="form-control" maxlength="1000" name="reclamacao"
  placeholder="Descrição" value="{{$sac->reclamacao}}" rows="5" required>{{$sac->reclamacao}}</textarea>

  </div>
  </div>

  <div class="row">
  <div class="col-12" align="center">
      <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
    </div>
    </div>
    </form>

@stop
