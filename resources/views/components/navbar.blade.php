```blade
<header class="sticky top-0 z-40 h-20 border-b border-white/10 bg-slate-950/95 backdrop-blur-xl">

    <div class="flex h-full items-center justify-between px-5 sm:px-8">

        <div>

            <p class="text-xs text-slate-600">
                NexPOS
            </p>

            <h1 class="text-lg font-semibold text-white">
                @yield('page-title', 'Dashboard')
            </h1>

        </div>


        <div class="flex items-center gap-4">

            <div class="hidden text-right sm:block">

                <p class="text-xs text-slate-500">
                    {{ now()->format('l, F j, Y') }}
                </p>

            </div>


            <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/[0.03] text-sm font-semibold text-blue-400">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

        </div>

    </div>

</header>
