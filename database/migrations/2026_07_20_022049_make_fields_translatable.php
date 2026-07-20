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
        Schema::table('site_categories', function (Blueprint $table) {
            $table->dropUnique('site_categories_name_unique');
        });

        // site_categories
        DB::statement("ALTER TABLE site_categories ALTER COLUMN name TYPE json USING json_build_object('id', name)");
        DB::statement("ALTER TABLE site_categories ALTER COLUMN description TYPE json USING CASE WHEN description IS NULL THEN NULL ELSE json_build_object('id', description) END");

        // heritage_sites
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN name TYPE json USING json_build_object('id', name)");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN description TYPE json USING CASE WHEN description IS NULL THEN NULL ELSE json_build_object('id', description) END");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN address TYPE json USING CASE WHEN address IS NULL THEN NULL ELSE json_build_object('id', address) END");

        // site_photos
        DB::statement("ALTER TABLE site_photos ALTER COLUMN caption TYPE json USING CASE WHEN caption IS NULL THEN NULL ELSE json_build_object('id', caption) END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // site_categories
        DB::statement("ALTER TABLE site_categories ALTER COLUMN name TYPE varchar USING name->>'id'");
        DB::statement("ALTER TABLE site_categories ALTER COLUMN description TYPE text USING description->>'id'");

        // heritage_sites
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN name TYPE varchar USING name->>'id'");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN description TYPE text USING description->>'id'");
        DB::statement("ALTER TABLE heritage_sites ALTER COLUMN address TYPE text USING address->>'id'");

        // site_photos
        DB::statement("ALTER TABLE site_photos ALTER COLUMN caption TYPE varchar USING caption->>'id'");

        Schema::table('site_categories', function (Blueprint $table) {
            $table->unique('name');
        });
    }
};
