@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold">

            {{ $category->name }}

        </h3>

        <p class="text-muted mb-0">

            {{ $category->description }}

        </p>

    </div>

    <div>

        <a href="{{ route('equipment.create') }}"
           class="btn btn-success">

            <i class="bi bi-plus-circle"></i>

            Tambah Alat

        </a>

        <a href="{{ route('categories.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow border-0">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Daftar Alat Pada Kategori {{ $category->name }}

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark text-center">

                    <tr>

                        <th width="60">No</th>

                        <th width="120">Foto</th>

                        <th>Nama Alat</th>

                        <th width="120">Total</th>

                        <th width="120">Stok</th>

                        <th width="160">Harga / Hari</th>

                        <th>Spesifikasi</th>

                        <th width="170">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($category->equipments as $equipment)

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

                        <td colspan="8" class="text-center py-4">

                            Belum ada alat pada kategori ini.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection