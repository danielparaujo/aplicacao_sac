<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


<style type="text/css">
.titulo2{ width: 90%; line-height:80px; font-size:15px;  float:left; margin: 25px 0;  text-align:left }


html {
  font-family: sans-serif;
  line-height: normal;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}




.container {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
/*
@media (min-width: 576px) {
  .container {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 720px;
  }
}

@media (min-width: 992px) {
  .container {
    max-width: 960px;
  }
}

@media (min-width: 1200px) {
  .container {
    max-width: 1140px;
  }
}
*/

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 1px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 1px solid #dee2e6;
}


.table-bordered {
  border: 0.5px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

.row-cols-1 > * {
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
}

.row-cols-2 > * {
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
}

.row-cols-3 > * {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}

.row-cols-4 > * {
  -ms-flex: 0 0 25%;
  flex: 0 0 25%;
  max-width: 25%;
}

.row-cols-5 > * {
  -ms-flex: 0 0 20%;
  flex: 0 0 20%;
  max-width: 20%;
}

.row-cols-6 > * {
  -ms-flex: 0 0 16.666667%;
  flex: 0 0 16.666667%;
  max-width: 16.666667%;
}

.col-auto {
  -ms-flex: 0 0 auto;
  flex: 0 0 auto;
  width: auto;
  max-width: 100%;
}

.col-1 {
  -ms-flex: 0 0 8.333333%;
  flex: 0 0 8.333333%;
  max-width: 8.333333%;
}

.col-2 {
  -ms-flex: 0 0 16.666667%;
  flex: 0 0 16.666667%;
  max-width: 16.666667%;
}

.col-3 {
  -ms-flex: 0 0 25%;
  flex: 0 0 25%;
  max-width: 25%;
}

.col-4 {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}

.col-5 {
  -ms-flex: 0 0 41.666667%;
  flex: 0 0 41.666667%;
  max-width: 41.666667%;
}

.col-6 {
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
}

.col-7 {
  -ms-flex: 0 0 58.333333%;
  flex: 0 0 58.333333%;
  max-width: 58.333333%;
}

.col-8 {
  -ms-flex: 0 0 66.666667%;
  flex: 0 0 66.666667%;
  max-width: 66.666667%;
}

.col-9 {
  -ms-flex: 0 0 75%;
  flex: 0 0 75%;
  max-width: 75%;
}

.col-10 {
  -ms-flex: 0 0 83.333333%;
  flex: 0 0 83.333333%;
  max-width: 83.333333%;
}

.col-11 {
  -ms-flex: 0 0 91.666667%;
  flex: 0 0 91.666667%;
  max-width: 91.666667%;
}

.col-12 {
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  max-width: 100%;
}



.container-fluid, .container-sm, .container-md, .container-lg, .container-xl {
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
.col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
.col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
.col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
.col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
.col-xl-auto {
  position: relative;
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
}
.rounded {
  border-radius: 0.25rem !important;
}
.float-left {
  float: left !important;
}
.justify-content-start {
  -ms-flex-pack: start !important;
  justify-content: flex-start !important;
}

.col {
  -ms-flex-preferred-size: 0;
  flex-basis: 0;
  -ms-flex-positive: 1;
  flex-grow: 1;
  min-width: 0;
  max-width: 100%;
}

img {
  vertical-align: middle;
  border-style: none;
}
hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1;
  color: #212529;
  text-align: left;
  background-color: #fff;
}

@media print{@page {size: landscape}}
</style>



  <!-- Fontes-->




  <div class="row ">
    <div class="col" >

        <h2>  <img class="img-fluid "  height="60" src="{{asset('storage/logo.png')}}" >FORMULÁRIO DE RECLAMAÇÃO</h2>
    </div>
  </div>


  <div class="row" style="border: 0.5px solid #d3d3d3">
        <div class="col " >
          <p><b>ID:</b>{{$sac->id}} <b> Data:</b> {{date('d/m/Y')}}</p>
        </div>
  </div>

<body>

          <h4 align="center">Dados do Cliente</h4>


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
      <td scope="col" colspan="1"><b>Motivo do Contato:</b> {{$sac->motivo}}</td>
      <td scope="col" colspan="2"><b>Contato com o consumidor:</b> {{$sac->meio_contato}}</td>

</tr>


</table>
</div>
<h4 align="center">Dados do Produto</h4>
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

        <h4 align="center">Dados do Fornecedor</h4>

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





</body>
