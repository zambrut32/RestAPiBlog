<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    public function add(Request $request) {
        $this->validate($request,[
            'post_id'   => 'required|integer',
            'comment'   =>  'required'
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'comment_by' => Auth::user()->id,
            'comment' => $request->comment,
        ]);

        $response = fractal()
            ->item($comment)
            ->transformWith(new CommentTransformer)
            ->toArray();

        return response()->json($response,201);
    }
}
