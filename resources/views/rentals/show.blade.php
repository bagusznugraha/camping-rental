@extends('layouts.admin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4 class="mb-0">
            Detail Penyewaan
        </h4>
    </div>

    <div class="card-body">

        <h5>Data Pelanggan</h5>

        <table class="table table-bordered">

            <tr>
                <th width="220">Nama</th>
                <td>{{ $rental->user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $rental->user->email }}</td>
            </tr>

            <tr>
                <th>No HP</th>
                <td>{{ $rental->phone }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $rental->address }}</td>
            </tr>

            <tr>
                <th>Metode Pengambilan</th>
                <td>

                    @if($rental->pickup_method == 'Diambil')

                        <span class="badge bg-primary">
                            Diambil Sendiri
                        </span>

                    @else

                        <span class="badge bg-success">
                            Dikirim
                        </span>

                    @endif

                </td>
            </tr>

            <tr>
                <th>Status Penyewaan</th>
                <td>

                    @switch($rental->status)

                        @case('menunggu')

                            <span class="badge bg-warning text-dark">
                                Menunggu
                            </span>

                            @break

                        @case('diproses')

                            <span class="badge bg-info">
                                Diproses
                            </span>

                            @break

                        @case('siap_diambil')

                            <span class="badge bg-success">
                                Siap Diambil
                            </span>

                            @break

                        @case('dikirim')

                            <span class="badge bg-primary">
                                Dikirim
                            </span>

                            @break
                                                    @case('dipinjam')

                            <span class="badge bg-dark">
                                Dipinjam
                            </span>

                            @break

                        @case('selesai')

                            <span class="badge bg-success">
                                Selesai
                            </span>

                            @break

                        @default

                            <span class="badge bg-secondary">
                                {{ ucfirst($rental->status) }}
                            </span>

                    @endswitch

                </td>
            </tr>

        </table>

        <hr>

        <h5>Daftar Barang</h5>

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>Foto</th>

                    <th>Nama</th>

                    <th>Jumlah</th>

                    <th>Harga / Hari</th>

                    <th>Subtotal</th>

                </tr>

            </thead>

            <tbody>

            @foreach($rental->rentalDetails as $detail)

                <tr>

                    <td width="90">

                        @if($detail->equipment->image)

                            <img
                                src="{{ asset('images/'.$detail->equipment->image) }}"
                                width="70"
                                class="rounded border">

                        @endif

                    </td>

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

        <div class="text-end">

            <h4>

                Total :
                Rp {{ number_format($rental->total_price,0,',','.') }}

            </h4>

        </div>

        <hr>

        <h5>Pembayaran</h5>

        <table class="table table-bordered">

            <tr>

                <th width="220">Metode</th>

                <td>

                    {{ $rental->payment->payment_method ?? '-' }}

                </td>

            </tr>

            <tr>
    <th>Jenis Pembayaran</th>
    <td>

        @if($rental->payment)

            @if($rental->payment->payment_type == 'deposit')

                <span class="badge bg-warning text-dark">
                    Deposit 10%
                </span>

            @elseif($rental->payment->payment_type == 'full')

                <span class="badge bg-success">
                    Bayar Lunas
                </span>

            @elseif($rental->payment->payment_type == 'remaining')

                <span class="badge bg-primary">
                    Pelunasan
                </span>

            @endif

        @endif

    </td>
</tr>

<tr>
    <th>Grand Total</th>
    <td>

        Rp {{ number_format($rental->grand_total,0,',','.') }}

    </td>
</tr>

<tr>
    <th>Nominal Dibayar</th>
    <td>

        @if($rental->payment)

            @if($rental->payment->payment_type == 'deposit')

                Rp {{ number_format($rental->deposit_amount,0,',','.') }}

            @elseif($rental->payment->payment_type == 'full')

                Rp {{ number_format($rental->grand_total,0,',','.') }}

            @elseif($rental->payment->payment_type == 'remaining')

                Rp {{ number_format($rental->payment->remaining_amount,0,',','.') }}

            @endif

        @endif

    </td>
</tr>

@if($rental->payment && $rental->payment->payment_type == 'deposit')

<tr>

    <th>Sisa Pelunasan</th>

    <td>

        Rp {{ number_format($rental->payment->remaining_amount,0,',','.') }}

    </td>

