<?php

namespace App\Http\Controllers;

use App\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $this->validate($request,[
            'class_id'  => 'required',
            'nis'       => 'required',
            'school'    => 'required',
            'name'      => 'required',
            'class_code'=> 'required',
            'email'     => 'required|email|unique:users',
            'age'       => 'required',
            'address'   => 'required',
            'gender'    => 'required',
            'password'  => 'required|min:6',

        ]);
//dd($request->class_id);
        $user = $user->create([
            "class_id"   => $request->class_id,
            "nis"        => $request->nis,
            "school"     => $request->school,
            "name"       => $request->name,
            "class_code" => $request->class_code,
            "img"        => $request->img,
            "email"      => $request->email,
            "age"        => $request->age,
            "address"    => $request->address,
            "gender"     => $request->gender,
            "password"   => bcrypt($request->password),
            "api_token"  => bcrypt($request->email),
        ]);
        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();

        return response()->json($response,201);
    }
    public function login(Request $request,User $user){
        if (!Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return response()->json(['error'=>'ada sesuatu yang salah '],401);
        }

        $user = $user->find(Auth::user()->id);

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'token' => $user->api_token,
            ])
            ->toArray();
    }
}
