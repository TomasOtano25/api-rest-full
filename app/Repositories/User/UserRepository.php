<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository 
{
    public function getAll() {
        return User::all();
    } 

    public function create($fields) {
        return User::create($fields);
    }

    public function update() {

    }

    public function delete(User $user) {
        $user->delete();
        return $user;
    }

    
}