</tr>

@endif

            <tr>

                <th>Status Pembayaran</th>

                <td>

                    @if($rental->payment)

                        <span class="badge bg-info">

                            {{ $rental->payment->status }}

                        </span>

                    @else

                        -

                    @endif

                </td>

            </tr>

            <tr>
    <th>
    @if($rental->payment->payment_type == 'deposit')
        Bukti Transfer Deposit
    @else
        Bukti Transfer Pembayaran
    @endif
</th>

    <td>

        @if($rental->payment && $rental->payment->payment_proof)

            <a href="{{ asset('storage/'.$rental->payment->payment_proof) }}" target="_blank">

                <img
                    src="{{ asset('storage/'.$rental->payment->payment_proof) }}"
                    width="250"
                    class="img-thumbnail">

            </a>

        @else

            <span class="text-danger">
                Belum upload bukti deposit
            </span>

        @endif

    </td>

</tr>

@if($rental->payment && $rental->payment->remaining_payment_proof)

<tr>

    <th>Bukti Transfer Pelunasan</th>

    <td>

        <a href="{{ asset('storage/'.$rental->payment->remaining_payment_proof) }}" target="_blank">

            <img
                src="{{ asset('storage/'.$rental->payment->remaining_payment_proof) }}"
                width="250"
                class="img-thumbnail">

        </a>

    </td>

</tr>

@endif

        </table>

        @if($rental->payment)

    {{-- Menunggu Verifikasi --}}
    @if($rental->payment->status == 'Menunggu Verifikasi')

        <div class="mb-3 d-flex gap-2">

            <form action="{{ route('payments.approve',$rental->payment) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-success">
                    ✔ Terima Pembayaran
                </button>
            </form>

            <button
                class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#rejectModal">

                ✖ Tolak Pembayaran

            </button>

        </div>

    @endif

@endif

        <hr>
                {{-- Tombol Proses Penyewaan --}}

                <hr>

<h5 class="mb-3"></h5>

<div class="d-flex flex-wrap gap-2">

{{-- ===========================
1. VERIFIKASI / PROSES PENYEWAAN
=========================== --}}

@if($rental->status=='disetujui')

    @if($rental->payment->status=='Menunggu Verifikasi Pelunasan')

        <form action="{{ route('payments.approve',$rental->payment) }}" method="POST">
            @csrf
            @method('PUT')

            <button class="btn btn-primary">
                ✔ Verifikasi Pelunasan
            </button>

        </form>

    @elseif(
        in_array($rental->payment->status,[
            'Deposit Diterima',
            'Lunas',
            'Cash Saat Pengambilan'
        ])
    )

        <form action="{{ route('rentals.process',$rental) }}" method="POST">
            @csrf
            @method('PUT')

            <button class="btn btn-success">
                ✔ Proses Penyewaan
            </button>

        </form>

    @endif

@endif

