@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pizza Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Create Unique Category for Pizzas</li>
            </ol>
        </div>
    </main>
    <form action="{{ route('admin#categories#create') }}" method="post">
        @csrf
        <div class="row m-3">
            <div class="col-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary"></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Pizza Category</h6>
                            <input type="text" name="category"
                                class="form-control @error('category')
                                is-invalid
                            @enderror"
                                placeholder="Enter Category Name..." value="{{ old('category') }}">
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <button class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary"></div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Updated at</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->id }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>{{ $category->updated_at->format('j-F-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#categories#editPage', $category->id) }}"><i
                                                        class="fa-solid fa-pen-to-square btn btn-md btn-outline-primary"></i></a>
                                            </td>
                                        <tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center h5 text-danger">There is no data available
                                            yet!</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
