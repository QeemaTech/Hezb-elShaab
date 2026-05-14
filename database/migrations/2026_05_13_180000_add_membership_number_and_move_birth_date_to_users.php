<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('national_id');
        });

        foreach (DB::table('members')->whereNotNull('user_id')->cursor() as $row) {
            if (! empty($row->birth_date)) {
                DB::table('users')->where('id', $row->user_id)->update(['birth_date' => $row->birth_date]);
            }
        }

        Schema::table('members', function (Blueprint $table) {
            $table->string('membership_number')->nullable()->unique()->after('national_id');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('birth_date');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->date('birth_date')->nullable()->after('national_id');
        });

        foreach (DB::table('members')->whereNotNull('user_id')->cursor() as $row) {
            $birth = DB::table('users')->where('id', $row->user_id)->value('birth_date');
            if ($birth !== null) {
                DB::table('members')->where('id', $row->id)->update(['birth_date' => $birth]);
            }
        }

        Schema::table('members', function (Blueprint $table) {
            $table->dropUnique(['membership_number']);
            $table->dropColumn('membership_number');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birth_date');
        });
    }
};
