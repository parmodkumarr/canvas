<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chart_comments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('chart_id');
			$table->string('comment');
			$table->string('xaxis', 200);
			$table->string('yaxis', 100);
			$table->text('font_style', 65535);
			$table->text('font_color', 65535);
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
		Schema::drop('chart_comments');
	}

}
