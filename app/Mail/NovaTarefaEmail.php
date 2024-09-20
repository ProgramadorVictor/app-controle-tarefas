<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Tarefa;

class NovaTarefaEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $tarefa;
    public $data_limite_conclusao;
    public $url;
    public function __construct(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa->tarefa;
        $this->data_limite_conclusao = date('d/m/Y', strtotime($tarefa->data_limite_conclusao));//Convertendo o padrão da data.
        $this->url = route('tarefa.show', $tarefa->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.nova-tarefa', ['tarefa' => $this->tarefa, 'data_limite_conclusao' => $this->data_limite_conclusao, 'url' => $this->url])
        ->subject('Nova tarefa cadastrada'); //Subject é o assunto do email.
    }
}
