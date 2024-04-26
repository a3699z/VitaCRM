<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

// use Firevel\FirebaseAuthentication\FirebaseAuthenticable;

use  Kreait\Firebase\Contract\Database;
use Closure;

require_once __DIR__ . '/Traits/SyncsWithFirebase.php';

use Mpociot\Firebase\SyncsWithFirebase;
use Kreait\Firebase\Contract\Database as FirebaseDatabase;


// use Firebase\FirebaseInterface;
// use Firebase\FirebaseLib;

class Reservation
{
    use HasFactory, Notifiable, SyncsWithFirebase;

    protected $database;

    public function __construct(array $attributes = [], FirebaseDatabase $database)
    {
        $this->database = $database;
    }

    // table
    // protected $table = 'users_no';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // is_amdin
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    // save user to firebase
    // public function saveToFirebase()
    // {
    //     try {
    //         $attribues = $this->getAttributes();
    //         $newPost = $this->database
    //             ->getReference('users')
    //             ->push([
    //                 'name' => 'name',
    //                 'email' => 'email',
    //                 'user_type' => 'type',
    //                 'uid' => 'alsdkjf',
    //             ]);
    //         } catch (\Throwable $th) {
    //             //throw $th;
    //             dd($th->getMessage());
    //         }

    //     // return $newPost->getvalue();
    // }


}
