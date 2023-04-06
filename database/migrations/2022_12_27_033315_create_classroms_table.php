<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassromsTable extends Migration {

	public function up()
	{
		Schema::create('classrooms', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('Name_Class');
			$table->bigInteger('Grade_Id')->unsigned();
			$table->foreign('Grade_Id')->references('id')->on('grades');
		});
	}

	public function down()
	{
		Schema::drop('classrooms');
	}
}