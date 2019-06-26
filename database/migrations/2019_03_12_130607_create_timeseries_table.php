<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimeseriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timeseries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('chart_id');
			$table->string('color', 50)->comment('1=Above,2=Below');
			$table->string('chart_type', 50);
			$table->integer('indicator');
			$table->integer('series_type');
			$table->integer('param_id')->default(0);
			$table->boolean('status')->default(1)->comment('1=Active,0=Inactive');
			$table->integer('created_by');
			$table->integer('updated_by');
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
		Schema::drop('timeseries');
	}

}
