<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Messages\MailMessage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]); //Laravel UI, com auth próprio deles. php artisan ui bootstrap --auth

Route::group(['middleware' => 'verified'], function(){
    // Route::get('/home', [HomeController::class, 'index'])->name('home'); //Comentamos a rota homa, não sendo necessária mais.
    Route::resource('/tarefa', TarefaController::class);
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