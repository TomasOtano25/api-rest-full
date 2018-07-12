<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository 
{
    public function getAll() {
        return User::all();
    } 

    public function create(Request $request) {
        return User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' => bcrypt($request->password),
            'verified' => User::USUARIO_NO_VERIFICADO,
            'verification_token' => User::generateVerificationToken(),
            'admin' => User::USUARIO_REGULAR
        ]);
        return User::create($fields);
    }

    public function update() {
        
    }

    public function delete(User $user) {
        $user->delete();
        return $user;
    }

    
}
