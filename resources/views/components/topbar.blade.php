<header class="sticky top-0 z-30 h-[73px] border-b border-slate-800 bg-slate-950/90 backdrop-blur">

    <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-4">

            <button
                id="open-sidebar"
                type="button"
                class="rounded-xl border border-slate-800 bg-slate-900 p-2.5 text-slate-400 hover:bg-slate-800 hover:text-white lg:hidden"
            >
                ☰
            </button>

            <div>
                <p class="hidden text-xs text-slate-500 sm:block">
                    Business Management
                </p>

                <h2 class="text-sm font-semibold text-white sm:text-base">
                    NexPOS Dashboard
                </h2>
            </div>

        </div>


        <div class="flex items-center gap-2 sm:gap-4">

            {{-- Notification --}}
            <button
                type="button"
                class="relative rounded-xl border border-slate-800 bg-slate-900 p-2.5 text-slate-400 transition hover:bg-slate-800 hover:text-white"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 17h5l-1.5-2V10a6.5 6.5 0 00-13 0v5L4 17h5m6 0a3 3 0 01-6 0"
                    />
                </svg>

                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-blue-500"></span>
            </button>


            {{-- Profile --}}
            <div class="hidden items-center gap-3 border-l border-slate-800 pl-4 sm:flex">

                <div class="text-right">

                    <p class="text-sm font-medium text-white">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Administrator
                    </p>

                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

            </div>

        </div>

    </div>

</header>