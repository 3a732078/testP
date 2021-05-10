<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('textbook_id')->nullable($value = true);
            $table->foreign('textbook_id')->references('id')->on('textbooks')->onDelete('cascade');
            $table->string('title');
            $table->string('attach')->nullable($value = true);
            $table->dateTime('time');
            $table->string('path');
            $table->boolean('share')->default(0);
            $table->integer('like');
            $table->string('textfile');
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
        Schema::dropIfExists('notes');
    }
}
