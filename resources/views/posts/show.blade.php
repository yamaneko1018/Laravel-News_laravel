
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Laravel News</title>
    </head>
    <body>
        <div>
            <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
            {{-- PostContorllerのshowメソッドから渡ってきた$post --}}
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
        </div>
        <div>
            <h4>コメント</h4>
            {{-- 　　　　　どの投稿に関するコメントかを伝えるため、$postを渡す --}}
                    <form method="post" action="{{ route('comments.store', $post) }}">
                        @csrf
                        @error('body')
                          <p>{{ $message }}</p>
                        @enderror

                        <div>
                            <textarea name="body" rows="10"></textarea>
                        </div>
                        <div>
                          <button>コメントを書く</button>
                        </div>
                    </form>
            <div>
                @foreach ($post->comments()->latest()->get() as $comment)
                  <p>
                      {{ $comment->body }}
                  </p>
                  {{-- どのコメントを削除するか渡したいので$commentとする --}}
                  <form method="post" action="{{ route('comments.destroy', $comment)}}">
                    @method('DELETE')
                    @csrf

                    <button>削除する</button>
                  </form>
                @endforeach
            </div>

        </div>
    </body>
</html>
