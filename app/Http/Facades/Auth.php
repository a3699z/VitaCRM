<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;
use App\Firebase\FirebaseAuth;

class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FirebaseAuth::class;
    }
}
