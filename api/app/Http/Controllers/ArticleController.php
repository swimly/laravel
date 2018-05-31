<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\ArticleFormRequest;
use App\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
   public function create (ArticleFormRequest $request) {
       $article = Article::create($request->all());
       $article->uId = md5(uniqid());
       $article->author = $request->author;
       $article->update();
       $article = fractal($article, new ArticleTransformer())->toArray();
        return response()->json([
            'status'=>1,
            'msg'=>'文章发布成功！',
            'data'=>$article
        ]);
   }
   public function list (Request $request) {
       $article = Article::paginate($request->pagesize);
       return $article;
   }
}
