@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-1">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <h4 class="card-header text-center">
                        <strong>{{ __('Produk') }}</strong>
                    </h4>
                    <div class="card-body">
                        <div class="d-flex mb-3" style="justify-content: space-between">
                            <div class="mt-2">
                                <a href="{{ route('product.create') }}" class="btn btn-success">Tambah Produk</a>
                            </div>
                            <form action="{{ route('product.index') }}" class="d-flex">
                                <input type="text" id="keyword" name="keyword" class="form-control m-1"
                                    placeholder="Cari Poduk" value="{{ request('keyword') }}">
                                <button class="btn btn-primary m-1" type="submit">
                                    {{ 'Cari' }}
                                </button>
                            </form>

                        </div>
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1">No.</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center" width="170">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $data)
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle">{{ $loop->iteration }}
                                        </th>
                                        <td style="vertical-align: middle">{{ $data->name }}</td>
                                        <td style="vertical-align: middle">Rp.{{ $data->price }},-</td>
                                        <td class="text-center" style="vertical-align: middle">{{ $data->stock }}</td>
                                        <td style="vertical-align: middle">{{ $data->description }}</td>
                                        <td style="vertical-align: middle" class="text-center">
                                            <form method="POST"
                                                action="{{ route('product.destroy', ['product' => $data->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('product.edit', ['product' => $data->id]) }}"
                                                    class="m-2 btn btn-primary">Edit</i></a>
                                                <button type="submit" class="m-2 btn btn-danger text-white"
                                                    style="text-decoration-style: none">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $product->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
