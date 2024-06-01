<?php

namespace App\Firebase;


use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;


use App\Http\Facades\Auth;

class FirebaseDatabase
{

    protected $database;
    public function __construct()
    {
        // Your code here
        $this->database = Firebase::database();
    }

    public function getReferences(string $path)
    {
        $items = $this->database->getReference($path)->getValue();
        if (empty($items)) {
            return [];
        }
        $items = array_map(function ($item, $key) {
            $item['key'] = $key;
            return $item;
        }, $items, array_keys($items));
        return $items;
    }

    public function getOneReference (string $path)
    {
        $item = $this->database->getReference($path)->getValue();
        if (empty($item)) {
            return [];
        }
        $item['key'] = $this->database->getReference($path)->getKey();
        return $item;
    }

    public function getWhere(string $path, string $key, $value)
    {
        $return =  $this->database->getReference($path)->orderByChild($key)->equalTo($value)->getValue();
        if (count($return) == 0) {
            return [];
        }
        $return = array_map(function ($item, $key) {
            $item['key'] = $key;
            return $item;
        }, $return, array_keys($return));
        return $return;
    }

    public function getOneWhere(string $path, string $key, $value)
    {
        $return =  $this->database->getReference($path)->orderByChild($key)->equalTo($value)->getValue();
        if (count($return) == 0) {
            return [];
        }
        $return = array_map(function ($item, $key) {
            $item['key'] = $key;
            return $item;
        }, $return, array_keys($return));
        return count($return) > 0 ? $return[0] : [];
    }

    public function countWhere(string $path, string $key, $value)
    {
        $return =  $this->database->getReference($path)->orderByChild($key)->equalTo($value)->getValue();
        return count($return);
    }


    public function push($path, $value)
    {
        return $this->database->getReference($path)->push($value);
    }

    public function set($path, $value)
    {
        return $this->database->getReference($path)->set($value);
    }

    public function update($path, $value)
    {
        return $this->database->getReference($path)->update($value);
    }

    public function delete($path)
    {
        return $this->database->getReference($path)->remove();
    }


    public function getAllUsers()
    {
        $users = $this->database->getReference('users')->getValue();
        $users = array_map(function ($user, $key) {
            $user['key'] = $key;
            $user_data = Auth::getUser($user['uid']);
            $user['email'] = $user_data->email;
            // $user['name'] = $user_data->displayName;
            return $user;
        }, $users, array_keys($users));
        return $users;
    }


}
