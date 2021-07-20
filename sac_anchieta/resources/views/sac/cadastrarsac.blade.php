@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Inserir Sac
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Inserir Sac</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<form  action='storesac' method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}

<h3>Dados do cliente</h3>
<hr>
<div class="row">
<div class="col-md-4">
     <label >Consumidor</label>
     <input type="text" maxlength="50" class="form-control" name="consumidor"
     placeholder="consumidor" required>
</div>
<div class="col-md-4">
     <label >Telefone</label>
     <input type="text" class="form-control" maxlength="50" name="telefone_cons"
     placeholder="telefone consumidor" required>
   </div>
   <div class="col-md-4">
     <label>Email</label>
     <input type="email" class="form-control" maxlength="50" name="email_cons"
     placeholder="email consumidor">
</div>
</div>

<div class="row">

<div class="col-md-4">
  <label>Endereço</label>
  <input type="text" class="form-control" maxlength="100" name="endereco_cons"
  placeholder="endereço consumidor" required>
</div>

<div class="col-md-4">
  <label>Cidade</label>
  <input type="text" class="form-control" maxlength="50" name="cidade_cons"
  placeholder="cidade consumidor" required>
</div>

<div class="col-md-4">
  <label for="estado">Estado</label>
  <select name="estado_cons" class="form-control" required>
  <option value="Minas Gerais" selected >Minas Gerais</option>
    <option value="Bahia">Bahia</option>

  <option value="Espírito Santo">Espírito Santo</option>

    <option value="Rio de Janeiro">Rio de Janeiro</option>
    <option value="São Paulo">São Paulo</option>

   </select>
</div>



</div>


<hr>

<h3>Informações do produto</h3>

<div class="row">
<div class="col-md-4">
     <label >Produto</label>
     <select name="produto" id="produto" class="form-control" required >
       <option value="">Selecionar</option>
       @foreach($produtos as $p)
       @if($p->situacao == 'ativo')
       <option value="{{$p->id}}">{{$p->nome}}</option>
       @endif
       @endforeach
     </select>
</div>





<div class="col-md-4">
<label >Validade</label>
<input type="text" class="form-control" maxlength="20" name="validade"
placeholder="validade" required>
</div>
<div class="col-md-4">
<label >Lote</label>
<input type="text" class="form-control" maxlength="20" name="lote"
placeholder="lote" required>
</div>
</div>
<div class="row">
<div class="col">
<label >Cliente</label>
<input type="text" class="form-control" maxlength="50" name="cliente_anch"
placeholder="Cliente" required>
</div>
</div>
<hr>
<h3>Sac</h3>
<div class="row">
  <div class="col">
  <label for="estado">Motivo Contato</label>
  <select name="motivo" class="form-control" required>
    <option selected value="reclamação">Reclamação</option>
    <option value="informação" >Informação</option>
    <option value="elogio">Elogio</option>
   </select>
  </div>
<div class="col">
<label >Ocorrido</label>
<select name="categoria" class="form-control" required>
  <option value="">Selecionar</option>
  @foreach($categorias as $c)
  <option value="{{$c->id}}">{{$c->nome}}</option>
  @endforeach
</select>
</div>
<div class="col">
<label for="estado">Meio Contato</label>
<select name="meio_contato" class="form-control" required>
<option value="telefone" selected >Telefone</option>
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
placeholder="Descrição" rows="5" required>Cliente Consumiu o produto ( )sim ( )não&#10;Cliente jogou o produto fora ( )sim ( )não&#10;Obs:  </textarea>

</div>
</div>

<div class="row">
<div class="col-12" align="center">
    <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
  </div>
  </div>
  </form>

@stop
