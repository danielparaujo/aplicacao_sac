@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Cadastrar Produto
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar Produto</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<form  action='storeprodutos' method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}

     <label for="produto">Produto</label>
     <input type="text" maxlength="50"class="form-control" name="produto" placeholder="produto" required>

     <label for="marca">Marca</label>
     <select name="marca" class="form-control">
       <option value="Anchieta">Anchieta</option>
       <option value="BigJo">BigJo</option>
     </select>



       <label for="fornecedor">Fornecedor</label>
       <select name="fornecedor_id" class="form-control">
         @foreach($fornecedores as $f)
         <option value="{{$f->id}}">{{$f->nome}}</option>
         @endforeach
       </select>

       <div class="row">
       <div class="col-12" align="center">
           <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
         </div>
         </div>
    </form>
@stop
