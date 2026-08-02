@extends('layouts.admin')

@section('content')

<div class="card shadow">

<div class="card-header">

Edit Alat Camping

</div>

<div class="card-body">

<form action="{{ route('equipment.update',$equipment->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-3">

<label>Kategori</label>

<select
name="category_id"
class="form-control">

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ $equipment->category_id == $category->id ? 'selected' : '' }}>

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
class="form-control"
value="{{ $equipment->name }}">

</div>

<div class="mb-3">

<label>Stok</label>

<input
type="number"
name="stock"
class="form-control"
value="{{ $equipment->stock }}">

<div class="mb-3">

    <label class="form-label">

        Total Barang

    </label>

    <input
        type="number"
        name="total_unit"
        value="{{ $equipment->total_unit }}"
        class="form-control"
        required>

</div>

</div>

<div class="mb-3">

<label>Harga / Hari</label>

<input
type="number"
name="price"
class="form-control"
value="{{ $equipment->price }}">

</div>

<div class="mb-3">

<label class="form-label">

    Spesifikasi Barang

</label>

<textarea
    name="specification"
    class="form-control"
    rows="6">{{ old('specification',$equipment->specification) }}</textarea>

</div>

<div class="mb-3">

<label>Foto Baru</label>

<input
type="file"
name="image"
class="form-control">

</div>

@if($equipment->image)

<img src="{{ asset('images/'.$equipment->image) }}"
width="120"
class="mb-3">

@endif

<button class="btn btn-success">

Update

</button>

<a href="{{ route('equipment.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@endsection