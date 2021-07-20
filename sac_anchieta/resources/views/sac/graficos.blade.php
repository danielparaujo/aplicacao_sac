@extends('adminlte::page')

@section('title', 'Gráfico')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
        Gráfico Sacs Finalizados
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Gráfico Sacs Finalizados</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/chart.js/utils.js"></script>
<script src="vendor/chart.js/chartjs-plugin-datalabels@0.7.0"></script>

<form  action='graficos' method="POST" enctype="multipart/form-data" >
  {{ csrf_field() }}

  <label>Motivo de Sac: </label>
  @if($request->motivo == "reclamação")
  <input type=radio name="motivo" value="%%" onchange="this.form.submit()" >Todos
  <input type=radio name="motivo" value="reclamação" checked  onchange="this.form.submit()">Reclamação
  <input type=radio name="motivo" value="elogio" onchange="this.form.submit()">Elogio
  <input type=radio name="motivo" value="informação" onchange="this.form.submit()">Informação
  @elseif($request->motivo == "elogio")
  <input type=radio name="motivo" value="%%" onchange="this.form.submit()" >Todos
  <input type=radio name="motivo" value="reclamação" onchange="this.form.submit()" >Reclamação
  <input type=radio name="motivo" value="elogio" onchange="this.form.submit()" checked>Elogio
  <input type=radio name="motivo" value="informação" onchange="this.form.submit()">Informação
  @elseif($request->motivo == "informação")
  <input type=radio name="motivo" value="%%" onchange="this.form.submit()" >Todos
  <input type=radio name="motivo" value="reclamação" onchange="this.form.submit()" >Reclamação
  <input type=radio name="motivo" value="elogio"  onchange="this.form.submit()">Elogio
  <input type=radio name="motivo" value="informação" checked onchange="this.form.submit()">Informação
  @else
  <input type=radio name="motivo" value="%%" checked onchange="this.form.submit()">Todos
  <input type=radio name="motivo" value="reclamação" onchange="this.form.submit()">Reclamação
  <input type=radio name="motivo" value="elogio" onchange="this.form.submit()">Elogio
  <input type=radio name="motivo" value="informação" onchange="this.form.submit()">Informação
  @endif



  <div class="row">

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

</div>

</form>





@php

$cor_fornecedores=[];
$fornecedores_array=[];
foreach ($fornecedores as $f) {
  foreach ($fsacs as $fsac) {
    if($fsac->fornecedor_id == $f->id){
    $fornecedores_array[] = $f->nome;
  }
}
}

$label_fornecedores=array_keys(array_count_values($fornecedores_array));
$data_fornecedores=array_values(array_count_values($fornecedores_array));
for($i = 0; $i < count($fornecedores); $i++) {
  $cor_fornecedores[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}

$tipos_array=[];
$analise_array=[];
$fabricante_array=[];
$reposicao_array=[];
$recolhimento_array=[];
  foreach ($fsacs as $fsac) {
    $tipos_array[] = $fsac->fabricacao;
    $analise_array[] = $fsac->enc_analise;
    $fabricante_array[] = $fsac->enc_fabricante;
    $reposicao_array[] = $fsac->reposicao_prod;
    $recolhimento_array[] = $fsac->recolhe_prod;
}
$cor_tipos=[];
$label_tipos=array_keys(array_count_values($tipos_array));
$data_tipos=array_values(array_count_values($tipos_array));
for($i = 0; $i < count($tipos_array); $i++) {
  $cor_tipos[]="#".str_pad(dechex(Rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
}

@endphp

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_fornecedores"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_fornecedores')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_tipos"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_tipos')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_analise"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_analise')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_fabricante"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_fabricante')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>

<div class="row">
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_recolhimento"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_recolhimento')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
<div class="col">
<div id="canvas-holder" style="width:100%" >
<canvas  id="grafico_reposicao"></canvas>
<h1 align="center">
  <button align="center" class="btn btn-success" type="button" onclick="downloadImage('grafico_reposicao')">
  <i class="fas fa-download"></i>Download</button></h1>
</div>
</div>
</div>


<script>





    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

    var cor_fornecedores = <?php echo json_encode($cor_fornecedores)?>;
    var label_fornecedores = <?php echo json_encode($label_fornecedores)?>;
    var data_fornecedores = <?php echo json_encode($data_fornecedores)?>;

    var cor_tipos = <?php echo json_encode($cor_tipos)?>;

    var label_tipos = <?php echo json_encode($label_tipos)?>;
    var data_tipos = <?php echo json_encode($data_tipos)?>;

    var label_analise = <?php echo json_encode(array_keys(array_count_values($analise_array)))?>;
    var data_analise = <?php echo json_encode(array_values(array_count_values($analise_array)))?>;

    var label_fabricante = <?php echo json_encode(array_keys(array_count_values($fabricante_array)))?>;
    var data_fabricante = <?php echo json_encode(array_values(array_count_values($fabricante_array)))?>;

    var label_reposicao = <?php echo json_encode(array_keys(array_count_values($reposicao_array)))?>;
    var data_reposicao = <?php echo json_encode(array_values(array_count_values($reposicao_array)))?>;

    var label_recolhimento = <?php echo json_encode(array_keys(array_count_values($recolhimento_array)))?>;
    var data_recolhimento = <?php echo json_encode(array_values(array_count_values($recolhimento_array)))?>;


Chart.defaults.global.defaultFontColor = 'black';

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

var config_tipos = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_tipos,
      backgroundColor: cor_tipos,
      label: data_tipos,
        borderColor: 'black',
    }],
    labels: label_tipos,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Tipos de Fabricação'
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

var config_analise = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_analise,
      backgroundColor: cor_tipos,
      label: data_analise,
        borderColor: 'black',
    }],
    labels: label_analise,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Encaminhado para análise'
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

var config_fabricante = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_fabricante,
      backgroundColor: cor_tipos,
      label: data_fabricante,
        borderColor: 'black',
    }],
    labels: label_fabricante,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Encaminhado para fabricante'
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


var config_recolhimento = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_recolhimento,
      backgroundColor: cor_tipos,
      label: data_recolhimento,
        borderColor: 'black',
    }],
    labels: label_recolhimento,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Recolhimento do produto'
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

var config_reposicao = {
  type: 'pie',
  data: {
    datasets: [{
      data: data_reposicao,
      backgroundColor: cor_tipos,
      label: data_reposicao,
        borderColor: 'black',
    }],
    labels: label_reposicao,

  },
  options: {
    responsive: true,
    legend: {
      position: 'right',
    },
    title: {
      display: true,
      text: 'Reposição do produto'
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







    window.onload = function() {

      var ctx_fornecedor = document.getElementById('grafico_fornecedores').getContext('2d');
      window.myPie = new Chart(ctx_fornecedor, config_fornecedores);

      var ctx_tipos = document.getElementById('grafico_tipos').getContext('2d');
      window.myPie = new Chart(ctx_tipos, config_tipos);
      var ctx_analise = document.getElementById('grafico_analise').getContext('2d');
      window.myPie = new Chart(ctx_analise, config_analise);
      var ctx_fabricante = document.getElementById('grafico_fabricante').getContext('2d');
      window.myPie = new Chart(ctx_fabricante, config_fabricante);
      var ctx_recolhimento = document.getElementById('grafico_recolhimento').getContext('2d');
      window.myPie = new Chart(ctx_recolhimento, config_recolhimento);
      var ctx_reposicao = document.getElementById('grafico_reposicao').getContext('2d');
      window.myPie = new Chart(ctx_reposicao, config_reposicao);



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
