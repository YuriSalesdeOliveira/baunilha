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
        Capsule::schema()->create('', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Capsule::schema()->dropIfExists('');
    }
};
