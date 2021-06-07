<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

//            $table->foreignId('teacher_id')->constrained();
            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->on('teachers')->references('id')
                ->onDelete('cascade');

//            $table->foreignId('TA_id')->constrained();
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->on('students')->references('id')
                ->onDelete('cascade');

            $table->longText('content');

            $table->string('sender');

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
        Schema::dropIfExists('messages');
    }
}
