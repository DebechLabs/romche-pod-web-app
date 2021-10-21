<?php


namespace App\Helpers;


class FirebaseHelper
{
    protected $database;

    public function __construct()
    {
        $this->database = app('firebase.database');
    }

    public function get($path = "/"){
        $reference = $this->database->getReference($path);
        return $reference->getValue();
    }

    public function saveData($path = "/", $data){
        return $this->database->getReference($path)
            ->push($data);
    }

    public function update($path, $data){
        return $this->database->getReference($path)
            ->set($data);
    }

    public function delete($path){
        return $this->database->getReference($path)->remove();
    }
}
