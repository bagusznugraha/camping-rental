<x-app-layout>

<x-slot name="header">
    <h2 class="fw-bold">
        👤 Profil Saya
    </h2>
</x-slot>

<div class="container py-4">

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<div class="card shadow border-0 mb-4">

    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Informasi Akun</h4>
    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-4">
                <h6>Nama</h6>
                <h5>{{ $user->name }}</h5>
            </div>

            <div class="col-md-4">
                <h6>Email</h6>
                <h5>{{ $user->email }}</h5>
            </div>

            <div class="col-md-4">
                <h6>Total Penyewaan</h6>
                <h3 class="text-success">{{ $rentals->count() }}</h3>
            </div>

        </div>

    </div>

</div>


<div class="card shadow border-0">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            📦 Riwayat Penyewaan
        </h4>

    </div>

    <div class="card-body">

@forelse($rentals as $rental)

<div class="card shadow-sm mb-4 border-0">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-3">

<div>

<h5 class="fw-bold">
Penyewaan #{{ $rental->id }}
</h5>

<small class="text-muted">

@if($rental->rental_date)

{{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}

@

{{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}

@else

<span class="text-warning">

Menunggu penyewaan dimulai

</span>

@endif

</small>

</div>

<div>

@if($rental->payment && $rental->payment->status == 'Ditolak')

    <span class="badge bg-danger">
        Pembayaran Ditolak
    </span>

@elseif($rental->status=="menunggu")
<span class="badge bg-warning">Menunggu</span>

@elseif($rental->status=="diproses")
<span class="badge bg-info">Diproses</span>

@elseif($rental->status=="siap_diambil")
<span class="badge bg-success">Siap Diambil</span>

@elseif($rental->status=="dipinjam")
<span class="badge bg-primary">Dipinjam</span>

@elseif($rental->status=="selesai")
<span class="badge bg-dark">Selesai</span>

@else
<span class="badge bg-danger">
{{ $rental->status }}
</span>
@endif

</div>

</div>

<hr>

@foreach($rental->rentalDetails as $detail)

<div class="row align-items-center mb-3">

    <div class="col-md-2">

        @if($detail->equipment->image)

            <img
                src="{{ asset('images/'.$detail->equipment->image) }}"
                class="img-fluid rounded border"
                style="width:110px;height:110px;object-fit:cover;">

        @else

            <img
                src="https://via.placeholder.com/110x110?text=No+Image"
                class="img-fluid rounded border"
                style="width:110px;height:110px;object-fit:cover;">

        @endif

    </div>

    <div class="col-md-6">

        <h5>{{ $detail->equipment->name }}</h5>

        Jumlah :
        <strong>{{ $detail->quantity }}</strong>

    </div>

    <div class="col-md-4 text-end">

        <h5 class="text-success">
            Rp {{ number_format($detail->subtotal,0,',','.') }}
        </h5>

    </div>

</div>

@endforeach

<hr>

<div class="row">

<div class="col-md-6">

<p>

<strong>Metode Pengambilan</strong>

<br>

@if($rental->pickup_method=="Diambil")

📦 Diambil Sendiri

@else

🚚 Dikirim

@endif

</p>

@if($rental->pickup_method=="Diambil")

@php
    $mulaiPengambilan = \Carbon\Carbon::parse($rental->rental_date)->subDay();
    $terakhirPengambilan = \Carbon\Carbon::parse($rental->return_date);
@endphp

<div class="alert alert-warning py-3">

    <h5 class="fw-bold mb-3">
        📦 Waktu Pengambilan
    </h5>

    <p class="mb-2">
        <strong>📅</strong>
        {{ $mulaiPengambilan->format('d M Y') }}
        <strong>s/d</strong>
        {{ $terakhirPengambilan->format('d M Y') }}
    </p>

    <p class="mb-3">
        <strong>🕗</strong>
        Pukul <strong>08:00 - 18:00 WIB</strong>
    </p>

    <hr>

    <small class="text-danger">
        ⚠ Barang tidak dapat diambil lagi apabila masa penyewaan telah berakhir.
    </small>

</div>

@endif

@if($rental->pickup_method=="Dikirim")

<p>

<strong>Ongkir</strong>

<br>

Rp {{ number_format($rental->delivery_fee,0,',','.') }}

</p>

@endif

</div>

<div class="col-md-6 text-end">

<h4 class="text-success">

Rp {{ number_format($rental->total_price,0,',','.') }}

</h4>

<p class="text-muted">
Total Pembayaran
</p>

<a
href="{{ route('profile.rental.detail',$rental) }}"
class="btn btn-primary">

📄 Detail Pesanan

</a>

@if($rental->payment && $rental->payment->status=="Belum Bayar")

<a
href="{{ route('payment.show') }}"
class="btn btn-warning">

💳 Bayar

</a>

@endif

@if($rental->status=="selesai" && $rental->reviews->count()==0)

<a
href="{{ route('review.create',$rental) }}"
class="btn btn-success mt-2">

⭐ Beri Ulasan

</a>

@endif

</div>

</div>

</div>

</div>

@empty

<div class="alert alert-info">

Belum ada riwayat penyewaan.

</div>

@endforelse

</div>

</div>

</div>

</x-app-layout>