@extends('adminlte::page')

@section('title', 'SAC')

@section('content_header')

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
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">


        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          <div class="row">
          <div class="col">
          <h1 class=" btn btn-dark btn-lg btn-block  " style="font-size: 30px;">Cadastrar
          <div class="row">
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/cadastrarprodutos') }}" ><i class="fas fa-plus-square"></i> Produto</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/cadastrarfornecedor') }}" ><i class="fas fa-plus-square"></i></i> Fornecedor</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/cadastrarcategoria') }}" ><i class="fas fa-plus-square"></i></i> Categoria</a></h1>
            </div>
          </div></h1>
          </div>
          </div>

          <div class="row">
          <div class="col">
          <h1 class=" btn btn-dark btn-lg btn-block  " style="font-size: 30px;">Exibir
          <div class="row">
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/exibirprodutos') }}" ><i class="fas fa-tv"></i> Produto</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/exibirfornecedor') }}" ><i class="fas fa-tv"></i></i> Fornecedor</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/exibircategoria') }}" ><i class="fas fa-tv"></i></i> Categoria</a></h1>
            </div>
          </div></h1>
          </div>
          </div>

          <div class="row">
          <div class="col">
          <h1 class=" btn btn-dark btn-lg btn-block  " style="font-size: 30px;">SAC
          <div class="row">
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('cadastrarsac') }}" ><i class="fas fa-plus-circle"></i> Inserir Sac</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/sacs') }}" ><i class="far fa-file"></i></i> Exibir todos</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/exibirsac') }}" ><i class="fas fa-filter"></i></i> Filtrar</a></h1>
            </div>
          </div></h1>
          </div>
          </div>



          <div class="row">
          <div class="col">
          <h1 class=" btn btn-dark btn-lg btn-block  " style="font-size: 30px;">Finalização SAC
          <div class="row">
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/exibirsacfsac') }}" ><i class="fas fa-hourglass-half"></i> Sacs pendentes</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;" href="{{ url('/exibirfsac') }}" ><i class="fas fa-check"></i> Sacs Finalizados</a></h1>
            </div>
          </div></h1>
          </div>
          </div>

          <div class="row">
                  <div class="col">
                  <h1 class=" btn btn-dark btn-lg btn-block  "style="font-size: 30px;" >Relatório
                  <div class="row">
                    <div class="col">
                    <h1 align="center"><a class="btn btn-info btn-block" align="center"  href="{{ url('/filtro') }}" style="font-size: 25px;"><i class="far fa-file-pdf"></i> Relatório</a></h1>
                    </div>

                  </div></h1>
                  </div>
                  </div>

          <div class="row">
          <div class="col">
          <h1 class=" btn btn-dark btn-lg btn-block  " style="font-size: 30px;">Gráfico
          <div class="row">
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/graficofiltro') }}" ><i class="fas fa-chart-pie"></i> Sac</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/graficoproduto') }}" ><i class="fas fa-chart-pie"></i> Produtos</a></h1>
            </div>
            <div class="col">
            <h1 align="center"><a class="btn btn-info btn-block" align="center" style="font-size: 25px;"  href="{{ url('/graficos') }}" ><i class="fas fa-chart-pie"></i> Finalização Sac</a></h1>
            </div>

          </div></h1>
          </div>
          </div>

        </div>
      </div>
    </div>
  </div>


</div>

@stop
