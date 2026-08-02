@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Kategori & Alat Camping
        </h3>

        <small class="text-muted">
            Kelola kategori alat camping beserta seluruh alat di dalamnya.
        </small>

    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-success">

        <i class="bi bi-plus-circle"></i>

        Tambah Kategori

    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow border-0">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Daftar Kategori

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark text-center">

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Kategori</th>

                        <th width="150">Jumlah Alat</th>

                        <th width="250">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td class="text-center">

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <strong class="text-success">

                                {{ $category->name }}

                            </strong>

                            @if($category->description)

                                <br>

                                <small class="text-muted">

                                    {{ $category->description }}

                                </small>

                            @endif

                        </td>

                        <td class="text-center">

                            <span class="badge bg-primary fs-6">

                                {{ $category->equipments_count }} Alat

                            </span>

                        </td>

                        <td class="text-center">

                            <a href="{{ route('categories.show',$category->id) }}"
                               class="btn btn-info btn-sm">

                                <i class="bi bi-eye"></i>

                                Lihat

                            </a>

                            <a href="{{ route('categories.edit',$category->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                                Edit

                            </a>

                            <form action="{{ route('categories.destroy',$category->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                    <i class="bi bi-trash"></i>

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-4">

                            <div class="text-muted">

                                Belum ada kategori.

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