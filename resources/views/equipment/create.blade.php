@extends('layouts.admin')

@section('content')

<div class="card shadow">

<div class="card-header">

Tambah Alat Camping

</div>

<div class="card-body">

<form action="{{ route('equipment.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Kategori</label>

<select
name="category_id"
class="form-control">

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Nama Alat</label>

<input
type="text"
name="name"
class="form-control">

</div>

<div class="mb-3">

<label>Stok</label>

<input
type="number"
name="stock"
class="form-control">

<div class="mb-3">

    <label class="form-label">

        Total Barang

    </label>

    <input
        type="number"
        name="total_unit"
        class="form-control"
        required>

</div>

</div>

<div class="mb-3">

<label>Harga / Hari</label>

<input
type="number"
name="price"
class="form-control">

</div>

<div class="mb-3">

<label class="form-label">

    Spesifikasi Barang

</label>

<textarea
    name="specification"
    class="form-control"
    rows="6"
    placeholder="Contoh:

• Kapasitas : 60 Liter
• Berat : 2,3 Kg
• Material : Nylon Waterproof
• Warna : Hitam"></textarea>

</div>

<div class="mb-3">

<label>Foto</label>

<input
type="file"
name="image"
class="form-control">

</div>

<button class="btn btn-primary">

Simpan

</button>

<a href="{{ route('equipment.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@endsection