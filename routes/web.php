<?php

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

use App\Http\Controllers\ControladorCategoria;
use App\Http\Controllers\LicitacaoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/','LicitacaoController@dashboard');
Route::get('/novalicitacao','LicitacaoController@create');
Route::post('/novalicitacao/store','LicitacaoController@store');
Route::get('/busca','LicitacaoController@busca');
Route::get('/licitacao/{id}','LicitacaoController@consulta');
Route::get('/download/{id}','LicitacaoController@baixarArquivo');
Route::get('/graficoanual','GraficoController@index');
Route::post('/graficoanual','GraficoController@getLicitacoes');
Route::get('/graficoanualapi','GraficoController@getJson');

Route::get('/licitacao/editar/{id}','LicitacaoController@edit');
Route::post('/licitacao/update/{id}','LicitacaoController@update');
Route::get('/cadastro/categoria','LicitacaoController@cadCategoria');
Route::post('/cadastro/categoria/store','LicitacaoController@storeCategoria');
Route::post('/licitacao/delete/{id}','LicitacaoController@delete');


// projeto tcc

Route::get('/register',function(){
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function(){


    //user
// Route::resource('/admin/usuario','Admin\UsuarioController');
Route::get('/admin/usuario/listar-usuarios','Admin\UsuarioController@index')->name('usuario.index');
Route::get('/admin/usuario/create','Admin\UsuarioController@create')->name('usuario.create');
Route::get('admin/usuario/block',['as' => 'usuario.block','uses' => 'Admin\UsuarioController@userBlock']);
Route::get('admin/usuario/meus-trabalhos','Admin\UsuarioController@myjobs')->name('usuario.myjobs');
Route::post('admin/usuario/store','Admin\UsuarioController@store')->name('usuario.store');
Route::post('admin/usuario/blocked','Admin\UsuarioController@block')->name('usuario.blocked');
Route::post('admin/usuario/desblock','Admin\UsuarioController@desblock')->name('usuario.desblock');
Route::get('admin/usuario/blacklist','Admin\UsuarioController@blacklist')->name('usuario.blacklist');
Route::post('admin/usuario/edit','Admin\UsuarioController@edit')->name('usuario.edit');
Route::post('admin/usuario/update','Admin\UsuarioController@update')->name('usuario.update');
Route::get('admin/usuario/search','Admin\UsuarioController@searchFilter')->name('usuario.search');
Route::post('admin/usuario/remove','Admin\UsuarioController@destroy')->name('usuario.delete');
Route::get('admin/usuario/edit-my-job/{id}','Admin\UsuarioController@editMyJob')->name('usuario.editmyjob');
Route::post('admin/usuario/update-my-job','Admin\UsuarioController@updateMyJob')->name('usuario.updatemyjob');
Route::post('admin/usuario/orientar-projeto','Admin\UsuarioController@orientarProject')->name('usuario.orientar');
Route::get('admin/usuario/perfil','Admin\UsuarioController@show')->name('usuario.perfil');
Route::get('admin/usuario/perfil/edit','Admin\UsuarioController@editmyperfil')->name('usuario.editmyperfil');
Route::post('admin/usuario/perfil/update','Admin\UsuarioController@updateMyPerfil')->name('usuario.updatemyperfil');

//trabalho
Route::get('admin/trabalho/create','Admin\TrabalhoController@create')->name('trabalho.create');
Route::get('admin/trabalho/listar-trabalhos','Admin\TrabalhoController@index')->name('trabalho.index');
Route::get('admin/trabalho/trabalhos-sem-orientador','Admin\TrabalhoController@semOrientador')->name('trabalho.empty');
Route::get('admin/trabalho/trabalhos-pendentes','Admin\TrabalhoController@trabalhosPendentes')->name('trabalho.pendente');
Route::post('admin/trabalho/store','Admin\TrabalhoController@store')->name('trabalho.store');
Route::post('admin/trabalho/visualizar','Admin\TrabalhoController@show')->name('trabalho.show');
Route::post('admin/trabalho/delete','Admin\TrabalhoController@delete')->name('trabalho.delete');
Route::get('admin/trabalho/edit/{id}','Admin\TrabalhoController@edit')->name('trabalho.edit');
Route::post('admin/trabalho/update','Admin\TrabalhoController@update')->name('trabalho.update');
Route::get('admin/trabalho/search','Admin\TrabalhoController@search')->name('trabalho.search');


//papel
Route::get('admin/papel','Admin\PapelController@index')->name('papel.index');
Route::get('admin/papel/permissao/{id}','Admin\PapelController@permissao')->name('papel.permissao');
Route::post('admin/papel/permissao/store','Admin\PapelController@permissaoStore')->name('papel.permissao.store');
Route::post('admin/papel/permissao/remove','Admin\PapelController@permissaoDestroy')->name('papel.permissao.remove');


//tema
Route::post('admin/tema/new','Admin\TemaController@store')->name('tema.store');

//notifications
Route::get('admin/notify/readall','Admin\NotifyController@readAll')->name('notify.readall');


});




// Route::get('/','LicitacaoController@index');

Auth::routes([
    'register' => false,
]);

Route::get('/home', 'LicitacaoController@dashboard')->name('home');