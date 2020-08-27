<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'cost',
        'type',
        'company_id',
        'user_id',
        'date',
        'shift_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function  shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
