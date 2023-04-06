<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_name');
            $table->foreignId('Grade_id')->references('id')->on('grades')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignId('Classroom_id')->references('id')->on('classrooms')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignId('teacher_id')->references('id')->on('teachers')->onDelete('cascade')->cascadeOnUpdate();
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
        Schema::dropIfExists('libraries');
    }
};
