<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->nullable()->after('path');
        });

        // Backfill existing rows with unique values.
        DB::table('sliders')->orderBy('id')->get(['id'])->each(function ($slider) {
            DB::table('sliders')->where('id', $slider->id)->update(['sort_order' => $slider->id]);
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->unique('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropUnique(['sort_order']);
            $table->dropColumn('sort_order');
        });
    }
};

