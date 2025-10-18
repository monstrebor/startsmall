<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Beverages', 'description' => 'Soft drinks, juices, water', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Snacks', 'description' => 'Chips, biscuits, and light snacks', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Personal Care', 'description' => 'Soap, shampoo, toothpaste', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Household', 'description' => 'Cleaning and laundry products', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
