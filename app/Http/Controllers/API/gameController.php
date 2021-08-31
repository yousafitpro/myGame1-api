<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\game;
use App\Models\score;
use Illuminate\Http\Request;


class gameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

}
