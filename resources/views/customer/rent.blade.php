<!DOCTYPE html>
<html>
<head>

    <title>Sewa Alat Camping</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4>Form Penyewaan Alat Camping</h4>

                </div>

                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('rent.store') }}" method="POST">

                        @csrf

                        <input type="hidden"
                               name="equipment_id"
                               value="{{ $equipment->id }}">

                        <div class="mb-3">

                            <label>Nama Alat</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $equipment->name }}"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label>Kategori</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $equipment->category->name }}"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label>Harga / Hari</label>

                            <input
                                type="text"
                                class="form-control"
                                value="Rp {{ number_format($equipment->price,0,',','.') }}"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label>Stok Tersedia</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $equipment->stock }}"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label>Jumlah Sewa</label>

                            <input
                                type="number"
                                name="quantity"
                                class="form-control"
                                min="1"
                                max="{{ $equipment->stock }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Tanggal Sewa</label>

                            <input
                                type="date"
                                name="rental_date"
                                class="form-control"
                                required>

                        </div>

                        <div class="mb-3">

                            <label>Tanggal Kembali</label>

                            <input
                                type="date"
                                name="return_date"
                                class="form-control"
                                required>

                        </div>

                        <button class="btn btn-success">

                            Kirim Penyewaan

                        </button>

                        <a href="{{ route('customer.equipment') }}"
                           class="btn btn-secondary">

                            Kembali

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>