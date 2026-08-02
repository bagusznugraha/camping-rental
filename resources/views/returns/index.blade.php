@extends('layouts.admin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Data Pengembalian
        </h4>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="60">No</th>

                        <th>Pelanggan</th>

                        <th>Jumlah Alat</th>

                        <th width="430">Barang Dipinjam</th>

                        <th>Tanggal Sewa</th>

                        <th>Tanggal Kembali</th>

                        <th>Total</th>

                        <th width="190">Aksi</th>

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

                                <div class="card border-0 shadow-sm mb-2">

                                    <div class="card-body p-2">

                                        <div class="d-flex align-items-center">

                                            {{-- FOTO BARANG --}}
                                            @if($detail->equipment && $detail->equipment->image)

                                                <img
                                                    src="{{ asset('images/'.$detail->equipment->image) }}"
                                                    alt="{{ $detail->equipment->name }}"
                                                    width="80"
                                                    height="80"
                                                    class="rounded border me-3"
                                                    style="object-fit:cover;">

                                            @else

                                                <div
                                                    class="border rounded d-flex align-items-center justify-content-center me-3"
                                                    style="width:80px;height:80px;background:#f5f5f5;font-size:12px;">

                                                    No Image

                                                </div>

                                            @endif

                                            <div>

                                                <h6 class="fw-bold text-success mb-2">

                                                    {{ $detail->equipment->name }}

                                                </h6>

                                                <small>

                                                    Jumlah :
                                                    <strong>

                                                        {{ $detail->quantity }}

                                                    </strong>

                                                </small>

                                                <br>

                                                <small>

                                                    Subtotal :

                                                    <strong>

                                                        Rp {{ number_format($detail->subtotal,0,',','.') }}

                                                    </strong>

                                                </small>

                                            </div>

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

                            <form
                                action="{{ route('returns.store',$rental->id) }}"
                                method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    class="btn btn-primary btn-sm w-100"
                                    onclick="return confirm('Yakin ingin memproses pengembalian alat ini?')">

                                    ✔ Proses Pengembalian

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center py-4">

                            <div class="text-muted">

                                Belum ada data pengembalian.

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