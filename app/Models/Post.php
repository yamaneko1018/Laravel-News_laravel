<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Post -> postsテーブルに紐づいている
class Post extends Model
{
    use HasFactory;

    protected $fillable = [   //値をどのカラムに挿入するのかを設定することで予期しないカラムに値が設定されてしまう危険を回避
        'title',
        'body',
    ];

    //$post->commentで関連するコメントを取得できるようにする
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
