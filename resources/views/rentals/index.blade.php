@extends('layouts.admin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Data Penyewaan
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
                    <th>Tanggal Sewa</th>
                    <th>Tanggal Kembali</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($rentals as $rental)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $rental->user->name }}</td>

                    <td>{{ $rental->rental_date }}</td>

                    <td>{{ $rental->return_date }}</td>

                    <td>
                        Rp {{ number_format($rental->total_price,0,',','.') }}
                    </td>

                    <td>

                        @switch($rental->status)

                            @case('menunggu')
                                <span class="badge bg-warning text-dark">
                                    ⏳ Menunggu
                                </span>
                                @break

                            @case('diproses')
                                <span class="badge bg-info">
                                    ⚙️ Diproses
                                </span>
                                @break

                            @case('siap_diambil')
                                <span class="badge bg-success">
                                    📦 Siap Diambil
                                </span>
                                @break

                            @case('dipinjam')
                                <span class="badge bg-primary">
                                    🚚 Dipinjam
                                </span>
                                @break

                            @case('selesai')
                                <span class="badge bg-dark">
                                    ✅ Selesai
                                </span>
                                @break

                            @default
                                <span class="badge bg-secondary">
                                    {{ ucfirst($rental->status) }}
                                </span>

                        @endswitch

                    </td>

                    <td>

                        <a href="{{ route('rentals.show',$rental->id) }}"
                           class="btn btn-info btn-sm">

                            Detail

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        Belum ada data penyewaan.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection