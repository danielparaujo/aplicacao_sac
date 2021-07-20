<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Produto;
use App\Sac;
use App\Categoria;
use App\Fornecedor;
use App\Fsac;
use App\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function index(Log $log) {
         $log->insert(['usuario'=>auth()->user()->name]);
         return view('sac.home');
       }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


   //Cadastrar
     public function cadastrarprodutos(Fornecedor $fornecedor) {
       $fornecedores=$fornecedor->all();
       return view('sac.cadastrarprodutos', compact('fornecedores'));
     }
     public function cadastrarcategoria() {
       return view('sac.cadastrarcategoria');
     }
     public function cadastrarfornecedor() {
       return view('sac.cadastrarfornecedor');
     }
     public function cadastrarsac(Produto $produto, Categoria $categoria,Fornecedor $fornecedor) {
       $produtos=$produto->all();
       $categorias=$categoria->all();
       $fornecedores=$fornecedor->all();
       return view('sac.cadastrarsac',compact('produtos','categorias','fornecedores'));
     }
     public function cadastrarfsac($id,Produto $produto, Categoria $categoria,
        Fornecedor $fornecedor,Sac $sac) {
       $sacs=$sac->all();
       $produtos=$produto->all();
       $categorias=$categoria->all();
       $fornecedores=$fornecedor->all();
       return view('sac.cadastrarfsac',compact('produtos','categorias','fornecedores','id'),compact('sacs'));
     }
   //Adicionar ao BD
     public function storecategoria(Request $request, Categoria $categoria) {
       $categoria->insert(['nome'=>$request->categoria]);
       return redirect('home')->with('mensagem','Categoria cadastrada com sucesso!');
     }
     public function storefornecedor(Request $request, Fornecedor $fornecedor) {
       $fornecedor->insert(['nome'=>$request->nome,'cnpj'=>$request->cnpj,'email'=>$request->email,'telefone'=>$request->telefone,'telefone_complemento'=>$request->telefone_complemento]);
       return redirect('home')->with('mensagem','Fornecedor cadastrado com sucesso!');
     }
     public function storeprodutos(Request $request, Produto $produtos) {
       $produtos->insert(['nome'=>$request->produto,'marca'=>$request->marca,
       'fornecedor_id'=>$request->fornecedor_id]);
       return redirect('home')->with('mensagem','Produto cadastrado com sucesso!');
     }
     public function storesac(Request $request, Sac $sac,Produto $prod, Fornecedor $forn) {
           $fornecedores=$forn->all();
           $produtos=$prod->all();
           $fornecedor_id = 0;
           $id=0;
           foreach ($produtos as $p) {
           if($p->id == $request->produto){
           $fornecedor_id=$p->fornecedor_id;
         }
       }
       if($request->motivo =="elogio"){
       $sac->insert(['consumidor'=>$request->consumidor,
       'email_cons'=>$request->email_cons,'telefone_cons'=>$request->telefone_cons,
       'endereco_cons'=>$request->endereco_cons,'cidade_cons'=>$request->cidade_cons,
       'estado_cons'=>$request->estado_cons,'produto_id'=>$request->produto,'categoria_id'=>$request->categoria,
       'validade_prod'=>$request->validade,'lote_prod'=>$request->lote,'cliente_anch'=>$request->cliente_anch,
       'reclamacao'=>$request->reclamacao, 'inserido_por'=>auth()->user()->name,'motivo'=>$request->motivo,'meio_contato'=>$request->meio_contato,
       'status'=>"fechado",'data_insercao'=>date('Y/m/d'),'data_envio'=>date('Y/m/d'),'data_fechamento'=>date('Y/m/d'),'fornecedor_id'=>$fornecedor_id]);
       $id=DB::getPdo()->lastInsertId();
       }
       else{
         $sac->insert(['consumidor'=>$request->consumidor,
         'email_cons'=>$request->email_cons,'telefone_cons'=>$request->telefone_cons,
         'endereco_cons'=>$request->endereco_cons,'cidade_cons'=>$request->cidade_cons,
         'estado_cons'=>$request->estado_cons,'produto_id'=>$request->produto,'categoria_id'=>$request->categoria,
         'validade_prod'=>$request->validade,'lote_prod'=>$request->lote,'cliente_anch'=>$request->cliente_anch,
         'reclamacao'=>$request->reclamacao, 'motivo'=>$request->motivo,
         'inserido_por'=>auth()->user()->name,'meio_contato'=>$request->meio_contato,'status'=>"novo",'data_insercao'=>date('Y/m/d'),'fornecedor_id'=>$fornecedor_id]);
         $id=DB::getPdo()->lastInsertId();
       }



           return redirect('home')->with('mensagem','Sac de ID '.$id.' cadastrado com sucesso!');
     }

     public function storesacfsac(Request $request, Sac $sac,Produto $prod, Fornecedor $forn,Fsac $fsac) {
       //dd($request->sac_id);
       $fsac->insert(['sac_id'=>$request->sac_id,'fornecedor_id'=>$request->fornecedor_id,'fabricacao'=>$request->fabricacao,
       'enc_analise'=>$request->enc_analise,'enc_fabricante'=>$request->enc_fabricante,'laboratorio'=>$request->laboratorio,
       'reposicao_prod'=>$request->reposicao_prod, 'inserido_por'=>auth()->user()->name, 'recolhe_prod'=>$request->recolhe_prod, 'data_insercao'=>date('Y/m/d')]);

       $sacs=$sac->where('id',$request->sac_id)->update(['status_finalizacao'=>"finalizado"]);



       return redirect('exibirfsac')->with('mensagem','Finalização de Sac cadastrada com sucesso!');
     }

   //Exibir
     public function exibircategoria(Categoria $categoria, Request $request){
       $categorias=$categoria->orderBy('nome','ASC')->paginate(10);
       return view('sac.exibircategoria',compact('categorias'));
     }
     public function exibirfornecedor(Fornecedor $fornecedor, Request $request){
       $fornecedores=$fornecedor->orderBy('nome','ASC')->paginate(10);
       return view('sac.exibirfornecedor',compact('fornecedores'));
     }
     public function exibirprodutos(Fornecedor $fornecedor,Produto  $produto, Request $request){
       $fornecedores=$fornecedor->all();
       $pesquisa=$request->pesquisa;
       if($request->all() ==null){
         $produtos=$produto->orderBy('nome','ASC')->paginate(10);
       }
       else {
         $produtos=$produto->where('nome', 'LIKE', '%'.$request->pesquisa.'%')->orderBy('nome','ASC')->paginate(10);
       }
       return view('sac.exibirprodutos',compact('produtos','pesquisa','fornecedores'));
     }
     public function exibirsac(Sac  $sac,Produto  $produto, Request $request,Fornecedor $fornecedor, Categoria $categoria){
       $produtos=$produto->all();
       $pesquisa=$request->pesquisa;
       $fornecedores=$fornecedor->all();
       $categorias=$categoria->all();
       if($request->all() ==null){
         $sacs=$sac->paginate(10);
         $todos_sacs=$sac->all();
       }
       elseif($request->imprimir){
         $sacs=$sac->whereIn('id', $request->imprimir)->orderBy('created_at','DESC')->get();
         return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs','fornecedores'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
       }
       else {
         $todos_sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
         ->where('status', 'LIKE', $request->status)
         ->where('produto_id', 'LIKE', $request->produto)
         ->where('fornecedor_id', 'LIKE', $request->fornecedor)
         ->where('categoria_id', 'LIKE', $request->categoria)
         ->orderBy('created_at','DESC')->get();
         $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
         ->where('status', 'LIKE', $request->status)
         ->where('produto_id', 'LIKE', $request->produto)
         ->where('fornecedor_id', 'LIKE', $request->fornecedor)
         ->where('categoria_id', 'LIKE', $request->categoria)
         ->orderBy('created_at','DESC')->paginate(10);
       }


       return view('sac.exibirsac',compact('pesquisa','sacs','categorias','fornecedores'),compact('produtos','request','todos_sacs'));
     }
     public function sacs(Sac  $sac,Produto  $produto, Request $request,Fornecedor $fornecedor, Categoria $categoria){
       $produtos=$produto->orderBy('nome','ASC')->get();
     //  dd($produtos);
       $pesquisa=$request->pesquisa;
       $fornecedores=$fornecedor->all();
       $categorias=$categoria->all();
       if($request->all() ==null){
         $sacs=$sac->orderBy('created_at','DESC')->paginate(10);
         }
       else {
         $pesquisa=$request->pesquisa;
         $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
         ->where('status', 'LIKE', $request->status)
         ->where('produto_id', 'LIKE', $request->produto)
         ->where('fornecedor_id', 'LIKE', $request->fornecedor)
         ->where('categoria_id', 'LIKE', $request->categoria)
         ->Where(function($query) use($pesquisa) {
                   $query->where('consumidor', 'LIKE', '%'.$pesquisa.'%')
                         ->orWhere('cidade_cons', 'LIKE', '%'.$pesquisa.'%' );
               })
         ->orderBy('created_at','DESC')->paginate(10);
       }
       return view('sac.sacs',compact('pesquisa','sacs','categorias','fornecedores'),compact('produtos','request'));
     }
     /*
     public function sacs(Sac  $sac,Produto  $produto, Request $request, Categoria $categoria){
       $pesquisa1=$request->pesquisa1;
       $prod=$request->prod;
       $status=$request->status;
       $pesquisa=$request->pesquisa;
       $categorias=$categoria->all();
       $produtos=$produto->all();
       $produtos_usados=DB::select('select DISTINCT p.nome, p.id from produtos as p, sacs as s where s.produto_id = p.id', [1]);
       $state='todos';
       if($status=="Novo"){
         $state='novo';
       }
       if($status=="Fechado"){
         $state='fechado';
       }
       if($status=="Em andamento"){
         $state='andamento';
       }
       if($request->pesquisa ==null){
         if($state == 'todos' ){
           $sacs=$sac->orderBy('data_insercao','DESC')->paginate(10);
         }
         else{
           $sacs=$sac->where('status', 'LIKE', $state)->orderBy('data_insercao','DESC')->paginate(10);
         }
       }
       if($request->pesquisa != null){
         if($state == 'todos' ){
           $sacs=$sac->where($request->pesquisa1, 'LIKE', '%'.$request->pesquisa.'%')->orderBy('data_insercao','DESC')->paginate(10);
         }
         else{
           $sacs=$sac->where('status', 'LIKE', $state)->where($request->pesquisa1, 'LIKE', '%'.$request->pesquisa.'%')->orderBy('data_insercao','DESC')->paginate(10);
         }
       }
       if($request->prod != null){
         if($state == 'todos' ){
           $sacs=$sac->where('produto_id', 'LIKE', $request->prod)->orderBy('data_insercao','DESC')->paginate(10);
         }
         else{
           $sacs=$sac->where('status', 'LIKE', $state)->where('produto_id', 'LIKE', $request->prod)->orderBy('data_insercao','DESC')->paginate(10);
         }
       }
       if($request->prod == 'todos'and $request->pesquisa == null){

         if($state == 'todos' ){

           $sacs=$sac->orderBy('data_insercao','DESC')->paginate(10);
         }
         else{
           $sacs=$sac->where('status', 'LIKE', $state)->orderBy('data_insercao','DESC')->paginate(10);
         }
       }
       return view('sac.sacs',compact('pesquisa','sacs','status','pesquisa1'),compact('produtos','produtos_usados','prod','categorias'));
     }

     */
     public function exibirsacfsac(Sac  $sac,Produto  $produto, Request $request,Fornecedor $fornecedor, Categoria $categoria){
       $produtos=$produto->all();
       $fornecedores=$fornecedor->all();
       $categorias=$categoria->all();
       $pesquisa=$request->pesquisa;
       if($request->all() ==null){
         $sacs=$sac->all();
       }
     else {
         $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
         ->where('status', 'LIKE', $request->status)
         ->where('produto_id', 'LIKE', $request->produto)
         ->where('fornecedor_id', 'LIKE', $request->fornecedor)
         ->where('categoria_id', 'LIKE', $request->categoria)
         ->orderBy('created_at','DESC')->get();
       }
       return view('sac.exibirsacfsac',compact('pesquisa','sacs','categorias','fornecedores'),compact('produtos','request'));
     }

     public function exibirfsac(Sac  $sac,Fornecedor $fornecedor, Fsac $fsac,Produto  $produto, Request $request, Categoria $categoria){
       $pesquisa=$request->pesquisa;
       $categorias=$categoria->all();
       $produtos=$produto->all();
       $fornecedores=$fornecedor->all();
       $sacs=$sac->all();
       //  $fsacs=$fsac->all();
       if($request->all() ==null){
         $fsacs=$fsac->all();
       }


       else{
       $fsacs=$fsac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
       ->where('sac_id', 'LIKE', "%".$request->pesquisa."%")->get();
     }

       return view('sac.exibirfsac',compact('pesquisa','sacs','fsacs'),compact('produtos','categorias','request'));
     }



   //Relatório para impressão
     public function relatorio(Categoria $categoria, Produto  $produto, Sac $sac){
       $produtos=$produto->all();
       $categorias=$categoria->all();
       $sacs=$sac->all();
       return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
       //  return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs'))->download('relatorio.pdf');
       //  return view('sac.relatorio',compact('produtos','categorias','sacs'));
     }
   //Impressão dos relatórios
     public function gerarrelatorio(Categoria $categoria, Produto  $produto, Sac $sac,Fornecedor $fornecedor, Request $request){
       $produtos=$produto->all();
       $fornecedores=$fornecedor->all();
       $categorias=$categoria->all();
       $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
       ->where('status', 'LIKE', $request->status)
       ->where('produto_id', 'LIKE', $request->produto)
       ->where('fornecedor_id', 'LIKE', $request->fornecedor)
       ->where('categoria_id', 'LIKE', $request->categoria)
       ->orderBy('data_insercao','ASC')->get();
       return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs','fornecedores'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
     }
     //Mostrar na tela o relatório
     public function relatoriodetalhado($id,Categoria $categorias,Fornecedor $fornecedores,
     Produto  $produtos, Sac $sacs,Request $r){
       $sac=$sacs->find((int)$id);
       $produto=$produtos->find((int)$sac->produto_id);
       $categoria=$categorias->find((int)$sac->categoria_id);
       $fornecedor=$fornecedores->find((int)$sac->fornecedor_id);
   //   return PDF::loadview('sac.relatoriodetalhado', compact('produto','categoria','sac','fornecedor'))->setPaper('a4')->download('relatorio.pdf');

       return view('sac.relatoriodetalhado',compact('produto','categoria','sac','fornecedor'));
     }
     public function relatorioimpressao($id,Categoria $categorias,Fornecedor $fornecedores,Fsac $fsacs,
     Produto  $produtos, Sac $sacs,Request $r){
       $fsac=$fsacs->find((int)$id);
       $sac=$sacs->find((int)$fsac->sac_id);
       $produto=$produtos->find((int)$sac->produto_id);
       $categoria=$categorias->find((int)$sac->categoria_id);
       $fornecedor=$fornecedores->find((int)$sac->fornecedor_id);
       $fornecedors=$fornecedores->all();
   //   return view('sac.relatorioimpressao',compact('produto','categoria','sac','fornecedor'),compact('fsac','fornecedors'));

     return PDF::loadview('sac.relatorioimpressao', compact('produto','categoria','sac','fornecedor'),compact('fsac','fornecedors'))->setPaper('a4','landscape')->download('relatorio_sac'.$sac->id.$sac->consumidor.'.pdf');

     }


     public function relatoriofsac($id,Categoria $categorias,Fornecedor $fornecedores,Fsac $fsacs,
     Produto  $produtos, Sac $sacs,Request $r){
       $fsac=$fsacs->find((int)$id);
       $sac=$sacs->find((int)$fsac->sac_id);
       $produto=$produtos->find((int)$sac->produto_id);
       $categoria=$categorias->find((int)$sac->categoria_id);
       $fornecedor=$fornecedores->find((int)$sac->fornecedor_id);
       $fornecedors=$fornecedores->all();
       return view('sac.relatoriofsac',compact('produto','categoria','sac','fornecedor'),compact('fsac','fornecedors'));
     }
   //Viwes de update
     public function updateproduto(Fornecedor $fornecedor,$id, Produto  $produtos){
       $fornecedores=$fornecedor->all();
       $produto=$produtos->find((int)$id);
       return view('sac.updateproduto',compact('produto','fornecedores'));
     }
     public function updatecategoria($id, Categoria  $categorias){
       $categoria=$categorias->find((int)$id);
       return view('sac.updatecategoria',compact('categoria'));
     }
     public function updatefornecedor($id, Fornecedor $fornecedores){
       $fornecedor=$fornecedores->find((int)$id);
       return view('sac.updatefornecedor',compact('fornecedor'));
     }
     public function updatesac($id, Produto  $prod, Sac $sacs ,Categoria $cat, Fornecedor $forn){
       $sac=$sacs->find((int)$id);
       $produto=$prod->find((int)$sac->produto_id);
       $categoria=$cat->find((int)$sac->categoria_id);
       $produtos=$prod->all();
       $categorias=$cat->all();
       $fornecedores=$forn->all();
       $fornecedor=$forn->find((int)$sac->fornecedor_id);

       return view('sac.updatesac',compact('produto', 'sac','produtos','fornecedor'),compact('categoria','categorias','fornecedores'));
     }
     //Salva as alterações do update no Banco de dados
     public function upproduto(Request $request, Produto  $produtos){
       $produto=$produtos->where('id',$request->id)->update(['nome'=> $request->produto,
       'marca'=> $request->marca, 'fornecedor_id'=> $request->fornecedor_id]);
       $mensagem=1;
       return redirect('exibirprodutos')->with('mensagem','Produto Alterado com sucesso!');
     }
     public function upcategoria(Request $request, Categoria $categorias){
       $categoria=$categorias->where('id',$request->id)->update(['nome'=> $request->categoria]);
       return redirect('exibircategoria')->with('mensagem', 'Categoria alterada com sucesso');
     }
     public function upfornecedor(Request $request, Fornecedor $fornecedores){
       $fornecedor=$fornecedores->where('id',$request->id)
       ->update(['nome'=> $request->nome,'cnpj'=>$request->cnpj,'email'=>$request->email,
       'telefone'=>$request->telefone,'telefone_complemento'=>$request->telefone_complemento]);
       return redirect('exibirfornecedor')->with('mensagem', 'Fornecedor alterado com sucesso');
     }
     public function upsac(Request $request, Sac $sacs){
       $sac=$sacs->where('id',$request->id)->update(['consumidor'=>$request->consumidor,
       'email_cons'=>$request->email_cons,'telefone_cons'=>$request->telefone_cons,
       'endereco_cons'=>$request->endereco_cons,'cidade_cons'=>$request->cidade_cons,
       'estado_cons'=>$request->estado_cons,'produto_id'=>$request->produto,'fornecedor_id'=>$request->fornecedor,'categoria_id'=>$request->categoria,
       'validade_prod'=>$request->validade,'lote_prod'=>$request->lote,'cliente_anch'=>$request->cliente_anch,
       'reclamacao'=>$request->reclamacao,'motivo'=>$request->motivo,'meio_contato'=>$request->meio_contato,
     'alterado_por'=>auth()->user()->name]);


       return redirect('sacs')->with('mensagem', 'Sac alterado com sucesso');
     }

     public function graficos(Sac  $sac,Fornecedor $fornecedor, Fsac $fsac,Produto  $produto, Request $request, Categoria $categoria){
       //$categorias=$categoria->all();
     //  $produtos=$produto->all();
     //  $fornecedores=$fornecedor->all();
       $sacs=$sac->all();
       //  $fsacs=$fsac->all();
       $motivos=$sac->where('motivo', 'LIKE',$request->motivo)
       ->where('produto_id','LIKE', $request->produto)
       ->where('categoria_id', 'LIKE', $request->categoria)->get('id');
       $fornecedores=DB::select('select DISTINCT f.nome, f.id from fornecedors as f, fsacs as s where s.fornecedor_id = f.id ', [1]);
       $categorias=DB::select('select DISTINCT c.nome, c.id from categorias as c, sacs as s, fsacs as f where s.categoria_id = c.id and f.sac_id = s.id', [1]);
       $produtos=DB::select('select DISTINCT p.nome, p.id from produtos as p, sacs as s, fsacs as f where s.produto_id = p.id and f.sac_id = s.id', [1]);

       if($request->all() ==null){
         $fsacs=$fsac->all();
       }
       else{
       $fsacs=$fsac->whereDate('data_insercao', '<=', $request->data_fim)
       ->whereDate('data_insercao', '>=', $request->data_inicio)
       ->whereIn('sac_id',$motivos)
       ->where('fornecedor_id', 'LIKE', $request->fornecedor)
       ->get();
     }

       return view('sac.graficos',compact('fornecedores','sacs','fsacs'),compact('produtos','categorias','request'));
     }


   public function graficofiltro(Sac  $sac,Produto  $produto, Request $request,Fornecedor $fornecedor, Categoria $categoria){
     $produtos=$produto->all();
     $fornecedores=$fornecedor->all();
     $categorias=$categoria->all();
     if($request->all() ==null){
       $sacs=$sac->all();
     }
     else {
       $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
       ->where('status', 'LIKE', $request->status)
       ->where('motivo', 'LIKE', $request->tipo)
       ->where('produto_id', 'LIKE', $request->produto)
       ->where('fornecedor_id', 'LIKE', $request->fornecedor)
       ->where('categoria_id', 'LIKE', $request->categoria)
       ->orderBy('created_at','DESC')->get();
     }
     return view('sac.graficofiltro',compact('sacs','categorias','fornecedores'),compact('produtos','request'));
   }
   public function graficoproduto(Sac  $sac,Produto  $produto, Request $request,Fornecedor $fornecedor, Categoria $categoria){
     $produtos=$produto->all();
     $fornecedores=$fornecedor->all();
     $categorias=$categoria->all();
     if($request->all() ==null){
       $sacs=$sac->all();
     }
     else {
       $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)
       ->where('status', 'LIKE', $request->status)
       ->where('motivo', 'LIKE', $request->tipo)
       ->where('produto_id', 'LIKE', $request->produto)
       ->where('fornecedor_id', 'LIKE', $request->fornecedor)
       ->where('categoria_id', 'LIKE', $request->categoria)
       ->orderBy('created_at','DESC')->get();
     }
     return view('sac.graficoproduto',compact('sacs','categorias','fornecedores'),compact('produtos','request'));
   }




   //exibição do sac detalhadamente com função de processar e fechar o sac
     public function detalhessac($id, Produto  $produtos,Sac $sacs,Categoria $categorias,Fornecedor $fornecedores){
       $sac=$sacs->find((int)$id);
       $produto=$produtos->find((int)$sac->produto_id);
       $categoria=$categorias->find((int)$sac->categoria_id);
       $fornecedor=$fornecedores->find((int)$sac->fornecedor_id);
       return view('sac.detalhessac',compact('produto','sac','fornecedor'),compact('categoria'));
     }
     //colocar o sac em andamento
     public function andamento(Request $request, Sac $sacs){
       $sac=$sacs->where('id',$request->id)->update(['status'=>"andamento",'alterado_por'=>auth()->user()->name,'data_envio'=>date('Y/m/d'),'obs_andamento'=>$request->justificativa]);
       return redirect('sacs')->with('mensagem', 'Sac '.$request->id.' Processado!');
     }
     //fechar o sac
     public function fechado(Request $request, Sac $sacs){
       $sac=$sacs->where('id',$request->id)->update(['status'=>"fechado",'alterado_por'=>auth()->user()->name,'data_fechamento'=>date('Y/m/d'),'obs_fechamento'=>$request->justificativa]);
       return redirect('sacs')->with('mensagem', 'Sac '.$request->id.' Fechado!');
     }
     //ativar o produto exibição
     public function ativarproduto($id,Produto  $produtos){
       $produto=$produtos->where('id',$id)->update(['situacao'=> "ativo"]);
       return redirect('exibirprodutos')->with('mensagem', 'Produto Ativado');
     }
     //desativar produto exibição
     public function inativarproduto($id,Produto  $produtos){
       $produto=$produtos->where('id',$id)->update(['situacao'=> "inativo"]);
       return redirect('exibirprodutos')->with('atencao', 'Produto Inativado');
     }
     //ativar o produto exibição
     public function ativarfornecedor($id,Fornecedor  $fornecedores){
       $fornecedor=$produtos->where('id',$id)->update(['situacao'=> "ativo"]);
       return redirect('exibirprodutos')->with('mensagem', 'Produto Ativado');
     }
     //desativar produto exibição
     public function inativarfornecedor($id,Fornecedor  $fornecedores){
       $produto=$produtos->where('id',$id)->update(['situacao'=> "inativo"]);
       return redirect('exibirprodutos')->with('atencao', 'Produto Inativado');
     }
     //deletar
     public function deleteproduto($id,Produto  $produtos, Sac $sac){
       $sacs= $sac->all();
       foreach($sacs as $s){
         if($s->produto_id == $id){
           return redirect('exibirprodutos')->with('erro','Produto sendo utilizado por Sac: '.$s->produto_id);
         }
       }
       $produto=$produtos->find($id);
       $produto->delete();
       return redirect('exibirprodutos')->with('mensagem', 'Excluido com sucesso');
     }
     public function deletecategoria($id,Categoria  $categorias, Sac $sac){
       $sacs= $sac->all();
       foreach ($sacs as $s) {
         if($s->categoria_id == $id){
           return redirect('exibircategoria')->with('erro','Não foi possível excluir!!Categoria utilizado pelo Sac: '.$s->categoria_id);
         }
       }
       $categoria=$categorias->find($id);
       $categoria->delete();
       return redirect('exibircategoria')->with('mensagem', 'Categoria excluida com sucesso');
     }

     public function deletefornecedor($id,Fornecedor  $fornecedores, Produto $produto){
       $produtos= $produto->all();
       foreach ($produtos as $p) {
         if($p->fornecedor_id == $id){
           return redirect('exibirfornecedor')->with('erro','Não foi possível excluir!!Fornecedor sendo utilizado por Produto');
         }
       }
       $fornecedor=$fornecedores->find($id);
       $fornecedor->delete();
       return redirect('exibirfornecedor')->with('mensagem', 'Categoria excluida com sucesso');
     }
   //Filtros para sac
     public function filtro(Produto $produto, Categoria $categoria,Sac $sac) {
       $categorias=$categoria->all();
       $sacs=$sac->all();
       $produtos=DB::select('select DISTINCT p.nome, p.id from produtos as p, sacs as s where s.produto_id = p.id', [1]);
       $fornecedores=DB::select('select DISTINCT f.nome, f.id from fornecedors as f, sacs as s where s.fornecedor_id = f.id', [1]);
       $categorias=DB::select('select DISTINCT c.nome, c.id from categorias as c, sacs as s where s.categoria_id = c.id', [1]);
       return view('sac.filtro', compact('categorias','sacs','produtos'),compact('fornecedores','categorias'));
     }


     //Filtros não usados
     public function filtroproduto(Produto $produto, Categoria $categoria,Sac $sac) {
       $categorias=$categoria->all();
       $sacs=$sac->all();
       $produtos=DB::select('select DISTINCT p.nome, p.id from produtos as p, sacs as s where s.produto_id = p.id', [1]);

       return view('sac.filtroproduto', compact('categorias','sacs','produtos'));
     }
     public function filtrofornecedor(Produto $produto, Fornecedor $fornecedor,Sac $sac) {
       $sacs=$sac->all();
       $produtos=$produto->all();
       $fornecedores=DB::select('select DISTINCT f.nome, f.id from fornecedors as f, sacs as s where s.fornecedor_id = f.id', [1]);
       return view('sac.filtrofornecedor', compact('fornecedores','sacs','produtos'));
     }
     public function filtrocategoria(Produto $produto, Categoria $categoria,Sac $sac) {
       $sacs=$sac->all();
       $produtos=$produto->all();
       $categorias=DB::select('select DISTINCT c.nome, c.id from categorias as c, sacs as s where s.categoria_id = c.id', [1]);
       return view('sac.filtrocategoria', compact('categorias','sacs','produtos'));
     }

   //Geração de relatórios não usados
       public function gerarrelatorioproduto(Categoria $categoria, Produto  $produto,
       Sac $sac,Request $request,Fornecedor $fornecedor){
         $produtos=$produto->all();
           if($request->produto=='todos'){
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         else{
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('produto_id', 'LIKE', $request->produto)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         $fornecedores=$fornecedor->all();
         $categorias=$categoria->all();
         return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs','fornecedores'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
       }

       public function gerarrelatoriofornecedor(Fornecedor $fornecedor, Produto  $produto,
       Sac $sac,Request $request){
         $produtos=$produto->all();
         if($request->produto=='todos'){
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         else{
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('fornecedor_id', 'LIKE', $request->fornecedor)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         $fornecedores=$fornecedor->all();
         return PDF::loadview('sac.relatorio', compact('produtos','fornecedores','sacs'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
       }

       public function gerarrelatoriocategoria(Categoria $categoria, Produto  $produto,
       Sac $sac,Request $request){
         $produtos=$produto->all();
         if($request->produto=='todos'){
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         else{
           $sacs=$sac->whereDate('data_insercao', '<=', $request->data_fim)->whereDate('data_insercao', '>=', $request->data_inicio)->where('categoria_id', 'LIKE', $request->categoria)->where('status', 'LIKE', $request->status)->orderBy('data_insercao','ASC')->get();
         }
         $categorias=$categoria->all();
         return PDF::loadview('sac.relatorio', compact('produtos','categorias','sacs'))->setPaper('a4', 'landscape')->download('relatorio.pdf');
       }



}
