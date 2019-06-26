<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartSignalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chart_signals', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('title', 65535);
			$table->integer('chart_id');
			$table->boolean('level')->comment('1=Above,2=Below');
			$table->string('value', 50);
			$table->text('signal_type', 65535)->nullable()->comment('1=SMS,2=Email,3=IVR');
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
		Schema::drop('chart_signals');
	}

}
