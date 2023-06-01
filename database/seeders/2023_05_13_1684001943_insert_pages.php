<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Seeder
{
    /**
     * Run the page seeder
     */
    public function run(): void
    {
        Capsule::table('pages')->insert([
            'id' => 1,
            'path' => 'home'
        ]);
    }
};
