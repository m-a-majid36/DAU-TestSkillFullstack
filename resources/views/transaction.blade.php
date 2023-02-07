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
                        <strong>{{ __('Transaksi') }}</strong>
                    </h4>
                    <div class="card-body">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1">No.</th>
                                    <th class="text-center">Nomor Referensi</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Total Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $data)
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle">{{ $loop->iteration }}
                                        </th>
                                        <td style="vertical-align: middle">{{ $data->reference_no }}</td>
                                        <td style="vertical-align: middle">{{ $data->product->name }}</td>
                                        <td style="vertical-align: middle">Rp.{{ $data->price }},-</td>
                                        <td class="text-center" style="vertical-align: middle">{{ $data->quantity }}</td>
                                        <td style="vertical-align: middle">Rp.{{ $data->payment_amount }},-</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transaction->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
