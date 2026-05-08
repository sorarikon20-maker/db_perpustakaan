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
        Schema::table('peminjamans', function (Blueprint $table) {
            // Add status column if not exists
            if (!Schema::hasColumn('peminjamans', 'status')) {
                $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam')->after('tanggal_kembali');
            }
            // Add denda column if not exists
            if (!Schema::hasColumn('peminjamans', 'denda')) {
                $table->integer('denda')->default(0)->after('status'); // denda dalam rupiah
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamans', 'denda')) {
                $table->dropColumn('denda');
            }
            if (Schema::hasColumn('peminjamans', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
