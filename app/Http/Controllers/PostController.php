<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //web.phpから呼び出すのでpublicとする
   public function index()
   {
        $posts = Post::latest()->get(); //投稿データを降順に取得
        return view('index')
            ->with(['posts' => $posts]); //index.blade.phpに$postsを渡す
    }

   //Implicit Binding(URLから渡されたidを暗黙的にモデルのデータに結びつけてくれる)
   public function show(Post $post){  //ルーティングのパラメータの名前と、コントローラの引数名を同じ($post)にし、モデルの型を指定（Post）

       return view('posts.show')
            ->with(['post' => $post]);  //show.blade.phpに変数$postを渡す
   }


   public function store(Request $request){   //フォームから送信されたデータはRequest型の$requestでまとめて受け取る

       $request->validate([
           'title' => 'required|max:30',
           'body' => 'required',
       ],[
           'title.required' => 'タイトルは必須です。',
           'title.max' => ':max 文字以内で入力してください。',
           'body.required' => '本文は必須です。',
       ]);

       $post = new Post();
       $post->title = $request->title;
       $post->body = $request->body;
       $post->save();

       return redirect()
         ->route('posts.index');
   }

}
