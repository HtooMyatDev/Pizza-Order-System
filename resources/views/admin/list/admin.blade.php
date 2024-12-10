@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <form action="{{ route('admin#list') }}" method="GET">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-4">Admin List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class=""> <a href="{{ route('admin#user#list') }}" class="btn btn-outline-primary">Go to
                                    User List</a></li>
                        </ol>

                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                            aria-describedby="btnNavbarSearch" name="searchKey" />
                        <button class="btn btn-primary" id="btnNavbarSearch"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                        <th scope="col">Provider</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($admins as $admin)
                        <tr>
                            <th scope="row">{{ $admin->id }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->address }}</td>
                            <td>{{ $admin->role }}</td>
                            <td>
                                @if ($admin->provider == 'simple')
                                    <i class="fa-solid fa-right-to-bracket text-success"></i>
                                @elseif ($admin->provider == 'google')
                                    <i class="fa-brands fa-google text-primary"></i>
                                @else
                                    <i class="fa-brands fa-github text-dark"></i>
                                @endif
                            </td>
                            @if ($admin->role == 'admin' && Auth::user()->role == 'superadmin')
                                <td>
                                    <a href="{{ route('admin#delete', $admin->id) }}"><i
                                            class="fa-solid fa-trash-can btn btn-danger rounded"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (Auth::user()->role == 'superadmin')

                <a href="{{ route('admin#add#accountPage') }}"
                    class="fw-bold ink-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Add
                    Admin to Team</a>

            @endif
        </div>
    </main>
@endsection
