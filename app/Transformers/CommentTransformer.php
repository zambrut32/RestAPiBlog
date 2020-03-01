<?php

namespace App\Transformers;

use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'comment_by'
    ];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
//            'comment_by' => $comment->comment_by,
            'post_id' => $comment->post_id,
            'comment' => $comment->comment
        ];
    }

    public function includeCommentBy (Comment $comment) {
        $commentBy = $comment->comment_by;

        return $this->item($commentBy, new UserTransformer);
    }
}

