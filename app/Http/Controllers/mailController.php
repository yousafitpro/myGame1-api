<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
   public static function sendMail($reciever,$subject,$data,$view)
   {

       Mail::send($view, ['data' => $data], function ($m) use ($subject,$reciever) {
           $m->from(Config::get('myconfig.mail.from'),Config::get('myconfig.mail.company_name'))
               ->subject($subject)
               ->to($reciever,"ok");

       });
   }
}
