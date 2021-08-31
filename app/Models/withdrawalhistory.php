<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withdrawalhistory extends Model
{
    public function __construct()
    {


    }
    public function user()
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
