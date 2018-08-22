<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'api_token'];
    protected $hidden = ['password', 'remember_token'];

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
}
