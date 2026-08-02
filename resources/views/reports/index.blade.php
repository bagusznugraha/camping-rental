@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">
    📊 Laporan Penyewaan
</h3>

<div class="row">

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-success text-white border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>
                    Rp {{ number_format($totalPendapatan,0,',','.') }}
                </h3>
                <small>Total Pendapatan</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-primary text-white border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>{{ $totalSewa }}</h3>
                <small>Total Penyewaan</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-warning border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>{{ $menunggu }}</h3>
                <small>Menunggu</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-info text-white border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>{{ $diproses }}</h3>
                <small>Diproses</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-primary text-white border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>{{ $dipinjam }}</h3>
                <small>Dipinjam</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2 mb-3">
        <div class="card bg-dark text-white border-0 shadow h-100">
            <div class="card-body text-center">
                <h3>{{ $selesai }}</h3>
                <small>Selesai</small>
            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0 mt-3">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">
            🔍 Filter Laporan
        </h5>

    </div>

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Tanggal Awal

                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Tanggal Akhir

                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="form-control">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="semua">
                            Semua
                        </option>

                        <option value="menunggu"
                            {{ request('status')=='menunggu'?'selected':'' }}>
                            Menunggu
                        </option>

                        <option value="diproses"
                            {{ request('status')=='diproses'?'selected':'' }}>
                            Diproses
                        </option>

                        <option value="siap_diambil"
                            {{ request('status')=='siap_diambil'?'selected':'' }}>
                            Siap Diambil
                        </option>

                        <option value="dipinjam"
                            {{ request('status')=='dipinjam'?'selected':'' }}>
                            Dipinjam
                        </option>

                        <option value="selesai"
                            {{ request('status')=='selesai'?'selected':'' }}>
                            Selesai
                        </option>

                    </select>

                </div>

                <div class="col-md-3 d-flex align-items-end mb-3">

                    <button class="btn btn-success me-2">

                        🔍 Filter

                    </button>

                    <a
                        href="{{ route('reports.index') }}"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow border-0 mt-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            📋 Data Laporan Penyewaan

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="60">No</th>

                        <th>Pelanggan</th>

                        <th width="90">Jumlah Alat</th>

                        <th width="350">Barang</th>

                        <th>Tanggal Sewa</th>

                        <th>Tanggal Kembali</th>

                        <th>Total</th>

                        <th width="140">Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($rentals as $rental)
                                    <tr>

                        <td class="text-center">

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <strong>

                                {{ $rental->user->name }}

                            </strong>

                        </td>

                        <td class="text-center">

                            <span class="badge bg-success fs-6">

                                {{ $rental->rentalDetails->count() }} Alat

                            </span>

                        </td>

                        <td>

                            @foreach($rental->rentalDetails as $detail)

                                <div class="border rounded p-2 mb-2 bg-light">

                                    <div class="d-flex align-items-center">

                                        @if($detail->equipment->image)

                                            <img
                                                src="{{ asset('images/'.$detail->equipment->image) }}"
                                                width="55"
                                                height="55"
                                                class="rounded border me-2"
                                                style="object-fit:cover;">

                                        @endif

                                        <div>

                                            <div class="fw-bold text-success">

                                                {{ $detail->equipment->name }}

                                            </div>

                                            <small class="text-muted">

                                                Jumlah :
                                                <strong>

                                                    {{ $detail->quantity }}

                                                </strong>

                                            </small>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}

                        </td>

                        <td>

                            <strong class="text-success">

                                Rp {{ number_format($rental->total_price,0,',','.') }}

                            </strong>

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

                        <td colspan="8" class="text-center py-4">

                            <div class="text-muted">

                                Belum ada data laporan penyewaan.

                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection