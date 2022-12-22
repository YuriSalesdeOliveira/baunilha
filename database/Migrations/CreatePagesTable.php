<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up()
    {
        Capsule::schema()->create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('pages');
    }
}
