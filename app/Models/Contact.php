<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = ['user_id', 'name', 'phone', 'email'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}