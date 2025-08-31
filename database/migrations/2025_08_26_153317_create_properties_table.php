<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->text('address');
            $table->decimal('price', 8, 2);
            $table->integer('surface')->unsigned();
            $table->integer('rooms')->unsigned();
            $table->integer('bedrooms')->unsigned();
            $table->integer('floor')->unsigned()->nullable();
            $table->string('postal_code')->nullable();
            $table->foreignIdFor(\App\Models\City::class)->constrained()->cascadeOnDelete();
            $table->boolean('sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
