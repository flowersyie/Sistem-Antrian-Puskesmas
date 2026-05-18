<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            if (!Schema::hasColumn('pasiens', 'phone')) {
                $table->string('phone')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('pasiens', 'alamat')) {
                $table->text('alamat')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('pasiens', 'qr_id')) {
                $table->string('qr_id')->nullable()->unique()->after('status');
            }
            if (!Schema::hasColumn('pasiens', 'queue_number')) {
                $table->string('queue_number')->nullable()->after('qr_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pasiens', function (Blueprint $table) {
            $table->dropColumn(['phone', 'alamat', 'qr_id', 'queue_number']);
        });
    }
};
