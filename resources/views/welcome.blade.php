<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CampRent</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{

            background:linear-gradient(rgba(0,0,0,.45),rgba(0,0,0,.45)),
            url("https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80");

            background-size:cover;

            background-position:center;

            height:100vh;

            color:white;

        }

        .hero{

            height:100vh;

            display:flex;

            align-items:center;

        }

        .card-custom{

            background:rgba(255,255,255,.12);

            backdrop-filter:blur(10px);

            border:none;

            border-radius:20px;

            padding:50px;

        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container">

        <a class="navbar-brand fw-bold fs-3" href="#">

            🏕 CampRent

        </a>

        <div>

            @auth

                @if(auth()->user()->role=='admin')

                    <a href="{{ route('dashboard') }}" class="btn btn-success">

                        Dashboard

                    </a>

                @else

                    <a href="{{ route('customer.equipment') }}" class="btn btn-success">

                        Mulai Sewa

                    </a>

                @endif

            @else

                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">

                    Login

                </a>

                <a href="{{ route('register') }}" class="btn btn-success">

                    Register

                </a>

            @endauth

        </div>

    </div>

</nav>

<div class="container hero">

    <div class="row w-100">

        <div class="col-lg-7">

            <div class="card-custom">

                <h1 class="display-3 fw-bold">

                    CAMPRENT

                </h1>

                <h3 class="mb-4">

                    Sistem Rental Alat Camping

                </h3>

                <p class="lead">

                    Sewa tenda, carrier, sleeping bag, kompor, lampu camping,

                    dan berbagai perlengkapan outdoor dengan mudah,

                    cepat, aman, dan terpercaya.

                </p>

                <div class="mt-4">

                    @auth

                        @if(auth()->user()->role=='admin')

                            <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg">

                                Dashboard Admin

                            </a>

                        @else

                            <a href="{{ route('customer.equipment') }}" class="btn btn-success btn-lg">

                                Sewa Sekarang

                            </a>

                        @endif

                    @else

                        <a href="{{ route('login') }}" class="btn btn-success btn-lg">

                            Mulai Sekarang

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>