{{-- ===========================
1. PROSES PENYEWAAN
=========================== --}}
{{-- 
@if(
    $rental->status == 'disetujui'
    &&
    $rental->payment->status == 'Lunas'
)

<form action="{{ route('rentals.process',$rental) }}" method="POST">
    @csrf
    @method('PUT')

    <button class="btn btn-success">
        ✔ Proses Penyewaan
    </button>

</form>

@endif

@if(
    $rental->status == 'disetujui'
    &&
    $rental->payment->status == 'Menunggu Verifikasi Pelunasan'
)

<form action="{{ route('payments.approve',$rental->payment) }}" method="POST">

    @csrf
    @method('PUT')

    <button class="btn btn-success">

        ✔ Verifikasi Pelunasan

    </button>

</form>

@endif

@if(
$rental->status=='disetujui'
&&
$rental->payment->status=='Menunggu Verifikasi Pelunasan'
)

<form action="{{ route('payments.approve',$rental->payment) }}" method="POST">

    @csrf
    @method('PUT')

    <button class="btn btn-primary">

        ✔ Verifikasi Pelunasan

    </button>

</form>

@endif
{{-- ===========================
2. SIAP DIAMBIL / KIRIM
=========================== --}}

@if($rental->status=='diproses')

    @if($rental->payment->status=='Menunggu Verifikasi Pelunasan')

    <div class="alert alert-info">

        <h5>⏳ Pelunasan Menunggu Verifikasi</h5>

        Pelanggan telah mengunggah bukti pelunasan.
        Silakan verifikasi pembayaran sebelum barang diproses lebih lanjut.

        <hr>

        <form action="{{ route('payments.approve',$rental->payment) }}" method="POST">

            @csrf
            @method('PUT')

            <button type="submit" class="btn btn-success">

                ✔ Verifikasi Pelunasan

            </button>

        </form>

    </div>

    @elseif(
        in_array($rental->payment->status,[
            'Lunas',
            'Cash Saat Pengambilan'
        ])
    )

        @if($rental->pickup_method=='Diambil')

            <form action="{{ route('rentals.pickup',$rental) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-primary">
                    📦 Barang Siap Diambil
                </button>

            </form>

        @else

            <form action="{{ route('rentals.ship',$rental) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-primary">
                    🚚 Barang Dikirim
                </button>

            </form>

        @endif

    @else

        <div class="alert alert-warning">

            ⏳ Barang sedang dipersiapkan.<br>
            Menunggu pelanggan melakukan pelunasan.

        </div>

    @endif

@endif

{{-- ===========================
2. SIAP DIAMBIL / KIRIM
=========================== --}}
{{-- 
@if($rental->status=='diproses')

    @if($rental->payment->status=='Menunggu Verifikasi Pelunasan')

        <div class="alert alert-info">

            ⏳ Pelanggan sudah mengupload bukti pelunasan.<br>

            Silakan verifikasi pembayaran pada menu Pembayaran.

        </div>

    @elseif(
        $rental->payment->status!='Lunas'
        &&
        $rental->payment->status!='Cash Saat Pengambilan'
    )

        <div class="alert alert-warning">

            ⏳ Barang sedang dipersiapkan.<br>

            Menunggu pelanggan melakukan pelunasan.

        </div>

    @else

        @if($rental->pickup_method=='Diambil')

            <form action="{{ route('rentals.pickup',$rental) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-primary">

                    📦 Barang Siap Diambil

                </button>

            </form>

        @else

            <form action="{{ route('rentals.ship',$rental) }}" method="POST">
                @csrf
                @method('PUT')

                <button class="btn btn-primary">

                    🚚 Barang Dikirim

                </button>

            </form>

        @endif

    @endif

@endif


{{-- ===========================
3. PELUNASAN CASH
=========================== --}}

@if(

$rental->payment->payment_type=='deposit'

&&

in_array($rental->payment->status,[
'Deposit Diterima',
'Cash Saat Pengambilan'
])

&&

in_array($rental->status,[
'siap_diambil',
'dikirim'
])

)

<form action="{{ route('payments.cash',$rental->payment) }}" method="POST">

    @csrf
    @method('PUT')

    <button
        class="btn btn-warning"
        onclick="return confirm('Pembayaran cash diterima?')">

        💵 Dibayar Cash

    </button>

</form>

@endif


{{-- ===========================
4. BARANG DISEWAKAN
=========================== --}}

@if(

(
$rental->status=='siap_diambil'
||
$rental->status=='dikirim'
)

&&

$rental->payment->status=='Lunas'

)

<form action="{{ route('rentals.start',$rental) }}" method="POST">
@csrf
@method('PUT')

<button class="btn btn-dark">
🚩 Barang Disewakan
</button>

</form>

@endif


{{-- ===========================
5. PENGEMBALIAN
=========================== --}}

@if($rental->status=='dipinjam')

<a
href="{{ route('returns.index') }}"
class="btn btn-success">

↩ Proses Pengembalian

</a>

@endif


{{-- ===========================
6. SELESAI
=========================== --}}

@if($rental->status=='selesai')

<span class="badge bg-success fs-6">

✅ Transaksi Selesai

</span>

@endif

</div>

    </div>

</div>

<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ route('payments.reject',$rental->payment) }}">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Tolak Pembayaran</h5>
                </div>

                <div class="modal-body">

                    <textarea
                        name="admin_note"
                        class="form-control"
                        rows="4"
                        placeholder="Alasan penolakan"
                        required></textarea>

                </div>

                <div class="modal-footer">

                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button class="btn btn-danger">
                        Tolak Pembayaran
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>

@endsection