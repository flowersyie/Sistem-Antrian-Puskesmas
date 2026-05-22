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

        .action-bar { 
            display: flex; 
            gap: 12px; 
            margin-bottom: 24px; 
        }

        .btn { 
            padding: 10px 24px; 
            border: none; 
            border-radius: 8px; 
            font-size: 14px; 
            font-weight: 600; 
            cursor: pointer; 
            transition: opacity .2s; 
        }

        .btn:hover { 
            opacity: .85; 
        }

        .btn-print { 
            background: #10b981; 
            color: #fff; 
        }

        .btn-close  { 
            background: #6b7280; 
            color: #fff; 
        }

        .ticket { width: 300px; background: #fff; border-radius: 16px; box-shadow: 0 8px 40px rgba(0,0,0,.15); overflow: hidden; }

        .ticket-header { background: #ffffff; color: #000000; text-align: center; padding: 20px 16px 14px; }
        .ticket-header h1 { font-size: 19px; font-weight: 900; letter-spacing: .5px; text-transform: uppercase; color: #000000; }
        .ticket-header p  { font-size: 12px; font-weight: 700; margin-top: 4px; color: #000000; } 

        .dashed { border: none; border-top: 1.5px dashed #000000; margin: 0 12px; }

        .queue-block { text-align: center; padding: 22px 8px 20px; }
        .queue-label { font-size: 12px; font-weight: 800; color: #000000; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; } 
        
        .queue-number { 
            font-size: 48px; 
            font-weight: 900; 
            color: #000000; 
            line-height: 1.1; 
            letter-spacing: -1px;
            white-space: nowrap; 
        }
        
        .poli-badge {
            display: inline-block; background: #ffffff; color: #000000;
            font-size: 13px; font-weight: 800; padding: 5px 16px;
            border-radius: 999px; margin-top: 12px; text-transform: uppercase;
            letter-spacing: .5px; border: 2px solid #000000;
        }

        .barcode-section { padding: 14px 0 16px; display: flex; flex-direction: column; align-items: center; gap: 0; }
        .barcode-id-label { font-size: 10px; font-weight: 800; color: #000000; text-transform: uppercase; letter-spacing: .8px; margin-top: 6px; } 
        #barcodeSvg { display: block; max-width: 100%; }

        .ticket-footer { background: #ffffff; text-align: center; padding: 16px 12px; }
        .ticket-footer p { font-size: 11px; color: #000000; font-weight: 700; line-height: 1.6; } 
        .ticket-footer strong { color: #000000; font-weight: 900; }

        @media print {
            @page {
                margin: 0;
                size: 58mm auto;
            }
            body { 
                background: #fff; 
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                min-height: unset;
            }
            .action-bar { display: none !important; }
            
            .ticket { 
                box-shadow: none; 
                border-radius: 0; 
                width: 58mm;
                max-width: 58mm;
                margin: 0 auto; 
            }
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
                width:       1.8,
                height:      50,
                displayValue: true,
                fontSize:    13, 
                fontOptions: 'bold',
                font:        'Courier New',
                textMargin:  4,
                margin:      5,
                background:  '#ffffff',
                lineColor:   '#000000' 
            });
        });
    </script>
</body>
</html>