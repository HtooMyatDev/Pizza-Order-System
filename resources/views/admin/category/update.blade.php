@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pizza Category</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Category Edit</li>
            </ol>

            <div class="row m-4">
                <div class="col-8 offset-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin#categories#edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="categoryID" value="{{ $category->id }}">
                                <div class="mb-3">
                                    <h5 class="fw-bold">Pizza Category</h5>
                                    <input type="text" name="category" value="{{ old('category', $category->name) }}"
                                        placeholder="Enter Category Name..."
                                        class="form-control @error('category')
                                            is-invalid
                                        @enderror">
                                    @error('category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('admin#categories') }}" class="btn btn-success">Return</a>
                                    <button class="btn btn-outline-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
