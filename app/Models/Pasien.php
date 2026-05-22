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
                $poliPrefix = [
                    'umum'   => 'U',
                    'gigi'   => 'G',
                    'anak'   => 'A',
                    'kia'    => 'K',
                    'lansia' => 'L',
                    'jiwa'   => 'J',
                    'gizi'   => 'Z',
                    'mata'   => 'M',
                    'tht'    => 'T',
                ];
                $prefix = $poliPrefix[$pasien->poli] ?? 'X';
                $count = static::whereDate('created_at', now()->toDateString())
                    ->where('poli', $pasien->poli)
                    ->count();
                $pasien->queue_number = $prefix . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
