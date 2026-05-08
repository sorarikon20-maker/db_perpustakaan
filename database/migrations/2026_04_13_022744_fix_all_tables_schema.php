<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Memperbaiki semua tabel agar kolom sesuai dengan kode aplikasi.
     */
    public function up(): void
    {
        // ===== SISWAS: tambah kolom jurusan =====
        Schema::table('siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('siswas', 'jurusan')) {
                $table->string('jurusan')->nullable()->after('kelas');
            }
        });

        // ===== KATEGORIS: tambah kolom keterangan =====
        Schema::table('kategoris', function (Blueprint $table) {
            if (!Schema::hasColumn('kategoris', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('nama_kategori');
            }
        });

        // ===== BUKUS: perbaiki nama kolom agar sesuai kode =====
        Schema::table('bukus', function (Blueprint $table) {
            // Rename pengarang -> penulis
            if (Schema::hasColumn('bukus', 'pengarang') && !Schema::hasColumn('bukus', 'penulis')) {
                $table->renameColumn('pengarang', 'penulis');
            }
            // Rename tahun -> tahun_terbit
            if (Schema::hasColumn('bukus', 'tahun') && !Schema::hasColumn('bukus', 'tahun_terbit')) {
                $table->renameColumn('tahun', 'tahun_terbit');
            }
        });

        // Tambah kolom penerbit -> stok (drop penerbit jika ada, tambah stok)
        Schema::table('bukus', function (Blueprint $table) {
            if (!Schema::hasColumn('bukus', 'stok')) {
                $table->integer('stok')->default(0)->after('kategori_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            if (Schema::hasColumn('siswas', 'jurusan')) {
                $table->dropColumn('jurusan');
            }
        });

        Schema::table('kategoris', function (Blueprint $table) {
            if (Schema::hasColumn('kategoris', 'keterangan')) {
                $table->dropColumn('keterangan');
            }
        });

        Schema::table('bukus', function (Blueprint $table) {
            if (Schema::hasColumn('bukus', 'penulis') && !Schema::hasColumn('bukus', 'pengarang')) {
                $table->renameColumn('penulis', 'pengarang');
            }
            if (Schema::hasColumn('bukus', 'tahun_terbit') && !Schema::hasColumn('bukus', 'tahun')) {
                $table->renameColumn('tahun_terbit', 'tahun');
            }
            if (Schema::hasColumn('bukus', 'stok')) {
                $table->dropColumn('stok');
            }
        });
    }
};
