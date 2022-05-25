<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{

    public function store(Request $request, Post $post){

        $request->validate([
            'body' => 'required|max:50',
        ],[
            'body.required' => 'コメントは必須です。',
            'body.max' => ':max 文字以内で入力してください。',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()
          ->route('posts.show', $post);
    }

    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()
          ->route('posts.show',$comment->post);
    }
}
