<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Messages\MailMessage;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function(){
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::resource('/tarefa', 'App\Http\Controllers\TarefaController');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Para renderizar o email
Route::get('mensagem-teste', function(){
    return new MensagemTesteMail();
    // Mail::to('victorochaandrade@gmail.com')->send(new MensagemTesteMail());
    // return "Mensagem enviada com sucesso";
});

Route::get('mensagem-template', function(){
    $minutos = 60;
    $url = 2;
    $name = "Victor";
    return (new MailMessage)
    ->subject('Atualização de senha!')
    ->greeting('Olá, '.$name)
    ->line('Esqueceu a senha? sem problemas vamos resolver isso!')
    ->action('Clique aqui, para modificar a senha', $url)
    ->line('O link acima expira em '.$minutos.' minutos')
    ->line('Caso não tenha requisitado a alteração de senha, então nenhuma ação é necessária.')
    ->salutation('Até breve!');
});