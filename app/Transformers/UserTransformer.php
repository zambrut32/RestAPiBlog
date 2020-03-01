<?php

namespace App\Transformers;


use App\User;
use App\Transformers\PostTransformer;
use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'posts',
    ];

    public function transform(User $user){
        return[
            'id' => $user->id,
            'class_id' => $user->class_id,
            'nis' => $user->nis,
            'school' => $user->school,
            'name' => $user->name,
            'class_code' => $user->class_code,
            'img' => $user->img,
            'email' => $user->email,
            'age' => $user->age,
            'address' => $user->addrees,
            'gender' => $user->gender,

            'registered' => $user->created_at->diffForHumans(),
        ];
    }

    public function includePosts(User $user)
    {
        $posts = $user->posts;

        return $this->collection($posts, new PostTransformer);
    }
}
