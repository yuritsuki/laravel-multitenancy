<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class Tenant extends Model
{
    use HasFactory;

    public static function getTenant() {
        $url = request()->getHttpHost();

        $url_array = explode('.',$url);
        $subdomain = $url_array[0];

        if($subdomain == 'www')
            $subdomain = $url_array[1];

        $tenant = Tenant::where('subdomain','like',$subdomain)->first();

        if(!$tenant) {
            echo view('404');
            exit();
        }

        View::share('tenant',$tenant->name);
    }
}
