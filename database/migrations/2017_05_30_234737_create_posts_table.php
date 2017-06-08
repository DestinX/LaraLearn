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
            $table->integer('user_id');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });

        DB::table('posts')->insert(
            array(
                'title' => 'En vacker sommardag',
                'user_id' => 1,
                'body' => 'Jag var en gång ute och lekte med mina kompisar när en varulv plötsligt kom.',
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            )
        );

        DB::table('posts')->insert(
            array(
                'title' => 'Finaste rubriken',
                'user_id' => 1,
                'body' => 'En lång text att skriva här för sakens skull.',
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            )
        );
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
