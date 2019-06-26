<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workareas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 111);
			$table->integer('workchart_id');
			$table->integer('mainchart_id')->nullable()->default(0);
			$table->string('type', 10)->default('S');
			$table->string('picture')->nullable();
			$table->string('chart_type')->nullable();
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
		Schema::drop('workareas');
	}

}
