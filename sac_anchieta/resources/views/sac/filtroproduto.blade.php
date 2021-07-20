@extends('adminlte::page')

@section('title', 'Relatório')

@section('content_header')
    <h1>SAC Anchieta</h1>
@stop


@section('content')

        <form  action='gerarrelatorioproduto' method="POST" enctype="multipart/form-data" >
          {{ csrf_field() }}

          <label>Status do SAC:</label>


          <select name="status" class="form-control">
            <option  value="%%">Todos</option>
             <option  value="novo">Novo</option>
            <option  value="andamento">Em andamento</option>
            <option  value="fechado">Fechado</option>

          </select>
          <hr>
          <label>Produtos com Sac:</label>

          <select name="produto" class="form-control">
            <option  value="todos">Todos produtos</option>
            @for ($i = 0; $i < count($produtos); $i++)
            <option  value="{{$produtos[$i]->id}}">{{$produtos[$i]->nome}}</option>
            @endfor
          </select>
          <hr>
          <h5>Data de inserção do Sac:</h5>

          <label >Data Inicial:</label>
          <input name="data_inicio" type="date" value="2020-01-01">

          <label >Data Final:</label>
          <input name="data_fim" type="date" value="{{date('Y-m-d')}}">
          <hr>


          <button class="btn btn-success" align="center" type="submit">Gerar Relatório</button>

        </form>



@endsection
