<?php

namespace App\Repositories\User;

use App\User;

class UserRepository 
{
    public function getAll() {
        return User::all();
    } 

    public function getUser($id) {
        return User::findOrFail($id);
    }

    public function create($fields) {
        return User::create($fields);
    }

    public function update() {

    }

    public function delete($id) {
        $user = $this->getUser($id);
        $user->delete();
        return $user;
    }

    
}
