<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->boolean('completed');
            $table->timestamps();
        });

        DB::table('tasks')->insert(
            array(
                'body' => 'en att gora paminnelse',
                'completed' => false,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            )
        );

        DB::table('tasks')->insert(
            array(
                'body' => 'ngt att skriva har kanske',
                'completed' => false,
                'created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')
            )
        );

        DB::table('tasks')->insert(
            array(
                'body' => 'en tasks som ar avklarad',
                'completed' => true,
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
        Schema::dropIfExists('tasks');
    }
}
