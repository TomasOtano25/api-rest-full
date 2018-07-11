<?php

namespace App\Repositories\User;

use App\User;

class UserRepository 
{
    public function getAll() {
        return User::all();
    } 

    public function find($id) {
        return User::find($id);
    }
}
