@extends('layouts.app')

@section('title', 'Add User - NexPOS')
@section('page-title', 'Add User')

@section('content')

<div class="page-header">

    <div>
        <h1>Add User</h1>
        <p>Create a new NexPOS account.</p>
    </div>

    <a
        href="{{ route('users.index') }}"
        class="btn-secondary"
    >
        Back
    </a>

</div>


<div class="card form-card">

    <form
        method="POST"
        action="{{ route('users.store') }}"
    >

        @csrf


        <div class="form-grid">

            <!-- NAME -->

            <div class="form-group">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter full name"
                    required
                >

                @error('name')
                    <small class="error-text">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter email address"
                    required
                >

                @error('email')
                    <small class="error-text">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            <!-- PASSWORD -->

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimum 8 characters"
                    required
                >

                @error('password')
                    <small class="error-text">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            <!-- CONFIRM PASSWORD -->

            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    required
                >

            </div>


            <!-- ROLE -->

            <div class="form-group">

                <label for="role">
                    Account Role
                </label>

                <select
                    id="role"
                    name="role"
                    required
                >

                    <option value="user">
                        User
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>

                @error('role')
                    <small class="error-text">
                        {{ $message }}
                    </small>
                @enderror

            </div>

        </div>


        <!-- BUTTONS -->

        <div class="form-actions">

            <a
                href="{{ route('users.index') }}"
                class="btn-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn-primary"
            >
                Create User
            </button>

        </div>

    </form>

</div>

@endsection