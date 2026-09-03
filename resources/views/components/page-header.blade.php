@props([
    'title',
    'description' => null,
])

<div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

    <div>

        <p class="text-sm font-semibold text-blue-600">
            NexPOS
        </p>

        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
            {{ $title }}
        </h1>

        @if($description)
            <p class="mt-2 text-sm text-slate-500">
                {{ $description }}
            </p>
        @endif

    </div>


    <div class="flex flex-wrap gap-3">

        <a
            href="#"
            class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-blue-200 transition hover:bg-blue-700"
        >
            <span class="text-lg leading-none">+</span>
            New Sale
        </a>

        <a
            href="#"
            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50"
        >
            <span class="text-lg leading-none">+</span>
            Add Product
        </a>

    </div>

</div>
