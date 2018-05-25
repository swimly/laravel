<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'classify', 'tag', 'star', 'read', 'content', 'created_at'];
}
