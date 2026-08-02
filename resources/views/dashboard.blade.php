@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">
    Dashboard Admin
</h3>
@if($waitingPayment > 0)

<div class="alert alert-warning border-0 shadow-lg rounded-4 mb-4">

    <div class="d-flex justify-content-between align-items-center">

        <div>

            <h5 class="fw-bold mb-1">

                🟡 {{ $waitingPayment }} Pembayaran Menunggu Verifikasi

            </h5>

            <small>

                Ada pelanggan yang sudah mengirim bukti pembayaran.
                Silakan lakukan verifikasi agar penyewaan dapat diproses.

            </small>

        </div>

        <a
            href="{{ route('rentals.index') }}"
            class="btn btn-dark">

            <i class="bi bi-credit-card"></i>

            Verifikasi

        </a>

    </div>

</div>

@endif

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow bg-primary text-white">
            <div class="card-body text-center">
                <h1>{{ $totalEquipment }}</h1>
                <h5>📦 Total Alat</h5>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow bg-success text-white">
            <div class="card-body text-center">
                <h1>{{ $totalCategory }}</h1>
                <h5>📁 Kategori</h5>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow bg-warning text-dark">
            <div class="card-body text-center">
                <h1>{{ $totalCustomer }}</h1>
                <h5>👤 Pelanggan</h5>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow bg-danger text-white">
            <div class="card-body text-center">
                <h1>{{ $totalRental }}</h1>
                <h5>📝 Total Penyewaan</h5>
            </div>
        </div>
    </div>

</div>

<div class="row mt-2">

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow">

            <div class="card-body text-center">

                <h2 class="text-warning">

                    {{ $waitingRental }}

                </h2>

                <h5>⏳ Menunggu</h5>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow">

            <div class="card-body text-center">

                <h2 class="text-primary">

                    {{ $borrowedRental }}

                </h2>

                <h5>🚚 Dipinjam</h5>

            </div>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow">

            <div class="card-body text-center">

                <h2 class="text-success">

                    {{ $finishedRental }}

                </h2>

                <h5>✅ Selesai</h5>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Penyewaan Terbaru

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th width="60">No</th>

                    <th>Pelanggan</th>

                    <th>Tanggal Sewa</th>

                    <th>Total</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($latestRentals as $rental)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $rental->user->name }}</td>

                    <td>{{ $rental->rental_date }}</td>

                    <td>

                        Rp {{ number_format($rental->total_price,0,',','.') }}

                    </td>

                    <td>

                        @if($rental->status=='menunggu')

                            <span class="badge bg-warning text-dark">
                                Menunggu
                            </span>

                        @elseif($rental->status=='diproses')

                            <span class="badge bg-info">
                                Diproses
                            </span>

                        @elseif($rental->status=='siap_diambil')

                            <span class="badge bg-success">
                                Siap Diambil
                            </span>

                        @elseif($rental->status=='dipinjam')

                            <span class="badge bg-primary">
                                Dipinjam
                            </span>

                        @elseif($rental->status=='selesai')

                            <span class="badge bg-dark">
                                Selesai
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ ucfirst($rental->status) }}
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">

                        Belum ada data penyewaan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection