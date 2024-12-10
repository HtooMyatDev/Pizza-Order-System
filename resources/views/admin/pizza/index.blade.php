@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pizza List</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add Pizza to List</li>
            </ol>
        </div>
    </main>

    <div class="row m-3">
        <div class="col-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary"></div>
                <div class="card-body">
                    <form action="{{ route('admin#pizzas#create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <h6 class="fw-bold">Pizza Name</h6>
                            <input type="text" name="name"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                placeholder="Enter Pizza Name..." value="{{ old('name') }}">
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
                                placeholder="Enter Pizza Price..." value="{{ old('price') }}">
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
                                placeholder="Enter Pizza Description...">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold">Photo of Pizza</h6>
                            <img src="{{ asset('pizza/default.png') }}" class="mb-3 img-fluid img-thumbnail"
                                style="height: 355px; width: 355px; object-fit: cover" id="output">
                            <input type="file" name="photo" onchange="loadFile(event)"
                                class="form-control @error('photo')
                                is-invalid
                            @enderror"
                                value="{{ old('photo') }}">
                            @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Pizza Category</h6>
                            <select name="pizza_category_id" class="form-select">
                                <option value="">Choose Category...</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('pizza_category_id') == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('pizza_category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="">
                            <button class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col text-center">
            <div class="card shadow-sm">
                <div class="card-header bg-primary"></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Pizza Category</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @if (count($pizzas) > 0)
                                @foreach ($pizzas as $pizza)
                                    <tr>
                                        <th scope="row">{{ $pizza->id }}</th>
                                        <td>{{ $pizza->name }}</td>
                                        <td>{{ $pizza->price }} <span class="text-primary fw-bold">mmk</span></td>
                                        <td>
                                            <img src="{{ asset('pizza/' . $pizza->photo) }}"
                                                style="height: 80px; width:80px; object-fit: cover"
                                                class="img-thumbnail img-fluid">
                                        </td>
                                        <td>{{ $pizza->category_name }}</td>
                                        <td>{{ $pizza->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $pizza->updated_at->format('j-F-Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin#pizzas#delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="pizzaImage" value="{{ $pizza->photo }}">
                                                <input type="hidden" name="pizzaID" value="{{ $pizza->id }}">
                                                <button class="btn btn-sm"><i
                                                        class="fa-solid fa-trash-can btn btn-md btn-outline-danger rounded"></i></button>
                                                <a href="{{ route('admin#pizzas#editPage', $pizza->id) }}"><i
                                                        class="fa-solid fa-pen-to-square btn btn-md btn-outline-primary"></i></a>
                                            </form>

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

@endsection
