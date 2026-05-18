<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Antrian – {{ $pasien->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 24px 16px;
        }
        .action-bar { display: flex; gap: 12px; margin-bottom: 24px; }
        .btn { padding: 10px 24px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: opacity .2s; }
        .btn:hover { opacity: .85; }
        .btn-print { background: #10b981; color: #fff; }
        .btn-close  { background: #6b7280; color: #fff; }

        .ticket { width: 300px; background: #fff; border-radius: 16px; box-shadow: 0 8px 40px rgba(0,0,0,.15); overflow: hidden; }

        .ticket-header { background: #111827; color: #fff; text-align: center; padding: 18px 16px 14px; }
        .ticket-header h1 { font-size: 15px; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; }
        .ticket-header p  { font-size: 11px; opacity: .7; margin-top: 2px; }

        .dashed { border: none; border-top: 2px dashed #e5e7eb; margin: 0 16px; }

        .queue-block { text-align: center; padding: 22px 16px 20px; }
        .queue-label { font-size: 11px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .queue-number { font-size: 64px; font-weight: 900; color: #111827; line-height: 1; letter-spacing: -1px; }
        .poli-badge {
            display: inline-block; background: #f3f4f6; color: #374151;
            font-size: 12px; font-weight: 700; padding: 5px 16px;
            border-radius: 999px; margin-top: 10px; text-transform: uppercase;
            letter-spacing: .5px; border: 1px solid #d1d5db;
        }

        .barcode-section { padding: 14px 0 4px; display: flex; flex-direction: column; align-items: center; gap: 0; }
        .barcode-id-label { font-size: 9px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: .8px; margin-top: 6px; }
        #barcodeSvg { display: block; max-width: 260px; }

        .ticket-footer { background: #f9fafb; border-top: 1px solid #f3f4f6; text-align: center; padding: 12px 16px; }
        .ticket-footer p { font-size: 10.5px; color: #9ca3af; line-height: 1.6; }
        .ticket-footer strong { color: #6b7280; }

        @media print {
            body { background: #fff; padding: 0; }
            .action-bar { display: none !important; }
            .ticket { box-shadow: none; border-radius: 0; width: 100%; max-width: 280px; margin: 0 auto; }
        }
    </style>
</head>
<body>

    <div class="action-bar">
        <button class="btn btn-print" onclick="window.print()">🖨️ &nbsp;Cetak Struk</button>
        <button class="btn btn-close" onclick="window.close()">✕ &nbsp;Tutup</button>
    </div>

    <div class="ticket">
        <div class="ticket-header">
            <h1>Puskesmas Tulip</h1>
            <p>Bukti Pendaftaran Antrian</p>
        </div>

        <hr class="dashed" style="margin-top:0;">

        <div class="queue-block">
            <div class="queue-label">Nomor Antrian</div>
            <div class="queue-number">{{ $pasien->queue_number ?? 'A-???' }}</div>
            <div class="poli-badge">
                @php
                    $poliMap = [
                        'umum'   => 'Poli Umum',  'gigi'   => 'Poli Gigi',
                        'anak'   => 'Poli Anak',  'kia'    => 'Poli KIA / KB',
                        'lansia' => 'Poli Lansia', 'jiwa'  => 'Poli Jiwa',
                        'gizi'   => 'Poli Gizi',  'mata'   => 'Poli Mata',
                        'tht'    => 'Poli THT',
                    ];
                @endphp
                {{ $poliMap[$pasien->poli] ?? $pasien->poli }}
            </div>
        </div>

        <hr class="dashed">

        <div class="barcode-section">
            <svg id="barcodeSvg"></svg>
            <div class="barcode-id-label">Scan barcode untuk verifikasi</div>
        </div>

        <hr class="dashed">

        <div class="ticket-footer">
            <p>Simpan struk ini sampai pelayanan selesai.<br>
            <strong>Terima kasih atas kepercayaan Anda.</strong></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const barcodeValue = '{{ $pasien->qr_id }}';
            JsBarcode('#barcodeSvg', barcodeValue, {
                format:      'CODE128',
                width:       2.2,
                height:      60,
                displayValue: true,
                fontSize:    13,
                fontOptions: 'bold',
                font:        'Courier New',
                textMargin:  4,
                margin:      10,
                background:  '#ffffff',
                lineColor:   '#111827'
            });
        });
    </script>
</body>
</html>