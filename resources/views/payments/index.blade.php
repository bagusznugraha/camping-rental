@extends('layouts.admin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Daftar Pembayaran
        </h4>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th width="60">No</th>

                    <th>Pelanggan</th>

                    <th>Jenis</th>

<th>Total Tagihan</th>

<th>Dibayar</th>

<th>Sisa</th>

<th>Status</th>

<th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($payments as $payment)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $payment->rental->user->name }}</td>

                    <td>

                        Rp {{ number_format($payment->amount,0,',','.') }}

                    </td>

                    <td>

@if($payment->payment_type=='deposit')

<span class="badge bg-warning">

Deposit

</span>

@elseif($payment->payment_type=='remaining')

<span class="badge bg-info">

Pelunasan

</span>

@else

<span class="badge bg-success">

Bayar Lunas

</span>

@endif

</td>

<td>

Rp {{ number_format($payment->amount,0,',','.') }}

</td>

<td>

Rp {{ number_format($payment->amount_paid,0,',','.') }}

</td>

<td>

Rp {{ number_format($payment->remaining_amount,0,',','.') }}

</td>

<td>

@if($payment->status=="Belum Bayar")

<span class="badge bg-secondary">

Belum Bayar

</span>

@elseif($payment->status=="Menunggu Verifikasi")

<span class="badge bg-warning text-dark">

Menunggu Verifikasi

</span>

@elseif($payment->status=="Menunggu Verifikasi Pelunasan")

<span class="badge bg-primary">

Menunggu Pelunasan

</span>

@elseif($payment->status=="Deposit Diterima")

<span class="badge bg-success">

Deposit Diterima

</span>

@elseif($payment->status=="Lunas")

<span class="badge bg-success">

Lunas

</span>

@elseif($payment->status=="Ditolak")

<span class="badge bg-danger">

Ditolak

</span>

@else

<span class="badge bg-secondary">

{{ $payment->status }}

</span>

@endif

</td>

                        <a href="{{ route('payments.show',$payment) }}"
                           class="btn btn-primary btn-sm">

                            Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada pembayaran.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection