@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <form action="{{ route('admin#user#list') }}" method="GET">
                <div class="row">
                    <div class="col">
                        <h1 class="mt-4">User List</h1>
                        <ol class="breadcrumb mb-4">
                            <li class=""> <a href="{{ route('admin#list') }}" class="btn btn-outline-primary">Go to Admin
                                    List</a></li>
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
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if ($user->provider == 'simple')
                                    <i class="fa-solid fa-right-to-bracket text-success"></i>
                                @elseif ($user->provider == 'google')
                                    <i class="fa-brands fa-google text-primary"></i>
                                @else
                                    <i class="fa-brands fa-github text-dark"></i>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin#user#delete', $user->id) }}"><i
                                        class="fa-solid fa-trash-can btn btn-danger rounded"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </main>
@endsection
