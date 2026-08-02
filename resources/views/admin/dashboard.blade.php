@extends('layouts.admin')

@section('content')

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Total Kategori</h6>
                <h2>{{ $totalKategori }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Total Alat</h6>
                <h2>{{ $totalAlat }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Penyewaan</h6>
                <h2>{{ $totalPenyewaan }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h6>Pengembalian</h6>
                <h2>{{ $totalPengembalian }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection