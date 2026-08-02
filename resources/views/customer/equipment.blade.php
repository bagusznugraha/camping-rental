<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CampRent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .card-equipment{
            transition:.3s;
            border:none;
            border-radius:15px;
        }

        .card-equipment:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 20px rgba(0,0,0,.2);
        }

        .equipment-image{
            height:240px;
            object-fit:cover;
            border-radius:15px 15px 0 0;
        }

        .badge-stock{
            font-size:13px;
        }

        .summary-card{
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}
    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container">

        <a class="navbar-brand fw-bold"
            href="{{ route('customer.equipment') }}">

            🏕 CampRent

        </a>

        <div class="ms-auto">

            @auth

                <span class="text-white me-3">

                    Halo,

                    <strong>{{ auth()->user()->name }}</strong>

                </span>

                <a href="{{ route('profile.edit') }}"
                    class="btn btn-warning">

                    Profil

                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    <button class="btn btn-danger">

                        Logout

                    </button>

                </form>

            @else

                <a href="{{ route('login') }}"
                    class="btn btn-light">

                    Login

                </a>

            @endauth

        </div>

    </div>

</nav>

<div class="container mt-4">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('rent.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-lg-8">

<h3 class="mb-4">

🏕 Daftar Peralatan Camping

</h3>

<div class="row">

@foreach($equipments as $equipment)

<div class="col-md-6 mb-4">

<div class="card card-equipment shadow h-100">

@if($equipment->image)

<img
src="{{ asset('images/'.$equipment->image) }}"
class="equipment-image">

@endif

<div class="card-body">

<div class="form-check mb-3">

<input
class="form-check-input equipment-check"
type="checkbox"
name="equipment[]"
value="{{ $equipment->id }}"
id="alat{{ $equipment->id }}"
data-price="{{ $equipment->price }}">

<label
class="form-check-label fw-bold"
for="alat{{ $equipment->id }}">

{{ $equipment->name }}

</label>

</div>

<p class="mb-1">

<strong>Kategori</strong>

<br>

{{ $equipment->category->name }}

</p>

<p class="mb-2">

<strong>Spesifikasi</strong>

<br>

<h6 class="mt-3">
    
</h6>

@if($equipment->specification)

    <pre class="mb-3"
style="white-space:pre-wrap;font-family:inherit;">{{ $equipment->specification }}</pre>

@else

    <span class="text-muted">
        Belum ada spesifikasi.
    </span>

@endif
</p>

<p class="mb-1">

<strong>Harga / Hari</strong>

<br>

Rp {{ number_format($equipment->price,0,',','.') }}

</p>

<div class="row text-center mb-3">

    <div class="col-4">

        <div class="bg-success text-white rounded py-2">

            <small>Total Barang</small>

            <h6 class="mb-0">

                {{ $equipment->total_unit }}

            </h6>

        </div>

    </div>

    <div class="col-4">

        <div class="bg-primary text-white rounded py-2">

            <small>Stok Tersedia</small>

            <h6 class="mb-0">

                {{ $equipment->stock }}

            </h6>

        </div>

    </div>

    <div class="col-4">

        <div class="bg-danger text-white rounded py-2">

            <small>Dipinjam</small>

            <h6 class="mb-0">

                {{ $equipment->total_unit - $equipment->stock }}

            </h6>

        </div>

    </div>

</div>

<p class="mb-3">

<strong>Total Disewa :</strong>

{{ $equipment->rent_count }} kali

</p>

<label class="form-label">

Jumlah

</label>

<input
type="number"
class="form-control quantity"
name="quantity[{{ $equipment->id }}]"
value="1"
min="1"
max="{{ $equipment->stock }}">
</div>

</div>

</div>

@endforeach

</div>

</div>

<div class="col-lg-4">

    <div class="card shadow summary-card">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                📋 Form Penyewaan

            </h5>

        </div>

        <div class="mb-3">
    <label class="form-label">
        Tanggal Mulai Sewa
    </label>

    <input
        type="date"
        id="start_date"
        name="start_date"
        class="form-control"
        min="{{ date('Y-m-d') }}"
        required>
</div>

        <div class="card-body">

            <div class="mb-3">

                <label class="form-label">

                    Lama Sewa (Hari)

                </label>

                <input
                    type="number"
                    id="rental_days"
                    name="rental_days"
                    class="form-control"
                    min="1"
                    value="1"
                    required>

            </div>

            <div class="mb-3">
    <label class="form-label">
        Tanggal Kembali
    </label>

    <input
        type="text"
        id="return_date"
        class="form-control"
        readonly>
</div>

            
            <div class="mb-3">

                <label class="form-label">

                    Nomor WhatsApp

                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    placeholder="08xxxxxxxxxx"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Alamat Lengkap

                </label>

                <textarea
                    name="address"
                    class="form-control"
                    rows="3"
                    placeholder="Masukkan alamat lengkap..."
                    required></textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Metode Pengambilan

                </label>

                <select
                    name="pickup_method"
                    id="pickup_method"
                    class="form-select">

                    <option value="Diambil">

                        Diambil Sendiri

                    </option>

                    <option value="Dikirim">

                        Dikirim (+Rp20.000)

                    </option>

                </select>

            </div>

            <div class="mb-3">

    <label class="form-label fw-bold">

        Pilihan Pembayaran

    </label>

    <div class="form-check">

        <input
            class="form-check-input"
            type="radio"
            name="payment_type"
            value="deposit"
            checked>

        <label class="form-check-label">

            Pembayaran Awal (Deposit 10%)

        </label>

    </div>

    <div class="form-check">

        <input
            class="form-check-input"
            type="radio"
            name="payment_type"
            value="full">

        <label class="form-check-label">

            Bayar Lunas

        </label>

    </div>

</div>

            <div class="mb-3">

                <label class="form-label">

                    Metode Pembayaran

                </label>

                <select
                    name="payment_method"
                    class="form-select"
                    required>

                    <option value="Transfer Bank">

                        Transfer Bank

                    </option>

                    <option value="Dana">

                        DANA

                    </option>

                    <option value="OVO">

                        OVO

                    </option>

                    <option value="GoPay">

                        GoPay

                    </option>

                </select>

            </div>

            <hr>

            <h5>Ringkasan Penyewaan</h5>

            <table class="table">

                <tr>

                    <td>Total Barang</td>

                    <td class="text-end">

                        <span id="total_item">0</span>

                    </td>

                </tr>

                <tr>

                    <td>Total Sewa</td>

                    <td class="text-end">

                        Rp <span id="subtotal">0</span>

                    </td>

                </tr>

                <tr>

                    <td>Ongkir</td>

                    <td class="text-end">

                        Rp <span id="delivery_fee">0</span>

                    </td>

                </tr>

                <tr class="table-success">

                    <th>Grand Total</th>

                    <th class="text-end">

                        Rp <span id="grand_total">0</span>

                    </th>

                </tr>

                <tr>
    <td>Deposit (10%)</td>
    <td class="text-end">
        Rp <span id="deposit_amount">0</span>
    </td>
</tr>

<tr>
    <td>Sisa Pembayaran</td>
    <td class="text-end">
        Rp <span id="remaining_payment">0</span>
    </td>
</tr>

<tr class="table-warning">
    <th>Deadline Deposit</th>
    <th class="text-end">
        <span id="deposit_deadline">-</span>
    </th>
</tr>

            </table>

            <button class="btn btn-success btn-lg w-100">

                🛒 Lanjut Pembayaran

            </button>

        </div>

    </div>

</div>

</div>

</form>

{{-- ulasan dan rating --}}

<hr class="my-5">

<div class="card shadow border-0">

    <div class="card-header bg-warning text-dark">

    <div class="d-flex justify-content-between align-items-start">

        <div>

            <h4 class="mb-1">
                ⭐ Ulasan Pelanggan
            </h4>

            <div class="fs-5">

                <span class="text-warning">

                    ★★★★★

                </span>

                <strong>{{ $averageRating }}</strong>

                ({{ $reviews->count() }} Ulasan)

            </div>

        </div>

        <div class="text-end">

    <a href="#"
       class="text-dark text-decoration-none"
       data-bs-toggle="modal"
       data-bs-target="#viewStatsModal">

        👁️ {{ number_format($totalViews ?? 0) }} kali dilihat

    </a>

</div>

    </div>

</div>

    <div class="card-body">

        @forelse($reviews as $review)

        <div class="card mb-4 shadow-sm border">

            <div class="card-body">

                {{-- HEADER --}}
                <div class="d-flex justify-content-between">

                    <div>

                        <h5 class="mb-1">

                            👤 {{ $review->user->name }}

                        </h5>

                        <small class="text-muted">

                            {{ $review->created_at->format('d F Y') }}

                        </small>

                    </div>

                    <div class="text-end">

                        @for($i=1;$i<=5;$i++)

                            @if($i <= $review->rating)

                                <span class="text-warning fs-4">★</span>

                            @else

                                <span class="text-secondary fs-4">☆</span>

                            @endif

                        @endfor

                    </div>

                </div>

                <hr>

                {{-- BARANG YANG DISEWA --}}
                <h6 class="fw-bold mb-3">

                    🏕 Barang yang Disewa

                </h6>

                @foreach($review->rental->rentalDetails as $detail)

                <div class="d-flex align-items-center border rounded p-2 mb-2">

                    {{-- FOTO BARANG --}}
                    <div style="width:80px;">

                        @if($detail->equipment->image)

                            <img
                                src="{{ asset('images/'.$detail->equipment->image) }}"
                                class="img-fluid rounded border"
                                style="width:70px;height:70px;object-fit:cover;">

                        @else

                            <img
                                src="https://via.placeholder.com/70"
                                class="img-fluid rounded">

                        @endif

                    </div>

                    {{-- NAMA --}}
                    <div class="ms-3 flex-grow-1">

                        <strong>

                            {{ $detail->equipment->name }}

                        </strong>

                        <br>

                        <small class="text-muted">

                            Jumlah :
                            {{ $detail->quantity }}

                            unit

                        </small>

                    </div>

                </div>

                @endforeach

                <hr>

                {{-- KOMENTAR --}}
                <h6 class="fw-bold">

                    💬 Ulasan

                </h6>

                <p class="mb-3">

                    {{ $review->comment }}

                </p>

                {{-- FOTO REVIEW --}}
                @if($review->photo)

                <div class="mt-3">

                    <strong>📷 Foto dari Penyewa</strong>

                    <br><br>

                    <img
                        src="{{ asset('review/'.$review->photo) }}"
                        class="img-fluid rounded shadow"
                        style="max-width:320px;">

                </div>

                @endif

            </div>

        </div>

        @empty

        <div class="alert alert-info text-center">

            <h5>

                Belum ada ulasan pelanggan.

            </h5>

            Jadilah pelanggan pertama yang memberikan ulasan.

        </div>

        @endforelse

    </div>

</div>

<!-- Modal Statistik Kunjungan -->
<div class="modal fade" id="viewStatsModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">
                    📊 Statistik Kunjungan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <div class="row text-center">

                    <div class="col-4">

                        <h4 class="text-success">
                            {{ $todayViews }}
                        </h4>

                        <small>📅 Hari Ini</small>

                    </div>

                    <div class="col-4">

                        <h4 class="text-primary">
                            {{ $weekViews }}
                        </h4>

                        <small>📆 Minggu Ini</small>

                    </div>

                    <div class="col-4">

                        <h4 class="text-warning">
                            {{ $monthViews }}
                        </h4>

                        <small>🗓️ Bulan Ini</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script>

const checks = document.querySelectorAll('.equipment-check');
const qtys = document.querySelectorAll('.quantity');

const rentalDays = document.getElementById('rental_days');
const pickupMethod = document.getElementById('pickup_method');

const startDate = document.getElementById('start_date');
const returnDate = document.getElementById('return_date');

function formatRupiah(angka){
    return angka.toLocaleString('id-ID');
}

function hitungTotal(){

    let totalItem = 0;
    let subtotal = 0;

    checks.forEach(function(check){

        if(check.checked){

            const id = check.value;

            const qty = parseInt(
                document.querySelector(
                    `input[name="quantity[${id}]"]`
                ).value
            ) || 1;

            const harga = parseInt(check.dataset.price);

            totalItem += qty;

            subtotal += harga * qty * parseInt(rentalDays.value);

        }

    });

    let ongkir = 0;

    if(pickupMethod.value === 'Dikirim'){
        ongkir = 20000;
    }

    const grandTotal = subtotal + ongkir;

    const deposit = Math.ceil(grandTotal * 0.10);

    const sisa = grandTotal - deposit;

    document.getElementById('total_item').innerHTML = totalItem;
    document.getElementById('subtotal').innerHTML = formatRupiah(subtotal);
    document.getElementById('delivery_fee').innerHTML = formatRupiah(ongkir);
    document.getElementById('grand_total').innerHTML = formatRupiah(grandTotal);

    document.getElementById('deposit_amount').innerHTML = formatRupiah(deposit);

    document.getElementById('remaining_payment').innerHTML = formatRupiah(sisa);

    if(startDate.value){

        let mulai = new Date(startDate.value);

        let kembali = new Date(mulai);

        kembali.setDate(
            kembali.getDate() + parseInt(rentalDays.value)
        );

        returnDate.value = kembali.toLocaleDateString('id-ID');

        let deadline = new Date(mulai);

        deadline.setDate(
            deadline.getDate() - 2
        );

        document.getElementById('deposit_deadline').innerHTML =
            deadline.toLocaleDateString('id-ID');

    }else{

        returnDate.value = '';

        document.getElementById('deposit_deadline').innerHTML='-';

    }

}

checks.forEach(function(item){
    item.addEventListener('change', hitungTotal);
});

qtys.forEach(function(item){
    item.addEventListener('input', hitungTotal);
});

pickupMethod.addEventListener('change', hitungTotal);

rentalDays.addEventListener('input', hitungTotal);

startDate.addEventListener('change', hitungTotal);

window.onload = hitungTotal;

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>