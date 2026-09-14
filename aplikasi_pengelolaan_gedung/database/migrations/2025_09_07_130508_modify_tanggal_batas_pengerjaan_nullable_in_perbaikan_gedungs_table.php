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
        Schema::table('perbaikan_gedungs', function (Blueprint $table) {
            $table->date('tanggal_batas_pengerjaan')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perbaikan_gedungs', function (Blueprint $table) {
            $table->date('tanggal_batas_pengerjaan')->default(DB::raw('CURRENT_DATE'))->nullable(false)->change();
        });
    }
};
