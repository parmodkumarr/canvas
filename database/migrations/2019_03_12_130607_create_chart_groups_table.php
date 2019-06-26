<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChartGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chart_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 200)->nullable();
			$table->boolean('status')->comment('1=Acitve,0=Inactive');
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
		Schema::drop('chart_groups');
	}

}
