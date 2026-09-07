<aside id="sidebar" class="sidebar">

    {{-- =====================================================
         LOGO
    ====================================================== --}}
    <div class="sidebar-logo">

        <a href="{{ route('dashboard') }}" class="logo-link">

            <img
                src="{{ asset('images/NexPOSLogo.png') }}"
                alt="NexPOS"
                class="logo-image"
            >

            <div class="logo-text">
                <strong>Nex<span>POS</span></strong>
                <small>Point of Sale System</small>
            </div>

        </a>

    </div>


    {{-- =====================================================
         NAVIGATION
    ====================================================== --}}
    <nav class="sidebar-nav">

        <div class="nav-group">

            <div class="nav-heading">
                MAIN MENU
            </div>


            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <span class="nav-icon">⌂</span>

                <span class="nav-label">
                    Dashboard
                </span>

            </a>


            {{-- Point of Sale --}}
            <a href="{{ route('pos') }}"
               class="nav-item {{ request()->routeIs('pos') ? 'active' : '' }}">

                <span class="nav-icon">▣</span>

                <span class="nav-label">
                    Point of Sale
                </span>

            </a>


            {{-- Products --}}
            <a href="{{ route('products.index') }}"
               class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">

                <span class="nav-icon">▦</span>

                <span class="nav-label">
                    Products
                </span>

            </a>


            {{-- Inventory --}}
            <a href="{{ route('inventory.index') }}"
               class="nav-item {{ request()->routeIs('inventory.*') ? 'active' : '' }}">

                <span class="nav-icon">☷</span>

                <span class="nav-label">
                    Inventory
                </span>

            </a>


            {{-- Customers --}}
            <a href="{{ route('customers.index') }}"
               class="nav-item {{ request()->routeIs('customers.*') ? 'active' : '' }}">

                <span class="nav-icon">♙</span>

                <span class="nav-label">
                    Customers
                </span>

            </a>


            {{-- Sales --}}
            <a href="{{ route('sales.index') }}"
               class="nav-item {{ request()->routeIs('sales.*') ? 'active' : '' }}">

                <span class="nav-icon">▤</span>

                <span class="nav-label">
                    Sales
                </span>

            </a>


            {{-- Reports --}}
            <a href="{{ route('reports.index') }}"
               class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                <span class="nav-icon">▥</span>

                <span class="nav-label">
                    Reports
                </span>

            </a>

        </div>

    </nav>


    {{-- =====================================================
         SIDEBAR BOTTOM
    ====================================================== --}}
    <div class="sidebar-bottom">

        {{-- Collapse --}}
        <button
            type="button"
            id="collapseSidebarButton"
            class="collapse-button"
            aria-label="Collapse sidebar"
        >

            <span>‹</span>

            <span class="nav-label">
                Collapse Sidebar
            </span>

        </button>


        {{-- User --}}
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