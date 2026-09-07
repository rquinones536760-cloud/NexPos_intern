<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NexPOS - Point of Sale & Inventory Management</title>

    <link rel="icon" type="image/png" href="{{ asset('images/NexPOSLogo.png') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue: #2563eb;
            --blue-light: #60a5fa;
            --blue-dark: #1d4ed8;
            --dark: #07101f;
            --dark-2: #0b1629;
            --text: #f8fafc;
            --muted: #94a3b8;
            --white: #ffffff;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            background: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font: inherit;
        }

        /* =========================================================
           NAVIGATION
        ========================================================= */

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 50;
            padding: 24px 6%;
        }

        .nav-inner {
            max-width: 1380px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .brand-name {
            color: white;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .brand-name span {
            color: #60a5fa;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 34px;
        }

        .nav-links a {
            color: #cbd5e1;
            font-size: 14px;
            font-weight: 600;
            transition: .25s ease;
        }

        .nav-links a:hover {
            color: white;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-login {
            color: white;
            padding: 11px 18px;
            font-size: 14px;
            font-weight: 700;
        }

        .nav-register {
            color: white;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.16);
            padding: 11px 19px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            backdrop-filter: blur(12px);
            transition: .25s ease;
        }

        .nav-register:hover {
            background: rgba(255,255,255,.18);
        }

        /* =========================================================
           HERO
        ========================================================= */

        .hero {
            min-height: 780px;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 75% 48%, rgba(37,99,235,.22), transparent 30%),
                radial-gradient(circle at 15% 30%, rgba(59,130,246,.12), transparent 25%),
                linear-gradient(135deg, #050b16 0%, #091426 55%, #07101e 100%);
            color: white;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 55px 55px;
            mask-image: linear-gradient(to bottom, black, transparent);
            pointer-events: none;
        }

        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            right: -180px;
            top: 100px;
            border-radius: 50%;
            background: rgba(37,99,235,.12);
            filter: blur(80px);
        }

        .hero-inner {
            max-width: 1380px;
            min-height: 780px;
            margin: auto;
            padding: 150px 6% 80px;
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            align-items: center;
            gap: 50px;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 8px 13px;
            border: 1px solid rgba(96,165,250,.25);
            background: rgba(37,99,235,.08);
            border-radius: 100px;
            color: #93c5fd;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .hero-badge i {
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 12px #22c55e;
        }

        .hero h1 {
            font-size: clamp(48px, 5vw, 76px);
            line-height: .98;
            letter-spacing: -4px;
            font-weight: 850;
            margin-bottom: 25px;
        }

        .hero h1 span {
            color: #60a5fa;
        }

        .hero-description {
            color: #94a3b8;
            font-size: 18px;
            line-height: 1.7;
            max-width: 530px;
            margin-bottom: 34px;
        }

        .hero-buttons {
            display: flex;
            gap: 13px;
            flex-wrap: wrap;
        }

        .primary-button,
        .secondary-button {
            padding: 14px 21px;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 750;
            transition: .25s ease;
        }

        .primary-button {
            color: white;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            box-shadow: 0 12px 30px rgba(37,99,235,.25);
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 35px rgba(37,99,235,.35);
        }

        .secondary-button {
            color: white;
            border: 1px solid rgba(255,255,255,.14);
            background: rgba(255,255,255,.05);
        }

        .secondary-button:hover {
            background: rgba(255,255,255,.1);
        }

        /* =========================================================
           3D POS SCENE
        ========================================================= */

        .pos-scene {
            height: 540px;
            position: relative;
            perspective: 1400px;
        }

        .pos-stage {
            position: absolute;
            width: 590px;
            height: 430px;
            left: 50%;
            top: 50%;
            transform:
                translate(-50%, -50%)
                rotateX(4deg)
                rotateY(-8deg)
                rotateZ(-1deg);
            transform-style: preserve-3d;
        }

        /* Ground */

        .ground {
            position: absolute;
            width: 570px;
            height: 230px;
            left: 15px;
            bottom: 0;
            border-radius: 50%;
            background: rgba(37,99,235,.14);
            filter: blur(25px);
            transform: rotateX(70deg) translateZ(-60px);
        }

        .desk {
            position: absolute;
            width: 560px;
            height: 90px;
            left: 20px;
            bottom: 28px;
            border-radius: 18px;
            background:
                linear-gradient(145deg, #162238, #080f1d);
            border: 1px solid rgba(255,255,255,.09);
            box-shadow:
                0 35px 45px rgba(0,0,0,.35),
                inset 0 1px rgba(255,255,255,.08);
            transform: rotateX(68deg);
            transform-origin: bottom;
        }

        /* Monitor */

        .monitor {
            position: absolute;
            width: 365px;
            height: 255px;
            left: 83px;
            top: 38px;
            transform: translateZ(55px);
            transform-style: preserve-3d;
            animation: monitorFloat 5s ease-in-out infinite;
        }

        .monitor-frame {
            position: absolute;
            inset: 0;
            border-radius: 17px;
            background: linear-gradient(145deg, #202d42, #080e19);
            border: 2px solid #334155;
            box-shadow:
                0 30px 45px rgba(0,0,0,.4),
                inset 0 1px rgba(255,255,255,.1);
            transform: translateZ(16px);
        }

        .monitor-screen {
            position: absolute;
            left: 12px;
            top: 12px;
            width: 341px;
            height: 225px;
            border-radius: 10px;
            overflow: hidden;
            background:
                linear-gradient(145deg, #0c172a, #111c31);
            border: 2px solid #020617;
            box-shadow:
                inset 0 0 25px rgba(37,99,235,.13);
            transform: translateZ(18px);
        }

        .screen-top {
            height: 38px;
            padding: 0 13px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .screen-logo {
            font-size: 12px;
            font-weight: 800;
            color: white;
        }

        .screen-logo span {
            color: #60a5fa;
        }

        .screen-online {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #86efac;
            font-size: 7px;
        }

        .screen-online i {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #22c55e;
        }

        .screen-content {
            padding: 13px;
            display: grid;
            grid-template-columns: 1fr 100px;
            gap: 10px;
        }

        .screen-products {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 7px;
        }

        .mini-product {
            height: 65px;
            padding: 8px;
            border-radius: 7px;
            background: rgba(255,255,255,.045);
            border: 1px solid rgba(255,255,255,.05);
        }

        .mini-product-icon {
            width: 22px;
            height: 22px;
            border-radius: 5px;
            display: grid;
            place-items: center;
            background: rgba(59,130,246,.14);
            color: #60a5fa;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .mini-product b {
            display: block;
            font-size: 7px;
            color: #e2e8f0;
        }

        .mini-product small {
            color: #64748b;
            font-size: 6px;
        }

        .screen-cart {
            border-radius: 7px;
            padding: 9px;
            background: rgba(37,99,235,.08);
            border: 1px solid rgba(96,165,250,.08);
        }

        .screen-cart-title {
            font-size: 7px;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .cart-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #cbd5e1;
            font-size: 6px;
        }

        .cart-total {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 8px;
            display: flex;
            justify-content: space-between;
            color: white;
            font-size: 8px;
            font-weight: 800;
        }

        .monitor-side {
            position: absolute;
            width: 20px;
            height: 250px;
            right: -10px;
            top: 4px;
            border-radius: 0 15px 15px 0;
            background: linear-gradient(#101a2b, #030813);
            transform: rotateY(90deg) translateZ(10px);
            transform-origin: left;
        }

        .monitor-top {
            position: absolute;
            width: 365px;
            height: 20px;
            left: 0;
            top: -9px;
            border-radius: 15px 15px 0 0;
            background: #26344b;
            transform: rotateX(90deg) translateZ(9px);
            transform-origin: bottom;
        }

        /* Stand */

        .monitor-stand {
            position: absolute;
            width: 88px;
            height: 110px;
            left: 225px;
            top: 270px;
            background: linear-gradient(90deg, #111c2e, #25344a, #0c1524);
            border: 1px solid #334155;
            border-radius: 8px;
            transform: translateZ(25px);
            box-shadow: 0 20px 25px rgba(0,0,0,.3);
        }

        .stand-neck {
            position: absolute;
            width: 55px;
            height: 65px;
            left: 16px;
            top: -38px;
            border-radius: 8px;
            background: linear-gradient(90deg, #111c2e, #334155, #111827);
            transform: skewX(-4deg);
        }

        .stand-base {
            position: absolute;
            width: 165px;
            height: 70px;
            left: 186px;
            top: 352px;
            border-radius: 18px;
            background: linear-gradient(145deg, #26354c, #0b1423);
            border: 1px solid #334155;
            box-shadow: 0 20px 30px rgba(0,0,0,.35);
            transform: translateZ(30px) rotateX(58deg);
        }

        /* Cash drawer */

        .cash-drawer {
            position: absolute;
            width: 220px;
            height: 74px;
            left: 320px;
            bottom: 70px;
            border-radius: 10px;
            background: linear-gradient(145deg, #1d2a3f, #080f1c);
            border: 1px solid #334155;
            box-shadow: 0 25px 30px rgba(0,0,0,.35);
            transform: translateZ(45px);
        }

        .drawer-line {
            position: absolute;
            width: 160px;
            height: 30px;
            left: 29px;
            top: 13px;
            border-radius: 5px;
            background: #080e18;
            border: 1px solid #26364d;
        }

        .drawer-handle {
            position: absolute;
            width: 65px;
            height: 5px;
            left: 77px;
            bottom: 12px;
            border-radius: 5px;
            background: #475569;
        }

        /* Barcode Scanner */

        .scanner {
            position: absolute;
            width: 105px;
            height: 145px;
            right: 30px;
            top: 235px;
            transform:
                translateZ(65px)
                rotateZ(8deg)
                rotateX(-4deg);
            transform-style: preserve-3d;
            animation: scannerFloat 4s ease-in-out infinite;
        }

        .scanner-body {
            position: absolute;
            width: 74px;
            height: 76px;
            left: 17px;
            top: 0;
            border-radius: 17px 17px 9px 9px;
            background: linear-gradient(145deg, #26364d, #090f1b);
            border: 1px solid #475569;
            box-shadow:
                0 20px 25px rgba(0,0,0,.4),
                inset 0 1px rgba(255,255,255,.1);
            transform: translateZ(15px);
        }

        .scanner-head {
            position: absolute;
            width: 74px;
            height: 30px;
            top: -14px;
            left: 0;
            border-radius: 16px 16px 6px 6px;
            background: linear-gradient(145deg, #34465f, #111a2b);
            border: 1px solid #475569;
            transform: translateZ(4px);
        }

        .scanner-glass {
            position: absolute;
            width: 32px;
            height: 10px;
            left: 21px;
            top: 9px;
            border-radius: 8px;
            background: #020617;
            box-shadow: inset 0 0 8px rgba(59,130,246,.8);
        }

        .laser {
            position: absolute;
            width: 2px;
            height: 135px;
            left: 52px;
            top: 15px;
            background: #ef4444;
            box-shadow: 0 0 12px #ef4444;
            opacity: .7;
            transform: rotate(24deg);
            animation: laserPulse 1.4s infinite;
        }

        .scanner-handle {
            position: absolute;
            width: 45px;
            height: 86px;
            left: 28px;
            top: 60px;
            border-radius: 9px 9px 20px 20px;
            background: linear-gradient(90deg, #101a2b, #26364d, #0a111d);
            border: 1px solid #334155;
            transform: rotate(18deg) translateZ(10px);
            transform-origin: top;
        }

        .scanner-button {
            position: absolute;
            width: 17px;
            height: 7px;
            top: 17px;
            left: 13px;
            border-radius: 5px;
            background: #3b82f6;
            box-shadow: 0 0 10px rgba(59,130,246,.6);
        }

        /* Receipt */

        .receipt {
            position: absolute;
            width: 83px;
            height: 115px;
            left: 395px;
            top: 0;
            padding: 11px;
            background: #f8fafc;
            color: #334155;
            box-shadow: 0 18px 30px rgba(0,0,0,.3);
            transform:
                translateZ(30px)
                rotateZ(8deg)
                rotateX(-8deg);
            animation: receiptFloat 4.5s ease-in-out infinite;
        }

        .receipt::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 100%;
            height: 12px;
            background:
                linear-gradient(135deg, transparent 6px, #f8fafc 0) 0 0 / 12px 12px repeat-x;
        }

        .receipt-logo {
            font-size: 10px;
            font-weight: 900;
            margin-bottom: 9px;
        }

        .receipt-logo span {
            color: #2563eb;
        }

        .receipt-line {
            height: 4px;
            background: #cbd5e1;
            margin: 6px 0;
            border-radius: 2px;
        }

        .receipt-line.short {
            width: 55%;
        }

        .receipt-total {
            margin-top: 12px;
            padding-top: 7px;
            border-top: 1px dashed #94a3b8;
            font-size: 8px;
            font-weight: 800;
        }

        /* Floating UI cards */

        .float-card {
            position: absolute;
            z-index: 10;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(15,23,42,.75);
            backdrop-filter: blur(18px);
            box-shadow: 0 25px 50px rgba(0,0,0,.35);
            border-radius: 14px;
            padding: 14px;
        }

        .sales-card {
            left: 0;
            top: 125px;
            width: 165px;
            animation: cardFloat 5s ease-in-out infinite;
        }

        .orders-card {
            right: 0;
            bottom: 90px;
            width: 160px;
            animation: cardFloat 4.5s ease-in-out infinite reverse;
        }

        .float-label {
            color: #94a3b8;
            font-size: 9px;
            margin-bottom: 5px;
        }

        .float-value {
            color: white;
            font-size: 21px;
            font-weight: 800;
        }

        .float-growth {
            color: #4ade80;
            font-size: 9px;
            margin-top: 4px;
        }

        .order-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .order-icon {
            width: 27px;
            height: 27px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: rgba(59,130,246,.15);
            color: #60a5fa;
            font-size: 11px;
        }

        .order-text strong {
            display: block;
            color: #e2e8f0;
            font-size: 9px;
        }

        .order-text small {
            color: #64748b;
            font-size: 7px;
        }

        /* =========================================================
           FEATURES
        ========================================================= */

        .features {
            padding: 110px 6%;
            background: #ffffff;
        }

        .section-inner {
            max-width: 1180px;
            margin: auto;
        }

        .section-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 55px;
        }

        .section-label {
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.8px;
        }

        .section-heading h2 {
            margin-top: 12px;
            font-size: 42px;
            letter-spacing: -2px;
            color: #0f172a;
        }

        .section-heading p {
            margin-top: 14px;
            color: #64748b;
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card {
            padding: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 10px 30px rgba(15,23,42,.04);
            transition: .3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(15,23,42,.09);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.65;
            font-size: 14px;
        }

        /* =========================================================
           CTA
        ========================================================= */

        .cta {
            padding: 90px 6%;
            background: #07101f;
            color: white;
        }

        .cta-inner {
            max-width: 1050px;
            margin: auto;
            text-align: center;
            padding: 70px 30px;
            border-radius: 25px;
            background:
                radial-gradient(circle at 50% 0, rgba(37,99,235,.3), transparent 55%),
                #0c1729;
            border: 1px solid rgba(255,255,255,.08);
        }

        .cta h2 {
            font-size: 42px;
            letter-spacing: -2px;
            margin-bottom: 15px;
        }

        .cta p {
            color: #94a3b8;
            margin-bottom: 28px;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            background: #050b15;
            color: #64748b;
            padding: 28px 6%;
            border-top: 1px solid rgba(255,255,255,.06);
        }

        .footer-inner {
            max-width: 1180px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            color: white;
            font-weight: 800;
        }

        .footer-brand span {
            color: #60a5fa;
        }

        /* =========================================================
           ANIMATIONS
        ========================================================= */

        @keyframes monitorFloat {
            0%, 100% {
                transform: translateZ(55px) translateY(0);
            }

            50% {
                transform: translateZ(55px) translateY(-7px);
            }
        }

        @keyframes scannerFloat {
            0%, 100% {
                transform: translateZ(65px) rotateZ(8deg) translateY(0);
            }

            50% {
                transform: translateZ(65px) rotateZ(8deg) translateY(-8px);
            }
        }

        @keyframes receiptFloat {
            0%, 100% {
                transform:
                    translateZ(30px)
                    rotateZ(8deg)
                    rotateX(-8deg)
                    translateY(0);
            }

            50% {
                transform:
                    translateZ(45px)
                    rotateZ(8deg)
                    rotateX(-8deg)
                    translateY(-12px);
            }
        }

        @keyframes cardFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes laserPulse {
            0%, 100% {
                opacity: .25;
            }

            50% {
                opacity: .9;
            }
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1150px) {
            .hero-inner {
                grid-template-columns: 1fr;
                text-align: center;
                padding-top: 135px;
            }

            .hero-content {
                max-width: 700px;
                margin: auto;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .pos-scene {
                width: 680px;
                max-width: 100%;
                margin: auto;
            }
        }

        @media (max-width: 800px) {
            .navbar {
                padding: 20px 5%;
            }

            .nav-links {
                display: none;
            }

            .hero {
                min-height: 900px;
            }

            .hero-inner {
                min-height: 900px;
                padding-left: 5%;
                padding-right: 5%;
            }

            .hero h1 {
                font-size: 48px;
                letter-spacing: -2.5px;
            }

            .hero-description {
                font-size: 16px;
            }

            .pos-scene {
                transform: scale(.78);
                transform-origin: top center;
                height: 430px;
                margin-bottom: -60px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .section-heading h2,
            .cta h2 {
                font-size: 34px;
            }
        }

        @media (max-width: 560px) {
            .nav-register {
                display: none;
            }

            .hero h1 {
                font-size: 41px;
            }

            .pos-scene {
                transform: scale(.57);
                height: 330px;
                margin-left: -35px;
                margin-right: -35px;
            }

            .hero {
                min-height: 780px;
            }

            .hero-inner {
                min-height: 780px;
                padding-top: 120px;
            }

            .sales-card {
                left: 15px;
            }

            .orders-card {
                right: 5px;
            }

            .features {
                padding: 75px 5%;
            }

            .cta {
                padding: 65px 5%;
            }

            .footer-inner {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- =========================================================
         NAVBAR
    ========================================================== -->

    <nav class="navbar">
        <div class="nav-inner">

            <a href="{{ route('home') }}" class="brand">
                <img
                    src="{{ asset('images/NexPOSLogo.png') }}"
                    alt="NexPOS"
                >

                <div class="brand-name">
                    Nex<span>POS</span>
                </div>
            </a>

            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#about">Why NexPOS</a>
            </div>

            <div class="nav-actions">
                <a href="{{ route('login') }}" class="nav-login">
                    Sign In
                </a>

                <a href="{{ route('register') }}" class="nav-register">
                    Get Started
                </a>
            </div>

        </div>
    </nav>


    <!-- =========================================================
         HERO
    ========================================================== -->

    <section class="hero">

        <div class="hero-glow"></div>

        <div class="hero-inner">

            <div class="hero-content">

                <div class="hero-badge">
                    <i></i>
                    Smart POS & Inventory Management
                </div>

                <h1>
                    Run your business
                    <span>smarter.</span>
                </h1>

                <p class="hero-description">
                    NexPOS brings your sales, products, inventory,
                    customers, and reports together in one simple
                    and powerful management system.
                </p>

                <div class="hero-buttons">
                    <a
                        href="{{ route('register') }}"
                        class="primary-button"
                    >
                        Get Started →
                    </a>

                    <a
                        href="{{ route('login') }}"
                        class="secondary-button"
                    >
                        Sign In
                    </a>
                </div>

            </div>


            <!-- =================================================
                 REALISTIC 3D POS
            ================================================== -->

            <div class="pos-scene">

                <div class="pos-stage">

                    <div class="ground"></div>

                    <div class="desk"></div>


                    <!-- SALES FLOAT CARD -->

                    <div class="float-card sales-card">
                        <div class="float-label">
                            Today's Sales
                        </div>

                        <div class="float-value">
                            ₱54,987
                        </div>

                        <div class="float-growth">
                            ↑ 12.8% from yesterday
                        </div>
                    </div>


                    <!-- POS MONITOR -->

                    <div class="monitor">

                        <div class="monitor-frame"></div>

                        <div class="monitor-top"></div>

                        <div class="monitor-side"></div>

                        <div class="monitor-screen">

                            <div class="screen-top">

                                <div class="screen-logo">
                                    Nex<span>POS</span>
                                </div>

                                <div class="screen-online">
                                    <i></i>
                                    SYSTEM ONLINE
                                </div>

                            </div>

                            <div class="screen-content">

                                <div class="screen-products">

                                    <div class="mini-product">
                                        <div class="mini-product-icon">▣</div>
                                        <b>Laptop Pro</b>
                                        <small>₱42,999</small>
                                    </div>

                                    <div class="mini-product">
                                        <div class="mini-product-icon">⌁</div>
                                        <b>Headset</b>
                                        <small>₱2,499</small>
                                    </div>

                                    <div class="mini-product">
                                        <div class="mini-product-icon">⌨</div>
                                        <b>Keyboard</b>
                                        <small>₱3,299</small>
                                    </div>

                                    <div class="mini-product">
                                        <div class="mini-product-icon">◉</div>
                                        <b>Mouse</b>
                                        <small>₱1,799</small>
                                    </div>

                                </div>

                                <div class="screen-cart">

                                    <div class="screen-cart-title">
                                        CURRENT ORDER
                                    </div>

                                    <div class="cart-line">
                                        <span>Laptop</span>
                                        <span>₱42,999</span>
                                    </div>

                                    <div class="cart-line">
                                        <span>Mouse</span>
                                        <span>₱1,799</span>
                                    </div>

                                    <div class="cart-line">
                                        <span>Tax</span>
                                        <span>₱5,375</span>
                                    </div>

                                    <div class="cart-total">
                                        <span>TOTAL</span>
                                        <span>₱50,173</span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- MONITOR STAND -->

                    <div class="monitor-stand">
                        <div class="stand-neck"></div>
                    </div>

                    <div class="stand-base"></div>


                    <!-- CASH DRAWER -->

                    <div class="cash-drawer">

                        <div class="drawer-line"></div>

                        <div class="drawer-handle"></div>

                    </div>


                    <!-- BARCODE SCANNER -->

                    <div class="scanner">

                        <div class="laser"></div>

                        <div class="scanner-body">

                            <div class="scanner-head">

                                <div class="scanner-glass"></div>

                            </div>

                        </div>

                        <div class="scanner-handle">

                            <div class="scanner-button"></div>

                        </div>

                    </div>


                    <!-- RECEIPT -->

                    <div class="receipt">

                        <div class="receipt-logo">
                            Nex<span>POS</span>
                        </div>

                        <div class="receipt-line"></div>
                        <div class="receipt-line short"></div>
                        <div class="receipt-line"></div>
                        <div class="receipt-line short"></div>
                        <div class="receipt-line"></div>

                        <div class="receipt-total">
                            TOTAL &nbsp; ₱50,173
                        </div>

                    </div>


                    <!-- ORDERS FLOAT CARD -->

                    <div class="float-card orders-card">

                        <div class="float-label">
                            Recent Order
                        </div>

                        <div class="order-row">

                            <div class="order-icon">
                                ✓
                            </div>

                            <div class="order-text">
                                <strong>
                                    Payment Complete
                                </strong>

                                <small>
                                    Transaction #1048
                                </small>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    <!-- =========================================================
         FEATURES
    ========================================================== -->

    <section class="features" id="features">

        <div class="section-inner">

            <div class="section-heading">

                <span class="section-label">
                    EVERYTHING IN ONE PLACE
                </span>

                <h2>
                    Built for modern businesses.
                </h2>

                <p>
                    Manage your everyday operations with a
                    clean and easy-to-use system.
                </p>

            </div>


            <div class="feature-grid">

                <div class="feature-card">

                    <div class="feature-icon">
                        🛒
                    </div>

                    <h3>
                        Point of Sale
                    </h3>

                    <p>
                        Process transactions quickly with a
                        simple checkout interface designed
                        for everyday business operations.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        📦
                    </div>

                    <h3>
                        Inventory Management
                    </h3>

                    <p>
                        Track your products, monitor stock
                        levels, and identify low-stock items
                        before they become a problem.
                    </p>

                </div>


                <div class="feature-card">

                    <div class="feature-icon">
                        📊
                    </div>

                    <h3>
                        Business Reports
                    </h3>

                    <p>
                        Understand your business with sales,
                        inventory, transaction, and performance
                        reports.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         CTA
    ========================================================== -->

    <section class="cta" id="about">

        <div class="cta-inner">

            <h2>
                Ready to simplify your business?
            </h2>

            <p>
                Start managing your sales and inventory
                with NexPOS today.
            </p>

            <a
                href="{{ route('register') }}"
                class="primary-button"
            >
                Create Your Account →
            </a>

        </div>

    </section>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer class="footer">

        <div class="footer-inner">

            <p>
                © {{ date('Y') }} NexPOS.
                All rights reserved.
            </p>

            <div class="footer-brand">
                Nex<span>POS</span>
            </div>

        </div>

    </footer>

</body>
</html>