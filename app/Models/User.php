<?php

namespace App\Models;

use App\Notifications\RedefinirSenhaNotification;
use App\Notifications\VerificarEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //Você deve subscrever os métodos caso seja necessário fora das depêndencias, não nas depêndencias, caso ocorra uma atualização ja era alteração la nas depêndencias
    public function sendPasswordResetNotification($token){
        $this->notify(new RedefinirSenhaNotification($token, $this->email, $this->name));
    }
    /**
     * Sobrescrevendo o método de disparo de verification de email. @Polimorfismo
     * Esse método pertence a MustVerifyEmail
     */
    public function sendEmailVerificationNotification(){
        $this->notify(new VerificarEmailNotification($this->name)); //Passando o name para lá e recuperando
    }
}
