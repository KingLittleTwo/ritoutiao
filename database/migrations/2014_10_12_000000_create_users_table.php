<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('');
            $table->string('email')->default('')->unique();
            $table->string('password')->default('');
            $table->string('avatar_b_url', 255)->default('')->comments('大图url');
            $table->string('avatar_m_url', 255)->default('')->comments('中图url');
            $table->string('avatar_s_url', 255)->default('')->comments('小图url');
//            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
