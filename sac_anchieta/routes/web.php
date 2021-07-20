<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//rotas dos produtos
Route::get('/cadastrarprodutos', 'HomeController@cadastrarprodutos')->name('cadastrarprodutos');
Route::post('storeprodutos', 'HomeController@storeprodutos')->name('storeprodutos');
Route::get('/exibirprodutos', 'HomeController@exibirprodutos');
Route::get('/updateproduto/{id}', 'HomeController@updateproduto')->middleware('auth');
Route::get('/deleteproduto/{id}', 'HomeController@deleteproduto')->middleware('auth');
Route::post('updateproduto/upproduto', 'HomeController@upproduto')->name('upproduto')->middleware('auth');
Route::get('/ativarproduto/{id}', 'HomeController@ativarproduto')->middleware('auth');
Route::get('/inativarproduto/{id}', 'HomeController@inativarproduto')->middleware('auth');


//rotas das categorias
Route::get('/cadastrarcategoria', 'HomeController@cadastrarcategoria')->name('cadastrarcategoria');
Route::post('storecategoria', 'HomeController@storecategoria')->name('storecategoria');
Route::get('/exibircategoria', 'HomeController@exibircategoria');
Route::get('/updatecategoria/{id}', 'HomeController@updatecategoria')->middleware('auth');
Route::get('/deletecategoria/{id}', 'HomeController@deletecategoria')->middleware('auth');
Route::post('updatecategoria/upcategoria', 'HomeController@upcategoria')->name('upcategoria')->middleware('auth');

//rotas dos fornecedores
Route::get('/cadastrarfornecedor', 'HomeController@cadastrarfornecedor')->name('cadastrarfornecedor');
Route::post('storefornecedor', 'HomeController@storefornecedor')->name('storefornecedor');
Route::get('/exibirfornecedor', 'HomeController@exibirfornecedor');
Route::get('/updatefornecedor/{id}', 'HomeController@updatefornecedor')->middleware('auth');
Route::get('/deletefornecedor/{id}', 'HomeController@deletefornecedor')->middleware('auth');
Route::post('updatefornecedor/upfornecedor', 'HomeController@upfornecedor')->name('upfornecedor')->middleware('auth');

//rotas dos sacs
Route::get('/cadastrarsac', 'HomeController@cadastrarsac')->name('cadastrarsac');
Route::post('storesac', 'HomeController@storesac')->name('storesac');
Route::get('/exibirsac', 'HomeController@exibirsac');
Route::post('/exibirsac', 'HomeController@exibirsac');
Route::get('/sacs', 'HomeController@sacs')->name('sacs');
Route::post('/sacs', 'HomeController@sacs')->name('sacs');
Route::get('/detalhessac/{id}', 'HomeController@detalhessac')->middleware('auth');
Route::get('/updatesac/{id}', 'HomeController@updatesac')->middleware('auth');
Route::post('updatesac/upsac', 'HomeController@upsac')->name('upsac')->middleware('auth');
Route::get('/cadastrarfsac', 'HomeController@cadastrarfsac')->name('cadastrarfsac');
//rotas Fsac
Route::any('/exibirsacfsac', 'HomeController@exibirsacfsac');
Route::get('/cadastrarfsac/{id}', 'HomeController@cadastrarfsac')->name('cadastrarfsac');
Route::post('/cadastrarfsac/storesacfsac', 'HomeController@storesacfsac')->name('storesacfsac');
Route::any('/exibirfsac', 'HomeController@exibirfsac');


//rotas das funções nos sacs( PRocessar e fechar o SAC)
Route::get('/andamento/{id}', 'HomeController@andamento')->middleware('auth');
Route::get('/fechado/{id}', 'HomeController@fechado')->middleware('auth');

//rota para chamar o relatorio de impressão
Route::get('/relatorio', 'HomeController@relatorio')->middleware('auth');
//rota para chamar o relatorio ddetalhado
Route::get('/relatoriodetalhado/{id}', 'HomeController@relatoriodetalhado')->middleware('auth');
Route::get('/relatorioimpressao/{id}', 'HomeController@relatorioimpressao')->middleware('auth');
Route::get('/relatoriofsac/{id}', 'HomeController@relatoriofsac')->middleware('auth');
//função para chamar os graficos
Route::any('/graficos','HomeController@graficos')->middleware('auth');
Route::any('/graficofiltro','HomeController@graficofiltro')->middleware('auth');


Route::any('/graficoproduto','HomeController@graficoproduto')->middleware('auth');




//rotas para chamar a função que realiza a filtragem para relatório e gerar o relatório
Route::get('/filtro', 'HomeController@filtro')->middleware('auth');
Route::post('/gerarrelatorio', 'HomeController@gerarrelatorio')->name('gerarrelatorio');

//rotas não utilizadas
Route::get('/filtroproduto', 'HomeController@filtroproduto')->middleware('auth');
Route::post('/gerarrelatorioproduto', 'HomeController@gerarrelatorioproduto')->name('gerarrelatorioproduto');
Route::get('/filtrofornecedor', 'HomeController@filtrofornecedor')->middleware('auth');
Route::post('/gerarrelatoriofornecedor', 'HomeController@gerarrelatoriofornecedor')->name('gerarrelatoriofornecedor');
Route::get('/filtrocategoria', 'HomeController@filtrocategoria')->middleware('auth');
Route::post('/gerarrelatoriocategoria', 'HomeController@gerarrelatoriocategoria')->name('gerarrelatoriocategoria');
