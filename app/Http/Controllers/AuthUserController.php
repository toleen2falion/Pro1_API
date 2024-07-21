<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\{
    createUserRequest,
    loginUserRequest,
};

use App\Traits\CRUD_Trait;

// use App\Enums\Country;

class AuthUserController extends Controller
{
    //
    use CRUD_Trait;

    public function createUser(createUserRequest $request)
    {
        return $this->creatUser(User::class,$request); 
   
    }

    ////7
    public function loginUser(loginUserRequest $request)
    {
        if(!Auth::attempt($request->only(['email', 'password'])))
             return $this->errorMessage("Email & Password  does not match with our record.",401);
        
        return  $this->logUser(User::class,$request->email);
           
    }

    public function logout(){  
        auth()->user()->tokens()->delete();
        return $this->successMessage('User Logged out',200);

    }
}
