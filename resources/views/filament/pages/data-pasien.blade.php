<x-filament-panels::page>
    <style>
        .dp-poli-section {
            margin-bottom: 28px;
        }
        .dp-poli-title {
            font-size: 13px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dp-poli-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }
        .dp-poli-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 14px;
        }
        .dp-poli-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 1px 6px rgba(0,0,0,.05);
        }
        .dp-poli-card-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .dp-poli-name {
            font-size: 13px;
            font-weight: 700;
            color: #f1f5f9;
        }
        .dp-poli-count {
            background: rgba(255,255,255,.12);
            color: #94a3b8;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 99px;
        }
        .dp-poli-card-body {
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            max-height: 220px;
            overflow-y: auto;
        }
        .dp-poli-card-body::-webkit-scrollbar { width: 3px; }
        .dp-poli-card-body::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
        .dp-patient-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
        }
        .dp-patient-row:hover { background: #f1f5f9; }
        .dp-queue-num {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            min-width: 44px;
            text-align: center;
            background: #e2e8f0;
            border-radius: 6px;
            padding: 3px 6px;
            flex-shrink: 0;
        }
        .dp-patient-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dp-status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .dp-dot-menunggu  { background: #f97316; }
        .dp-dot-dipanggil { background: #3b82f6; }
        .dp-dot-selesai   { background: #22c55e; }
        .dp-hadir-time {
            font-size: 10px;
            font-weight: 600;
            color: #1e40af;
            background: #dbeafe;
            border: 1px solid #bfdbfe;
            border-radius: 5px;
            padding: 2px 6px;
            white-space: nowrap;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            gap: 3px;
        }
        .dp-hadir-time svg {
            width: 10px;
            height: 10px;
            color: #2563eb;
        }
        .dp-hadir-jam {
            color: #065f46;
            background: #d1fae5;
            border-color: #a7f3d0;
        }
        .dp-hadir-jam svg {
            color: #059669;
        }
        .dp-poli-card-header-meta {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }
        .dp-empty-poli {
            text-align: center;
            padding: 32px 16px;
            color: #94a3b8;
            font-size: 12px;
            background: #f8fafc;
            border-radius: 14px;
            border: 1px dashed #e2e8f0;
        }
    </style>

    @php $poliSummary = $this->poliSummary; @endphp

    {{-- Bagian Poli Hari Ini --}}
    <div class="dp-poli-section">
        <div class="dp-poli-title">
            📋 Poli Aktif Hari Ini — {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>

        @if (count($poliSummary) > 0)
        <div class="dp-poli-grid">
            @foreach ($poliSummary as $poli)
            <div class="dp-poli-card">
                <div class="dp-poli-card-header">
                    <div>
                        <div class="dp-poli-name">{{ $poli['label'] }}</div>
                        <div class="dp-poli-card-header-meta">{{ now()->locale('id')->isoFormat('D MMM YYYY') }}</div>
                    </div>
                    <span class="dp-poli-count">{{ $poli['patients']->count() }} pasien</span>
                </div>
                <div class="dp-poli-card-body">
                    @foreach ($poli['patients'] as $p)
                    @php
                        $dotClass = match($p->status) {
                            'menunggu'  => 'dp-dot-menunggu',
                            'dipanggil' => 'dp-dot-dipanggil',
                            'selesai'   => 'dp-dot-selesai',
                            default     => 'dp-dot-menunggu',
                        };
                    @endphp
                    <div class="dp-patient-row">
                        <span class="dp-queue-num">{{ $p->queue_number }}</span>
                        <span class="dp-patient-name">{{ $p->name }}</span>
                        <span class="dp-hadir-time" title="Tanggal & Jam Hadir">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            {{ $p->created_at->setTimezone('Asia/Jakarta')->format('d/m/Y') }}
                        </span>
                        <span class="dp-hadir-time dp-hadir-jam" title="Jam Hadir">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <path stroke-linecap="round" d="M12 6v6l4 2"/>
                            </svg>
                            {{ $p->created_at->setTimezone('Asia/Jakarta')->format('H:i') }}
                        </span>
                        <span class="dp-status-dot {{ $dotClass }}" title="{{ ucfirst($p->status) }}"></span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="dp-empty-poli">
            Belum ada pasien terdaftar hari ini
        </div>
        @endif
    </div>


</x-filament-panels::page>
