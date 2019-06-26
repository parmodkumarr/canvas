<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartLinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chart_lines', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('chart_id');
			$table->text('start_x', 65535);
			$table->text('start_y', 65535);
			$table->text('end_x', 65535);
			$table->text('end_y', 65535);
			$table->string('extra_info')->nullable();
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
		Schema::drop('chart_lines');
	}

}
