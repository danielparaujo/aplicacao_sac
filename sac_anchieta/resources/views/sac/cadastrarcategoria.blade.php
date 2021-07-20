@extends('adminlte::page')

@section('title', 'Cadastrar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Cadastrar Categoria
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar Categoria</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

<form  action='storecategoria' method="POST" enctype="multipart/form-data" >
{{ csrf_field() }}

     <label for="categoria">Categoria</label>
     <input type="text" class="form-control" maxlength="100" name="categoria" placeholder="categoria" required>

     <div class="row">
     <div class="col-12" align="center">
         <h1><button class="btn btn-info w-50 btn-lg" type="submit"><i class="fas fa-plus-square"></i> Cadastrar</button></h1>
       </div>
       </div>
    </form>
@stop
