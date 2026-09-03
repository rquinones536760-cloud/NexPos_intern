@props([
    'title',
    'value',
    'change' => null,
    'icon' => null,
])

<div class="min-w-0 rounded-2xl border border-slate-800 bg-slate-900/70 p-5 shadow-sm">
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <p class="truncate text-sm font-medium text-slate-500">
                {{ $title }}
            </p>

            <p class="mt-2 truncate text-2xl font-bold tracking-tight text-white">
                {{ $value }}
            </p>

            @if($change)
                <p class="mt-2 truncate text-xs text-slate-500">
                    {{ $change }}
                </p>
            @endif
        </div>

        @if($icon)
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-500/10 text-sm text-blue-400">
                {{ $icon }}
            </div>
        @endif
    </div>
</div>