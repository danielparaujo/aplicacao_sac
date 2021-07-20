<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="../vendor/adminlte/dist/css/adminlte.css">
<style type="text/css">
.titulo2{ width: 90%; line-height:80px; font-size:18px;  float:left; margin: 25px 0;  text-align:left }






</style>



  <!-- Fontes-->

<body>
<div class="container">
  <div class="container-fluid">
  <div class="row justify-content-start">
    <div class="col-3" >
      <img class="rounded float-left" src="../storage/logo.png" >
      </div>
      <div class="col-6 titulo2"   >
        <h2>FORMULÁRIO DE RECLAMAÇÃO</h2>
    </div>
  </div>
</div>
<hr>
<div class="row justify-content-start">
  <div class="col-10" >
    <p><b>ID:</b>{{$sac->id}}</p>
  </div>
    <div class="col-6" >
    <p> <b>Data:</b> {{date('d/m/Y')}} </p>
    </div>
</div>

  <div class="row" style="border: 0.5px solid #d3d3d3">
        <div class="col-12 " align="center">
          <h4>Dados do Cliente</h4>
        </div>
  </div>

    <div class="row " >
      <table class="table table-bordered ">
        <tr>
          <td scope="col"><b>Nome:</b> {{$sac->consumidor}}</td>
          <td scope="col"><b>Email:</b> {{$sac->email_cons}}</td>
          <td scope="col"><b>Telefone:</b> {{$sac->telefone_cons}}</td>

    </tr>

        <tr>
          <td scope="col"><b>Endereço:</b> {{$sac->endereco_cons}}</td>
          <td scope="col"><b>Cidade:</b> {{$sac->cidade_cons}}</td>
          <td scope="col"><b>Estado:</b> {{$sac->estado_cons}}</td>
    </tr>
    <tr>
      <td scope="col" colspan="3"><b>Contato com o consumidor:</b> {{$sac->meio_contato}}</td>

</table>
</div>

<div class="row" style="border: 0.5px solid #d3d3d3">
      <div class="col-12 " align="center">
        <h4>Dados do Produto</h4>
      </div>
</div>
<div class="row" >
  <table class="table table-bordered">
    <tr>
      <td scope="col"><b>Produto:</b> {{$produto->nome}}</td>
      <td scope="col"><b>Marca:</b> {{$produto->marca}}</td>
      <td scope="col"><b>Lote:</b> {{$sac->lote_prod}}</td>
      <td scope="col"><b>Validade:</b> {{$sac->validade_prod}}</td>
    </tr>
    <tr>
      <td scope="col"><b>Fornecedor:</b> {{$fornecedor->nome}}</td>
      <td scope="col"><b>Tipo:</b> {{$fsac->fabricacao}}</td>
      <td scope="col"colspan="2"><b>Estabelecimento que o cliente comprou:</b> {{$sac->cliente_anch}}</td>
</tr>

</table>
</div>

<div class="row" style="border: 0.5px solid #d3d3d3">
      <div class="col-12 " align="center">
        <h4>Dados do Fornecedor</h4>
      </div>
</div>
<div class="row" >
  <table class="table table-bordered">
    <tr>
      <td scope="col"colspan="2"><b>Razão Social:</b> {{$fornecedor->nome}}</td>
      <td scope="col"><b>CNPJ:</b> {{$fornecedor->cnpj}}</td>
      </tr>
      <tr>
        <td scope="col"><b>Email:</b> {{$fornecedor->email}}</td>
        <td scope="col"><b>Telefone:</b> {{$fornecedor->telefone}}</td>
        <td scope="col"><b>Complemento :</b> {{$fornecedor->telefone_complemento}}</td>
      </tr>
</table>
</div>
<div class="row" >
      <div class="col-12 " style="border: 0.5px solid #d3d3d3">
        <p><b>Motivo do contato:</b> {{$sac->motivo}}</p>
      </div>
</div>
<hr color="white">
<div class="row" style="border: 0.5px solid #d3d3d3">
      <div class="col-12 " align="center">
        <h4>Histórico</h4>
      </div>
</div>
<div class="row" >
  <table class="table table-bordered">
      <tr>
      <td scope="col"><b>Data:</b> {{date('d/m/Y', strtotime($sac->data_insercao))}}</td>
      <td scope="col"><b>Reclamação:</b><pre style="margin: 0; border-color: transparent;">{{$sac->reclamacao}}</pre></td>
      </tr>
    </table>
    </div>
    <hr color="white">
    <div class="row" style="border: 0.5px solid #d3d3d3">
          <div class="col-12 " align="center">
            <h4>Posicionamento da Anchieta</h4>
          </div>
    </div>
    <div class="row" >
      <table class="table table-bordered">
          <tr>
          <td scope="col" ><b>Encaminhamento para análise:</b> {{$fsac->enc_analise}}</td>
          <td scope="col" ><b>Laboratório:</b> {{$fsac->laboratorio}} </td>
          </tr>
          <tr>
          <td scope="col" ><b>Encaminhamento para fabricante: </b>{{$fsac->enc_fabricante}}
            @foreach($fornecedors as $f)
            @if($f->id == $fsac->fornecedor_id)
          <td scope="col" ><b>Fabricante: </b>{{$f->nome}}</td>
          @endif
          @endforeach
          </tr>

        </table>
        </div>
        <div class="row" style="border: 0.5px solid #d3d3d3">
              <div class="col-12 " align="center">
                <h4>Resposta ao consumidor</h4>
              </div>
        </div>
      <div class="row" >
      <table class="table table-bordered">
        <tr>
        <td scope="col"><b>Reposição dos produtos:</b> {{$fsac->reposicao_prod}}</td>
        <td scope="col"><b>Data: </b>{{date('d/m/Y', strtotime($sac->data_fechamento))}}</td>
        </tr>
        <tr>
        <td scope="col"><b>Recolhimento do produtos:</b> {{$fsac->recolhe_prod}}</td>
        <td scope="col"><b>Data: </b>{{date('d/m/Y', strtotime($sac->data_fechamento))}}</td>
        </tr>
      </table>
      </div>
      <div class="row" style="border: 0.5px solid #d3d3d3">
            <div class="col-12 " align="center">
              <h4>Acompanhamento processo junto ao consumidor</h4>
            </div>
      </div>

      <div class="row" >
      <table class="table table-bordered ">
            <tr>
      <td scope="col"><b>Data Andamento:</b>
        @if($sac->data_envio)
        {{date('d/m/Y', strtotime($sac->data_envio))}}
        @endif
      </td>
      <td scope="col"><b>Andamento:</b> <pre style="margin: 0; border-color: transparent;">{{$sac->obs_andamento}}</pre></td>
      </tr>
      <tr>
      <td scope="col"><b>Data Fechamento:</b>
        @if($sac->data_fechamento)
         {{date('d/m/Y', strtotime($sac->data_fechamento))}}
         @endif
         </td>
      <td scope="col"><b>Fechamento:</b> <pre style="margin: 0; border-color: transparent;">{{$sac->obs_fechamento}}</pre></td>
      </tr>

</table>
</div>




<div class="row" >
  <div class="col-3">
    <form>
    <button class="btn btn-info" onClick="window.print()"><i class="fas fa-print"></i>Imprimir</button>
    </form>

    </div>
    <div class="col-3">
      <a class=" btn btn-info" title="Detalhes" href="{{ url("/relatorioimpressao/{$fsac->id}") }}">
      <i class="far fa-fw fa-file-alt fa-2x " style="color: #2B5DE8;"></i>Gerar Pdf</a>

      </div>

    </div>




</div>
</body>
