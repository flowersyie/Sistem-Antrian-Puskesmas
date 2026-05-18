<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'name',
        'nik',
        'phone',
        'alamat',
        'poli',
        'penjamin',
        'queue_number',
        'qr_id',
        'status',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($pasien) {
            if (empty($pasien->qr_id)) {
                do {
                    $qrId = str_pad(random_int(0, 9999999), 7, '0', STR_PAD_LEFT);
                } while (static::where('qr_id', $qrId)->exists());
                $pasien->qr_id = $qrId;
            }
            if (empty($pasien->queue_number)) {
                do {
                    $random = 'A-' . str_pad(random_int(1, 999), 3, '0', STR_PAD_LEFT);
                    $exists = static::whereDate('created_at', now()->toDateString())
                                    ->where('queue_number', $random)
                                    ->exists();
                } while ($exists);

                $pasien->queue_number = $random;
            }
        });
    }
}
