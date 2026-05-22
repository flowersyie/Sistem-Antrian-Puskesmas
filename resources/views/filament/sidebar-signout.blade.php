@auth
<div style="padding: 12px 16px 16px; margin-bottom: 2rem;">

    {{-- Link Profil Saya --}}
    <a href="{{ route('filament.admin.pages.profile') }}" style="
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 8px;
        color: rgb(209,213,219);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid transparent;
    "
    onmouseover="this.style.background='rgba(255,255,255,0.07)';this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='white';"
    onmouseout="this.style.background='transparent';this.style.borderColor='transparent';this.style.color='rgb(209,213,219)';"
    >
        <svg style="width:16px;height:16px;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <span>Profil Saya</span>
    </a>

    {{-- Admin Info Card --}}
    <div style="
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        margin-bottom: 10px;
        border-radius: 12px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
    ">
        {{-- Avatar Inisial --}}
        <div style="
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            text-transform: uppercase;
        ">
            {{ mb_substr(auth()->user()->name, 0, 1) }}
        </div>

        {{-- Nama & Email --}}
        <div style="min-width: 0; flex: 1;">
            <div style="
                font-size: 13px;
                font-weight: 600;
                color: rgb(243, 244, 246);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            ">
                {{ auth()->user()->name }}
            </div>
            <div style="
                font-size: 11px;
                color: rgb(156, 163, 175);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            ">
                {{ auth()->user()->email }}
            </div>
        </div>
    </div>

    {{-- Tombol Logout --}}
    <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
        @csrf
        <button
            type="submit"
            style="
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 8px 16px;
                border-radius: 9999px;
                border: 1px solid rgba(156,163,175,0.5);
                background: transparent;
                color: rgb(209,213,219);
                font-size: 12px;
                font-weight: 600;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                cursor: pointer;
                transition: all 0.2s;
            "
            onmouseover="this.style.borderColor='white';this.style.color='white';"
            onmouseout="this.style.borderColor='rgba(156,163,175,0.5)';this.style.color='rgb(209,213,219)';"
        >
            <svg style="width:16px;height:16px;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
            <span style="line-height:1;">Logout</span>
        </button>
    </form>
</div>
@endauth
