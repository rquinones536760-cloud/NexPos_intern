@extends('layouts.app')

@section('title', 'Users - NexPOS')
@section('page-title', 'Users')

@section('content')

<div class="page-header">

    <div>
        <h1>User Management</h1>
        <p>Manage NexPOS administrator and user accounts.</p>
    </div>

    <a href="{{ route('users.create') }}" class="btn-primary">
        + Add User
    </a>

</div>


<div class="card">

    <div class="table-wrapper">

        <table class="data-table">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($users as $user)

                    <tr>

                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>

                            @if ($user->role === 'admin')

                                <span class="role-badge admin">
                                    Admin
                                </span>

                            @else

                                <span class="role-badge user">
                                    User
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>


                                @if ($user->id !== auth()->id())

                                    <form
                                        method="POST"
                                        action="{{ route('users.destroy', $user) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this user?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="empty-state">
                            No users found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection