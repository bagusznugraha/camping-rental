@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Data Alat Camping</h3>

    <a href="{{ route('equipment.create') }}" class="btn btn-primary">
        + Tambah Alat
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark text-center">

                    <tr>

                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Alat</th>
                        <th>Kategori</th>
                        <th>Total Barang</th>
                        <th>Stok Tersedia</th>
                        <th>Harga / Hari</th>
                        <th>Spesifikasi</th>
                        <th width="150">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($equipments as $equipment)

                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="text-center">

                            @if($equipment->image)

                                <img
                                    src="{{ asset('images/'.$equipment->image) }}"
                                    width="90"
                                    class="rounded border">

                            @else

                                <span class="text-muted">
                                    Tidak ada foto
                                </span>

                            @endif

                        </td>

                        <td>

                            <strong>
                                {{ $equipment->name }}
                            </strong>

                        </td>

                        <td>

                            {{ $equipment->category->name }}

                        </td>

                        <td class="text-center">

                            {{ $equipment->total_unit }}

                        </td>

                        <td class="text-center">

                            {{ $equipment->stock }}

                        </td>

                        <td>

                            Rp {{ number_format($equipment->price,0,',','.') }}

                        </td>

                        <td style="min-width:250px">

                            @if($equipment->specification)

                                <pre style="white-space:pre-wrap;font-family:inherit;margin:0;">{{ $equipment->specification }}</pre>

                            @else

                                <span class="text-muted">

                                    Belum ada spesifikasi

                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <a
                                href="{{ route('equipment.edit',$equipment->id) }}"
                                class="btn btn-warning btn-sm mb-1">

                                Edit

                            </a>

                            <form
                                action="{{ route('equipment.destroy',$equipment->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus alat ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            Belum ada data alat camping.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection