<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->comments('标题');
            $table->integer('category_id')->comments('分类id');
            $table->text('content')->comments('文章内容');
            $table->integer('author_id')->comments('作者id');
            $table->string('tag_id', 128)->comments('标签id，逗号分隔');
            $table->integer('hits')->comments('点击量');
            $table->string('img_big_url', 255)->comments('大图url');
            $table->string('img_small_url', 255)->comments('小图url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
