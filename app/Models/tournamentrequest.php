<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class tournamentrequest extends Model
{
    use HasFactory;
    public function __construct()
    {
        if(Auth::check())
        {
            $this->user_id=Auth::user()->id;
        }

    }
    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
    public function pmethod()
    {
        return $this->hasOne(paymentMethod::class,'id', 'paymentmethod_id');
    }
}
