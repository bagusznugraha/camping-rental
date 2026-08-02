<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CampRent') }}</title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body{

            font-family:'Figtree',sans-serif;

            background:
            linear-gradient(
            135deg,
            #e8f5e9 0%,
            #f8fff9 45%,
            #dcedc8 100%);

            min-height:100vh;

        }

        /* Header */

        header{

            background:white !important;

            border-bottom:1px solid #d9ead9;

        }

        /* Card */

        .card{

            border:none;

            border-radius:18px;

            overflow:hidden;

            box-shadow:0 8px 22px rgba(0,0,0,.08);

            transition:.3s;

        }

        .card:hover{

            transform:translateY(-4px);

            box-shadow:0 15px 35px rgba(0,0,0,.15);

        }

        .card-header{

            font-weight:600;

            border:none;

        }

        /* Button */

        .btn{

            border-radius:12px;

            font-weight:600;

        }

        /* Badge */

        .badge{

            padding:8px 15px;

            border-radius:20px;

            font-size:13px;

        }

        /* Table */

        .table{

            vertical-align:middle;

        }

        /* Alert */

        .alert{

            border-radius:12px;

        }

        /* Form */

        .form-control,
        .form-select{

            border-radius:10px;

        }

        .form-control:focus,
        .form-select:focus{

            box-shadow:0 0 0 .2rem rgba(25,135,84,.15);

            border-color:#198754;

        }

        /* Smooth */

        *{

            transition:.2s;

        }

    </style>

</head>

<body class="font-sans antialiased">

<div class="min-h-screen">

@include('layouts.navigation')

@if(isset($header))

<header class="shadow-sm">

<div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">

{{ $header }}

</div>

</header>

@endif

<main class="py-4">

{{ $slot }}

</main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>