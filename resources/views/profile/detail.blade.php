<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl">
📦 Detail Pesanan
</h2>
</x-slot>

<div class="py-4">

<div class="container">

<div class="card shadow">

<div class="card-header bg-success text-white">

Informasi Penyewaan

</div>

<div class="card-body">

<table class="table">

<tr>
<th width="220">Kode Pesanan</th>
<td>#{{ $rental->id }}</td>
</tr>

<tr>
<th>Tanggal Sewa</th>
<td>{{ $rental->rental_date }}</td>
</tr>

@if($rental->return_date)

<tr>

    <th>Tanggal Kembali</th>

    <td>

        {{ $rental->return_date }}

    </td>

</tr>

@endif

<tr>
<th>Status</th>
<td>{{ $rental->status }}</td>
</tr>

<tr>
<th>Total Pembayaran</th>
<td>

Rp {{ number_format($rental->grand_total,0,',','.') }}

</td>
</tr>

<tr>
    <th>Status Pembayaran</th>
    <td>

        {{ $rental->payment->status }}

        <pre>
Status : {{ $rental->payment->status }}
Type   : {{ $rental->payment->payment_type }}
</pre>

        @if($rental->payment->status == 'Ditolak')

            <div class="alert alert-danger mt-3 mb-0">

                <strong>❌ Pembayaran Ditolak</strong>

                <hr>

                <strong>Alasan Admin :</strong><br>

                {{ $rental->payment->admin_note }}

            </div>

        @endif

    </td>
</tr>

@if($rental->late_fee > 0)

<tr>

    <th>Denda Keterlambatan</th>

    <td>

        <span class="text-danger fw-bold">

            Rp {{ number_format($rental->late_fee,0,',','.') }}

        </span>

        <br>

        Terlambat {{ $rental->late_days }} hari

    </td>

</tr>

<tr>

    <th>Status Denda</th>

    <td>

        @if($rental->late_fee_status == 'Belum Dibayar')

            <span class="badge bg-danger">

                Belum Dibayar

            </span>

        @else

            <span class="badge bg-success">

                Lunas

            </span>

        @endif

    </td>

</tr>

@endif

</table>

</div>

</div>

<br>

<div class="card shadow">

<div class="card-header bg-primary text-white">

Barang Yang Disewa

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Barang</th>

<th>Jumlah</th>

<th>Harga</th>

<th>Subtotal</th>

</tr>

</thead>

<tbody>

@foreach($rental->rentalDetails as $detail)

<tr>

<td>

{{ $detail->equipment->name }}

</td>

<td>

{{ $detail->quantity }}

</td>

<td>

Rp {{ number_format($detail->price,0,',','.') }}

</td>

<td>

Rp {{ number_format($detail->subtotal,0,',','.') }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@if($rental->payment->status=='Belum Bayar')

<br>

<a
href="{{ route('payment.show') }}"
class="btn btn-warning">

Lanjut Pembayaran

</a>

@endif

@if($rental->payment->status == 'Ditolak')

<br>

@if($rental->payment->payment_type == 'deposit')

<div class="alert alert-warning">

    Silakan upload ulang bukti pembayaran deposit.

</div>

<form
    action="{{ route('payment.upload',$rental) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <label class="form-label">

            Upload Bukti Transfer Baru

        </label>

        <input
            type="file"
            name="payment_proof"
            class="form-control"
            required>

    </div>

    <button class="btn btn-warning">

        🔄 Upload Ulang Deposit

    </button>

</form>

@elseif(
    in_array($rental->payment->payment_type, ['full', 'remaining'])
)

<div class="alert alert-warning">

    Silakan upload ulang bukti pelunasan.

</div>

<form
    action="{{ route('payment.uploadRemaining',$rental) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <label class="form-label">

            Upload Bukti Pelunasan Baru

        </label>

        <input
            type="file"
            name="payment_proof"
            class="form-control"
            required>

    </div>

    <button class="btn btn-warning">

        🔄 Upload Ulang Pelunasan

    </button>

</form>

@endif

@endif

@if(
    $rental->payment
    && $rental->payment->payment_type == 'deposit'
    && $rental->payment->status == 'Deposit Diterima'
)

<br><br>

<div class="alert alert-warning">

    <strong>Pelunasan Diperlukan</strong><br>

    Deposit Anda telah diterima.

    Silakan upload bukti pelunasan sebelum barang dapat
    diambil atau dikirim.

</div>

<a
href="{{ route('payment.show') }}"
class="btn btn-success">

💳 lakukan Pelunasan

</a>

@endif

@if(
    $rental->pickup_method == 'Diambil'
    &&
    $rental->payment->payment_type == 'deposit'
    &&
    $rental->payment->status == 'Deposit Diterima'
)

<form action="{{ route('payment.cashRequest',$rental) }}" method="POST">

    @csrf

    <button class="btn btn-dark">

        💵 Bayar Cash Saat Pengambilan

    </button>

</form>

@endif

@if($rental->is_finished && $rental->reviews->count()==0)

<a href="{{ route('review.create',$rental) }}"
   class="btn btn-success">

⭐ Beri Rating & Ulasan

</a>

@endif

<a
href="{{ route('profile.edit') }}"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</x-app-layout>