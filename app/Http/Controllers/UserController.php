<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\Transformers\PostTransformer;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function users(User $user){
        $users= $user->all();
//        return response()->json($users); ini api biasa
        return fractal()
            ->collection($users)
            ->transformWith(new UserTransformer)
            ->toArray();
    }
    public function profile(User $user){
//        $user = $user->where('id',Auth::user()->id)->with('posts')->first();
        $user = User::where('id', Auth::user()->id)->with('posts')->first();

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->includePosts()
            ->toArray();
    }



}
