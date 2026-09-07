
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>@yield('title', 'NexPOS')</title>

    {{-- NexPOS Logo --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/NexPOSLogo.png') }}"
    >

    <link
        rel="apple-touch-icon"
        href="{{ asset('images/NexPOSLogo.png') }}"
    >

    {{-- =========================================================
         NEXPOS CSS
         NO VITE
    ========================================================== --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/nexpos.css') }}"
    >

    {{-- =========================================================
         NEXPOS JAVASCRIPT
         NO VITE
    ========================================================== --}}
    <script
        src="{{ asset('js/nexpos.js') }}"
        defer
    ></script>

    @stack('styles')
</head>


<body>

<div class="nexpos-app">

    {{-- =========================================================
         MOBILE OVERLAY
    ========================================================== --}}
    <div
        id="mobileOverlay"
        class="mobile-overlay"
    ></div>


    {{-- =========================================================
         SIDEBAR
         
         IMPORTANT:
         The sidebar is already located at:
         
         resources/views/components/sidebar.blade.php
         
         We are loading it here instead of duplicating it.
    ========================================================== --}}
    <x-sidebar />


    {{-- =========================================================
         MAIN AREA
    ========================================================== --}}
    <div
        id="mainArea"
        class="main-area"
    >

        {{-- =====================================================
             TOPBAR
        ====================================================== --}}
        <header class="topbar">

            <div class="topbar-left">

                {{-- Mobile Menu Button --}}
                <button
                    type="button"
                    id="mobileMenuButton"
                    class="mobile-menu-button"
                    aria-label="Open menu"
                >
                    ☰
                </button>


                {{-- Page Heading --}}
                <div>

                    <p class="date-text">
                        {{ now()->format('l, F j, Y') }}
                    </p>

                    <h1>
                        @yield('page-title', 'NexPOS')
                    </h1>

                </div>

            </div>


            {{-- =================================================
                 TOPBAR RIGHT
            ================================================== --}}
            <div class="topbar-right">

                {{-- System Status --}}
                <div class="system-status">

                    <span></span>

                    System Online

                </div>


                {{-- Notification --}}
                <button
                    type="button"
                    class="notification-button"
                    aria-label="Notifications"
                >
                    🔔
                </button>

            </div>

        </header>


        {{-- =====================================================
             PAGE CONTENT
        ====================================================== --}}
        <main class="page-content">

            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}
            @if(session('success'))

                <div class="flash-message success">

                    <span>✓</span>

                    {{ session('success') }}

                </div>

            @endif


            {{-- =================================================
                 ERROR MESSAGE
            ================================================== --}}
            @if(session('error'))

                <div class="flash-message error">

                    <span>!</span>

                    {{ session('error') }}

                </div>

            @endif


            {{-- =================================================
                 VALIDATION ERRORS
            ================================================== --}}
            @if($errors->any())

                <div class="flash-message error">

                    <span>!</span>

                    <div>

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- =================================================
                 CHILD PAGE CONTENT
                 
                 Dashboard, POS, Products, Inventory, etc.
            ================================================== --}}
            @yield('content')

        </main>

    </div>

</div>


{{-- =========================================================
     PAGE-SPECIFIC SCRIPTS
========================================================= --}}
@stack('scripts')


</body>

</html>
