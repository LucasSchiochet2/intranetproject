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
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE tasks ALTER COLUMN attachment TYPE json USING attachment::json');
            DB::statement('ALTER TABLE tasks ALTER COLUMN attachment DROP NOT NULL');
        } else {
            Schema::table('tasks', function (Blueprint $table) {
                $table->json('attachment')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('attachment', 255)->nullable()->change();
        });
    }
};
