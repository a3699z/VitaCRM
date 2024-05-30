<?php

namespace App\Firebase;


use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseDatabase
{

    protected $database;
    public function __construct()
    {
        // Your code here
        $this->database = Firebase::database();
    }

    public function getReference(string $path)
    {
        return $this->database->getReference($path);
    }

    public function getReferenceFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url);
    }

    public function getSnapshot(string $path)
    {
        return $this->database->getReference($path)->getSnapshot();
    }

    public function getSnapshotFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url)->getSnapshot();
    }

    public function getValue(string $path)
    {
        $items = $this->database->getReference($path)->getValue();
        $items = array_map(function ($value, $key) {
            $value['key'] = $key;
            return $value;
        }, $items, array_keys($items));
        return $items;
    }

    public function getValueFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url)->getValue();
    }

    public function setValue(string $path, $value)
    {
        return $this->database->getReference($path)->set($value);
    }

    public function setValueFromUrl(string $url, $value)
    {
        return $this->database->getReferenceFromUrl($url)->set($value);
    }

    public function pushFromUrl(string $url, $value)
    {
        return $this->database->getReferenceFromUrl($url)->push($value);
    }

    public function update(string $path, array $value)
    {
        return $this->database->getReference($path)->update($value);
    }

    public function updateFromUrl(string $url, array $value)
    {
        return $this->database->getReferenceFromUrl($url)->update($value);
    }

    public function remove(string $path)
    {
        return $this->database->getReference($path)->remove();
    }

    public function removeFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url)->remove();
    }

    public function orderByChild(string $path, string $child)
    {
        return $this->database->getReference($path)->orderByChild($child);
    }

    public function orderByChildFromUrl(string $url, string $child)
    {
        return $this->database->getReferenceFromUrl($url)->orderByChild($child);
    }

    public function orderByKey(string $path)
    {
        return $this->database->getReference($path)->orderByKey();
    }

    public function orderByKeyFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url)->orderByKey();
    }

    public function orderByValue(string $path)
    {
        return $this->database->getReference($path)->orderByValue();
    }

    public function orderByValueFromUrl(string $url)
    {
        return $this->database->getReferenceFromUrl($url)->orderByValue();
    }

    public function startAt(string $path, $value)
    {
        return $this->database->getReference($path)->startAt($value);
    }

    public function startAtFromUrl(string $url, $value)
    {
        return $this->database->getReferenceFromUrl($url)->startAt($value);
    }

    public function endAt(string $path, $value)
    {
        return $this->database->getReference($path)->endAt($value);
    }


    public function endAtFromUrl(string $url, $value)
    {
        return $this->database->getReferenceFromUrl($url)->endAt($value);
    }

    public function equalTo(string $path, $value)
    {
        return $this->database->getReference($path)->equalTo($value);
    }

    public function equalToFromUrl(string $url, $value)
    {
        return $this->database->getReferenceFromUrl($url)->equalTo($value);
    }

    public function limitToFirst(string $path, int $limit)
    {
        return $this->database->getReference($path)->limitToFirst($limit);
    }

    public function limitToFirstFromUrl(string $url, int $limit)
    {
        return $this->database->getReferenceFromUrl($url)->limitToFirst($limit);
    }

    public function limitToLast(string $path, int $limit)
    {
        return $this->database->getReference($path)->limitToLast($limit);
    }

    public function limitToLastFromUrl(string $url, int $limit)
    {
        return $this->database->getReferenceFromUrl($url)->limitToLast($limit);
    }

    public function getWhere(string $path, string $key, $value)
    {
        $return =  $this->database->getReference($path)->orderByChild($key)->equalTo($value)->getValue();
        $return = array_map(function ($item, $key) {
            $item['key'] = $key;
            return $item;
        }, $return, array_keys($return));
        return $return;
    }

    public function getOneWhere(string $path, string $key, $value)
    {
        $return =  $this->database->getReference($path)->orderByChild($key)->equalTo($value)->getValue();
        $return = array_map(function ($item, $key) {
            $item['key'] = $key;
            return $item;
        }, $return, array_keys($return));
        return $return[0];
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

}
