<aside id="sidebar" class="sidebar">

    {{-- LOGO --}}
    <div class="sidebar-logo">

        <a href="{{ route('dashboard') }}" class="logo-link">

            <img
                src="{{ asset('images/NexPOSLogo.png') }}"
                alt="NexPOS"
                class="logo-image"
            >

            <div class="logo-text">
                <strong>
                    Nex<span>POS</span>
                </strong>

                <small>
                    Point of Sale System
                </small>
            </div>

        </a>

    </div>


    {{-- NAVIGATION --}}
    <nav class="sidebar-nav">

        <div class="nav-group">

            <div class="nav-heading">
                MAIN MENU
            </div>


            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <span class="nav-icon">⌂</span>

                <span class="nav-label">
                    Dashboard
                </span>
            </a>


            {{-- Point of Sale --}}
            <a
                href="{{ route('pos') }}"
                class="nav-item {{ request()->routeIs('pos') ? 'active' : '' }}"
            >
                <span class="nav-icon">▣</span>

                <span class="nav-label">
                    Point of Sale
                </span>
            </a>


            {{-- Products --}}
            <a
                href="{{ route('products.index') }}"
                class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▦</span>

                <span class="nav-label">
                    Products
                </span>
            </a>


            {{-- ADMIN ONLY --}}
            @if(auth()->user()->isAdmin())

                {{-- Inventory --}}
                <a
                    href="{{ route('inventory.index') }}"
                    class="nav-item {{ request()->routeIs('inventory.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">☷</span>

                    <span class="nav-label">
                        Inventory
                    </span>
                </a>


                {{-- Customers --}}
                <a
                    href="{{ route('customers.index') }}"
                    class="nav-item {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">♙</span>

                    <span class="nav-label">
                        Customers
                    </span>
                </a>

            @endif


            {{-- Sales --}}
            <a
                href="{{ route('sales.index') }}"
                class="nav-item {{ request()->routeIs('sales.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">▤</span>

                <span class="nav-label">
                    Sales
                </span>
            </a>


            {{-- ADMIN ONLY --}}
            @if(auth()->user()->isAdmin())

                {{-- Reports --}}
                <a
                    href="{{ route('reports.index') }}"
                    class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">▥</span>

                    <span class="nav-label">
                        Reports
                    </span>
                </a>


                {{-- Users --}}
                <a
                    href="{{ route('users.index') }}"
                    class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}"
                >
                    <span class="nav-icon">♙</span>

                    <span class="nav-label">
                        Users
                    </span>
                </a>

            @endif

        </div>

    </nav>


    {{-- SIDEBAR BOTTOM --}}
    <div class="sidebar-bottom">

        {{-- Collapse --}}
        <button
            type="button"
            id="collapseSidebarButton"
            class="collapse-button"
            aria-label="Collapse sidebar"
            aria-expanded="true"
        >
            <span id="collapseIcon">
                ‹
            </span>

            <span class="nav-label">
                Collapse Sidebar
            </span>
        </button>


        {{-- Logged-in User --}}
        <div class="user-box">

            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>

            <div class="user-info">

                <strong>
                    {{ auth()->user()->name ?? 'User' }}
                </strong>

                <span>
                    {{ auth()->user()->email ?? 'user@nexpos.com' }}
                </span>

                <small style="display:block; margin-top:3px;">
                    {{ ucfirst(auth()->user()->role ?? 'user') }}
                </small>

            </div>

        </div>


        {{-- Logout --}}
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >
                <span class="logout-icon">
                    ↪
                </span>

                <span class="nav-label">
                    Logout
                </span>
            </button>

        </form>

    </div>

</aside>