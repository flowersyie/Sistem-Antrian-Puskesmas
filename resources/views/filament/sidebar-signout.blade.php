@auth
<div style="padding: 16px; margin-bottom: 2rem;">
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
