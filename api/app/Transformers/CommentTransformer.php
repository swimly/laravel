<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Comment;

class CommentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            //
        ];
    }
}
