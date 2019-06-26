<?php

use Illuminate\Database\Seeder;

class WorkchartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Workchart::class, 20)->create();
    }
}
