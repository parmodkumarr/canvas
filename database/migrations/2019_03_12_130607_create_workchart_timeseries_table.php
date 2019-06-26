<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkchartTimeseriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workchart_timeseries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('workchart_id');
			$table->integer('series_type');
			$table->integer('indicator');
			$table->string('chart_type', 100);
			$table->boolean('status')->default(1)->comment('1=Active,0=Inactive');
			$table->timestamps();
			$table->integer('created_by');
			$table->integer('updated_by');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workchart_timeseries');
	}

}
