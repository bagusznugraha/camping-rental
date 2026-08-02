<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - CampRent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

            background:linear-gradient(rgba(0,0,0,.45),rgba(0,0,0,.45)),
            url("https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80");

            background-size:cover;
            background-position:center;
            min-height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

            padding:30px;

        }

        .register-card{

            width:500px;

            background:rgba(255,255,255,.95);

            border:none;

            border-radius:20px;

            box-shadow:0 20px 40px rgba(0,0,0,.25);

            padding:35px;

        }

    </style>

</head>

<body>

<div class="register-card">

    <div class="text-center mb-4">

        <h2 class="fw-bold text-success">

            🏕 CampRent

        </h2>

        <p class="text-muted">

            Buat Akun Baru

        </p>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">

                Nama Lengkap

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Email

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Password

            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Konfirmasi Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>

        </div>

        <button class="btn btn-success w-100">

            Register

        </button>

    </form>

    <hr>

    <div class="text-center">

        Sudah punya akun?

        <a href="{{ route('login') }}">

            Login

        </a>

    </div>

    <div class="text-center mt-3">

        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm">

            ← Kembali ke Beranda

        </a>

    </div>

</div>

</body>

</html>