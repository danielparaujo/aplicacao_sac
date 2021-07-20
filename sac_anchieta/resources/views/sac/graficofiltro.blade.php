@extends('adminlte::page')

@section('title', 'Gráfico')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Gráfico Sacs
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
<form class="needs-validation" action='graficofiltro' method="POST" enctype="multipart/form-data" >
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
  <div class="col ">

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

  <label>Produto:</label>
  <select name="produto" class="form-control" onchange="this.form.submit()">
    @if($request->produto and $request->produto !="%%")
      <option  value="{{$request->produto}}" >{{$produto}}</option>
    @endif
    <option  value="%%" >Todos produtos</option>

    @for ($i = 0; $i < count($produtos); $i++)
    <option  value="{{$produtos[$i]->id}}">{{$produtos[$i]->nome}}</option>
    @endfor
  </select>
</div>
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
$sacs_array=[];
$cor_sacs=[];
foreach ($sacs as $s) {
  $sacs_array[] = $s->status;
}
$label_sacs=array_keys(array_count_values($sacs_array));
$data_sacs=array_values(array_count_values($sacs_array));

for($i = 0; $i < count($sacs); $i++) {
    $cor_sacs[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}

$sacs_finalizacao_array=[];
$cor_sacs_finalizacao=[];
foreach ($sacs as $s) {
  $sacs_finalizacao_array[] = $s->status_finalizacao;
}
$label_sacs_finalizacao=array_keys(array_count_values($sacs_finalizacao_array));
$data_sacs_finalizacao=array_values(array_count_values($sacs_finalizacao_array));

for($i = 0; $i < count($sacs); $i++) {
    $cor_sacs_finalizacao[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}

$fornecedores_array=[];
$cor_fornecedores=[];
foreach ($fornecedores as $f) {
  foreach ($sacs as $s) {
    if($s->fornecedor_id == $f->id){
    $fornecedores_array[] = $f->nome;

  }
}
}
$label_fornecedores=array_keys(array_count_values($fornecedores_array));
$data_fornecedores=array_values(array_count_values($fornecedores_array));
for($i = 0; $i < count($fornecedores); $i++) {
  $cor_fornecedores[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}


$produtos_array=[];
$cor_produtos=[];
  foreach ($produtos as $p) {
    foreach ($sacs as $s) {
      if($s->produto_id == $p->id){
      $produtos_array[] = $p->nome;

    }
  }
}
$label_produtos=array_keys(array_count_values($produtos_array));
$data_produtos=array_values(array_count_values($produtos_array));
for($i = 0; $i < count($produtos); $i++) {
    $cor_produtos[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}
$categorias_array=[];
$cor_categorias=[];
  foreach ($categorias as $c) {
    foreach ($sacs as $s) {
      if($s->categoria_id == $c->id){
      $categorias_array[] = $c->nome;

    }
  }
}
$label_categorias=array_keys(array_count_values($categorias_array));
$data_categorias=array_values(array_count_values($categorias_array));
for($i = 0; $i < count($categorias); $i++) {
    $cor_categorias[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}

@endphp


<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_sacs"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_sacs')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_sacs_finalizacao"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_sacs_finalizacao')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>




<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%">
<canvas  id="grafico_produtos"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_produtos')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%">
<canvas  id="grafico_categorias"></canvas>
<h1 align="center">
<button type="button" class="btn btn-success" onclick="downloadImage('grafico_categorias')"><i class="fas fa-download"></i>Download</button>
</h1>
</div>
</div>
</div>
<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%">
<canvas  id="grafico_fornecedores"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_fornecedores')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>



<script>





    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };
    var cor_sacs = <?php echo json_encode($cor_sacs)?>;
    var label_sacs = <?php echo json_encode($label_sacs)?>;
    var data_sacs = <?php echo json_encode($data_sacs)?>;

    var cor_sacs_finalizacao = <?php echo json_encode($cor_sacs_finalizacao)?>;
    var label_sacs_finalizacao = <?php echo json_encode($label_sacs_finalizacao)?>;
    var data_sacs_finalizacao = <?php echo json_encode($data_sacs_finalizacao)?>;

    var cor_produtos = <?php echo json_encode($cor_produtos)?>;
    var label_produtos = <?php echo json_encode($label_produtos)?>;
    var data_produtos = <?php echo json_encode($data_produtos)?>;

    var cor_categorias = <?php echo json_encode($cor_categorias)?>;
    var label_categorias = <?php echo json_encode($label_categorias)?>;
    var data_categorias = <?php echo json_encode($data_categorias)?>;

    var cor_fornecedores = <?php echo json_encode($cor_fornecedores)?>;
    var label_fornecedores = <?php echo json_encode($label_fornecedores)?>;
    var data_fornecedores = <?php echo json_encode($data_fornecedores)?>;




Chart.defaults.global.defaultFontColor = 'black';
var config_sacs = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_sacs,
      backgroundColor: cor_sacs,
      label: data_sacs,
      borderColor: 'black',
    }],
    labels: label_sacs,

  },
  options: {

    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Status do Sac'
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
            let percentage = value+"/"+sum+" - "+(value*100 / sum).toFixed(2)+"%";
            return percentage ;
        },
        color: '#fff',
    }
}
  }
};
var config_sacs_finalizacao = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_sacs_finalizacao,
      backgroundColor: cor_sacs_finalizacao,
      label: data_sacs_finalizacao,
      borderColor: 'black',
    }],
    labels: label_sacs_finalizacao,

  },
  options: {

    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Finalização do Sac'
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
            let percentage = value+"/"+sum+" - "+(value*100 / sum).toFixed(2)+"%";
            return percentage;
        },
        color: '#fff',
    }
}
  }
};
var config_fornecedores = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_fornecedores,
      backgroundColor: cor_fornecedores,
      label: data_fornecedores,
        borderColor: 'black',
    }],
    labels: label_fornecedores,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Fornecedores'
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
            let percentage =value+" - "+ (value*100 / sum).toFixed(2)+"%";
            return percentage;


        },
        color: '#fff',
    }
}
  }
};



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
					position: 'right',
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
    var config_categorias = {
      type: 'pie',
      data: {
        datasets: [{
          data: data_categorias,
          backgroundColor: cor_categorias,
          label: data_categorias,
            borderColor: 'black',
        }],
        labels: label_categorias,

      },
      options: {
        responsive: true,
        legend: {
          position: 'right',
        },
        title: {
          display: true,
          text: 'Categorias'
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
      var ctx_categoria = document.getElementById('grafico_categorias').getContext('2d');
      var chart_categoria = new Chart(ctx_categoria, config_categorias);
      window.myPie = chart_categoria;
          var ctx_sac = document.getElementById('grafico_sacs').getContext('2d');
      var chart_sac = new Chart(ctx_sac, config_sacs);
      window.myPie = chart_sac;
      var ctx_fornecedor = document.getElementById('grafico_fornecedores').getContext('2d');
      var chart_fornecedor = new Chart(ctx_fornecedor, config_fornecedores);
      window.myPie = chart_fornecedor;
      var ctx_sac_finalizacao = document.getElementById('grafico_sacs_finalizacao').getContext('2d');
  var chart_sac_finalizacao = new Chart(ctx_sac_finalizacao, config_sacs_finalizacao);
  window.myPie = chart_sac_finalizacao;

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
