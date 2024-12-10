@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pizza List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Update Pizza Details</li>
            </ol>
        </div>
    </main>
    <form action="{{ route('admin#pizzas#edit') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pizzaID" value="{{ $pizza->id }}">

        <input type="hidden" name="oldImage" value="{{ $pizza->photo }}">
        <div class="row m-3">
            <div class="col offset-1">
                <div class="row">
                    <div class="col-3">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary"></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Photo of Pizza</h6>
                                    <img src="{{ asset('pizza/' . $pizza->photo) }}" alt=""
                                        class="img-thumbnail mb-3" style="height:355px;width:355px;object-fit: cover"
                                        id="output">
                                    <input type="file" name="photo" onchange="loadFile(event)"
                                        class="form-control @error('photo')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('photo') }}">
                                    @error('photo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary"></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="fw-bold">Pizza Name</h6>
                                    <input type="text" name="name"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        placeholder="Enter Pizza Name..." value="{{ old('name', $pizza->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <h6 class="fw-bold">Pizza Price</h6>
                                    <input type="number" name="price"
                                        class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                                        placeholder="Enter Pizza Price..." value="{{ old('price', $pizza->price) }}">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h6 class="fw-bold">Pizza Description</h6>
                                    <textarea type="number" name="description"
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        placeholder="Enter Pizza Description..." rows=4>{{ old('description', $pizza->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <h6 class="fw-bold">Pizza Category</h6>
                                    <select name="pizza_category_id" class="form-select">
                                        <option value="">Choose Category...</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('pizza_category_id', $pizza->pizza_category_id) == $category->id) selected @endif>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizza_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary w-100">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
