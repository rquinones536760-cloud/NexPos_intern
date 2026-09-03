<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NexPOS - Point of Sale & Inventory Management</title>

    <link rel="icon" type="image/png" href="{{ asset('images/NexPOSLogo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/NexPOSLogo.png') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-width: 320px;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            color: #0f172a;
            background: #f8fafc;
            overflow-x: hidden;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        /* =========================
           NAVIGATION
        ========================= */

        .welcome-nav {
            width: 100%;
            padding: 22px 6%;
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid #e2e8f0;
            backdrop-filter: blur(14px);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-inner {
            max-width: 1250px;
            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .brand-text strong {
            display: block;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #0f172a;
        }

        .brand-text strong span {
            color: #2563eb;
        }

        .brand-text small {
            display: block;
            margin-top: 1px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-login {
            padding: 10px 18px;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .nav-login:hover {
            color: #2563eb;
        }

        .nav-register {
            padding: 11px 19px;
            border-radius: 10px;
            color: #ffffff;
            background: #2563eb;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.18);
            transition: 0.2s ease;
        }

        .nav-register:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            position: relative;
            padding: 80px 6% 100px;
            overflow: hidden;
            background:
                radial-gradient(
                    circle at 75% 30%,
                    rgba(37, 99, 235, 0.10),
                    transparent 32%
                ),
                linear-gradient(
                    180deg,
                    #ffffff 0%,
                    #f8fafc 100%
                );
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.05);
            filter: blur(5px);
            top: -230px;
            right: -180px;
        }

        .hero-inner {
            position: relative;
            z-index: 2;

            max-width: 1250px;
            margin: 0 auto;

            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            align-items: center;
            gap: 65px;
        }

        .hero-content {
            max-width: 570px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 7px 12px;
            margin-bottom: 22px;

            border: 1px solid #dbeafe;
            border-radius: 999px;

            color: #2563eb;
            background: #eff6ff;

            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .hero-badge i {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.10);
        }

        .hero h1 {
            font-size: clamp(42px, 5vw, 72px);
            line-height: 1.02;
            letter-spacing: -3px;
            font-weight: 850;
            color: #0f172a;
        }

        .hero h1 span {
            color: #2563eb;
        }

        .hero-description {
            margin-top: 24px;
            max-width: 530px;

            color: #64748b;
            font-size: 17px;
            line-height: 1.8;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-top: 32px;
            flex-wrap: wrap;
        }

        .primary-button,
        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            min-height: 48px;
            padding: 0 21px;

            border-radius: 11px;

            font-size: 14px;
            font-weight: 750;

            transition: 0.2s ease;
        }

        .primary-button {
            color: #ffffff;
            background: #2563eb;
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.20);
        }

        .primary-button:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.25);
        }

        .secondary-button {
            color: #334155;
            background: #ffffff;
            border: 1px solid #dbe3ee;
        }

        .secondary-button:hover {
            border-color: #bfdbfe;
            color: #2563eb;
            transform: translateY(-2px);
        }

        /* =========================
           HERO POS VISUAL
        ========================= */

        .hero-visual {
            position: relative;
            min-height: 510px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .visual-glow {
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.08);
            filter: blur(2px);
        }

        .pos-machine {
            position: relative;
            z-index: 3;

            width: min(440px, 90%);
            padding: 18px;

            border: 1px solid #dbe3ee;
            border-radius: 22px;

            background: #ffffff;

            box-shadow:
                0 35px 80px rgba(15, 23, 42, 0.14),
                0 8px 20px rgba(15, 23, 42, 0.06);

            transform: perspective(1100px) rotateY(-7deg) rotateX(2deg);
        }

        .machine-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 5px 4px 15px;
        }

        .machine-brand {
            font-size: 13px;
            font-weight: 850;
            color: #0f172a;
        }

        .machine-brand span {
            color: #2563eb;
        }

        .machine-status {
            display: flex;
            align-items: center;
            gap: 5px;

            font-size: 10px;
            font-weight: 700;
            color: #16a34a;
        }

        .machine-status i {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
        }

        .machine-screen {
            min-height: 280px;
            padding: 18px;

            border-radius: 15px;
            background: #0f172a;
            color: #ffffff;
        }

        .screen-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 17px;
        }

        .screen-heading strong {
            font-size: 13px;
        }

        .screen-heading span {
            color: #94a3b8;
            font-size: 10px;
        }

        .screen-total {
            padding: 17px;
            margin-bottom: 15px;

            border-radius: 12px;
            background: #172033;
        }

        .screen-total small {
            display: block;
            color: #94a3b8;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .screen-total strong {
            display: block;
            margin-top: 5px;

            color: #ffffff;
            font-size: 27px;
        }

        .screen-items {
            display: grid;
            gap: 8px;
        }

        .screen-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 9px 11px;

            border-radius: 8px;
            background: #172033;
        }

        .screen-item span {
            color: #cbd5e1;
            font-size: 10px;
        }

        .screen-item strong {
            color: #ffffff;
            font-size: 10px;
        }

        .machine-base {
            width: 78%;
            height: 55px;

            margin: 0 auto;
            margin-top: 10px;

            border-radius: 8px 8px 16px 16px;

            background: linear-gradient(
                180deg,
                #e2e8f0,
                #cbd5e1
            );

            box-shadow: inset 0 2px 4px rgba(255,255,255,0.8);
        }

        /* =========================
           FLOATING CARDS
        ========================= */

        .floating-card {
            position: absolute;
            z-index: 5;

            padding: 14px 16px;

            border: 1px solid #e2e8f0;
            border-radius: 13px;

            background: rgba(255, 255, 255, 0.96);

            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.10);

            backdrop-filter: blur(10px);
        }

        .floating-card strong {
            display: block;
            color: #0f172a;
            font-size: 12px;
        }

        .floating-card span {
            display: block;
            margin-top: 3px;
            color: #64748b;
            font-size: 9px;
        }

        .sales-card {
            left: 0;
            bottom: 78px;
        }

        .sales-card strong {
            color: #16a34a;
            font-size: 15px;
        }

        .stock-card {
            right: 0;
            top: 80px;
        }

        .stock-card strong {
            color: #2563eb;
            font-size: 15px;
        }

        /* =========================
           FEATURES
        ========================= */

        .features {
            padding: 90px 6%;
            background: #ffffff;
        }

        .section-inner {
            max-width: 1100px;
            margin: 0 auto;
        }

        .section-heading {
            max-width: 650px;
            margin: 0 auto 45px;
            text-align: center;
        }

        .section-label {
            display: block;
            margin-bottom: 10px;

            color: #2563eb;
            font-size: 11px;
            font-weight: 850;
            letter-spacing: 1.5px;
        }

        .section-heading h2 {
            color: #0f172a;
            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.15;
            letter-spacing: -1.5px;
        }

        .section-heading p {
            margin-top: 14px;
            color: #64748b;
            line-height: 1.7;
            font-size: 15px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature-card {
            padding: 28px;

            border: 1px solid #e2e8f0;
            border-radius: 16px;

            background: #ffffff;

            transition: 0.25s ease;
        }

        .feature-card:hover {
            border-color: #bfdbfe;
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.07);
        }

        .feature-icon {
            width: 45px;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 20px;

            border-radius: 12px;

            color: #2563eb;
            background: #eff6ff;

            font-size: 20px;
        }

        .feature-card h3 {
            color: #0f172a;
            font-size: 17px;
        }

        .feature-card p {
            margin-top: 9px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =========================
           CTA
        ========================= */

        .cta-section {
            padding: 80px 6%;
            background: #f8fafc;
        }

        .cta-box {
            max-width: 1100px;
            margin: 0 auto;

            padding: 55px 50px;

            border-radius: 22px;

            background:
                radial-gradient(
                    circle at 85% 20%,
                    rgba(96, 165, 250, 0.25),
                    transparent 30%
                ),
                #0f172a;

            color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 35px;
        }

        .cta-box h2 {
            font-size: clamp(27px, 4vw, 38px);
            letter-spacing: -1px;
        }

        .cta-box p {
            max-width: 600px;
            margin-top: 10px;
            color: #94a3b8;
            line-height: 1.7;
            font-size: 14px;
        }

        .cta-button {
            flex-shrink: 0;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 48px;
            padding: 0 22px;

            border-radius: 10px;

            color: #0f172a;
            background: #ffffff;

            font-size: 14px;
            font-weight: 800;

            transition: 0.2s ease;
        }

        .cta-button:hover {
            background: #eff6ff;
            color: #2563eb;
            transform: translateY(-2px);
        }

        /* =========================
           FOOTER
        ========================= */

        .welcome-footer {
            padding: 25px 6%;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
        }

        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-inner p {
            color: #94a3b8;
            font-size: 12px;
        }

        .footer-brand {
            color: #334155;
            font-size: 13px;
            font-weight: 800;
        }

        .footer-brand span {
            color: #2563eb;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1050px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .hero-content {
                max-width: 720px;
                margin: 0 auto;
                text-align: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-visual {
                min-height: 500px;
            }

            .feature-grid {
                grid-template-columns: 1fr 1fr;
            }

            .cta-box {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 700px) {
            .welcome-nav {
                padding: 17px 5%;
            }

            .nav-register {
                display: none;
            }

            .hero {
                padding: 60px 5% 70px;
            }

            .hero h1 {
                letter-spacing: -2px;
            }

            .hero-description {
                font-size: 15px;
            }

            .hero-visual {
                min-height: 420px;
            }

            .pos-machine {
                width: 94%;
                transform: none;
            }

            .machine-screen {
                min-height: 240px;
            }

            .floating-card {
                padding: 11px 13px;
            }

            .sales-card {
                left: -5px;
                bottom: 45px;
            }

            .stock-card {
                right: -5px;
                top: 50px;
            }

            .features {
                padding: 70px 5%;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .cta-section {
                padding: 60px 5%;
            }

            .cta-box {
                padding: 40px 28px;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .brand-text small {
                display: none;
            }

            .nav-login {
                padding: 8px;
            }

            .hero h1 {
                font-size: 39px;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .primary-button,
            .secondary-button {
                width: 100%;
            }

            .hero-visual {
                min-height: 350px;
            }

            .machine-screen {
                min-height: 200px;
                padding: 13px;
            }

            .screen-total strong {
                font-size: 22px;
            }

            .floating-card {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         NAVIGATION
    ========================== -->

    <header class="welcome-nav">
        <div class="nav-inner">

            <a href="{{ route('home') }}" class="brand">

                <img
                    src="{{ asset('images/NexPOSLogo.png') }}"
                    alt="NexPOS Logo"
                    class="brand-logo"
                >

                <div class="brand-text">
                    <strong>Nex<span>POS</span></strong>
                    <small>Management System</small>
                </div>

            </a>

            <div class="nav-actions">

                <a href="{{ route('login') }}" class="nav-login">
                    Sign In
                </a>

                <a href="{{ route('register') }}" class="nav-register">
                    Get Started
                </a>

            </div>

        </div>
    </header>


    <!-- =========================
         HERO
    ========================== -->

    <main>

        <section class="hero">

            <div class="hero-inner">

                <div class="hero-content">

                    <div class="hero-badge">
                        <i></i>
                        SIMPLE. SMART. READY TO USE.
                    </div>

                    <h1>
                        Run your business
                        <span>smarter.</span>
                    </h1>

                    <p class="hero-description">
                        NexPOS brings point-of-sale, inventory, products,
                        sales, and business management into one simple
                        system built for modern businesses.
                    </p>

                    <div class="hero-buttons">

                        <a href="{{ route('login') }}" class="primary-button">
                            Sign In
                            <span>→</span>
                        </a>

                        <a href="{{ route('register') }}" class="secondary-button">
                            Create Account
                        </a>

                    </div>

                </div>


                <!-- POS VISUAL -->

                <div class="hero-visual">

                    <div class="visual-glow"></div>


                    <div class="floating-card sales-card">
                        <strong>+₱54,987</strong>
                        <span>Today's Sales</span>
                    </div>


                    <div class="floating-card stock-card">
                        <strong>1,248</strong>
                        <span>Products</span>
                    </div>


                    <div class="pos-machine">

                        <div class="machine-top">

                            <div class="machine-brand">
                                Nex<span>POS</span>
                            </div>

                            <div class="machine-status">
                                <i></i>
                                System Online
                            </div>

                        </div>


                        <div class="machine-screen">

                            <div class="screen-heading">
                                <strong>Current Order</strong>
                                <span>Register #01</span>
                            </div>


                            <div class="screen-total">
                                <small>Total Amount</small>
                                <strong>₱54,987.00</strong>
                            </div>


                            <div class="screen-items">

                                <div class="screen-item">
                                    <span>Laptop Pro</span>
                                    <strong>₱42,999</strong>
                                </div>

                                <div class="screen-item">
                                    <span>Wireless Headset</span>
                                    <strong>₱2,499</strong>
                                </div>

                                <div class="screen-item">
                                    <span>Gaming Mouse</span>
                                    <strong>₱1,799</strong>
                                </div>

                                <div class="screen-item">
                                    <span>Mechanical Keyboard</span>
                                    <strong>₱3,299</strong>
                                </div>

                            </div>

                        </div>


                        <div class="machine-base"></div>

                    </div>

                </div>

            </div>

        </section>


        <!-- =========================
             FEATURES
        ========================== -->

        <section class="features">

            <div class="section-inner">

                <div class="section-heading">

                    <span class="section-label">
                        EVERYTHING YOU NEED
                    </span>

                    <h2>
                        One system for your daily operations.
                    </h2>

                    <p>
                        Manage your sales and products without jumping
                        between different systems.
                    </p>

                </div>


                <div class="feature-grid">

                    <article class="feature-card">

                        <div class="feature-icon">
                            🛒
                        </div>

                        <h3>
                            Point of Sale
                        </h3>

                        <p>
                            Process transactions quickly with a simple
                            and organized checkout interface.
                        </p>

                    </article>


                    <article class="feature-card">

                        <div class="feature-icon">
                            📦
                        </div>

                        <h3>
                            Inventory Management
                        </h3>

                        <p>
                            Keep track of products, available stock,
                            and low-stock items in one place.
                        </p>

                    </article>


                    <article class="feature-card">

                        <div class="feature-icon">
                            📊
                        </div>

                        <h3>
                            Business Overview
                        </h3>

                        <p>
                            View sales activity, transactions, products,
                            and important business information.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        <!-- =========================
             CALL TO ACTION
        ========================== -->

        <section class="cta-section">

            <div class="cta-box">

                <div>

                    <h2>
                        Ready to simplify your business?
                    </h2>

                    <p>
                        Start using NexPOS and manage your sales,
                        products, and inventory from one place.
                    </p>

                </div>

                <a
                    href="{{ route('register') }}"
                    class="cta-button"
                >
                    Create Your Account →
                </a>

            </div>

        </section>

    </main>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer class="welcome-footer">

        <div class="footer-inner">

            <p>
                © {{ date('Y') }} NexPOS. All rights reserved.
            </p>

            <div class="footer-brand">
                Nex<span>POS</span>
            </div>

        </div>

    </footer>

</body>

</html>