<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'uId', 'topicId', 'topicType','parentId','fromId','toId','content','created_at','updated_at'
    ];
    public function childCategory() {
        $comments = $this->hasMany('App\Comment', 'parentId', 'uId')
        ->join('users', function ($join) {
            $join->on('comments.fromId', '=', 'users.uId');
        })->select('users.name as fromname', 'users.cover as fromface', 'comments.*');
        return $comments;
    }

    public function children()
    {
        return $this->childCategory()->with('children');
    }
}
