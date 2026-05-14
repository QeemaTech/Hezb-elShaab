<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'member_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'member_status')) {
                $table->enum('member_status', ['pending', 'active', 'rejected'])->nullable();
            }
            if (! Schema::hasColumn('users', 'member_reviewed_by')) {
                $table->foreignId('member_reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            }
        });

        if (Schema::hasTable('members') && Schema::hasColumn('members', 'user_id')) {
            DB::statement('
                UPDATE users u
                INNER JOIN members m ON m.user_id = u.id
                SET
                    u.member_id = COALESCE(u.member_id, m.id),
                    u.member_status = m.status,
                    u.member_reviewed_by = m.reviewed_by
            ');
        }

        DB::table('users')->whereNotNull('member_id')->whereNull('member_status')->update(['member_status' => 'pending']);

        if (Schema::hasColumn('members', 'user_id')) {
            Schema::table('members', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
            });
        }
        if (Schema::hasColumn('members', 'reviewed_by')) {
            Schema::table('members', function (Blueprint $table) {
                $table->dropForeign(['reviewed_by']);
            });
        }

        $dropFromMembers = array_values(array_filter(
            ['user_id', 'reviewed_by', 'status'],
            fn (string $col) => Schema::hasColumn('members', $col)
        ));
        if ($dropFromMembers !== []) {
            Schema::table('members', function (Blueprint $table) use ($dropFromMembers) {
                $table->dropColumn($dropFromMembers);
            });
        }
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending')->index();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
        });

        if (Schema::hasColumn('users', 'member_id')) {
            DB::statement("
                UPDATE members m
                INNER JOIN users u ON u.member_id = m.id
                SET
                    m.user_id = u.id,
                    m.status = COALESCE(u.member_status, 'pending'),
                    m.reviewed_by = u.member_reviewed_by
            ");
        }

        if (Schema::hasColumn('users', 'member_reviewed_by')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['member_reviewed_by']);
            });
        }
        $dropUserCols = array_values(array_filter(
            ['member_status', 'member_reviewed_by'],
            fn (string $col) => Schema::hasColumn('users', $col)
        ));
        if ($dropUserCols !== []) {
            Schema::table('users', function (Blueprint $table) use ($dropUserCols) {
                $table->dropColumn($dropUserCols);
            });
        }
    }
};
