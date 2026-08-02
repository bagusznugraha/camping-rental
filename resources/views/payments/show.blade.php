@extends('layouts.admin')

@section('content')

<h1 style="color:red">
INI FILE payments/show.blade.php
</h1>

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Detail Pembayaran
        </h4>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="row">

            <div class="col-md-8">

                <div class="card mb-3">

                    <div class="card-header bg-primary text-white">

                        Data Penyewaan

                    </div>

                    <div class="card-body">

                        <table class="table">

                        <tr>

    <th width="220">

        Kode Penyewaan

    </th>

    <td>

        #{{ $payment->rental->id }}

    </td>

</tr>

                            <tr>
                                <th width="220">Nama Pelanggan</th>
                                <td>{{ $payment->rental->user->name }}</td>
                            </tr>

                            <tr>
                                <th>No WhatsApp</th>
                                <td>{{ $payment->rental->phone }}</td>
                            </tr>

                            <tr>
                                <th>Alamat</th>
                                <td>{{ $payment->rental->address }}</td>
                            </tr>

                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>{{ $payment->payment_method }}</td>
                            </tr>

                            <tr>
                                <th>Total Pembayaran</th>
                                <td>

                                    Rp {{ number_format($payment->amount,0,',','.') }}

                                </td>
                            </tr>

                            <tr>

    <th>Jenis Pembayaran</th>

    <td>

        @if($payment->payment_type=='deposit')

            <span class="badge bg-warning">

                Deposit

            </span>

        @elseif($payment->payment_type=='remaining')

            <span class="badge bg-info">

                Pelunasan

            </span>

        @else

            <span class="badge bg-success">

                Bayar Lunas

            </span>

        @endif

    </td>

</tr>

<tr>

    <th>Sudah Dibayar</th>

    <td>

        Rp {{ number_format($payment->amount_paid,0,',','.') }}

    </td>

</tr>

<tr>

    <th>Sisa Pembayaran</th>

    <td>

        Rp {{ number_format($payment->remaining_amount,0,',','.') }}

    </td>

</tr>

@if($payment->payment_type=='deposit')

<tr>

    <th>Batas Bayar Deposit</th>

    <td>

        <span class="badge bg-danger">

            {{ \Carbon\Carbon::parse($payment->deposit_deadline)->format('d M Y') }}

        </span>

    </td>

</tr>

@endif

<tr>

    <th>Status</th>

    <td>

        @if($payment->status=="Belum Bayar")

            <span class="badge bg-secondary">

                Belum Bayar

            </span>

        @elseif($payment->status=="Menunggu Verifikasi")

            <span class="badge bg-warning">

                Menunggu Verifikasi Deposit

            </span>

        @elseif($payment->status=="Menunggu Verifikasi Pelunasan")

            <span class="badge bg-primary">

                Menunggu Verifikasi Pelunasan

            </span>

        @elseif($payment->status=="Deposit Diterima")

            <span class="badge bg-success">

                Deposit Diterima

            </span>

            @elseif($payment->status=="Cash Saat Pengambilan")

    <span class="badge bg-dark">

        Cash Saat Pengambilan

    </span>

        @elseif($payment->status=="Lunas")

            <span class="badge bg-success">

                Lunas

            </span>

        @elseif($payment->status=="Ditolak")

            <span class="badge bg-danger">

                Ditolak

            </span>

        @endif

    </td>

</tr>

                        </table>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header bg-info text-white">

                        Barang Yang Disewa

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <thead class="table-light">

                                <tr>

                                    <th>Nama Barang</th>

                                    <th>Jumlah</th>

                                    <th>Subtotal</th>

                                </tr>

                            </thead>

                            <tbody>

                            @foreach($payment->rental->rentalDetails as $detail)

                                <tr>

                                    <td>{{ $detail->equipment->name }}</td>

                                    <td>{{ $detail->quantity }}</td>

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

            <div class="col-md-4">

                <div class="card mb-3">

    <div class="card-header bg-warning">

    @if($payment->payment_type=='deposit')

        Bukti Transfer Deposit

    @elseif($payment->payment_type=='remaining')

        Bukti Transfer Pelunasan

    @else

        Bukti Transfer Pembayaran Lunas

    @endif

</div>

    <div class="card-body text-center">

        @if($payment->payment_proof)

            <img
                src="{{ asset('storage/'.$payment->payment_proof) }}"
                class="img-fluid rounded mb-3">

        @else

            <div class="alert alert-secondary">

                Belum ada bukti pembayaran.

            </div>

        @endif

    </div>

</div>

@if($payment->remaining_payment_proof)

<div class="card mb-3">

    <div class="card-header bg-info text-white">

        Bukti Pelunasan

    </div>

    <div class="card-body text-center">

        <img
            src="{{ asset('storage/'.$payment->remaining_payment_proof) }}"
            class="img-fluid rounded">

    </div>

</div>

@endif

<div class="alert alert-danger">
Status :
{{ $payment->status }}

<br>

Jenis :
{{ $payment->payment_type }}
</div>

                

@if(

$payment->status=='Menunggu'

||

$payment->status=='Menunggu Verifikasi'

||

$payment->status=='Menunggu Verifikasi Pelunasan'

||

$payment->status=='Cash Saat Pengambilan'

)



                <div class="card">

                    <div class="card-body">

                        <form action="{{ route('payments.approve',$payment) }}"
                              method="POST">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-success w-100 mb-3">

@if($payment->payment_type=='deposit')

    ✔ Verifikasi Deposit

@elseif($payment->payment_type=='remaining')

    ✔ Verifikasi Pelunasan

@else

    ✔ Verifikasi Pembayaran Lunas

@endif

</button>

                        </form>

                        
                        <form action="{{ route('payments.reject',$payment) }}"
                              method="POST">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">

                                <label>Alasan Penolakan</label>

                                <textarea
                                    name="admin_note"
                                    class="form-control"
                                    rows="3"
                                    required></textarea>

                            </div>

                            <button class="btn btn-danger w-100">

                                ✖ Tolak Pembayaran

                            </button>

                        </form>

                    </div>

                </div>

                @else

                <div class="alert alert-success text-center">

@if($payment->status=='Lunas')

✅ Pembayaran telah lunas.

@elseif($payment->status=='Deposit Diterima')

✅ Deposit telah diterima.

@elseif($payment->status=='Ditolak')

❌ Pembayaran ditolak.

@else

Pembayaran sudah diproses.

@endif

</div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection