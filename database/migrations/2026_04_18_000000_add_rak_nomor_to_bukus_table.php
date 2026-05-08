<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom rak_nomor ke tabel bukus untuk menyimpan lokasi rak buku.
     */
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            if (!Schema::hasColumn('bukus', 'rak_nomor')) {
                $table->string('rak_nomor')->nullable()->after('stok');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            if (Schema::hasColumn('bukus', 'rak_nomor')) {
                $table->dropColumn('rak_nomor');
            }
        });
    }
};
