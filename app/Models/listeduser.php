<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class listeduser extends Model
{
    public function __construct()
    {
        if(auth('api')->check())
        {
            $this->user_id=auth('api')->user()->id;
        }

    }
    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
    public function game()
    {
        return $this->hasOne(game::class,'id', 'game_id');
    }
}
