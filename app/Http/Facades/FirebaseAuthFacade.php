<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\FirebaseAuthService;

class FirebaseAuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FirebaseAuthService::class;
    }
}
