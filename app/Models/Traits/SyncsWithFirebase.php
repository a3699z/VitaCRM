<?php

namespace Mpociot\Firebase;

// use Firebase\FirebaseInterface;
// use Firebase\FirebaseLib;
use  Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;
// closure
use Closure;

/**
 * Class SyncsWithFirebase
 * @package App\Traits
 */
trait SyncsWithFirebase
{

    // assign database to the model
    public function __construct( array $attributes = [])
    {
        // dd($attributes);
        parent::__construct($attributes);
        $this->database = Firebase::database();
    }

    // get attributes of each model
    public function getAttributes()
    {
        $attributes = $this->attributes;
        return $attributes;

    }

    /**
     * Boot the trait and add the model events to synchronize with firebase
     */
    // public static function bootSyncsWithFirebase()
    // {
    //     static::created(function ($model) {
    //         $model->saveToFirebase('set');
    //     });
    //     static::updated(function ($model) {
    //         $model->saveToFirebase('update');
    //     });
    //     static::deleted(function ($model) {
    //         $model->saveToFirebase('delete');
    //     });
    //     static::retrieved(function ($model) {
    //         $model->saveToFirebase('set');
    //     });
    // }

    /**
     * @param FirebaseInterface|null $firebaseClient
     */
    public function setFirebaseClient($firebaseClient)
    {
        $this->firebaseClient = $firebaseClient;
    }

    /**
     * @return array
     */
    protected function getFirebaseSyncData()
    {
        if ($fresh = $this->fresh()) {
            return $fresh->toArray();
        }
        return [];
    }

    /**
     * @param $mode
     */
    public function saveToFirebase()
    {

        $attribues = $this->getAttributes();
        $newPost = $this->database
            ->getReference($this->getTable())
            ->push($attribues);

        return $newPost->getvalue();
    }


    // get user with event_id
    public function getByKey($key, $value)
    {
        $path = '/users';
        $data = $this->database->getReference($this->getTable())->getValue();
        $return = [];
        foreach ($data as $index => $one) {
            if ($one[$key] == $value) {
                $return[] = $one;
            }
        }
        return $return;
    }

    public function getKeyByKey($key, $value)
    {
        $path = '/users';
        $data = $this->database->getReference($this->getTable())->getValue();
        $return = [];
        foreach ($data as $index => $one) {
            if ($one[$key] == $value) {
                return $index;
            }
        }
    }

    // search by name if the name like the name in the database
    public function searchByName($name)
    {
        $path = '/users';
        $data = $this->database->getReference($this->getTable())->getValue();
        $result = [];
        foreach ($data as $index => $one) {
            if (strpos($one['name'], $name) !== false) {
                $result[] = $one;
            }
        }
        return $result;
    }

    // save the properties to firebase
    // protected function saveToFirebase($mode)
    // {
    //     $path = $this->getTable() . '/' . $this->getKey();
    //     $this->database->getReference($path)->set($this->getFirebaseSyncData());
    // }
}
