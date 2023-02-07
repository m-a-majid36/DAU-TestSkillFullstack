@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-header text-center">
                        <strong>{{ __('Tambah Produk') }}</strong>
                    </h4>
                    <div class="card-body">
                        <form method="POST" action="{{ route('product.update', $product->id) }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') ? old('name') : $product->name }}" required
                                        autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Harga') }}</label>
                                <div class="col-md-6">
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        value="{{ old('price') ? old('price') : $product->price }}" required
                                        autocomplete="price">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="stock"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Stock') }}</label>
                                <div class="col-md-6">
                                    <input id="stock" type="number"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        name="stock"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        value="{{ old('stock') ? old('stock') : $product->stock }}" required
                                        autocomplete="stock">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi') }}</label>
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description"
                                        value="{{ old('description') ? old('description') : $product->description }}"
                                        required autocomplete="description">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
