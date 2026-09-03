<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'NexPOS')</title>

    <link rel="icon" type="image/png"
          href="{{ asset('images/NexPOSLogo.png') }}">

    <link rel="apple-touch-icon"
          href="{{ asset('images/NexPOSLogo.png') }}">

    {{-- NO VITE --}}
    <link rel="stylesheet"
          href="{{ asset('css/nexpos.css') }}">

    <script
        src="{{ asset('js/nexpos.js') }}"
        defer>
    </script>
</head>

<body>

<div class="nexpos-app">

    {{-- Mobile Overlay --}}
    <div id="mobileOverlay" class="mobile-overlay"></div>


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}
    <aside id="sidebar" class="sidebar">

        {{-- Logo --}}
        <div class="sidebar-logo">

            <a href="{{ route('dashboard') }}"
               class="logo-link">

                <img
                    src="{{ asset('images/NexPOSLogo.png') }}"
                    alt="NexPOS Logo"
                    class="logo-image"
                >

                <div class="logo-text">
                    <strong>
                        Nex<span>POS</span>
                    </strong>

                    <small>
                        Management
                    </small>
                </div>

            </a>

        </div>


        {{-- Navigation --}}
        <nav class="sidebar-nav">

            {{-- Main --}}
            <div class="nav-group">

                <p class="nav-heading">
                    MAIN
                </p>

                <a
                    href="{{ route('dashboard') }}"
                    class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >
                    <span class="nav-icon">⌂</span>
                    <span class="nav-label">Dashboard</span>
                </a>


                <a
                    href="{{ route('pos') }}"
                    class="nav-item {{ request()->routeIs('pos') ? 'active' : '' }}"
                >
                    <span class="nav-icon">▣</span>
                    <span class="nav-label">Point of Sale</span>
                </a>

            </div>


            {{-- Management --}}
            <div class="nav-group">

                <p class="nav-heading">
                    MANAGEMENT
                </p>


                <a href="#" class="nav-item">
                    <span class="nav-icon">▦</span>
                    <span class="nav-label">Products</span>
                </a>


                <a href="#" class="nav-item">
                    <span class="nav-icon">☷</span>
                    <span class="nav-label">Inventory</span>
                </a>


                <a href="#" class="nav-item">
                    <span class="nav-icon">♙</span>
                    <span class="nav-label">Customers</span>
                </a>


                <a href="#" class="nav-item">
                    <span class="nav-icon">▤</span>
                    <span class="nav-label">Sales</span>
                </a>


                <a href="#" class="nav-item">
                    <span class="nav-icon">▥</span>
                    <span class="nav-label">Reports</span>
                </a>

            </div>

        </nav>


        {{-- Sidebar Bottom --}}
        <div class="sidebar-bottom">

            <button
                type="button"
                id="collapseSidebar"
                class="collapse-button"
            >
                <span id="collapseIcon">‹</span>
                <span class="nav-label">Collapse</span>
            </button>


            {{-- User --}}
            <div class="user-box">

                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>

                <div class="user-info">

                    <strong>
                        {{ explode(' ', auth()->user()->name ?? 'User')[0] }}
                    </strong>

                    <span>
                        {{ auth()->user()->email ?? '' }}
                    </span>

                </div>

            </div>


            {{-- Logout --}}
            <form
                action="{{ route('logout') }}"
                method="POST"
                class="logout-form"
            >
                @csrf

                <button
                    type="submit"
                    class="logout-button"
                >
                    <span class="logout-icon">↪</span>
                    <span class="nav-label">Sign Out</span>
                </button>

            </form>

        </div>

    </aside>


    {{-- =========================================================
         MAIN AREA
    ========================================================== --}}
    <div id="mainArea" class="main-area">

        {{-- Topbar --}}
        <header class="topbar">

            <div class="topbar-left">

                <button
                    type="button"
                    id="mobileMenuButton"
                    class="mobile-menu-button"
                    aria-label="Open menu"
                >
                    ☰
                </button>


                <div>

                    <p class="date-text">
                        {{ now()->format('l, F j, Y') }}
                    </p>

                    <h1>
                        @yield('page-title', 'NexPOS')
                    </h1>

                </div>

            </div>


            <div class="topbar-right">

                <div class="system-status">
                    <span></span>
                    System Online
                </div>


                <button
                    type="button"
                    class="notification-button"
                    aria-label="Notifications"
                >
                    🔔
                </button>

            </div>

        </header>


        {{-- Page --}}
        <main class="page-content">

            @if(session('success'))
                <div class="flash-message success">
                    <span>✓</span>
                    {{ session('success') }}
                </div>
            @endif


            @if(session('error'))
                <div class="flash-message error">
                    <span>!</span>
                    {{ session('error') }}
                </div>
            @endif


            @yield('content')

        </main>

    </div>

</div>

</body>
</html>