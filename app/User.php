<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    const USUARIO_ADMINISTRADOR = 'true';
    const USUARIO_REGULAR = 'false ';

    protected $table = 'users'; // Debido a la herencia de seller y buyer

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token'
    ];

    // Mutadores y accesores
    /* Mutadores */
    public function setNameAttribute($value) {
        $this->attributes['name'] = strtolower($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    /* Accesores */
    public function getNameAttribute($value) {
        //return ucfirst($valor);
        return ucwords($value);
    }

    public function isVerified() {
        return $this->verified == User::USUARIO_VERIFICADO;
    }

    public function isAdministrator() {
        return $this->admin == User::USUARIO_ADMINISTRADOR;
    }

    public static function generateVerificationToken() {
        return str_random(40); // 24-...
    }
}
