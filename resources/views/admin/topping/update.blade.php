@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Payment Method</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Payment Method Edit</li>
            </ol>

            <div class="row m-4">
                <div class="col-8 offset-2">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary"></div>
                        <div class="card-body">
                            <form action="{{ route('admin#toppings#edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="toppingID" value="{{ $topping->id }}">
                                <div class="mb-3">
                                    <h5 class="fw-bold">Type of Topping</h5>
                                    <input type="text" name="topping" value="{{ old('topping', $topping->topping) }}"
                                        placeholder="Enter Topping Name..."
                                        class="form-control @error('topping')
                                            is-invalid
                                        @enderror">
                                    @error('topping')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h5 class="fw-bold">Topping Counts</h5>
                                    <input type="number" name="count" value="{{ old('count', $topping->count) }}"
                                        placeholder="Enter Topping Amount..."
                                        class="form-control @error('count')
                                            is-invalid
                                        @enderror">
                                    @error('count')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h5 class="fw-bold">Price per Topping</h5>
                                    <input type="number" name="price" value="{{ old('price', $topping->price) }}"
                                        placeholder="Enter Price per Topping..."
                                        class="form-control @error('price')
                                            is-invalid
                                        @enderror">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <h5 class="fw-bold">Price per Topping</h5>
                                    <select name="pizza_category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == $topping->pizza_category_id) selected @endif>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <a href="{{ route('admin#toppings') }}" class="btn btn-success">Return</a>
                                    <button class="btn btn-outline-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
