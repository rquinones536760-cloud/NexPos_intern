@extends('layouts.app')

@section('title', 'Edit User - NexPOS')
@section('page-title', 'Edit User')

@section('content')

<div class="page-header">

    <div>
        <h1>Edit User</h1>
        <p>Update account information and permissions.</p>
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
        action="{{ route('users.update', $user) }}"
    >

        @csrf
        @method('PUT')


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
                    value="{{ old('name', $user->name) }}"
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
                    value="{{ old('email', $user->email) }}"
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
                    New Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Leave blank to keep current password"
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
                    Confirm New Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm new password"
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

                    <option
                        value="user"
                        {{ old('role', $user->role) === 'user' ? 'selected' : '' }}
                    >
                        User
                    </option>

                    <option
                        value="admin"
                        {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                    >
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
                Save Changes
            </button>

        </div>

    </form>

</div>

@endsection