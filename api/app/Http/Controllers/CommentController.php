<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\Http\Requests\CommentFormRequest;

class CommentController extends Controller
{
    public function create (CommentFormRequest $request) {
        $params = $request->all();
        $params['uId'] = md5(uniqid());
        $comment = Comment::create($params);
        if ($comment) {
            return response()->json([
                'status'=>1,
                'msg'=>'评论成功！'
            ]);
        }
    }
    public function list (Request $request) {
        $pagesize = $request->pagesize;
        $comments = Comment::where('topicId', $request->topicId)->whereNull('parentId')->orderBy('created_at', 'desc')->paginate($pagesize);
        $total = count(Comment::where('topicId', $request->topicId)->get());
        foreach($comments as $index => $comment) {
        $comments[$index]['from'] = User::where('uId', $comment->fromId)->first();
        $comments[$index]['to'] = User::where('uId', $comment->toId)->first();
        $children = Comment::where('parentId', $comment->uId)->get();
        foreach($children as $idx => $child) {
            $children[$idx]['from'] = User::where('uId', $child->fromId)->first();
            $children[$idx]['to'] = User::where('uId', $child->toId)->first();
        }
        $comments[$index]['children'] = $children;
        }
        return response()->json([
            'status'=>1,
            'data'=>[
                'total'=>$total,
                'data'=>$comments
            ]
        ]);
    }
}
