
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Laravel News</title>
    </head>
    <body>
        <div>
            <h1>Laravel News</h1>
            <h2>さぁ、最新のニュースをシェアしましょう</h2>

            <form method="post" action="{{ route('posts.store') }}" id="new_post">
                @csrf

                @error('title')
                  <p>{{ $message }}</p>
                @enderror
                <div>
                    タイトル
                    <input type="text" name="title" value="{{ old('title') }}">
                </div>
                @error('body')
                  <p>{{ $message }}</p>
                @enderror
                <div>
                    記事
                    <textarea name="body" rows="10">{{ old('body') }}</textarea>
                </div>
                <button>送信</button>
            </form>
            <script>
                'use strict';

                {
                    document.getElementById('new_post').addEventListener('submit', e => {
                        e.preventDefault();

                        if(!confirm('投稿してよろしいですか?')){
                            return;
                        }
                        e.target.submit();
                    })
                }
            </script>


        </div>
        <div>
            @forelse ($posts as $post)
                <div>
                    <h3>{{ $post->title }}</h3>
                    <p>{!! nl2br(e(Str::limit($post->body, 50))) !!}</p>

                    {{-- ImplicitBindingによりここで生成されるリンクのURLには$postのidが自動的にセットされる --}}
                    <a href="{{ route('posts.show', $post)}}">
                        記事全文・コメントを見る
                    </a>
                </div>
            @empty
                <li>No posts yet!</li>
            @endforelse



        </div>
    </body>
</html>
