<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-slate-800 bg-slate-950 transition-transform duration-300 lg:translate-x-0"
>

    {{-- Logo --}}
    <div class="flex h-[73px] items-center justify-between border-b border-slate-800 px-6">

        <a
            href="{{ url('/dashboard') }}"
            class="flex items-center gap-3"
        >

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 shadow-lg shadow-blue-600/20">
                <svg
                    class="h-5 w-5 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M8 11h8M8 15h5"
                    />
                </svg>
            </div>

            <div>
                <h1 class="text-lg font-bold tracking-tight text-white">
                    NexPOS
                </h1>

                <p class="text-xs text-slate-500">
                    Business Management
                </p>
            </div>

        </a>

        <button
            id="close-sidebar"
            type="button"
            class="rounded-lg p-2 text-slate-400 hover:bg-slate-800 hover:text-white lg:hidden"
        >
            ✕
        </button>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <p class="mb-3 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
            Overview
        </p>

        <div class="space-y-1">

            <a
                href="{{ url('/dashboard') }}"
                class="flex items-center gap-3 rounded-xl bg-blue-600/10 px-3 py-3 text-sm font-medium text-blue-400"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    ▣
                </span>

                Dashboard
            </a>

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    $
                </span>

                Sales
            </a>

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    🛒
                </span>

                Orders
            </a>

        </div>


        <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
            Management
        </p>

        <div class="space-y-1">

            <a
                href="#"
                class="flex items-center justify-between rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex items-center gap-3">
                    <span class="flex h-5 w-5 items-center justify-center">
                        ▦
                    </span>

                    Products
                </span>
            </a>

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    ◫
                </span>

                Inventory
            </a>

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    ♙
                </span>

                Customers
            </a>

        </div>


        <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
            Analytics
        </p>

        <div class="space-y-1">

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    ◒
                </span>

                Reports
            </a>

        </div>


        <p class="mb-3 mt-8 px-3 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
            System
        </p>

        <div class="space-y-1">

            <a
                href="#"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <span class="flex h-5 w-5 items-center justify-center">
                    ⚙
                </span>

                Settings
            </a>

        </div>

    </nav>


    {{-- User --}}
    <div class="border-t border-slate-800 p-4">

        <div class="flex items-center gap-3 rounded-xl bg-slate-900 p-3">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>

            <div class="min-w-0 flex-1">

                <p class="truncate text-sm font-semibold text-white">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </p>

                <p class="truncate text-xs text-slate-500">
                    Administrator
                </p>

            </div>

        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
            class="mt-2"
        >
            @csrf

            <button
                type="submit"
                class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition hover:bg-red-500/10 hover:text-red-400"
            >
                <span>↪</span>
                Sign out
            </button>
        </form>

    </div>

</aside>