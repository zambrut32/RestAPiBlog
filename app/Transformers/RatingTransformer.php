<?php

namespace App\Transformers;

use App\Rating;
use League\Fractal\TransformerAbstract;

class RatingTransformer extends TransformerAbstract
{
    public function transform(Rating $rating)
    {
        return [
            'id' => $rating->id,
            'post_id' => $rating->post_id,
            'rating' => $rating->rating
        ];
    }
}

