<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tourism_destinations', function (Blueprint $table) {
            if (!Schema::hasColumn('tourism_destinations', 'person_prices')) {
                $table->json('person_prices')->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tourism_destinations', function (Blueprint $table) {
            if (Schema::hasColumn('tourism_destinations', 'person_prices')) {
                $table->dropColumn('person_prices');
            }
        });
    }
};
