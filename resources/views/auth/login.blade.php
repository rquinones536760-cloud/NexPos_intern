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
        Sign In - NexPOS
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
                    circle at top left,
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
            width: 58px;
            height: 58px;

            object-fit: contain;
        }

        .auth-brand strong {
            margin-top: 10px;

            color: #0f172a;

            font-size: 23px;
            letter-spacing: -0.5px;
        }

        .auth-brand strong span {
            color: #2563eb;
        }

        .auth-brand p {
            margin-top: 5px;

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
            margin-top: 24px;
        }

        .form-group {
            margin-bottom: 17px;
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
            height: 45px;

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

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin: 4px 0 20px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 7px;

            color: #64748b;

            font-size: 10px;
        }

        .remember-label input {
            accent-color: #2563eb;
        }

        .auth-button {
            width: 100%;
            height: 45px;

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
            margin-top: 6px;

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
            Welcome Back
        </h1>

        <p>
            Sign in to access your NexPOS dashboard.
        </p>


        @if ($errors->any())

            <div class="auth-error">

                {{ $errors->first() }}

            </div>

        @endif


        <form
            action="{{ route('login.store') }}"
            method="POST"
            class="auth-form"
        >

            @csrf


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
                    autofocus
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
                    placeholder="Enter your password"
                    required
                >

                @error('password')

                    <div class="auth-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Remember --}}
            <div class="remember-row">

                <label class="remember-label">

                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                    >

                    Remember me

                </label>

            </div>


            <button
                type="submit"
                class="auth-button"
            >
                Sign In
            </button>

        </form>


        <div class="auth-footer">

            Don't have an account?

            <a href="{{ route('register') }}">
                Create Account
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