<x-filament-widgets::widget>
    <style>
        .phw-panel {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0,0,0,.07);
            border: 1px solid #e5e7eb;
        }


        .phw-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }
        .phw-header-left h3 {
            color: #f1f5f9;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: -.2px;
        }
        .phw-header-left p {
            color: #64748b;
            font-size: 12px;
            margin-top: 3px;
        }


        .phw-tabs {
            display: flex;
            gap: 4px;
            background: rgba(255,255,255,.06);
            padding: 4px;
            border-radius: 10px;
        }
        .phw-tab {
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            color: #94a3b8;
            background: transparent;
            transition: all .15s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .phw-tab.active {
            background: #fff;
            color: #0f172a;
        }
        .phw-tab .phw-badge {
            background: rgba(255,255,255,.15);
            color: #94a3b8;
            border-radius: 99px;
            padding: 1px 6px;
            font-size: 10px;
        }
        .phw-tab.active .phw-badge {
            background: #e5e7eb;
            color: #374151;
        }


        .phw-list {
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 520px;
            overflow-y: auto;
        }
        .phw-list::-webkit-scrollbar { width: 4px; }
        .phw-list::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }


        .phw-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            border-radius: 14px;
            border: 1.5px solid #e5e7eb;
            background: #f8fafc;
            transition: border-color .15s, transform .1s;
        }
        .phw-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }


        .phw-card.st-dipanggil {
            background: #0f172a;
            border-color: #334155;
        }
        .phw-card.st-dipanggil .phw-name { color: #f1f5f9; }
        .phw-card.st-dipanggil .phw-sub  { color: #64748b; }
        .phw-card.st-selesai { opacity: .55; }


        .phw-queue {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: #fff;
            border: 2px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 15px;
            color: #0f172a;
            flex-shrink: 0;
        }
        .st-dipanggil .phw-queue {
            background: #1e293b;
            border-color: #475569;
            color: #f1f5f9;
        }
        .phw-q-lbl { font-size: 7px; text-transform: uppercase; font-weight: 600; opacity: .5; margin-top: 1px; }


        .phw-info { flex: 1; min-width: 0; }
        .phw-name {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .phw-sub {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        .phw-pill {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 600;
            color: #475569;
        }
        .st-dipanggil .phw-pill {
            background: #1e293b;
            border-color: #334155;
            color: #94a3b8;
        }


        .phw-status {
            padding: 4px 11px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            border: 1.5px solid;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .phw-s-menunggu  { background: #f8fafc; color: #475569; border-color: #e2e8f0; }
        .phw-s-dipanggil { background: #3b82f6; color: #fff;    border-color: #3b82f6; }
        .phw-s-selesai   { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }
        .phw-s-batal     { background: #fef2f2; color: #991b1b; border-color: #fecaca; }


        .phw-empty {
            text-align: center;
            padding: 48px 24px;
            color: #94a3b8;
        }
        .phw-empty p { font-size: 13px; margin-top: 10px; }


        .phw-time {
            font-size: 11px;
            color: #94a3b8;
            white-space: nowrap;
            flex-shrink: 0;
        }
    </style>

    @php
        $patients = $this->pasienList;
        $counts   = $this->getCountByStatus();
        $poliMap  = [
            'umum'   => 'Poli Umum',
            'gigi'   => 'Poli Gigi',
            'anak'   => 'Poli Anak',
            'kia'    => 'Poli KIA/KB',
            'lansia' => 'Poli Lansia',
            'jiwa'   => 'Poli Jiwa',
            'gizi'   => 'Poli Gizi',
            'mata'   => 'Poli Mata',
            'tht'    => 'Poli THT',
        ];
    @endphp

    <div class="phw-panel">


        <div class="phw-header">
            <div class="phw-header-left">
                <h3>📋 Daftar Pasien Hari Ini</h3>
                <p>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</p>
            </div>

            <div class="phw-tabs">
                @foreach ([
                    'all'       => 'Semua',
                    'menunggu'  => 'Menunggu',
                    'dipanggil' => 'Dipanggil',
                    'selesai'   => 'Selesai',
                ] as $key => $label)
                <button
                    class="phw-tab {{ $filterStatus === $key ? 'active' : '' }}"
                    wire:click="$set('filterStatus', '{{ $key }}')"
                >
                    {{ $label }}
                    <span class="phw-badge">{{ $counts[$key] ?? 0 }}</span>
                </button>
                @endforeach
            </div>
        </div>


        <div class="phw-list">
            @forelse ($patients as $p)
            @php
                $cardClass = match($p->status) {
                    'dipanggil' => 'st-dipanggil',
                    'selesai'   => 'st-selesai',
                    default     => '',
                };
                $statusLabel = match($p->status) {
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
            <div class="phw-card {{ $cardClass }}">

                <div class="phw-queue">
                    {{ $p->queue_number }}
                    <span class="phw-q-lbl">No.</span>
                </div>


                <div class="phw-info">
                    <div class="phw-name">{{ $p->name }}</div>
                    <div class="phw-sub">
                        <span class="phw-pill">{{ $poliMap[$p->poli] ?? $p->poli }}</span>
                        <span class="phw-pill">{{ $penjaminLabel }}</span>
                        @if ($p->nik)
                        <span class="phw-pill">NIK: {{ \Illuminate\Support\Str::mask((string)$p->nik, '*', 4, -4) }}</span>
                        @endif
                    </div>
                </div>


                <div class="phw-time">
                    {{ $p->created_at->format('H:i') }}
                </div>


                <span class="phw-status phw-s-{{ $p->status }}">{{ $statusLabel }}</span>
            </div>
            @empty
            <div class="phw-empty">
                <svg width="44" height="44" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
                </svg>
                <p>Belum ada pasien terdaftar hari ini</p>
            </div>
            @endforelse
        </div>
    </div>
</x-filament-widgets::widget>
