<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\User\UserRepository;
use App\Http\Controllers\ApiController;


class UserController extends ApiController
{
    protected $user;
    public function __construct(UserRepository $user) {
        $this->user = $user;
    }
    
    public function index()
    {
        $users = $this->user->getAll();
        //$users = User::all();
        //return $users;
        //return response()->json(['data' => $users], 200);
        return $this->showAll($users, 200);

    }

    public function store(Request $request)
    {
        // rules: contraseña con lo menos 6 caracteres y contraseña confirmada
        $rules = [
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6|confirmed', // password_confirmation
        ];

        $this->validate($request, $rules);
        
        $fields = $request->all();
        $fields['password'] = bcrypt($request->password);
        $fields['verified'] = User::USUARIO_NO_VERIFICADO;
        $fields['verification_token'] = User::generateVerificationToken();
        $fields['admin'] = User::USUARIO_REGULAR;

        $user = $this->user->create($fields);

        //return response()->json(['data' => $user], 201);
        return $this->showOne($user, 201);
    }

    // public function show($id)
    public function show(User $user)
    {
        //$user = $this->user->getUser($id);
        //return response()->json(['data' => $user], 200);
        return $this->showOne($user);
    }

    public function update(Request $request, User $user)
    {
        //$user = $this->user->getUser($id);

        $rules = [
            'email'=> 'email|unique:users,email,' . $user->id, //comprueba el email menos el del usuario actual
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::USUARIO_ADMINISTRADOR . ',' . User::USUARIO_REGULAR
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $user->name = $request->name;
        } 
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_token = User::generateVerificationToken();
            $user->email = $request->email;  
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if($request->has('admin')) {
            if(!$user->isVerified()) {
                return $this->errorReponse('Unicamente los usuarios verificados pueden cambiar su valor de administrador', 409);
                // return response()->json(['error' => 'Unicamente los usuarios verificados pueden cambiar su valor de administrador', 'code'=> 409], 409);
            }
            $user->admin = $request->admin;
        }

        if(!$user->isDirty()) { // determina si hubo cambios en el metodo
            return $this->errorResponse('Se debe especificar al meno un valor diferente para actualizar', 422);
            // return response()->json(['error' => 'Se debe especificar al meno un valor diferente para actualizar', 'code'=> 422], 422);
        }

        $user->save();

        //return response()->json(['data' => $user], 200);
        return $this->showOne($user, 200);
    }

    //public function destroy($id)
    public function destroy(User $user)
    {
        $user = $this->user->delete($user);

        // return response()->json(['data' => $user], 200);
        return $this->showOne($user, 200);
    }
}
