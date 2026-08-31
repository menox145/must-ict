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
        if (!Schema::hasColumn('data_barang', 'jenis')) {
            Schema::table('data_barang', function (Blueprint $table) {
                $table->string('jenis')->default('Tidak Dapat Dipinjamkan')->after('type');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('data_barang', 'jenis')) {
            Schema::table('data_barang', function (Blueprint $table) {
                $table->dropColumn('jenis');
            });
        }
    }
};
