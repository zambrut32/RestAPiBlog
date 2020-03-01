<?php

namespace App\Http\Controllers;

use App\Post;
use App\Transformers\PostTransformer;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function add(Request $request,Post $post){
        $this->validate($request,[
            'content' => 'required|min:10'
        ]);

         $post = $post->create([
             'user_id' => Auth::user()->id,
             'content' => $request->content,
         ]);

        $response = fractal()
            ->item($post)
            ->transformWith(new PostTransformer)
            ->includePosts()
            ->toArray();

        return response()->json($response,201);
    }

    public function getMyPost(){
        $posts = Post::where('user_id',Auth::user()->id)->with('ratings', 'comments')->get();

        $response = fractal()
            ->collection($posts)
            ->transformWith(new PostTransformer)
            ->toArray();

        return response()->json($response,201);
    }

    public function getAllPost() {
        $posts = Post::all();

        $response = fractal()
            ->collection($posts)
            ->transformWith(new PostTransformer)
            ->includeUser()
            ->toArray();

        return response()->json($response,201);
    }

    public function getDetailPost(Request $request) {
        $post = Post::where('id', $request->id)->first();

        $response = fractal()
            ->item($post)
            ->transformWith(new PostTransformer)
            ->includeUser()
            ->includeRatings()
            ->includeComments()
            ->toArray();

        return response()->json($response,201);
    }
    public function update(Request $request,Post $post){
        $this->authorize('update',$post);

        $post->content = $request->get('content',$post->content);

        $post->save();

        return fractal()
            ->item($post)
            ->transformWith(new PostTransformer)
            ->toArray();

    }

    public function delete(Post $post){
        $this->authorize('delete',$post);

        $post->delete();
        return response()->json([
            'massage' => 'post delete',
        ]);


    }
}
