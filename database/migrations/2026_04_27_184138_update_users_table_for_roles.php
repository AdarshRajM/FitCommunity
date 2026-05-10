<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role_id column
            $table->foreignId('role_id')->default(2)->constrained('roles')->onDelete('cascade');
        });

        // Migrate existing roles if needed
        DB::table('users')->where('role', 'admin')->update(['role_id' => 1]);
        DB::table('users')->where('role', 'user')->update(['role_id' => 2]);
        DB::table('users')->where('role', 'doctor')->update(['role_id' => 3]);
        DB::table('users')->where('role', 'trainer')->update(['role_id' => 4]);

        Schema::table('users', function (Blueprint $table) {
            // Drop old role column
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
        });

        DB::table('users')->where('role_id', 1)->update(['role' => 'admin']);
        DB::table('users')->where('role_id', 2)->update(['role' => 'user']);
        DB::table('users')->where('role_id', 3)->update(['role' => 'doctor']);
        DB::table('users')->where('role_id', 4)->update(['role' => 'trainer']);

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
