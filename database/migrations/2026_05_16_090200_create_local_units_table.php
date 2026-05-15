<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('local_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained('districts')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('district_id');
            $table->index('name');
            $table->index('status');
            $table->index('sort_order');
            $table->unique(['district_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('local_units');
    }
};


