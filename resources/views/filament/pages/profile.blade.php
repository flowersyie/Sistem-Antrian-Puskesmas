<x-filament-panels::page>

    {{-- Header Avatar --}}
    <div style="
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 24px;
        border-radius: 16px;
        background: rgba(99,102,241,0.12);
        border: 1px solid rgba(99,102,241,0.25);
        margin-bottom: 24px;
    ">
        <div style="
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(99,102,241,0.4);
        ">
            {{ mb_substr(auth()->user()->name, 0, 1) }}
        </div>
        <div>
            <div style="font-size: 20px; font-weight: 700; color: rgb(243,244,246);">
                {{ auth()->user()->name }}
            </div>
            <div style="font-size: 14px; color: rgb(156,163,175); margin-top: 2px;">
                {{ auth()->user()->email }}
            </div>
            <div style="
                display: inline-block;
                margin-top: 6px;
                padding: 2px 10px;
                border-radius: 9999px;
                background: rgba(99,102,241,0.2);
                color: #a5b4fc;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                border: 1px solid rgba(99,102,241,0.3);
            ">Administrator</div>
        </div>
    </div>

    {{-- Form Ubah Nama & Email --}}
    <div style="
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
        overflow: hidden;
        margin-bottom: 20px;
        background: rgba(255,255,255,0.03);
    ">
        <div style="
            padding: 14px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgb(229,231,235);
        ">
            <x-heroicon-o-user-circle style="width:20px;height:20px;color:#818cf8;" />
            Informasi Akun
        </div>
        <div style="padding: 20px;">
            <form wire:submit="saveProfile">
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:rgb(156,163,175); margin-bottom:6px;">
                        Nama Petugas <span style="color:#f87171;">*</span>
                    </label>
                    <input
                        type="text"
                        wire:model="name"
                        placeholder="Nama lengkap petugas"
                        style="
                            width: 100%;
                            padding: 9px 14px;
                            border-radius: 8px;
                            border: 1px solid rgba(255,255,255,0.12);
                            font-size: 14px;
                            outline: none;
                            box-sizing: border-box;
                            background: rgba(255,255,255,0.05);
                            color: rgb(243,244,246);
                        "
                        onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.25)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none'"
                    />
                    @error('name')
                        <div style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:rgb(156,163,175); margin-bottom:6px;">
                        Email <span style="color:#f87171;">*</span>
                    </label>
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="email@puskesmas.go.id"
                        style="
                            width: 100%;
                            padding: 9px 14px;
                            border-radius: 8px;
                            border: 1px solid rgba(255,255,255,0.12);
                            font-size: 14px;
                            outline: none;
                            box-sizing: border-box;
                            background: rgba(255,255,255,0.05);
                            color: rgb(243,244,246);
                        "
                        onfocus="this.style.borderColor='#6366f1';this.style.boxShadow='0 0 0 2px rgba(99,102,241,0.25)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none'"
                    />
                    @error('email')
                        <div style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" style="
                    padding: 9px 22px;
                    border-radius: 8px;
                    background: linear-gradient(135deg, #6366f1, #8b5cf6);
                    color: white;
                    font-size: 14px;
                    font-weight: 600;
                    border: none;
                    cursor: pointer;
                    transition: opacity 0.2s;
                "
                onmouseover="this.style.opacity='0.85'"
                onmouseout="this.style.opacity='1'"
                >
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    {{-- Form Ubah Password --}}
    <div style="
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.08);
        overflow: hidden;
        background: rgba(255,255,255,0.03);
    ">
        <div style="
            padding: 14px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-weight: 600;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgb(229,231,235);
        ">
            <x-heroicon-o-lock-closed style="width:20px;height:20px;color:#f87171;" />
            Ubah Kata Sandi
        </div>
        <div style="padding: 20px;">
            <form wire:submit="savePassword">
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:rgb(156,163,175); margin-bottom:6px;">
                        Kata Sandi Saat Ini <span style="color:#f87171;">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model="current_password"
                        placeholder="••••••••"
                        style="
                            width: 100%;
                            padding: 9px 14px;
                            border-radius: 8px;
                            border: 1px solid rgba(255,255,255,0.12);
                            font-size: 14px;
                            outline: none;
                            box-sizing: border-box;
                            background: rgba(255,255,255,0.05);
                            color: rgb(243,244,246);
                        "
                        onfocus="this.style.borderColor='#ef4444';this.style.boxShadow='0 0 0 2px rgba(239,68,68,0.2)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none'"
                    />
                    @error('current_password')
                        <div style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:rgb(156,163,175); margin-bottom:6px;">
                        Kata Sandi Baru <span style="color:#f87171;">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model="new_password"
                        placeholder="Minimal 8 karakter"
                        style="
                            width: 100%;
                            padding: 9px 14px;
                            border-radius: 8px;
                            border: 1px solid rgba(255,255,255,0.12);
                            font-size: 14px;
                            outline: none;
                            box-sizing: border-box;
                            background: rgba(255,255,255,0.05);
                            color: rgb(243,244,246);
                        "
                        onfocus="this.style.borderColor='#ef4444';this.style.boxShadow='0 0 0 2px rgba(239,68,68,0.2)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none'"
                    />
                    @error('new_password')
                        <div style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display:block; font-size:13px; font-weight:600; color:rgb(156,163,175); margin-bottom:6px;">
                        Konfirmasi Kata Sandi Baru <span style="color:#f87171;">*</span>
                    </label>
                    <input
                        type="password"
                        wire:model="new_password_confirmation"
                        placeholder="Ulangi kata sandi baru"
                        style="
                            width: 100%;
                            padding: 9px 14px;
                            border-radius: 8px;
                            border: 1px solid rgba(255,255,255,0.12);
                            font-size: 14px;
                            outline: none;
                            box-sizing: border-box;
                            background: rgba(255,255,255,0.05);
                            color: rgb(243,244,246);
                        "
                        onfocus="this.style.borderColor='#ef4444';this.style.boxShadow='0 0 0 2px rgba(239,68,68,0.2)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.12)';this.style.boxShadow='none'"
                    />
                    @error('new_password_confirmation')
                        <div style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" style="
                    padding: 9px 22px;
                    border-radius: 8px;
                    background: linear-gradient(135deg, #ef4444, #dc2626);
                    color: white;
                    font-size: 14px;
                    font-weight: 600;
                    border: none;
                    cursor: pointer;
                    transition: opacity 0.2s;
                "
                onmouseover="this.style.opacity='0.85'"
                onmouseout="this.style.opacity='1'"
                >
                    Ubah Kata Sandi
                </button>
            </form>
        </div>
    </div>

</x-filament-panels::page>
