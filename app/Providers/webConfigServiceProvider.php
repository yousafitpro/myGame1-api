<?php

namespace App\Providers;

use App\Models\webconfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class webConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        if(webconfig::all()->count()==0)
//        {
//            $webConfig=new webconfig();
//            $webConfig->save();
//        }
//        $config=webconfig::first();
//        View::share('webConfig', $config);
    }
}
