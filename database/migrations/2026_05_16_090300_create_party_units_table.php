<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('party_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_unit_id')->constrained('local_units')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('local_unit_id');
            $table->index('name');
            $table->index('status');
            $table->index('sort_order');
            $table->unique(['local_unit_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('party_units');
    }
};


