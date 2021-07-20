@extends('adminlte::page')

@section('title', 'Gráfico')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Gráfico Produtos
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gráfico Sacs</li>
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
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/chart.js/chartjs-plugin-datalabels@0.7.0"></script>
<script src="vendor/chart.js/utils.js"></script>
<script src="vendor/jquery.flot.pie.js"></script>
<script src="vendor/jquery.flot.js"></script>
<form class="needs-validation" action='graficoproduto' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}


<label>Motivo de Sac: </label>
@if($request->tipo == "reclamação")
<input type=radio name="tipo" value="%%" onchange="this.form.submit()" >Todos
<input type=radio name="tipo" value="reclamação" checked  onchange="this.form.submit()">Reclamação
<input type=radio name="tipo" value="elogio" onchange="this.form.submit()">Elogio
<input type=radio name="tipo" value="informação" onchange="this.form.submit()">Informação
@elseif($request->tipo == "elogio")
<input type=radio name="tipo" value="%%" onchange="this.form.submit()" >Todos
<input type=radio name="tipo" value="reclamação" onchange="this.form.submit()" >Reclamação
<input type=radio name="tipo" value="elogio" onchange="this.form.submit()" checked>Elogio
<input type=radio name="tipo" value="informação" onchange="this.form.submit()">Informação
@elseif($request->tipo == "informação")
<input type=radio name="tipo" value="%%" onchange="this.form.submit()" >Todos
<input type=radio name="tipo" value="reclamação" onchange="this.form.submit()" >Reclamação
<input type=radio name="tipo" value="elogio"  onchange="this.form.submit()">Elogio
<input type=radio name="tipo" value="informação" checked onchange="this.form.submit()">Informação
@else
<input type=radio name="tipo" value="%%" checked onchange="this.form.submit()">Todos
<input type=radio name="tipo" value="reclamação" onchange="this.form.submit()">Reclamação
<input type=radio name="tipo" value="elogio" onchange="this.form.submit()">Elogio
<input type=radio name="tipo" value="informação" onchange="this.form.submit()">Informação
@endif


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
  <input name="data_inicio" type="date" class="form-control" value="{{$request->data_inicio}}" onchange="this.form.submit()">
  @else
  <input name="data_inicio" type="date" class="form-control" value="2020-01-01" onchange="this.form.submit()">
  @endif
</div>
  <div class="col-3">
  <label >Data Final:</label>
  @if($request->data_fim)
  <input name="data_fim" type="date" class="form-control" value="{{$request->data_fim}}" onchange="this.form.submit()">
  @else
  <input name="data_fim" type="date" class="form-control" value="{{date('Y-m-d')}}" onchange="this.form.submit()">
  @endif
</div>
</div>


<!--
<div class="row">
  <div class="col ">
    <h1 align="center"><button class="btn btn-info btn-lg " align="center" type="submit"><i class="fas fa-chart-line"></i> Gerar Gráfico</button></h1>
  </div>
</div>
-->

</form>

@php

$produtos_array=[];
$cor_produtos=[];
  foreach ($produtos as $p) {
    foreach ($sacs as $s) {
      if($s->produto_id == $p->id){
      $produtos_array[] = $p->nome;

    }
  }
}



$prod=array_count_values($produtos_array);
arsort($prod);

$label_produtos=array_keys($prod);
$data_produtos=array_values($prod);



for($i = 0; $i < count($produtos); $i++) {
    $cor="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
    while(in_array($cor,$cor_produtos)){
      $cor="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
    }
    $cor_produtos[$i]=$cor;
}


@endphp





<div class="row">
<div class="col">
<div id="canvas-holder" >
<canvas  id="grafico_produtos"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_produtos')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>




<script>





    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };


    var cor_produtos = <?php echo json_encode($cor_produtos)?>;
    var label_produtos = <?php echo json_encode($label_produtos)?>;
    var data_produtos = <?php echo json_encode($data_produtos)?>;




Chart.defaults.global.defaultFontColor = 'black';

    var config_produtos = {
      type: 'pie',
      data: {
        datasets: [{
          data: data_produtos,
          backgroundColor: cor_produtos,
          label: data_produtos,
            borderColor: 'black',
        }],
        labels: label_produtos,

      },
      options: {
        responsive: true,
        legend: {
					position: 'bottom',
          align: 'start',
          labels:{
            boxWidth: 20,
            boxHeight: 10,
            padding: 5,
            font: {
                size: 8,
                    },
          },
				},
				title: {
					display: true,
					text: 'Produtos'
				},
				animation: {
					animateRotate: false,
					animateScale: true
				},
        plugins: {
        datalabels: {
            formatter: (value, ctx) => {

                let sum = 0;
                let dataArr = ctx.chart.data.datasets[0].data;
                dataArr.map(data => {
                    sum += data;
                });
                let percentage = value+" - "+(value*100 / sum).toFixed(2)+"%";
                return percentage;


            },
            color: '#fff',
        }
    }
			}
    };



    window.onload = function() {
      var ctx_produto = document.getElementById('grafico_produtos').getContext('2d');
      var chart_produto = new Chart(ctx_produto, config_produtos);
      window.myPie = chart_produto;


    };



function downloadImage(id) {
    var canvas = document.getElementById(id);
      image = canvas.toDataURL("image/jpg", 1.0);
      var link = document.createElement('a');
      link.download = id+".jpg";
      link.href = image;
      link.click();
    }



  </script>



@stop
