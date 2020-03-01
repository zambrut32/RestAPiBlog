<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Transformers\RatingTransformer;
use Illuminate\Http\Request;
use Auth;

class RatingController extends Controller
{
    public function add(Request $request) {
        $this->validate($request,[
            'post_id'   => 'required|integer',
            'rating'   =>  'required'
        ]);
        $check = Rating::where('rating_by', Auth::user()->id)->count();
        if ($check > 0) {
            return response()->json(['error' => 'Anda sudah memberi rating post ini.'],401);
        }

        $rating = Rating::create([
            'post_id' => $request->post_id,
            'rating_by' => Auth::user()->id,
            'rating' => $request->rating,
        ]);

        $response = fractal()
            ->item($rating)
            ->transformWith(new RatingTransformer)
            ->toArray();

        return response()->json($response,201);
    }
}
