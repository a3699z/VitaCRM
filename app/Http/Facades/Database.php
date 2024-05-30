<?php

namespace App\Http\Facades;

use Illuminate\Support\Facades\Facade;
use App\Firebase\FirebaseDatabase;

class Database extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FirebaseDatabase::class;
    }
}
