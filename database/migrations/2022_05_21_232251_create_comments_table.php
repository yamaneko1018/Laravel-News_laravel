<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id'); //postsテーブルのidカラムに紐付ける。同じ型にする。
            $table->string('body');
            $table->timestamps();
            $table
                 ->foreign('post_id')  //postsテーブルに存在しないidが入らないように外部キーを設定
                 ->references('id')  //postsテーブルのidに紐づける
                 ->on('posts')
                 ->onDelete('cascade');//記事が削除されたら関連するコメントも削除される。※今回は不要かも
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
