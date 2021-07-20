<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Relatório</title>

        <style>
        body {
  font: 75%/1.6 "Myriad Pro", Frutiger, "Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", Verdana, sans-serif;
}
table {
  border-collapse: collapse;
  width: 70em;
  border: 1px solid #666;
}
thead {
  background: #ccc ;
  border-top: 1px solid #a5a5a5;
  border-bottom: 1px solid #a5a5a5;
}
tr:hover {
  background-color:#3d80df;
  color: #fff;
}
thead tr:hover {
  background-color: transparent;
  color: inherit;
}
tr:nth-child(even) {
    background-color: #edf5ff;
}
th {
  font-weight: normal;
  text-align: left;
}
th, td {
  padding: 0.1em 1em;
}



        </style>

    </head>


      <h1><img class="img-fluid " src="storage/logo.png" height="40">Relatório de Sacs</h1>



<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Status</th>
      <th scope="col">Consumidor</th>
      <th scope="col">Produto</th>
      <th scope="col">Fornecedor</th>

      <th scope="col">Categoria do Sac</th>
      <th scope="col">Cidade</th>
      <th scope="col">Data Inserção</th>
      <th scope="col">Lote</th>

      </tr>
  </thead>
  <tbody>
    @foreach($sacs as $sac)
    <tr>
      <!--
        <th scope="row">{{$sac->status}}</th>
      -->
<td>{{$sac->id}}</td>
    <th><img class="img-fluid " src="storage/{{$sac->status}}.png" alt="{{$sac->status}}">{{$sac->status}}</th>

      <td>{{$sac->consumidor}}</td>
      @foreach($produtos as $produto)
      @if($sac->produto_id ==$produto->id)
      <td>{{$produto->nome}}</td>
      @endif
      @endforeach
      @foreach($fornecedores as $fornecedor)
      @if($sac->fornecedor_id ==$fornecedor->id)
        <td>{{$fornecedor->nome}}</td>
      @endif

      @endforeach
      @foreach($categorias as $cat)
      @if($sac->categoria_id ==$cat->id)
      <td>{{$cat->nome}}</td>
      @endif
      @endforeach
      <td>{{$sac->cidade_cons}}</td>
      <td>{{date("d/m/Y", strtotime($sac->data_insercao))}}</td>
        <td>{{$sac->lote_prod}}</td>




    </tr>
    @endforeach
  </tbody>
</table>

</body>
