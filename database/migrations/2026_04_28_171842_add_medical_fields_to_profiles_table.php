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
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('medical_history')->nullable()->after('skin_color');
            $table->text('allergies')->nullable()->after('medical_history');
            $table->string('emergency_contact_name')->nullable()->after('allergies');
            $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');
            $table->string('profile_picture')->nullable()->after('emergency_contact_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'medical_history',
                'allergies',
                'emergency_contact_name',
                'emergency_contact_phone',
                'profile_picture'
            ]);
        });
    }
};
