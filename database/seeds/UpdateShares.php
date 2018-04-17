<?php

use Illuminate\Database\Seeder;

class UpdateShares extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('shares:update');
    }
}
