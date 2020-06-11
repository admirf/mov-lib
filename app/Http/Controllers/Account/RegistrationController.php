<?php

namespace App\Http\Controllers\Account;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $this->validator($request->all())->validate();

        $user = new User($data);
        $user->password = bcrypt($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);
    }
}
