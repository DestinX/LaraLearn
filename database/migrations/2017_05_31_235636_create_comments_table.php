<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('user_id');
            $table->text('body');
            $table->timestamps();
        });

        DB::table('comments')->insert(
            array(
                'post_id' => 1,
                'user_id' => 1,
                'body' => 'En kommentar till en post.',
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
        Schema::dropIfExists('comments');
    }
}
