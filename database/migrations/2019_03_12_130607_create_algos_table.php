<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlgosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('algos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191);
			$table->integer('user_id')->unsigned();
			$table->string('formula', 191);
			$table->string('operator_type', 191);
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
		Schema::drop('algos');
	}

}
