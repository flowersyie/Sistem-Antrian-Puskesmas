<x-filament-panels::page>
    @push('styles')
    <style>
        .scan-layout {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .scan-layout { grid-template-columns: 1fr; }
        }

        .scan-sidebar {
            background: #111827;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 24px rgba(0,0,0,.2);
            position: sticky;
            top: 24px;
            border: 1px solid #1f2937;
        }
        .sidebar-heading {
            border-bottom: 1px solid #1f2937;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .sidebar-heading h2 {
            color: #f9fafb;
            font-size: 15px;
            font-weight: 700;
        }
        .sidebar-heading p { color: #6b7280; font-size: 12px; margin-top: 3px; }

        .scanner-area {
            background: #1f2937;
            border: 2px dashed #374151;
            border-radius: 12px;
            padding: 20px 16px;
            text-align: center;
            margin-bottom: 16px;
            transition: border-color .2s;
        }
        .scanner-area.focused { border-color: #6b7280; }
        .scanner-area svg { display: block; margin: 0 auto 10px; opacity: .5; }
        .scanner-area p {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
        }
        .scanner-area .scan-status {
            font-size: 13px;
            font-weight: 700;
            color: #9ca3af;
            margin-top: 6px;
        }
        .scanner-area.focused .scan-status { color: #f9fafb; }

        .scanner-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
            width: 1px;
            height: 1px;
        }

        .manual-wrap { margin-bottom: 10px; }
        .manual-label {
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 6px;
        }
        .manual-input {
            width: 100%;
            background: #1f2937;
            border: 1.5px solid #374151;
            border-radius: 10px;
            padding: 11px 14px;
            color: #f9fafb;
            font-size: 14px;
            font-weight: 600;
            outline: none;
            transition: border-color .2s;
        }
        .manual-input::placeholder { color: #4b5563; font-weight: 400; }
        .manual-input:focus { border-color: #6b7280; }

        .btn-submit {
            width: 100%;
            background: #fff;
            color: #111827;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s;
            letter-spacing: .3px;
        }
        .btn-submit:hover { background: #f3f4f6; }

        .scan-result {
            margin-top: 16px;
            border-radius: 10px;
            padding: 14px;
        }
        .scan-result.success {
            background: #f0fdf4;
            border: 1.5px solid #bbf7d0;
        }
        .scan-result.error {
            background: #fef2f2;
            border: 1.5px solid #fecaca;
        }
        .result-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 10px;
        }
        .scan-result.success .result-title { color: #15803d; }
        .scan-result.error   .result-title { color: #b91c1c; }
        .queue-big {
            font-size: 34px;
            font-weight: 900;
            color: #111827;
            text-align: center;
            margin: 6px 0;
            letter-spacing: -1px;
        }
        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .result-row .lbl { font-size: 11px; color: #6b7280; font-weight: 600; text-transform: uppercase; }
        .result-row .val { font-size: 13px; color: #111827; font-weight: 600; }
        .badge-called {
            background: #111827;
            color: #fff;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 18px;
        }
        .stat-card {
            background: #1f2937;
            border: 1px solid #374151;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
        }
        .stat-num { font-size: 24px; font-weight: 800; color: #f9fafb; line-height: 1; }
        .stat-lbl { font-size: 10px; color: #6b7280; margin-top: 3px; font-weight: 600; text-transform: uppercase; letter-spacing: .3px; }

        .list-panel {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(0,0,0,.07);
            border: 1px solid #e5e7eb;
        }
        .list-header {
            background: #111827;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .list-header h3 { color: #f9fafb; font-size: 14px; font-weight: 700; }
        .list-header p  { color: #6b7280; font-size: 12px; margin-top: 2px; }

        .filter-tabs {
            display: flex;
            gap: 4px;
            background: rgba(255,255,255,.07);
            padding: 3px;
            border-radius: 8px;
        }
        .filter-tab {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            color: #9ca3af;
            background: transparent;
            transition: all .15s;
        }
        .filter-tab.active-tab { background: #fff; color: #111827; }

        .patients-list {
            padding: 14px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 680px;
            overflow-y: auto;
        }
        .patients-list::-webkit-scrollbar { width: 4px; }
        .patients-list::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }

        .patient-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 14px;
            transition: border-color .15s;
        }
        .patient-card:hover { border-color: #9ca3af; }
        .patient-card.is-dipanggil {
            background: #111827;
            border-color: #374151;
        }
        .patient-card.is-dipanggil .patient-name { color: #f9fafb; }
        .patient-card.is-dipanggil .meta-pill { background: #1f2937; color: #9ca3af; border-color: #374151; }
        .patient-card.is-selesai { opacity: .55; }

        .queue-badge {
            min-width: 54px;
            height: 54px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 16px;
            flex-shrink: 0;
            border: 2px solid #e5e7eb;
            background: #fff;
            color: #111827;
        }
        .patient-card.is-dipanggil .queue-badge {
            background: #fff;
            color: #111827;
            border-color: #9ca3af;
        }
        .q-label { font-size: 8px; font-weight: 600; text-transform: uppercase; opacity: .5; margin-top: 1px; }

        .patient-info { flex: 1; min-width: 0; }
        .patient-name { font-size: 14px; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .patient-meta { font-size: 11px; margin-top: 4px; display: flex; gap: 6px; flex-wrap: wrap; }
        .meta-pill {
            background: #f3f4f6;
            color: #374151;
            padding: 2px 8px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 600;
            border: 1px solid #e5e7eb;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
            border: 1.5px solid;
        }
        .s-menunggu  { background: #f9fafb; color: #374151; border-color: #d1d5db; }
        .s-dipanggil { background: #fff;    color: #111827; border-color: #fff; }
        .s-selesai   { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
        .s-batal     { background: #fef2f2; color: #991b1b; border-color: #fecaca; }

        .empty-state { text-align: center; padding: 48px 24px; color: #9ca3af; }
        .empty-state p { font-size: 13px; margin-top: 10px; }
    </style>
    @endpush

    <div class="scan-layout">

        {{-- SIDEBAR --}}
        <aside class="scan-sidebar">
            <div class="sidebar-heading">
                <h2>Scan Barcode / QR</h2>
                <p>Arahkan alat scanner ke barcode pada struk pasien</p>
            </div>

            {{-- Area visual status scanner --}}
            <div class="scanner-area" id="scannerArea">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 18h.75v.75h-.75V18zM18 13.5h.75v.75H18v-.75zM18 18h.75v.75H18V18zM16.5 16.5h.75v.75h-.75v-.75z"/>
                </svg>
                <p>Klik area ini, lalu scan barcode</p>
                <div class="scan-status" id="scanStatus">Siap menerima scan</div>
            </div>

            {{-- Form yang menampung input scanner --}}
            <div id="scanForm">
                {{-- Input tampilan (juga menerima input dari scanner fisik) --}}
                <div class="manual-wrap">
                    <div class="manual-label">QR ID / Input Manual</div>
                    <input
                        type="text"
                        id="visibleInput"
                        class="manual-input"
                        placeholder="Scan QR atau ketik QR ID..."
                        autocomplete="off"
                        autofocus
                    >
                </div>

                <button type="button" id="btnProses" class="btn-submit">
                    <span id="btnLabel">Proses Scan</span>
                </button>
            </div>

            {{-- Hasil Scan --}}
            @if ($scannedPasien)
            <div class="scan-result success">
                <div class="result-title">Pasien Dipanggil</div>
                <div class="queue-big">{{ $scannedPasien['queue_number'] }}</div>
                <div class="result-row">
                    <span class="lbl">Nama</span>
                    <span class="val">{{ $scannedPasien['name'] }}</span>
                </div>
                <div class="result-row">
                    <span class="lbl">Poli</span>
                    <span class="val">{{ $scannedPasien['poli'] }}</span>
                </div>
                <div class="result-row">
                    <span class="lbl">Penjamin</span>
                    <span class="val">{{ $scannedPasien['penjamin'] }}</span>
                </div>
                <div class="result-row">
                    <span class="lbl">Status</span>
                    <span class="badge-called">Dipanggil</span>
                </div>
            </div>
            @endif

            @if ($scanError)
            <div class="scan-result error">
                <div class="result-title">Tidak Ditemukan</div>
                <p style="font-size:13px; color:#b91c1c;">{{ $scanError }}</p>
            </div>
            @endif

            {{-- Statistik --}}
            @php $stats = $this->statistics; @endphp
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-num">{{ $stats['total'] }}</div>
                    <div class="stat-lbl">Total</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num">{{ $stats['menunggu'] }}</div>
                    <div class="stat-lbl">Menunggu</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num">{{ $stats['dipanggil'] }}</div>
                    <div class="stat-lbl">Dipanggil</div>
                </div>
                <div class="stat-card">
                    <div class="stat-num">{{ $stats['selesai'] }}</div>
                    <div class="stat-lbl">Selesai</div>
                </div>
            </div>
        </aside>

        {{-- DAFTAR PASIEN --}}
        <div class="list-panel">
            <div class="list-header">
                <div>
                    <h3>Daftar Antrian Hari Ini</h3>
                    <p>{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="filter-tabs">
                    @foreach (['all' => 'Semua', 'menunggu' => 'Menunggu', 'dipanggil' => 'Dipanggil', 'selesai' => 'Selesai'] as $key => $label)
                    <button
                        class="filter-tab {{ $filterStatus === $key ? 'active-tab' : '' }}"
                        wire:click="$set('filterStatus', '{{ $key }}')"
                    >{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            @php
                $patients = $this->pasienList;
                $poliMap = [
                    'umum'=>'Poli Umum','gigi'=>'Poli Gigi','anak'=>'Poli Anak',
                    'kia'=>'Poli KIA/KB','lansia'=>'Poli Lansia','jiwa'=>'Poli Jiwa',
                    'gizi'=>'Poli Gizi','mata'=>'Poli Mata','tht'=>'Poli THT',
                ];
            @endphp

            <div class="patients-list">
                @forelse ($patients as $p)
                @php
                    $cardClass    = $p->status === 'dipanggil' ? 'is-dipanggil' : ($p->status === 'selesai' ? 'is-selesai' : '');
                    $statusLabel  = match($p->status) {
                        'menunggu'  => 'Menunggu',
                        'dipanggil' => 'Dipanggil',
                        'selesai'   => 'Selesai',
                        'batal'     => 'Batal',
                        default     => $p->status,
                    };
                    $penjaminLabel = match($p->penjamin ?? '') {
                        'bpjs'          => 'BPJS',
                        'asuransi_lain' => 'Asuransi',
                        'umum'          => 'Umum',
                        default         => $p->penjamin ?? '-',
                    };
                @endphp
                <div class="patient-card {{ $cardClass }}">
                    <div class="queue-badge">
                        {{ $p->queue_number }}
                        <span class="q-label">Antrian</span>
                    </div>
                    <div class="patient-info">
                        <div class="patient-name">{{ $p->name }}</div>
                        <div class="patient-meta">
                            <span class="meta-pill">{{ $poliMap[$p->poli] ?? $p->poli }}</span>
                            <span class="meta-pill">{{ $penjaminLabel }}</span>
                            @if ($p->nik)
                            <span class="meta-pill">NIK: {{ \Illuminate\Support\Str::mask((string)$p->nik, '*', 4, -4) }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="status-badge s-{{ $p->status }}">{{ $statusLabel }}</span>
                </div>
                @empty
                <div class="empty-state">
                    <svg width="40" height="40" fill="none" stroke="#9ca3af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    <p>Belum ada pasien terdaftar hari ini</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const scannerArea  = document.getElementById('scannerArea');
        const scanStatus   = document.getElementById('scanStatus');
        const visibleInput = document.getElementById('visibleInput');
        const btnProses    = document.getElementById('btnProses');
        const btnLabel     = document.getElementById('btnLabel');

        function doScan() {
            const val = visibleInput.value.trim();
            if (val === '') return;

            btnLabel.textContent = 'Memproses...';
            btnProses.disabled   = true;

            @this.set('barcodeInput', val).then(() => {
                @this.call('processScan');
                visibleInput.value = '';
            });
        }

        visibleInput.addEventListener('input', function () {
            @this.set('barcodeInput', this.value);
        });

        visibleInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                doScan();
            }
        });

        btnProses.addEventListener('click', function () {
            doScan();
        });

        scannerArea.addEventListener('click', function () {
            visibleInput.focus();
        });

        visibleInput.addEventListener('focus', function () {
            scannerArea.classList.add('focused');
            scanStatus.textContent = 'Siap — scan sekarang';
        });

        visibleInput.addEventListener('blur', function () {
            scannerArea.classList.remove('focused');
            scanStatus.textContent = 'Klik area ini untuk scan';
        });

        visibleInput.focus();
    });

    document.addEventListener('livewire:updated', function () {
        const el  = document.getElementById('visibleInput');
        const btn = document.getElementById('btnProses');
        const lbl = document.getElementById('btnLabel');
        if (el)  { el.value = ''; el.focus(); }
        if (btn) btn.disabled = false;
        if (lbl) lbl.textContent = 'Proses Scan';
    });
    </script>
</x-filament-panels::page>

