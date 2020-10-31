<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('adddat')->nullable();
            $table->string('name');
            $table->integer('progress')->default(0);
            $table->boolean('is_done')->default(false);
            $table->text('description')->nullable();
            $table->date('deadline')->nullable();
            $table->date('updated_at');
            $table->date('created_at');
            $table->unsignedBigInteger('from')->nullable();
            $table->index('user_id');
        });
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
