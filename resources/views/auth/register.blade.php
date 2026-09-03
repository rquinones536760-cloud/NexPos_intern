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

    <title>
        Create Account - NexPOS
    </title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/NexPOSLogo.png') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/nexpos.css') }}"
    >

    <style>

        body.auth-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 25px;

            background:
                radial-gradient(
                    circle at top right,
                    #dbeafe,
                    transparent 38%
                ),
                #f5f7fb;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .auth-brand {
            display: flex;
            flex-direction: column;
            align-items: center;

            margin-bottom: 24px;

            text-align: center;
        }

        .auth-brand img {
            width: 55px;
            height: 55px;

            object-fit: contain;
        }

        .auth-brand strong {
            margin-top: 9px;

            color: #0f172a;

            font-size: 23px;
        }

        .auth-brand strong span {
            color: #2563eb;
        }

        .auth-brand p {
            margin-top: 4px;

            color: #64748b;

            font-size: 11px;
        }

        .auth-card {
            padding: 30px;

            background: #fff;

            border:
                1px solid #e2e8f0;

            border-radius: 18px;

            box-shadow:
                0 20px 50px rgba(15, 23, 42, 0.08);
        }

        .auth-card h1 {
            color: #0f172a;

            font-size: 24px;
            letter-spacing: -0.5px;
        }

        .auth-card > p {
            margin-top: 6px;

            color: #64748b;

            font-size: 12px;
        }

        .auth-form {
            margin-top: 23px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 11px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            height: 44px;

            padding: 0 13px;

            background: #f8fafc;

            border:
                1px solid #e2e8f0;

            border-radius: 9px;

            color: #0f172a;

            font-size: 12px;

            outline: none;

            transition: 0.2s ease;
        }

        .form-control:focus {
            background: #fff;

            border-color: #93c5fd;

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, 0.08);
        }

        .auth-button {
            width: 100%;
            height: 45px;

            margin-top: 5px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            border-radius: 9px;

            color: #fff;

            font-size: 12px;
            font-weight: 700;

            box-shadow:
                0 6px 15px
                rgba(37, 99, 235, 0.18);

            transition: 0.2s ease;
        }

        .auth-button:hover {
            transform: translateY(-1px);
        }

        .auth-error {
            margin-top: 5px;

            color: #dc2626;

            font-size: 10px;
        }

        .auth-footer {
            margin-top: 20px;

            text-align: center;

            color: #64748b;

            font-size: 11px;
        }

        .auth-footer a {
            color: #2563eb;

            font-weight: 700;
        }

        .back-home {
            display: block;

            margin-top: 17px;

            color: #64748b;

            text-align: center;

            font-size: 10px;
        }

        .back-home:hover {
            color: #2563eb;
        }

        @media (max-width: 480px) {

            body.auth-page {
                padding: 15px;
            }

            .auth-card {
                padding: 22px;
            }

        }

    </style>

</head>


<body class="auth-page">

<div class="auth-wrapper">


    {{-- Brand --}}
    <div class="auth-brand">

        <img
            src="{{ asset('images/NexPOSLogo.png') }}"
            alt="NexPOS"
        >

        <strong>
            Nex<span>POS</span>
        </strong>

        <p>
            Simple. Smart. Powerful Point of Sale.
        </p>

    </div>


    {{-- Card --}}
    <div class="auth-card">

        <h1>
            Create Account
        </h1>

        <p>
            Create your NexPOS account to get started.
        </p>


        @if ($errors->any())

            <div class="auth-error">

                {{ $errors->first() }}

            </div>

        @endif


        <form
            action="{{ route('register.store') }}"
            method="POST"
            class="auth-form"
        >

            @csrf


            {{-- Name --}}
            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autofocus
                >

                @error('name')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Email --}}
            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >

                @error('email')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Password --}}
            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Create a password"
                    required
                >

                @error('password')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Confirm Password --}}
            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Create Account
            </button>

        </form>


        <div class="auth-footer">

            Already have an account?

            <a href="{{ route('login') }}">
                Sign In
            </a>

        </div>

    </div>


    <a
        href="{{ route('home') }}"
        class="back-home"
    >
        ← Back to NexPOS Home
    </a>

</div>

</body>
</html>