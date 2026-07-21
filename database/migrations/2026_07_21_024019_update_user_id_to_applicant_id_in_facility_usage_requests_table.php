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
        Schema::table('facility_usage_requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->foreignId('applicant_id')->nullable()->after('heritage_site_id')->constrained('applicants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_usage_requests', function (Blueprint $table) {
            $table->dropForeign(['applicant_id']);
            $table->dropColumn('applicant_id');
            $table->foreignId('user_id')->after('heritage_site_id')->constrained()->cascadeOnDelete();
        });
    }
};
