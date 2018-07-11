<?php

namespace App\Repositories\User;

use App\User;

class UserRepository 
{
    public function getAll() {
        return User::all();
    } 

    public function findOrFail($id) {
        return User::findOrFail($id);
    }
}
