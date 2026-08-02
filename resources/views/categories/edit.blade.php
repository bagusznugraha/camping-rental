@extends('layouts.admin')

@section('content')

<div class="card shadow">

<div class="card-header">

Edit Kategori

</div>

<div class="card-body">

<form action="{{ route('categories.update',$category->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nama Kategori</label>

<input
type="text"
name="name"
class="form-control"
value="{{ $category->name }}"
required>

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="description"
class="form-control"
rows="4">{{ $category->description }}</textarea>

</div>

<button class="btn btn-success">

Update

</button>

<a href="{{ route('categories.index') }}"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

@endsection