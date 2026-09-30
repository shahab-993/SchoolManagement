
@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="container-fluid mt-4 px-4">


    {{-- =========================
         Page Header
    ========================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">


        {{-- Page Title --}}

        <h1 class="mb-0">
            Users
        </h1>


        {{-- Search + Add User --}}

        <div class="d-flex align-items-center gap-3">


            {{-- Search --}}

            <div class="input-group">

                <span class="input-group-text bg-white">

                    <i class="bi bi-search"></i>

                </span>


                <input
                    type="search"
                    id="userSearch"
                    class="form-control"
                    placeholder="Search user by name or email..."
                    value="{{ $query ?? '' }}"
                >

            </div>


            {{-- Add User --}}

            @if(auth()->user()->hasPermission('create_users'))

                <a
                    href="{{ route('users.create') }}"
                    class="btn btn-primary-action text-nowrap">

                    <i class="bi bi-plus-lg me-1"></i>

                    Add User

                </a>

            @endif


        </div>

    </div>



    {{-- =========================
         Users Table
    ========================== --}}

    <div class="table-responsive">

        <table
            id="usersTable"
            class="table table-hover align-middle text-nowrap">


            {{-- Table Header --}}

            <thead>

                <tr>

                    <th>
                        ID
                    </th>

                    <th>
                        Name
                    </th>

                    <th>
                        Email
                    </th>

                    <th>
                        Role
                    </th>

                    <th>
                        Created
                    </th>

                    <th>
                        Actions
                    </th>

                </tr>

            </thead>



            {{-- Table Body --}}

            <tbody>

                @forelse ($users as $user)

                    <tr>


                        {{-- Number --}}

                        <td>

                            {{ $users->firstItem() + $loop->index }}

                        </td>



                        {{-- User Name --}}

                        <td>

                            {{ $user->name }}

                        </td>



                        {{-- Email --}}

                        <td>

                            {{ $user->email }}

                        </td>



                        {{-- Role --}}

                        <td>

                            @if ($user->role)

                                @if ($user->role->name === 'admin')

                                    <span class="badge bg-primary">

                                        Admin

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Teacher

                                    </span>

                                @endif

                            @else

                                <span class="badge bg-danger">

                                    No Role

                                </span>

                            @endif

                        </td>



                        {{-- Created Date --}}

                        <td>

                            {{ $user->created_at->format('Y-m-d') }}

                        </td>



                        {{-- Actions --}}

                        <td>


                            {{-- Edit --}}

                            @if(auth()->user()->hasPermission('edit_users'))

                                <a
                                    href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning"
                                    title="Edit User">

                                    <i class="bi bi-pencil"></i>

                                </a>

                            @endif



                            {{-- Delete --}}

                            @if(auth()->user()->hasPermission('delete_users'))

                                <form
                                    action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Delete User"
                                        onclick="return confirm('Are you sure you want to delete this user?');">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            @endif


                        </td>

                    </tr>

                @empty


                    {{-- No Users --}}

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-4 text-muted">

                            <i class="bi bi-people fs-4 d-block mb-2"></i>

                            No users found.

                        </td>

                    </tr>


                @endforelse

            </tbody>

        </table>



        {{-- =========================
             Pagination
        ========================== --}}

        <div class="mt-4">

            {{ $users->links() }}

        </div>


    </div>

</div>



{{-- =========================
     User Search
========================== --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const searchInput =
            document.getElementById('userSearch');


        if (searchInput) {

            let searchTimer;


            searchInput.addEventListener('input', function () {

                clearTimeout(searchTimer);


                searchTimer = setTimeout(function () {

                    const search =
                        searchInput.value.trim();


                    const url =
                        new URL(window.location.href);


                    if (search) {

                        url.searchParams.set(
                            'search',
                            search
                        );

                    } else {

                        url.searchParams.delete(
                            'search'
                        );

                    }


                    window.location.href =
                        url.toString();


                }, 500);

            });

        }

    });

</script>

@endsection

