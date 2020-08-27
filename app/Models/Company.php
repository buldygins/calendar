<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }


}
