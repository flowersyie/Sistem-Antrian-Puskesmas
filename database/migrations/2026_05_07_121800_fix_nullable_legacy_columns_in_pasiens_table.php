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
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('nomor_antrian')->nullable()->change();
            $table->string('nomor_hp')->nullable()->change();
            $table->string('penjamin')->nullable()->change();
            $table->string('prioritas')->nullable()->change();
            $table->date('tanggal_kedatangan')->nullable()->change();
            $table->text('alamat')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->string('nomor_antrian')->nullable(false)->change();
            $table->string('nomor_hp')->nullable(false)->change();
            $table->string('penjamin')->nullable(false)->change();
            $table->string('prioritas')->nullable(false)->change();
            $table->date('tanggal_kedatangan')->nullable(false)->change();
            $table->text('alamat')->nullable(false)->change();
        });
    }
};
