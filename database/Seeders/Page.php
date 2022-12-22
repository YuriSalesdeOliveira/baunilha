<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Capsule\Manager as Capsule;

class Page extends Seeder
{
    /**
     * Run the page seeder
     */
    public function run()
    {
        Capsule::table('pages')->insert([
            'id' => 1
        ]);
    }
}
