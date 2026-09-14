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
        Schema::create('perbaikan_gedungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perbaikan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('divisi_asal_id')->constrained('divisis')->onDelete('cascade');
            $table->foreignId('divisi_tujuan_id')->constrained('divisis')->onDelete('cascade');
            $table->string('status_perbaikan')->default("Draft");
            $table->date('tanggal_temuan_kerusakan')->default(DB::raw('CURRENT_DATE'));
            $table->date('tanggal_batas_pengerjaan')->default(DB::raw('CURRENT_DATE'));
            $table->date('tanggal_selesai_pengerjaan')->nullable();
            $table->string('keterangan_temuan')->nullable();
            $table->string('keterangan_perbaikan')->nullable();
            $table->json('uploaded_temuan_kerusakan_images')->nullable();
            $table->json('uploaded_perbaikan_kerusakan_images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan_gedungs');
    }
};
