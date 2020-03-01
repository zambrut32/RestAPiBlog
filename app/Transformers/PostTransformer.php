<?php

namespace App\Transformers;

use App\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user', 'ratings','comments',
    ];

    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'content' => $post->content,
            'published' => $post->created_at->diffForhumans(),
        ];
    }

    public function includeUser(Post $post)
    {
        $user = $post->user;

        return $this->item($user, new UserTransformer);
    }

    public function includeRatings(Post $post)
    {
        $ratings = $post->ratings;

        return $this->collection($ratings, new RatingTransformer);
    }

    public function includeComments(Post $post)
    {
        $comments = $post->comments;

        return $this->collection($comments, new CommentTransformer);
    }
}

