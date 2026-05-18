<x-filament-widgets::widget>
    <style>
        .dsw-wrap {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            border-radius: 20px;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            border: 1px solid #1e293b;
            box-shadow: 0 8px 32px rgba(0,0,0,.35);
            flex-wrap: wrap;
        }
        .dsw-clock-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .dsw-clock-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.06);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.08);
            flex-shrink: 0;
        }
        .dsw-clock-icon svg { opacity: .7; }
        .dsw-time {
            font-size: 42px;
            font-weight: 900;
            color: #f1f5f9;
            line-height: 1;
            letter-spacing: 0;
            font-variant-numeric: tabular-nums;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .dsw-seg {
            display: inline-block;
            min-width: 58px;
            text-align: center;
        }
        .dsw-colon {
            animation: blink 1s step-start infinite;
            display: inline-block;
            color: #475569;
            line-height: 1;
            margin-bottom: 4px;
        }
        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.2} }
        .dsw-date {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 5px;
            font-weight: 500;
        }
        .dsw-date span { color: #f1f5f9; font-weight: 700; }
        .dsw-stats {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .dsw-stat {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 14px;
            padding: 14px 20px;
            text-align: center;
            min-width: 80px;
            transition: background .2s;
        }
        .dsw-stat:hover { background: rgba(255,255,255,.09); }
        .dsw-stat-num {
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
        }
        .dsw-stat-lbl {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-top: 5px;
            color: #64748b;
        }
        .dsw-stat.s-total   .dsw-stat-num { color: #e2e8f0; }
        .dsw-stat.s-wait    .dsw-stat-num { color: #fbbf24; }
        .dsw-stat.s-called  .dsw-stat-num { color: #60a5fa; }
        .dsw-stat.s-done    .dsw-stat-num { color: #34d399; }
        .dsw-live {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-top: 6px;
        }
        .dsw-live-dot {
            width: 8px; height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse-dot 1.5s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%,100% { opacity:1; transform:scale(1); }
            50%      { opacity:.5; transform:scale(.7); }
        }
    </style>

    @php
        $now   = \Carbon\Carbon::now('Asia/Jakarta');
        $stats = $this->getStats();
        $hari  = $now->locale('id')->isoFormat('dddd');
        $tgl   = $now->locale('id')->isoFormat('D MMMM YYYY');
        $hh    = $now->format('H');
        $mm    = $now->format('i');
        $ss    = $now->format('s');
    @endphp

    <div class="dsw-wrap">

        {{-- Jam & Tanggal — Alpine.js clock (tahan Livewire re-render) --}}
        <div class="dsw-clock-section"
             x-data="{
                hh: '--', mm: '--', ss: '--',
                pad(n) { return ('0' + n).slice(-2); },
                tick() {
                    var n = new Date();
                    // UTC + 7 jam = WIB (Asia/Jakarta)
                    var t = new Date(n.getTime() + 7 * 3600000);
                    this.hh = this.pad(t.getUTCHours());
                    this.mm = this.pad(t.getUTCMinutes());
                    this.ss = this.pad(t.getUTCSeconds());
                },
                init() {
                    this.tick();
                    // $cleanup otomatis hapus interval saat Livewire re-render
                    // sehingga tidak ada interval bertumpuk → detik tidak cepat
                    var id = setInterval(() => this.tick(), 1000);
                    this.$cleanup(() => clearInterval(id));
                }
             }"
             x-init="init()">

            <div class="dsw-clock-icon">
                <svg width="26" height="26" fill="none" stroke="#94a3b8" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                </svg>
            </div>

            <div>
                <div class="dsw-time">
                    <span class="dsw-seg" x-text="hh"></span>
                    <span class="dsw-colon">:</span>
                    <span class="dsw-seg" x-text="mm"></span>
                    <span class="dsw-colon">:</span>
                    <span class="dsw-seg" x-text="ss"></span>
                    <span style="font-size:16px;font-weight:700;color:#475569;letter-spacing:0;margin-left:4px;align-self:flex-end;margin-bottom:4px;">WIB</span>
                </div>
                <div class="dsw-date">
                    <span>{{ $hari }}</span>, {{ $tgl }}
                </div>
                <div class="dsw-live">
                    <div class="dsw-live-dot"></div>
                    Live
                </div>
            </div>
        </div>

        {{-- Statistik Antrian --}}
        <div class="dsw-stats">
            <div class="dsw-stat s-total">
                <div class="dsw-stat-num">{{ $stats['total'] }}</div>
                <div class="dsw-stat-lbl">Total</div>
            </div>
            <div class="dsw-stat s-wait">
                <div class="dsw-stat-num">{{ $stats['menunggu'] }}</div>
                <div class="dsw-stat-lbl">Menunggu</div>
            </div>
            <div class="dsw-stat s-called">
                <div class="dsw-stat-num">{{ $stats['dipanggil'] }}</div>
                <div class="dsw-stat-lbl">Dipanggil</div>
            </div>
            <div class="dsw-stat s-done">
                <div class="dsw-stat-num">{{ $stats['selesai'] }}</div>
                <div class="dsw-stat-lbl">Selesai</div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>