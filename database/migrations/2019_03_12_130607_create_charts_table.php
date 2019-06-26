<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('charts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('chart_id')->default(0);
			$table->string('title');
			$table->integer('workchart_id');
			$table->integer('group_id')->default(0);
			$table->string('type', 11)->default('S');
			$table->boolean('chart_mode')->default(1)->comment('1=Real-Time,2=Historical');
			$table->dateTime('start_date')->nullable();
			$table->dateTime('end_date')->nullable();
			$table->integer('picture')->nullable();
			$table->string('chart_type', 11)->nullable();
			$table->string('chart_color', 10)->nullable();
			$table->string('data_group', 100)->nullable();
			$table->string('data_group_option', 100)->nullable();
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
		Schema::drop('charts');
	}

}
