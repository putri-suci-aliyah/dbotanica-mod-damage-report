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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('keterangan_user')->nullable();
            $table->foreignId('divisi_id')->constrained('divisis')->onDelete('cascade');
            
            $table->boolean('is_super_admin')->default(false);
            $table->boolean('is_create')->default(false);
            $table->boolean('is_update')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->boolean('is_read')->default(false);
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'keterangan_user',
                'divisi_id',
                'is_super_admin',
                'is_create',
                'is_update',
                'is_delete',
                'is_read',
                'is_active'
            ]);
        });
    }
};
