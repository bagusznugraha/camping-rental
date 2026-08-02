<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beri Ulasan - CampRent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4 class="mb-0">

                        ⭐ Beri Rating & Ulasan

                    </h4>

                </div>

                <div class="card-body">

                    <h5>

                        Penyewaan #{{ $rental->id }}

                    </h5>

                    <p>

                        Terima kasih telah menyewa di CampRent.

                    </p>

                    <hr>

                    <form action="{{ route('review.store', $rental) }}"
      method="POST"
      enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Rating

                            </label>

                            <select
                                name="rating"
                                class="form-select"
                                required>

                                <option value="">Pilih Rating</option>

                                <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>

                                <option value="4">⭐⭐⭐⭐ Puas</option>

                                <option value="3">⭐⭐⭐ Cukup</option>

                                <option value="2">⭐⭐ Kurang</option>

                                <option value="1">⭐ Sangat Buruk</option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Ulasan

                            </label>

                            <textarea
                                name="comment"
                                rows="5"
                                class="form-control"
                                placeholder="Bagaimana pengalaman Anda selama menyewa di CampRent?"
                                required></textarea>

                        </div>
                        <div class="mb-4">

    <label class="form-label">

        Foto Barang (Opsional)

    </label>

    <input
        type="file"
        name="photo"
        class="form-control"
        accept="image/*">

    <small class="text-muted">

        Upload foto perlengkapan yang Anda sewa (tidak wajib).

    </small>

</div>

                        <button class="btn btn-success">

                            Kirim Ulasan

                        </button>

                        <a
                            href="{{ route('profile.edit') }}"
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