<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pembayaran - CampRent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success shadow">

    <div class="container">

        <a class="navbar-brand fw-bold"
            href="{{ route('customer.equipment') }}">

            🏕 CampRent

        </a>

        <a href="{{ route('customer.equipment') }}"
           class="btn btn-light">

            Kembali

        </a>

    </div>

</nav>

<div class="container py-4">

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

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        Detail Penyewaan

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table">

    <tr>
        <th width="220">Kode Penyewaan</th>
        <td>#{{ $rental->id }}</td>
    </tr>

    <tr>
        <th>Tanggal Sewa</th>
        <td>
            {{ \Carbon\Carbon::parse($rental->rental_date)->format('d M Y') }}
        </td>
    </tr>

    <tr>
        <th>Tanggal Kembali</th>
        <td>
            {{ \Carbon\Carbon::parse($rental->return_date)->format('d M Y') }}
        </td>
    </tr>

    <tr>
        <th>Batas Bayar Deposit</th>
        <td>
            <span class="badge bg-danger">
                {{ \Carbon\Carbon::parse($rental->deposit_deadline)->format('d M Y') }}
            </span>
        </td>
    </tr>

    <tr>
        <th>Lama Sewa</th>
        <td>{{ $rental->rental_days }} Hari</td>
    </tr>

    <tr>
        <th>Nomor HP</th>
        <td>{{ $rental->phone }}</td>
    </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $rental->address }}</td>
                        </tr>

                        <tr>
                            <th>Metode Pengambilan</th>
                            <td>{{ $rental->pickup_method }}</td>
                        </tr>

                    </table>

                </div>

            </div>

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

                            <td>{{ $detail->equipment->name }}</td>

                            <td>{{ $detail->quantity }}</td>

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

        </div>

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-warning">

                    <strong>Pembayaran</strong>

                </div>

                <div class="card-body">

                    <h5 class="mb-3">Ringkasan Pembayaran</h5>

<table class="table">

    <tr>
        <td>Total Sewa</td>
        <td class="text-end">
            Rp {{ number_format($rental->total_price,0,',','.') }}
        </td>
    </tr>

    <tr>
        <td>Ongkir</td>
        <td class="text-end">
            Rp {{ number_format($rental->delivery_fee,0,',','.') }}
        </td>
    </tr>

    <tr class="table-light">
        <th>Grand Total</th>
        <th class="text-end">
            Rp {{ number_format($rental->grand_total,0,',','.') }}
        </th>
    </tr>

</table>

<hr>

@if($rental->payment->payment_type == 'deposit')

<div class="alert alert-warning">

    <h5>Metode Pembayaran</h5>

    Deposit 10%

    <hr>

    <strong>Jumlah Deposit</strong>

    <h3 class="text-danger">

        Rp {{ number_format($rental->deposit_amount,0,',','.') }}

    </h3>

</div>

@else

<div class="alert alert-success">

    <h5>Metode Pembayaran</h5>

    Bayar Lunas

</div>

@endif

@if($rental->payment->remaining_amount > 0)

<div class="alert alert-success">

<strong>Sisa Pelunasan</strong>

<h4>

Rp {{ number_format($rental->payment->remaining_amount,0,',','.') }}

</h4>

Dibayar sebelum barang diterima.

</div>

@endif

@if($rental->payment->payment_type=='deposit')

<div class="alert alert-danger">

<strong>Batas Pembayaran Deposit</strong>

<br>

{{ \Carbon\Carbon::parse($rental->deposit_deadline)->format('d M Y') }}

<hr>

Jika melewati tanggal tersebut,
pesanan otomatis dibatalkan.

</div>

@endif

                    <h5>Transfer Ke</h5>

                    <div class="alert alert-info">

                        <strong>Bank BRI</strong><br>

                        1234567890<br>

                        a.n CampRent

                    </div>

                    <div class="alert alert-success">

                        <strong>DANA</strong><br>

                        081234567890

                    </div>

                    @if($rental->payment)

                        <div class="alert alert-secondary">

@if($rental->payment->status=="Belum Bayar")

<span class="badge bg-secondary">Belum Bayar</span>

@elseif($rental->payment->status=="Menunggu Verifikasi")

<span class="badge bg-warning">

Menunggu Verifikasi

</span>

@elseif($rental->payment->status=="Deposit Diterima")

<span class="badge bg-success">

Deposit Diterima

</span>

@elseif($rental->payment->status=="Lunas")

<span class="badge bg-primary">

Lunas

</span>

@elseif($rental->payment->status=="Ditolak")

<span class="badge bg-danger">

Ditolak

</span>

@endif

                    @if($rental->payment->status == 'Belum Bayar')

<form
action="{{ route('payment.upload',$rental) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label class="form-label">

@if($rental->payment->payment_type=='deposit')

Upload Bukti Deposit

@else

Upload Bukti Pelunasan

@endif

</label>

<input
type="file"
name="payment_proof"
class="form-control"
required>

</div>

<button class="btn btn-success w-100">

@if($rental->payment->payment_type=='deposit')

Bayar Deposit

@else

Bayar Lunas

@endif

</button>

</form>

@elseif($rental->payment->status=='Menunggu Verifikasi')

<div class="alert alert-warning">

🟡 Bukti pembayaran sedang diverifikasi Admin.

</div>

@elseif($rental->payment->status=='Ditolak')

<div class="alert alert-danger">

❌ Pembayaran ditolak.

Silakan upload ulang.

</div>

<form
action="{{ route('payment.upload',$rental) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<input
type="file"
name="payment_proof"
class="form-control mb-3"
required>

<button class="btn btn-danger w-100">

Upload Ulang

</button>

</form>

@elseif($rental->payment->status=='Deposit Diterima')

<div class="alert alert-success">

✅ Deposit diterima.

</div>

@if($rental->payment->remaining_amount > 0)

<div class="alert alert-primary">

<strong>Jumlah Pelunasan</strong>

<h4>

Rp {{ number_format($rental->payment->remaining_amount,0,',','.') }}

</h4>

Silakan lakukan pelunasan sebelum barang diterima.

</div>

<form
action="{{ route('payment.uploadRemaining',$rental) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label class="form-label">

Upload Bukti Pelunasan

</label>

<input
type="file"
name="payment_proof"
class="form-control"
required>

</div>

<button class="btn btn-primary w-100">

Bayar Pelunasan

</button>

</form>

@endif

@elseif($rental->payment->status=='Lunas')

<div class="alert alert-success">
    ✅ Pembayaran telah lunas.
</div>

@endif   {{-- menutup if status --}}

@endif   {{-- menutup if($rental->payment) --}}

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>