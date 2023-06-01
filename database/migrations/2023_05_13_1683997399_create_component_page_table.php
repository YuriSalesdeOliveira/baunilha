<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

return new class extends Migration {

    /**
     * Run the migrations
     */
    public function up(): void
    {
        Capsule::schema()->create('component_page', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('component');
            $table->unsignedBigInteger('page');
            $table->foreign('component')->references('id')->on('components');
            $table->foreign('page')->references('id')->on('pages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Capsule::schema()->dropIfExists('component_page');
    }
};
