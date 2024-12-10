@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Toppings</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Add Topping to Table</li>
            </ol>
        </div>
    </main>
    <form action="{{ route('admin#toppings#create') }}" method="post">
        @csrf
        <div class="row m-3">
            <div class="col-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary"></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold">Type of Topping</h6>
                            <input type="text" name="topping"
                                class="form-control @error('topping')
                                is-invalid
                            @enderror"
                                placeholder="Enter Topping Name..." value="{{ old('topping') }}">
                            @error('topping')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Topping Counts</h6>
                            <input type="number" name="count"
                                class="form-control @error('count')
                                is-invalid
                            @enderror"
                                placeholder="Enter Topping Amount..." value="{{ old('count') }}">
                            @error('count')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Price per Topping</h6>
                            <input type="number" name="price"
                                class="form-control @error('price')
                                is-invalid
                            @enderror"
                                placeholder="Enter Price per Topping..." value="{{ old('price') }}">
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h6 class="fw-bold">Pizza Category</h6>
                            <select name="pizza_category_id" class="form-select">
                                <option value="">Choose Category...</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('pizza_category_id') == $category->id)  @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
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
                                    <th scope="col">Topping Type</th>
                                    <th scope="col">Topping Amount</th>
                                    <th scope="col">Price per Topping</th>
                                    <th scope="col">Pizza Category</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Updated at</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (count($toppings) > 0)
                                    @foreach ($toppings as $topping)
                                        <tr>
                                            <th scope="row">{{ $topping->id }}</th>
                                            <td>{{ $topping->topping }}</td>
                                            <td>{{ $topping->count }} @if ($topping->count <= 25)
                                                    <span class="fw-bold text-danger">Low Amount<span>
                                                @endif
                                            </td>
                                            <td>{{ $topping->price }}</td>
                                            <td>{{ $topping->category }}</td>
                                            <td>{{ $topping->created_at->format('j-F-Y') }}</td>
                                            <td>{{ $topping->updated_at->format('j-F-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#toppings#delete', $topping->id) }}"><i
                                                        class="fa-solid fa-trash-can btn btn-md btn-outline-danger rounded"></i></a>

                                                <a href="{{ route('admin#toppings#editPage', $topping->id) }}"><i
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
