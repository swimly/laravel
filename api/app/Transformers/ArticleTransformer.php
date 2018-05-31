<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Article;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Article $article)
    {
        return [
            'id' => $article->uId,
            'title' => $article->title,
            'classify' => $article->classify,
            'tag' => $article->tag,
            'star' => $article->star,
            'read' => $article->read,
            'author' => $article->author,
            'content' => $article->content,
            'time' => $article->created_at
        ];
    }
    // public function with($request)
    // {
    //     return [
    //         'links'    => [
    //             'self' => url('api/articles/' . $this->id),
    //         ],
    //     ];
    // }
}
